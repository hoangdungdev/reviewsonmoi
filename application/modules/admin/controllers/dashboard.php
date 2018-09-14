<?php
class Dashboard extends CI_Controller{
	var $data = array();
	function __construct(){
		parent::__construct();
        $this->load->database();
		$auth = $this->session->userdata('auth');
		$this->data['module'] = strtolower($this->uri->segment(1));

		if(!$auth || $auth->usertype != 'administrator')
		{
			redirect($this->data['module'].'/auth/login?url='.base64_encode(current_url()));
		}else{
			$this->layout->setLayout('ad_layout');
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower((__CLASS__));
		}
	}
    function index(){
		$this->form_validation->set_rules('info','Nội dung','required');
        if($this->form_validation->run()==false)
        {
            $this->layout->view(strtolower((__CLASS__)).'/index',$this->data);
        }
        else
        {
            $data_update = array(
                'info'=>$this->input->post('info')
            );
            $this->update('1',$data_update);
            $this->layout->view(strtolower((__CLASS__)).'/index',$this->data);
        }
	}
}
