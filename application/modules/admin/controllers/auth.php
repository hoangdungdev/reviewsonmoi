<?php
class Auth extends CI_Controller
{
	var $data;
	function __construct()
	{
		parent::__construct();
		$this->data['module'] = strtolower($this->uri->segment(1));
	}
	function login()
	{
		try {
			$auth = $this->session->userdata('auth'); //kt xem co session hay chưa?
			if($auth && $auth->usertype == 'administrator'){
				redirect('dpadmin/product');
			}
			$input = $this->input->post();
			
			// co input trong
			if(empty($input)){
				$this->data['url'] = $this->input->get('url');
				$this->load->view(strtolower(__CLASS__).'/login',$this->data); //báo lỗi  
			} else {
				$this->form_validation->set_rules('uid', 'Tên tài khoản', 'required|trim');
				$this->form_validation->set_rules('pwd', 'Mật khẩu', 'required|callback_validate_login['.$input['uid'].']');
				if($this->form_validation->run()== FALSE){
					$this->load->view(strtolower(__CLASS__).'/login',$this->data);
				} else {
					$this->load->model('users_model');
					$user = $this->users_model->getbyusername($input['uid']);
					$this->session->set_userdata('auth',$user);  //tạo session
					$date = date("Y-m-d H:i:s");
					$this->users_model->update($user->id,array('lastvisited'=>$date));
					if($input['url']) // khi lần trước đã ghi nhớ đăng nhập 
					{
						redirect(base64_decode($input['url']));
					} else {
						redirect('dpadmin/product');
					}
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function validate_login($pwd,$uid){
		$this->load->model('users_model');
		$user = $this->users_model->checklogin($uid,md5($pwd));
		if(!empty($user)){
			return TRUE;
		} else {
			$this->form_validation->set_message('validate_login', 'Tên đăng nhập hoặc mật khẩu sai');
			return FALSE;
		}
	}
	function logout()
	{
		if($this->session->userdata('auth'))
		{
			$this->session->unset_userdata('auth');
			redirect($this->data['module'].'/auth/login');
		} else {
			redirect($this->data['module'].'/auth/login');
		}
	}
}