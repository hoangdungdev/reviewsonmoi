<?php
class Liveedit extends CI_Controller
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
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower(__CLASS__);
			
		}
	}
	function index()
	{
		try {
			$listFile = array();
			array_push($listFile,array('name' => 'Giao diện', 'file' => 'application/views/home_layout.php'));
			array_push($listFile,array('name' => 'Liên hệ', 'file' => 'application/views/home/block_contact.php'));
			$this->data['listfile'] = $listFile;
			$this->data['update'] = $this->input->get('update');
			switch($this->input->post('act')){
				case 'getcontent': // ghi lai trang layout
					if(!empty($listFile[$this->input->post('uid')])){
						$filename = $listFile[$this->input->post('uid')]['file'];
							/*	
								$filename = array(array('file' => 'application/views/home_layout.php'),array('file' => 'application/views/home/block_contact.php'))
							*/
						$pathinfo = pathinfo($filename);
							/*
								$pathinfo['dirname'] = 'application/views'	: tên thư mục
								$pathinfo['basename'] = 'home_layout.php'	 : tên file
							*/
						$isBackup = false;
						if(file_exists($pathinfo['dirname'].'/.sz/'.$pathinfo['basename'])){
							$isBackup = true;
						}
						$content = file_get_contents($filename);  //hiển thị home_layout
						echo json_encode(array('status' => true, 'mesage' => $content, 'bk' => $isBackup));
					}
				break;
				case 'update':  // update layout
					if(!empty($listFile[$this->input->post('uid')])){
						$filename = $listFile[$this->input->post('uid')]['file'];
						$pathinfo = pathinfo($filename);
						// create backup
						if(!file_exists($pathinfo['dirname'].'/.sz/'.$pathinfo['basename'])){
							if(!file_exists ($pathinfo['dirname'].'/.sz')) mkdir($pathinfo['dirname'].'/.sz');
							$original = file_get_contents($listFile[$this->input->post('uid')]['file']);
							file_put_contents($pathinfo['dirname'].'/.sz/'.$pathinfo['basename'], $original, LOCK_EX);
						}
						file_put_contents($filename, $this->input->post('content'), LOCK_EX);
						redirect(site_url().$this->data['module'].'/'.$this->data['controller'].'?update=edit');
					}
				break;
				case 'getbk':   // phục hồi lại layout
					if(!empty($listFile[$this->input->post('uid')])){
						$filename = $listFile[$this->input->post('uid')]['file'];
						$pathinfo = pathinfo($filename);
						if(file_exists($pathinfo['dirname'].'/.sz/'.$pathinfo['basename'])){
							$content = file_get_contents($pathinfo['dirname'].'/.sz/'.$pathinfo['basename']);
							echo json_encode(array('status' => true, 'mesage' => $content));
						}
					}
				break;
				default:
					if($this->input->get('uid')) $uid = $this->input->get('uid'); else $uid=0;
					if(!empty($listFile[$uid])) {
						$filename = $listFile[$uid]['file'];
						$pathinfo = pathinfo($filename);
						$this->data['dataset'] = file_get_contents($filename);
					} else {
						redirect(site_url().$this->data['module'].'/'.$this->data['controller']);
					}
					$this->data['bk'] = false;
					if(file_exists($pathinfo['dirname'].'/.sz/'.$pathinfo['basename'])){
						$this->data['bk'] = true;
					}
					$this->data['uid'] = $uid;
					$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
				break;
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
}