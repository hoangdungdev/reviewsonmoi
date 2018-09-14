<?php
class Contact extends CI_Controller
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
			$this->load->model('contact_model');
			$this->load->model('slug_model');
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
			$config['total_rows'] = $this->contact_model->count($key);
			$this->pagination->initialize($config);
			// load data with parameters
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->contact_model->getlist($key,$offset,$config['per_page']);
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
				$this->contact_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);
				if (!empty($id)) $this->contact_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	
	function edit(){
		try {
			$id = $this->uri->segment(4);
			if (isset($id)){
				$this->data['action'] = strtolower(__FUNCTION__);
				$this->data['country'] = $this->contact_model->getbyid($id);
				//$this->data['categories'] = $this->post_category_model->getmenu();
				$input = $this->input->post();
				//----------------------
				if (empty($input)){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$this->form_validation->set_rules('name', 'Tên - Việt', 'min_length[1]|max_length[255]|trim|required');
					if($this->form_validation->run()== FALSE){
						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
					} else {
						$date = date("Y-m-d H:i:s");
						$this->data['value'] = array('name' => $input['name'],
												'address' => $input['address'],
												'phone' => $input['phone'],
												'content' => $input['content'],
												'email' => $input['email'],
												'modified' => $date,
												'status' => $input['status']												
						);
						$this->contact_model->update($id,$this->data['value']);
						$insert_id = $id;
						// -------- Image Upload -----------

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

	function generateSlug($title){

		$slug = url_title(trim($title), 'dash', true);

		$suffix = 0;

		while($this->contact_model->getbyslug($slug)){

			if ($suffix)

				$slug = preg_replace ('/[0-9]+$/', ++$suffix, $slug );

			else

				$slug .= '-' . ++$suffix;

		}

		return $slug;

	}
	
	function generateSlug_slug($title){

		$slug = url_title(trim($title), 'dash', true);

		$suffix = 0;

		while($this->slug_model->getbyslug($slug)){

			if ($suffix)

				$slug = preg_replace ('/[0-9]+$/', ++$suffix, $slug );

			else

				$slug .= '-' . ++$suffix;

		}

		return $slug;

	}
	function livestatus(){
		try {
			$id = $this->input->post('id');
			$product = $this->contact_model->getbyid($id);
			if(!empty($product)){
				if($product->status == 1 || $product->status == -1) $this->contact_model->update($id,array('status' => -$product->status));
				$message = array('status' => -$product->status, 'content' => ($product->status == 1)?'Draff':'Public');
				echo json_encode($message);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
}