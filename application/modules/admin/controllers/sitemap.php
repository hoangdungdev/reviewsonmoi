<?php
class Sitemap extends CI_Controller
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
			$this->load->model('loaitintuc_model');
			$this->load->model('tintuc_model');
			$this->load->model('category_model');
			$this->load->model('chinhsach_model');
			$this->data['auth'] = $auth;
			$this->data['controller'] = strtolower(__CLASS__);
		}
	}
	function index()
	{
		try {
			$this->load->helper('file');			
			
			$loaitintucs = $this->loaitintuc_model->getlisthome(0,20);
			$tintucs = $this->tintuc_model->getlisthome('',0,200);
			$tintucs = $this->tintuc_model->getlisthome('',0,200);
			$categorys = $this->category_model->getbyparent();
			$chinhsachs = $this->chinhsach_model->getlisthome(0,10);
			$this->data['action'] = strtolower(__FUNCTION__);
			$this->data['update'] = $this->input->get('update');
			$str = '<?xml version="1.0" encoding="UTF-8"?>';
			$str .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
				$str .= '<url>';
					$str .= '<loc>'.base_url().'</loc>';
				$str .= '</url>';
				$str .= '<url>';
					$str .= '<loc>'.base_url('gioi-thieu').'</loc>';
				$str .= '</url>';
				$str .= '<url>';
					$str .= '<loc>'.base_url('in-bao-li-xi').'</loc>';
				$str .= '</url>';
				$str .= '<url>';
					$str .= '<loc>'.base_url('thiet-ke-bao-li-xi').'</loc>';
				$str .= '</url>';
				$str .= '<url>';
					$str .= '<loc>'.base_url('mau-bao-li-xi').'</loc>';
				$str .= '</url>';
				$str .= '<url>';
					$str .= '<loc>'.base_url('tin-tuc').'</loc>';
				$str .= '</url>';
				$str .= '<url>';
					$str .= '<loc>'.base_url('lien-he').'</loc>';
				$str .= '</url>';
				if (count($loaitintucs)>0) {
					foreach ($loaitintucs as $item_loaitintuc) {
						$str .= '<url><loc>'.base_url('tin-tuc/'.$item_loaitintuc->loaitintuc_slug).'</loc></url>';
					}
				}
				if (count($tintucs)>0) {
					foreach ($tintucs as $item_tintuc) {
						$str .= '<url><loc>'.base_url('tin-tuc/'.$item_tintuc->loaitintuc_slug.'/'.$item_tintuc->slug).'</loc></url>';		
					}
				}
				if (count($categorys)>0) {
					foreach ($categorys as $item) {
						$str .= '<url><loc>'.base_url('mau-bao-li-xi/'.$item->slug).'</loc></url>';	
					}
				}
				if (count($chinhsachs)>0) {
					foreach ($chinhsachs as $item) {
						$str .= '<url><loc>'.base_url('chinh-sach/'.$item->slug).'</loc></url>';	
					}
				}
			$str .= '</urlset>';
			write_file(realpath(FCPATH."sitemap.xml"),$str);
			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
}