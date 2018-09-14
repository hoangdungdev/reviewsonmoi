<?php
/*
 * Order status
 * 1 = pending;
 */
class Orders extends CI_Controller
{
	var $data = array();
	function __construct()
	{
		parent::__construct();
		$auth = $this->session->userdata('auth');
		$this->data['module'] = strtolower($this->uri->segment(1));
		if(!$auth || $auth->usertype != 'administrator'){
			redirect($this->data['module'].'/auth/login?url='.base64_encode(current_url()));
		}else{
			$this->layout->setLayout('ad_layout');
			$this->load->model('orders_model');
			$this->load->model('coupon_model');
			$this->load->model('ordersdetail_model');
			$this->load->model('payment_method_model');
			$this->load->model('delivery_method_model');
			$this->load->model('users_model');
			$this->load->model('config_model');
			$this->data['config'] = $this->config_model->getconfig();
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower((__CLASS__));
		}
	}
	function index()
	{
		try {
			$this->data['action'] = strtolower(__FUNCTION__);
			$this->data['update'] = $this->input->get('update');
			// init pagination with parameters
			$key =$this->input->get('s');
			$config['base_url'] = strtolower(__CLASS__)."/".strtolower(__FUNCTION__).'?s='.$key;
			$config['num_links'] = 3;
			$config['per_page'] = 10;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->orders_model->count($key);
			$this->pagination->initialize($config);
			// load data with parameters
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['dataset'] = $this->orders_model->getlist($key,$offset,$config['per_page']);
			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function view()
	{
		try {
			$input = $this->input->post();
			if(!empty($input)){
				$order_id = $this->uri->segment(4);
				$order_status = array(
								'pending' => 'pending',
								'processing' => 'processing',
								'delivered' => 'delivered',
								'complete' => 'complete'
				);
				if($order_status[$input['delivery_status']]) {
					$this->orders_model->update($order_id,array('delivery_status' => $order_status[$input['delivery_status']], 'modified' => date("Y-m-d H:i:s"), 'modified_by' => $this->data['auth']->username));
					redirect($this->data['module'].'/'.strtolower(__CLASS__)."/index/?update=edit");
				} else redirect('404');
			} else {
				$id = $this->uri->segment(4);
				$this->data['action'] = strtolower(__FUNCTION__);
				$this->data['update'] = $this->input->get('update');
				$this->data['order'] = $this->orders_model->getbyid($id);
				if($this->data['order']){
					$this->data['product'] = $this->ordersdetail_model->getbyorderid($id);
					$this->data['coupon'] = $this->coupon_model->getbycode($this->data['order']->coupon);
					$this->layout->view(strtolower(__CLASS__).'/view',$this->data);
				} else {
					redirect('404');
				}
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
				$this->orders_model->delete($row);
				endforeach;
			}
			else{
				$id = $this->uri->segment(4);
				if (!empty($id)) $this->orders_model->delete($id);
			}
			redirect($this->data['module'].'/'.strtolower(__CLASS__)."/index/?update=del");
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function nganluong_live_check(){
		$order_code = $this->input->post('uid');
		$order = $this->orders_model->getbyid($order_code);
		if($order){
			$payment_id = json_decode($order->params)->payment_id;
			ini_set("soap.wsdl_cache_enabled", "0");
			$client = new SoapClient('https://www.nganluong.vn/public_api.php?wsdl',array('encoding'=>'ISO-8859-1'));
			$param = "<ORDERS><TOTAL>1</TOTAL>
						<ORDER>
							<ORDER_CODE>$order_code</ORDER_CODE>
							<PAYMENT_ID>$payment_id</PAYMENT_ID>
						</ORDER>
					</ORDERS>";
			$param_xml = new SimpleXMLElement($param);
			$secure_pass =  $this->data['config']['payment_nganluong_secure_pass'];
			// nganluong webservices "checkOrder" parameter
			$merchant_id = $this->data['config']['payment_nganluong_merchant_site_code'];
			$param = $param_xml->asXML();
			$checksum = md5($merchant_id + $param + $secure_pass);
			$result = $client->__soapCall("checkOrder", array($merchant_id,$param,$checksum));
			// parse result
			$result_xml = new SimpleXMLElement($result);
			$result = array();
			if($result_xml->ERROR_CODE == '00'){
				$result['order_code'] = $result_xml->TRANSACTION->ORDER_CODE;
				$result['payment_id'] = $result_xml->TRANSACTION->PAYMENT_ID;
				$result['amount'] = $result_xml->TRANSACTION->AMOUNT;
				switch($result_xml->TRANSACTION->PAYMENT_TYPE){
					case 9: $result['payment_type'] = 'Thanh toán bằng số dư tài khoản Ngân Lượng';break;
					case 7: $result['payment_type'] = 'Thanh toán bằng tiền mặt hoặc qua Ngân Hàng';break;
					default: $result['payment_type'] = 'invalid';
				};
				switch($result_xml->TRANSACTION->TRANSACTION_TYPE){
					case 1: $result['transaction_type'] = 'Thanh toán ngay';break;
					case 2: $result['transaction_type'] = 'Thanh toán tạm giữ';break;
					default: $result['transaction_type'] = 'invalid';
				};
				$result['payer_fullname'] = $result_xml->TRANSACTION->PAYER_FULLNAME;
				$result['payer_email'] = $result_xml->TRANSACTION->PAYER_EMAIL;
				$result['payer_mobile'] = $result_xml->TRANSACTION->PAYER_MOBILE;
				$result['divery_address'] = $result_xml->TRANSACTION->DELIVERY_ADDRESS;
				$result['created_time'] = $result_xml->TRANSACTION->CREATED_TIME;
				$result['paid_time'] = $result_xml->TRANSACTION->PAID_TIME;
				switch($result_xml->TRANSACTION->TRANSACTION_STATUS){
					case 1: $result['transaction_status'] = 'Giao dịch mới tạo, chưa thanh toán';break;
					case 2: $result['transaction_status'] = 'Đã thanh toán, đang bị tạm giữ';break;
					case 3: $result['transaction_status'] = 'Giao dịch bị huỷ/hoàn trả';break;
					case 4: $result['transaction_status'] = 'Giao dịch hoàn thành, tiền đã chuyển vào tài khoản của người nhận';break;
					default: $result['transaction_status'] = 'invalid';
				};
			}
			$this->load->view(strtolower(__CLASS__).'/nganluong_live_check',$result);
		}
	}
	function baokim_live_check(){
		$order_code = $this->input->post('uid');
		$order = $this->orders_model->getbyid($order_code);
		if($order){
			$this->load->view(strtolower(__CLASS__).'/baokim_live_check',$order);
		}
	}
}