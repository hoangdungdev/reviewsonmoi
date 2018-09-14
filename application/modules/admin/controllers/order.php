<?php
class Order extends CI_Controller
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
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower(__CLASS__); 
			
			$this->load->model('order_model');
			$this->load->model('detailorder_model');
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
			$config['total_rows'] = $this->order_model->count($key);
			$this->pagination->initialize($config);
			// load data with parameters
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->order_model->getlist($key,$offset,$config['per_page']);
			$this->layout->view(strtolower(__CLASS__).'/index',$this->data); 
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function livestatus(){
		try {
			$id = $this->input->post('id');
			$product = $this->order_model->getbyid($id);
			if(!empty($product)){
				if($product->status == 1 || $product->status == -1) $this->order_model->update($id,array('status' => -$product->status));
				$message = array('status' => -$product->status, 'content' => ($product->status == 1)?'Đã giao':'Chưa giao');
				echo json_encode($message);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function delete(){
		try {
			$id = $this->input->post('list');
			if(!empty($id)){
				foreach ($id as $row):
				$this->order_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);
				if (!empty($id)) $this->order_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}	
	function detail(){
		try { 
			$this->load->model('tinhthanhpho_model');
			$this->load->model('quanhuyen_model');
			$id = $this->uri->segment(4); 
			$this->data['order'] = $this->order_model->getbyid($id);
			$this->data['detail'] = $this->detailorder_model->getall($id); //var_dump($order);die;
			
			$id_tinh = $this->data['order']->tinhthanhpho;
			$this->data['tinhthanhphos'] = $this->tinhthanhpho_model->getbyid($id_tinh);
			
			$id_quanhuyen = $this->data['order']->quanhuyen;
			$this->data['quanhuyens'] = $this->quanhuyen_model->getbyid($id_quanhuyen);

			$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
}