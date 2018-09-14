<?php
class Config extends CI_Controller
{
	var $data = array();
	function __construct(){
		parent::__construct();
		$auth = $this->session->userdata('auth');
		$this->data['module'] = strtolower($this->uri->segment(1));
		if(!$auth || $auth->usertype != 'administrator')
		{
			redirect($this->data['module'].'/auth/login?url='.base64_encode(current_url()));
		}else{
			$this->layout->setLayout('ad_layout');
			$this->load->model('config_model');
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower(__CLASS__);
		}
	}
	function site()
	{
		try {
			$input = $this->input->post();
			$this->data['update'] = $this->input->get('update');
									//	get(update) : lấy giá trị update trên tahnh trình duyệt
			if(empty($input)){
				$this->data['dataset'] = $this->config_model->getconfig();
				$this->layout->view(strtolower((__CLASS__)).'/site',$this->data);
			} else {
				$config = array();
				array_push($config,array('key' => 'site_name','value' => $input['site_name']));
				array_push($config,array('key' => 'site_description','value' => $input['site_description']));
				array_push($config,array('key' => 'site_keyword','value' => $input['site_keyword']));
				array_push($config,array('key' => 'site_mail','value' => $input['site_mail']));
				array_push($config,array('key' => 'site_phone','value' => $input['site_phone']));
				array_push($config,array('key' => 'site_address','value' => $input['site_address']));
				array_push($config,array('key' => 'site_hotline','value' => $input['site_hotline']));
				array_push($config,array('key' => 'site_facebook','value' => $input['site_facebook']));
				array_push($config,array('key' => 'site_instagram','value' => $input['site_instagram']));
				array_push($config,array('key' => 'site_youtube','value' => $input['site_youtube']));
				$this->config_model->update($config);
				redirect("admin/".strtolower(__CLASS__)."/".strtolower(__FUNCTION__)."?update=edit");
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function mail(){
		try {
			$input = $this->input->post();
			$this->data['update'] = $this->input->get('update');
			if(empty($input)){
				$this->data['dataset'] = $this->config_model->getconfig();
				$this->layout->view(strtolower((__CLASS__)).'/mail',$this->data);
			} else {
				$config = array();
				array_push($config,array('key' => 'mail_host','value' => $input['mail_host']));
				array_push($config,array('key' => 'mail_port','value' => $input['mail_port']));
				array_push($config,array('key' => 'mail_user','value' => $input['mail_user']));
				array_push($config,array('key' => 'mail_pass','value' => $input['mail_pass']));
				array_push($config,array('key' => 'mail_name','value' => $input['mail_name']));
				$this->config_model->update($config);
				redirect("admin/".strtolower(__CLASS__)."/".strtolower(__FUNCTION__)."?update=edit");
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}

	function meta(){
		try {
			$input = $this->input->post();
			$this->data['update'] = $this->input->get('update');
			if(empty($input)){
				$this->data['dataset'] = $this->config_model->getconfig();
				$this->layout->view(strtolower((__CLASS__)).'/meta',$this->data);
			} else {
				$config = array();
				array_push($config,array('key' => 'meta_home_title','value' => $input['meta_home_title']));
				array_push($config,array('key' => 'meta_home_des','value' => $input['meta_home_des']));
				array_push($config,array('key' => 'meta_home_key','value' => $input['meta_home_key']));
				array_push($config,array('key' => 'meta_sp_title','value' => $input['meta_sp_title']));
				array_push($config,array('key' => 'meta_sp_des','value' => $input['meta_sp_des']));
				array_push($config,array('key' => 'meta_sp_key','value' => $input['meta_sp_key']));
				array_push($config,array('key' => 'meta_news_title','value' => $input['meta_news_title']));
				array_push($config,array('key' => 'meta_news_des','value' => $input['meta_news_des']));
				array_push($config,array('key' => 'meta_news_key','value' => $input['meta_news_key']));
				array_push($config,array('key' => 'meta_contact_title','value' => $input['meta_contact_title']));
				array_push($config,array('key' => 'meta_contact_des','value' => $input['meta_contact_des']));
				array_push($config,array('key' => 'meta_contact_key','value' => $input['meta_contact_key']));
				array_push($config,array('key' => 'meta_intro_title','value' => $input['meta_intro_title']));
				array_push($config,array('key' => 'meta_intro_des','value' => $input['meta_intro_des']));
				array_push($config,array('key' => 'meta_intro_key','value' => $input['meta_intro_key']));
				$this->config_model->update($config);
				redirect("admin/".strtolower(__CLASS__)."/".strtolower(__FUNCTION__)."?update=edit");
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
}