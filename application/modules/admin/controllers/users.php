<?php
class Users extends CI_Controller{
	var $data = array();
	function __construct(){
		parent::__construct();
		$auth = $this->session->userdata('auth');
		$this->data['module'] = strtolower($this->uri->segment(1));
		if(!$auth || $auth->usertype != 'administrator')  //kiem tra session
		{
			redirect($this->data['module'].'/auth/login?url='.base64_encode(current_url()));
		}else{
			$this->layout->setLayout('ad_layout');
			$this->load->model('users_model');
			$this->load->model('usergroups_model');
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower(__CLASS__);
			
		}
	}
	function index(){
		try {
            //ham
			$this->data['action'] = strtolower(__FUNCTION__);
            //
			$this->data['update'] = $this->input->get('update');
			// init pagination with parameters
			$key =$this->input->get('s');
			$config['base_url'] = site_url().$this->data['module'].'/'.strtolower(__CLASS__)."/".strtolower(__FUNCTION__).'?s='.$key;
						// xác định trang phân trang
			$config['num_links'] = 3;
			$config['per_page'] = 10;   // x/đ số record mỗi trang
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->users_model->count($key);
			$this->pagination->initialize($config);      //phân trang 
			// load data with parameters 
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->users_model->getlist($key,$offset,$config['per_page']);
			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function delete(){
		try {
			$id = $this->input->post('list');  //dấu check chọn phần tử muốn xóa
			if(!empty($id)){
				foreach ($id as $row):
				$this->users_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);  //ko check mà gõ xóa id trên thanh trình duyệt, 
				if (!empty($id)) $this->users_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function add(){
		try {
			$this->data['usergroups'] = $this->usergroups_model->get();
			$this->data['action'] = strtolower(__FUNCTION__);
			$input = $this->input->post();
			//------------------
			if (!$input){
				$this->layout->view($this->data['controller'].'/modify',$this->data);
			} else {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[100]|callback_validusername_check');
				$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[3]|max_length[100]');
				$this->form_validation->set_rules('pwd', 'Password', 'required|min_length[8]|max_length[100]|matches[conf_pwd]|md5');
				$this->form_validation->set_rules('conf_pwd', 'Confirm Password', 'required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|callback_validemail_check');
				$this->form_validation->set_rules('phone', 'Phone', 'trim');
				$this->form_validation->set_rules('role', 'Role', 'required');
				$this->form_validation->set_rules('status', 'status', 'required');
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('id'=>null,
						'username'=>$input['username'],
						'name' => $input['fullname'],
						'password' => md5($input['pwd']),
						'email' => $input['email'],
						'phone' => $input['phone'],
						'usertype' => $input['role'],
						'status' => $input['status'],
						'created' => $date
					);
					//---------------------
					if($_FILES['avatar']['name']){
						$config['upload_path'] = './upload/users';
						if (!file_exists($config['upload_path'])) {
							mkdir($config['upload_path']);
						}
						if (!file_exists($config['upload_path'].'/thumb')) {
							mkdir($config['upload_path'].'/thumb');
						}
						$config['allowed_types'] = 'jpg|png|jpeg';
						$config['encrypt_name'] = TRUE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						//-------------------
						
						$upload_data = null;
						if (!$this->upload->do_upload("avatar"))
						{
							$this->data['error'] = $this->upload->display_errors();
						} else {
							$upload_data =  $this->upload->data();
							$this->data['value']['avatar'] = $upload_data['file_name'];
							// thumbnail
							$this->load->library('image_lib');
							$iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2
							$iconfig['maintain_ratio'] = TRUE;
							$iconfig['width']     = 128;
							$iconfig['height']    = 128;
							$iconfig['source_image']= $upload_data['full_path'];
							$this->image_lib->initialize($iconfig);
							if ( !$this->image_lib->resize())
							{
								$this->data['error'] = $this->upload->display_errors();
							}
							$iconfig['create_thumb'] = TRUE;
							$iconfig['width']     = 48;
							$iconfig['height']    = 48;
							$iconfig['new_image'] = $config['upload_path']."/thumb";
							$this->image_lib->initialize($iconfig);
							if ( ! $this->image_lib->resize())
							{
								$this->data['error'] = $this->upload->display_errors();
							}
						}
					}
					if(!empty($this->data['error'])){
						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
					} else {
						$this->users_model->add($this->data['value']);
						redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=add");
					}
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function edit(){
		try {
			$id = $this->uri->segment(4);
			if (isset($id)){
				$this->data['usergroups'] = $this->usergroups_model->get();
				$this->data['user_info'] = $this->users_model->getbyid($id);
				$this->data['action'] = strtolower(__FUNCTION__);
				$input = $this->input->post();
				//----------------------
				if (empty($input)){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$this->form_validation->set_rules('username', 'Username', 'trim');
					$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|min_length[3]|max_length[100]');
					$this->form_validation->set_rules('pwd', 'pwd', 'matches[conf_pwd]');
					$this->form_validation->set_rules('conf_pwd', 'Confirm Password', '');
					$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
					$this->form_validation->set_rules('phone', 'Phone', 'trim');
					$this->form_validation->set_rules('role', 'Role', 'required');
					$this->form_validation->set_rules('status', 'status', 'required');
					if($this->form_validation->run()== FALSE){
						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
					} else {
						$date = date("Y-m-d H:i:s");
						$this->data['value'] = array('name' => $input['fullname'],
													'email' => $input['email'],
													'phone' => $input['phone'],
													'usertype' => $input['role'],
													'status' => $input['status'],
													'created' => $date							
						);
						//---------------------
						if($_FILES['avatar']['name']){
							$config['upload_path'] = './upload/users';
							if (!file_exists($config['upload_path'])) {
								mkdir($config['upload_path']);
							}
							if (!file_exists($config['upload_path'].'/thumb')) {
								mkdir($config['upload_path'].'/thumb');
							}
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['encrypt_name'] = TRUE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							//-------------------
							
							$upload_data = null;
							if (!$this->upload->do_upload("avatar"))
							{
								$this->data['error'] = $this->upload->display_errors();
							} else {
								$upload_data =  $this->upload->data();
								$this->data['value']['avatar'] = $upload_data['file_name'];
								// thumbnail
								$this->load->library('image_lib');
								$iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2
								$iconfig['maintain_ratio'] = TRUE;
								$iconfig['width']     = 128;
								$iconfig['height']    = 128;
								$iconfig['source_image']= $upload_data['full_path'];
								$this->image_lib->initialize($iconfig);
								if ( !$this->image_lib->resize())
								{
									$this->data['error'] = $this->upload->display_errors();
								}
								$iconfig['create_thumb'] = TRUE;
								$iconfig['width']     = 48;
								$iconfig['height']    = 48;
								$iconfig['new_image'] = $config['upload_path']."/thumb";
								$this->image_lib->initialize($iconfig);
								if ( ! $this->image_lib->resize())
								{
									$this->data['error'] = $this->upload->display_errors();
								}
							}
						}
						if(!empty($this->data['error'])){
							$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
						} else {
							if(!empty($input['pwd'])) $this->data['value']['password'] =md5($input['pwd']);
							$this->users_model->update($id,$this->data['value']);
							redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=edit");
						}
					}
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function validusername_check($str){
		$recipient = $this->users_model->getbyusername($str);
		if (!empty($recipient))
		{
			$this->form_validation->set_message('validusername_check', 'This username has been used.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function validemail_check($str){
		$recipient = $this->users_model->getbyemail($str);
		if (!empty($recipient))
		{
			$this->form_validation->set_message('validemail_check', 'This email has been used.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
