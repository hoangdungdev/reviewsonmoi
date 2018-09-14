<?php
class Gioithieu extends CI_Controller
{
	var $data = array();
	function __construct(){
		parent::__construct();
		$auth = $this->session->userdata('auth');
		$this->data['module'] = strtolower($this->uri->segment(1));
		if(!$auth || $auth->usertype != 'administrator'){
			redirect($this->data['module'].'/auth/login');
		}else{
			$this->layout->setLayout('ad_layout');
			$this->load->model('gioithieu_model');
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower(__CLASS__);
		}
	}
	function index()
	{
		try {
			$this->data['action'] = strtolower(__FUNCTION__);
			$this->data['update'] = $this->input->get('update');
			// init pagination with parameters
			$key =$this->input->get('s');
			$config['base_url'] = site_url().$this->data['module'].'/'.strtolower(__CLASS__)."/".strtolower(__FUNCTION__).'?s='.$key;
			$config['num_links'] = 3;
			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->gioithieu_model->count($key);
			$this->pagination->initialize($config);
			// load data with parameters
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->gioithieu_model->getlist($key,$offset,$config['per_page']);
			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function delete(){
		try {
			$id = $this->input->post('list');
			if(!empty($id)){
				foreach ($id as $row):
				$this->gioithieu_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);
				if (!empty($id)) $this->gioithieu_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function live_generateSlug(){
		$slug = $this->generateSlug($this->input->post('title'));
		echo $slug;
	}
	function generateSlug($title){
		$slug = url_title(trim($title), 'dash', true);
		$suffix = 0;
		while($this->gioithieu_model->getbyslug($slug)){
			if ($suffix)
				$slug = preg_replace ('/[0-9]+$/', ++$suffix, $slug );
			else
				$slug .= '-' . ++$suffix;
		}
		return $slug;
	}
	function add(){
		try {
			$this->data['action'] = strtolower(__FUNCTION__);
			$input = $this->input->post();
			//------------------
			if (!$input){
				$this->layout->view($this->data['controller'].'/modify',$this->data);
			} else {
				$this->form_validation->set_rules('title', 'Tên', 'min_length[1]|max_length[255]|trim|required');
				$this->form_validation->set_rules('parent', 'Chuyên mục', '');
				$this->form_validation->set_rules('description', 'Miêu tả', '');
				$this->form_validation->set_rules('content', 'Nội dung', '');
				$this->form_validation->set_rules('order', 'Order', '');
				$this->form_validation->set_rules('status', 'status', '');
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('title' => $input['title'],
												'slug' => $this->generateSlug($input['title']),
												'description' => $input['description'],
												'content' => $input['content'],
												'order' => $input['order'],
												'meta_key' => $input['meta_key'],
												'meta_des' => $input['meta_des'],
												'created' => $date,
												'created_by' => $this->data['auth']->username,
												'modified' => $date,
												'modified_by' => $this->data['auth']->username,
												'status' => $input['status']
					);
					$insert_id = $this->gioithieu_model->add($this->data['value']);
					// -------- Image Upload -----------
					if($_FILES['post-image']['name']){
						$config['upload_path'] = './upload/gioithieu/';
						if (!file_exists($config['upload_path'])) {
							mkdir($config['upload_path']);
							mkdir($config['upload_path'].'/thumb');
						}
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['encrypt_name'] = FALSE;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
						//-------- upload file -----------
						$upload_data = null;
						if (!$this->upload->do_upload("post-image"))
						{
							$this->data['error'] = $this->upload->display_errors();
						} else {
							$upload_data =  $this->upload->data();
							$this->data['value']['image'] = $upload_data['file_name'];
							//-------- resize image and create thumbnail -----------
							$this->load->library('image_lib');
							$iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2
							$iconfig['maintain_ratio'] = TRUE;
							// $iconfig['width']     = 140;
							// $iconfig['height']    = 120;
							$iconfig['source_image']= $upload_data['full_path'];
							$iconfig['new_image']= $config['upload_path'];
							$this->image_lib->initialize($iconfig);
							if ( !$this->image_lib->resize())
							{
								$this->data['error'] = $this->upload->display_errors();
							}
							$iconfig['create_thumb'] = TRUE;
							$iconfig['width']     = 200;
							$iconfig['height']    = 267;
							$iconfig['new_image'] = $config['upload_path']."/thumb";
							$this->image_lib->initialize($iconfig);
							if ( ! $this->image_lib->resize())
							{
								$this->data['error'] = $this->upload->display_errors();
							}
						}
						if(!empty($this->data['error'])){
							$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
						} else {
							$this->gioithieu_model->update($insert_id, array('image' => $upload_data['file_name']));
						}
					}
					if(empty($this->data['error'])) redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=add");
					// -------- end Image Upload -----------
				}
			}
			// redirect($this->data['module'].'/'.strtolower(__CLASS__));
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function edit(){
		try {
			$id = $this->uri->segment(4);
			if (isset($id)){
				$this->data['action'] = strtolower(__FUNCTION__);
				$this->data['post'] = $this->gioithieu_model->getbyid($id);
				$input = $this->input->post();
				//----------------------
				if (empty($input)){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$this->form_validation->set_rules('title', 'Tên', 'min_length[1]|max_length[255]|trim|required');
					$this->form_validation->set_rules('parent', 'Chuyên mục', '');
					$this->form_validation->set_rules('description', 'Miêu tả', '');
					$this->form_validation->set_rules('content', 'Nội dung', '');
					$this->form_validation->set_rules('order', 'Order', '');
					$this->form_validation->set_rules('status', 'status', '');
					if($this->form_validation->run()== FALSE){
						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
					} else {
						$date = date("Y-m-d H:i:s");
						$this->data['value'] = array('title' => $input['title'],
												'description' => $input['description'],
												'content' => $input['content'],
												'meta_key' => $input['meta_key'],
												'meta_des' => $input['meta_des'],
												'order' => $input['order'],
												'modified' => $date,
												'modified_by' => $this->data['auth']->username,
												'status' => $input['status']
						);
						$this->gioithieu_model->update($id,$this->data['value']);
						$insert_id = $id;
						// -------- Image Upload -----------
						if($_FILES['post-image']['name']){
							$config['upload_path'] = './upload/gioithieu';
							if (!file_exists($config['upload_path'])) {
								mkdir($config['upload_path']);
								mkdir($config['upload_path'].'/thumb');
							}
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['encrypt_name'] = FALSE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							//-------- upload file -----------
							$upload_data = null;
							if (!$this->upload->do_upload('post-image'))
							{
								$this->data['error'] = $this->upload->display_errors();
							} else {
								$upload_data =  $this->upload->data();
								$this->data['value']['image'] = $upload_data['file_name'];
								//-------- resize image and create thumbnail -----------
								$this->load->library('image_lib');
								$iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2
								$iconfig['maintain_ratio'] = TRUE;
								// $iconfig['width']     = 140;
								// $iconfig['height']    = 120;
								$iconfig['source_image']= $upload_data['full_path'];
								$iconfig['new_image']= $config['upload_path'];
								$this->image_lib->initialize($iconfig);
								if ( !$this->image_lib->resize())
								{
									$this->data['error'] = $this->upload->display_errors();
								}
								$iconfig['create_thumb'] = TRUE;
								$iconfig['width']     = 200;
								$iconfig['height']    = 267;
								$iconfig['new_image'] = $config['upload_path']."/thumb";
								$this->image_lib->initialize($iconfig);
								if ( ! $this->image_lib->resize())
								{
									$this->data['error'] = $this->upload->display_errors();
								}
							}
							if(!empty($this->data['error'])){
								$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
							} else {
								$this->gioithieu_model->update($insert_id, array('image' => $upload_data['file_name']));
							}
						}
						redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=edit");
						// -------- end Image Upload -----------
					}
				}
			} else {
				show_404();
			}
		} catch (Exception $e) {
			echo $e->getMessage();die();
		}
	}
	function livestatus(){
		try {
			$id = $this->input->post('id');
			$product = $this->gioithieu_model->getbyid($id);
			if(!empty($product)){
				if($product->status == 1 || $product->status == -1) $this->gioithieu_model->update($id,array('status' => -$product->status));
				$message = array('status' => -$product->status, 'content' => ($product->status == 1)?'Draff':'Public');
				echo json_encode($message);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
}