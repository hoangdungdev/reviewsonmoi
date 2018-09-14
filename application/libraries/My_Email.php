<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * Send email with site_config
 * Extends CI_Email
 * $to: destination email
 *      be a string like 'one@example.com, two@example.com, three@example.com'
 *      or array like  array('one@example.com', 'two@example.com', 'three@example.com')
 **/
class My_Email extends CI_Email{
	public function sz_send($to,$bcc,$subject,$content)
	{
		$CI =& get_instance();
		// get config
		$CI->load->model('config_model');
		$site_config = $CI->config_model->getconfig();
		// init mail
		
		$mail_config['protocol'] = 'smtp';
		$mail_config['smtp_host'] = $site_config['mail_host'];
		$mail_config['smtp_port'] = $site_config['mail_port'];
		$mail_config['smtp_user'] = $site_config['mail_user'];
		$mail_config['smtp_pass'] = $site_config['mail_pass'];
		$mail_config['charset'] = 'utf-8';
		$mail_config['mailtype'] = 'html';
		$mail_config['wordwrap'] = TRUE;
		$mail_config['smtp_timeout'] = '7';
		$mail_config['newline']    = "\r\n";
		$mail_config['validation'] = TRUE;
		$CI->load->library('email');
		$CI->email->initialize($mail_config);
		$CI->email->from($site_config['mail_user'], $site_config['mail_name']);
		$CI->email->to($to);
		$CI->email->bcc($bcc);
		$CI->email->subject($subject);
		$CI->email->message($content);
		if($CI->email->send()){
			return TRUE; 
		} else {
			//echo $CI->email->print_debugger();
			return FALSE;
		}
	}
}

/* End of file Someclass.php */