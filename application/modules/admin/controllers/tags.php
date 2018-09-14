<?php
class Tags extends CI_Controller
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
			$this->load->model('tags_model');
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
			$config['total_rows'] = $this->tags_model->count($key);
			$this->pagination->initialize($config);
			// load data with parameters
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->tags_model->getlist($key,$offset,$config['per_page']);
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
				$this->tags_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);
				if (!empty($id)) $this->tags_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
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
				$this->form_validation->set_rules('link', 'Link', '');
				$this->form_validation->set_rules('order', 'Order', '');
				$this->form_validation->set_rules('status', 'status', '');
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$date = date("Y-m-d H:i:s"); 
					$this->data['value'] = array('title' => $input['title'], 
												'link' => $input['link'], 
												'order' => $input['order'],
												'created' => $date,
												'created_by' => $this->data['auth']->username,
												'modified' => $date,
												'modified_by' => $this->data['auth']->username,
												'status' => $input['status']
					);
					$insert_id = $this->tags_model->add($this->data['value']);	
					if(empty($this->data['error'])) redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=add");					
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
				$this->data['action'] = strtolower(__FUNCTION__);
				$this->data['post'] = $this->tags_model->getbyid($id);
				$input = $this->input->post();
				//----------------------
				if (empty($input)){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$this->form_validation->set_rules('title', 'Tên', 'min_length[1]|max_length[255]|trim|required');
					$this->form_validation->set_rules('link', 'Link', '');
					$this->form_validation->set_rules('order', 'Order', '');
					$this->form_validation->set_rules('status', 'status', '');
					if($this->form_validation->run()== FALSE){
						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
					} else {
						$date = date("Y-m-d H:i:s");
						$this->data['value'] = array('title' => $input['title'],
												'link' => $input['link'],
												'order' => $input['order'],
												'modified' => $date,
												'modified_by' => $this->data['auth']->username,
												'status' => $input['status']
						);
						$this->tags_model->update($id,$this->data['value']);
						$insert_id = $id;				
						redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=edit");
					}
				}
			} else {
				show_404();
			}
		} catch (Exception $e) {
			echo $e->getMessage();die();
		}
	}
}