<?php
class Loaitintuc extends CI_Controller
{
	var $data = array();
	function __construct(){
		parent::__construct();
		$auth = $this->session->userdata('auth');
		$this->data['module'] = strtolower($this->uri->segment(1));
		if(!$auth || $auth->usertype != 'administrator'){
			redirect($this->data['module'].'/auth/login?url='.base64_encode(current_url()));
		}else{
			$this->layout->setLayout('ad_layout');
			$this->load->model('loaitintuc_model');
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
			$config['total_rows'] = $this->loaitintuc_model->count($key);
			$this->pagination->initialize($config);
			// load data with parameters
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->loaitintuc_model->getlist($key,$offset,$config['per_page']);
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
				$this->loaitintuc_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);
				if (!empty($id)) $this->loaitintuc_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function add(){
		try {
			$this->data['action'] = strtolower(__FUNCTION__);
			$this->data['categories'] = $this->loaitintuc_model->getmenu();
			$input = $this->input->post();
			//------------------
			if (!$input){
				$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
			} else {
				$this->form_validation->set_rules('name', 'Name', 'min_length[1]|max_length[50]|trim|required');
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('name' => $input['name'],
												'meta_des' => $input['meta_des'],
												'meta_key' => $input['meta_key'],
												'meta_title' => $input['meta_title'],
												'slug' => $this->generateSlug($input['name']),
												'parent_id' => $input['parent'],
												'description' => $input['description'],
												'content' => $input['content'],
												'status' => $input['status'],
												'created' => $date,
												'created_by' => $this->data['auth']->username,
												'modified' => $date,
												'modified_by' => $this->data['auth']->username,
												'order' => 0
					);
					$this->loaitintuc_model->add($this->data['value']);
					//var_dump($this->data['value']);die;
					redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=add");
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
				$this->data['post_category'] = $this->loaitintuc_model->getbyid($id);
				$this->data['categories'] = $this->loaitintuc_model->getmenu();
				$input = $this->input->post();
				//------------------
				if (!$input){
					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
				} else {
					$this->form_validation->set_rules('name', 'Name', 'min_length[1]|max_length[50]|trim|required');
					if($this->form_validation->run()== FALSE){
						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
					} else {
						$date = date("Y-m-d H:i:s");
						$this->data['value'] = array('name' => $input['name'],
													'meta_des' => $input['meta_des'],
													'meta_key' => $input['meta_key'],
													'meta_title' => $input['meta_title'],
													'parent_id' => $input['parent'],
													'description' => $input['description'],
													'content' => $input['content'],
													'status' => $input['status'],
													'modified' => $date,
													'modified_by' => $this->data['auth']->username,
													'order' => $input['order']
						);
						$this->loaitintuc_model->update($id,$this->data['value']);
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
	function live_generateSlug(){
		$slug = $this->generateSlug($this->input->post('title'));
		echo $slug;
	}
	function generateSlug($title){
		$slug = url_title(trim($title), 'dash', true);
		$suffix = 0;
		while($this->loaitintuc_model->getbyslug($slug)){
			if ($suffix)
				$slug = preg_replace ('/[0-9]+$/', ++$suffix, $slug );
			else
				$slug .= '-' . ++$suffix;
		}
		return $slug;
	}
}