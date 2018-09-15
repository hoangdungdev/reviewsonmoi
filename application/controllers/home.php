<?php
class home extends CI_Controller
{
	var $data = array();
	function __construct(){
		parent::__construct();
		$this->data['controller'] = strtolower(__CLASS__);
		//init home data
		$this->load->model('config_model');
		$this->load->model('product_model');
		$this->load->model('post_model');
		$this->load->model('category_model');
		$this->load->model('loaitintuc_model');
		$this->load->model('tintuc_model');
		$this->load->model('chinhsach_model');
		$this->load->model('clientuser_model');
		$this->load->model('gioithieu_model');
		$this->load->model('tags_model');
		$this->load->model('order_model');
		$this->load->model('detailorder_model');
		$this->load->model('banner_model');
		$this->data['config'] = $this->config_model->getconfig();
		$this->data['menu_maus'] = $this->category_model->getbyparent();
		$this->data['menu_tintucs'] = $this->loaitintuc_model->getlisthome(0,10);
		$this->data['chinhsachs'] = $this->chinhsach_model->getlisthome(0,10);
		$this->data['gioithieus'] = $this->gioithieu_model->getlisthome(0,10);
		$this->data['tintucs'] = $this->tintuc_model->getlistnoibat(0,6);
		$this->data['tags'] = $this->tags_model->getlisthome(0,20);
		$this->data['banchays'] = $this->product_model->get_noibat(0,10);
	}
	function index(){
		try {
			$this->layout->setLayout('home_layout');
			$this->load->model('slider_model');
      		$this->data['title'] = "Trang chủ";
      		$this->data['meta_title'] = $this->data['config']['meta_home_title'];
			$this->data['meta_key'] = $this->data['config']['meta_home_des'];
			$this->data['meta_des'] = $this->data['config']['meta_home_key'];
			$this->data['banners_left'] = $this->banner_model->getlistleft();
			$this->data['banners_right'] = $this->banner_model->getlistright(0,2);
			$this->data['sliders'] = $this->slider_model->getliststatus('',0,8);
			$this->data['mois'] = $this->product_model->get_new(0,3);

			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function listproduct(){
		try {
			$this->layout->setLayout('home_layout');


			$this->data['title'] = "Mẫu bao lì xì";
      		$this->data['meta_title'] = $this->data['config']['meta_sp_title'];
			$this->data['meta_key'] = $this->data['config']['meta_sp_des'];
			$this->data['meta_des'] = $this->data['config']['meta_sp_key'];

			$get_key = $this->input->get('s');
			$key = (isset($get_key) && !empty($get_key)) ? $get_key : '';

			$config['base_url'] = current_url().'?';
			$config['num_links'] = 3;
			$config['per_page'] = 21;
			$config['num_tag_open'] = '<li class="page-link">';
    		$config['num_tag_close'] = '</li>';
		    $config['next_tag_open'] = '<li class="page-link">';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_tag_open'] = '<li class="page-link">';
		    $config['prev_tag_close'] = '</li>';
			$config['cur_tag_open']	= '<li class="active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['page_query_string'] = TRUE;

			$config['total_rows'] = $this->product_model->count($key);
			$this->pagination->initialize($config);
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['products'] = $this->product_model->getlist($key,$offset,$config['per_page']);
      		$this->layout->view(strtolower(__CLASS__).'/listsp',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function listproductsale(){
		try {
			$this->layout->setLayout('home_layout');

			$this->data['title'] = "Mẫu bao lì xì";
      		$this->data['meta_title'] = $this->data['config']['meta_sp_title'];
			$this->data['meta_key'] = $this->data['config']['meta_sp_des'];
			$this->data['meta_des'] = $this->data['config']['meta_sp_key'];

			$config['base_url'] = current_url().'?';
			$config['num_links'] = 3;
			$config['per_page'] = 21;
			$config['num_tag_open'] = '<li class="page-link">';
    		$config['num_tag_close'] = '</li>';
		    $config['next_tag_open'] = '<li class="page-link">';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_tag_open'] = '<li class="page-link">';
		    $config['prev_tag_close'] = '</li>';
			$config['cur_tag_open']	= '<li class="active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['page_query_string'] = TRUE;

			$config['total_rows'] = $this->product_model->countsale();
			$this->pagination->initialize($config);
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
			$this->data['products'] = $this->product_model->getsale($offset,$config['per_page']);
      		$this->layout->view(strtolower(__CLASS__).'/listproductsale',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function danhmuc(){
		try {
			$this->layout->setLayout('home_layout');
			$slug = $this->uri->segment(2);
			$this->data['categories'] = $this->category_model->getbyslug($slug);
			$id_cat = $this->data['categories']->id;
			if($this->data['categories']){
				$this->data['title'] = $this->data['categories']->name;
				$this->data['meta_title'] = $this->data['categories']->meta_title;
				$this->data['meta_des'] = $this->data['categories']->meta_des;
				$this->data['meta_key'] = $this->data['categories']->meta_key;

				$config['base_url'] = current_url().'?';
				$config['num_links'] = 3;
				$config['per_page'] = 30;
				$config['num_tag_open'] = '<li class="page-link">';
	    		$config['num_tag_close'] = '</li>';
			    $config['next_tag_open'] = '<li class="page-link">';
			    $config['next_tag_close'] = '</li>';
			    $config['prev_tag_open'] = '<li class="page-link">';
			    $config['prev_tag_close'] = '</li>';
				$config['cur_tag_open']	= '<li class="active"><a href="#" class="page-link">';
				$config['cur_tag_close'] = '</a></li>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['page_query_string'] = TRUE;
				$offset = $this->input->get('per_page');
				//kiểm tra xem parent có menu con ko và trả về list id con			
				$listcategory = $this->category_model->getbyparent($id_cat);	
				if($listcategory){
					foreach($listcategory as $listCategory){
						$arr[] = $listCategory->id;
						array_push($arr, $id_cat);
					}	
					$this->data['menu_chas'] = $listcategory;	
					$config['total_rows'] = $this->product_model->countgetbyparent($arr);
					$this->pagination->initialize($config);
					$this->data['products'] = $this->product_model->getbyparent($arr,$offset,$config['per_page']);
				}
				else{//ko có menu con
					$config['total_rows'] = $this->product_model->countparent($id_cat);
					$this->pagination->initialize($config);
					// load data with parameters	 Product_ca
					$this->data['total_rows'] = $config['total_rows'];
					$this->data['products'] = $this->product_model->getbyparent($id_cat,$offset,$config['per_page']);
				}//#ko có menu con	

	      		$this->layout->view(strtolower(__CLASS__).'/danhmuc',$this->data);
	      	}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}

	function tintuc(){
		try {
			$this->data['meta_title'] = $this->data['config']['meta_news_title'];
			$this->data['meta_key'] = $this->data['config']['meta_news_des'];
			$this->data['meta_des'] = $this->data['config']['meta_news_key'];
			$this->data['title'] = 'Tin tức';
			$this->layout->setLayout('home_layout');			
			
			$config['base_url'] = current_url().'?';
			$config['num_links'] = 3;
			$config['per_page'] = 2;
			// $config['num_tag_open'] = '<a>';
   //  		$config['num_tag_close'] = '</a>';
		    // $config['next_tag_open'] = '<a>';
		    // $config['next_tag_close'] = '</a>';
		    // $config['prev_tag_open'] = '<a>';
		    // $config['prev_tag_close'] = '</a>';
			$config['cur_tag_open']	= '<a class="current-page">';
			$config['cur_tag_close'] = '</a>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->tintuc_model->count('');
			$this->pagination->initialize($config);
			$offset = $this->input->get('per_page');

			$this->data['list_news'] = $this->tintuc_model->getlisthome('',$offset,$config['per_page']);
            $this->layout->view(strtolower(__CLASS__).'/tintuc',$this->data);

		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}

	function loaitintuc(){
		try {
    		
    		$slug = $this->uri->segment(2);
			$this->data['dataset'] = $this->loaitintuc_model->getbyslug($slug);

			if(!empty($this->data['dataset'])){
				$idcat = $this->data['dataset']->id;
				$this->data['title'] = $this->data['dataset']->name;
				$this->data['meta_title'] = $this->data['dataset']->meta_title;
				$this->data['meta_des'] = $this->data['dataset']->meta_des;
    			$this->data['meta_key'] = $this->data['dataset']->meta_key;
				$this->layout->setLayout('home_layout');
				
				$config['base_url'] = current_url().'?';
				$config['num_links'] = 3;
				$config['per_page'] = 4;
				$config['num_tag_open'] = '<li class="page-link">';
	    		$config['num_tag_close'] = '</li>';
			    $config['next_tag_open'] = '<li class="page-link">';
			    $config['next_tag_close'] = '</li>';
			    $config['prev_tag_open'] = '<li class="page-link">';
			    $config['prev_tag_close'] = '</li>';
				$config['cur_tag_open']	= '<li class="active"><a href="#" class="page-link">';
				$config['cur_tag_close'] = '</a></li>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['page_query_string'] = TRUE;
				$config['total_rows'] = $this->tintuc_model->counthomeparent($idcat);
				$this->pagination->initialize($config);
				$offset = $this->input->get('per_page');

				$this->data['list_news'] = $this->tintuc_model->getlisthomeparent($idcat,$offset,$config['per_page']);			
	            $this->layout->view(strtolower(__CLASS__).'/loaitintuc',$this->data);
			}else{
				redirect(base_url(),'refresh');
			}	
			
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function chitiettintuc()
    {
        try {
        	$this->layout->setLayout('home_layout');
    		
            $alias = $this->uri->segment(3);

            $this->data['dataset'] = $this->tintuc_model->getbyhomeslug($alias);
            if(!empty($this->data['dataset'])){
	            $this->data['newslq'] = $this->tintuc_model->getlistrandom(0,9);
	            $this->data['title'] = $this->data['dataset']->title;
	    		$this->data['meta_des'] = $this->data['dataset']->meta_des;
	    		$this->data['meta_key'] = $this->data['dataset']->meta_key;
	    		$this->data['meta_title'] = $this->data['dataset']->meta_title;
				$this->layout->view(strtolower(__CLASS__).'/chitiettintuc',$this->data);
			}else{
				redirect(base_url(),'refresh');
			}	
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function gioithieu(){
		try {
			$this->data['meta_title'] = $this->data['config']['meta_intro_title'];
			$this->data['meta_key'] = $this->data['config']['meta_intro_des'];
			$this->data['meta_des'] = $this->data['config']['meta_intro_key'];
			$this->data['title'] = 'Giới thiệu';
			$this->layout->setLayout('home_layout');			
			
			$config['base_url'] = current_url().'?';
			$config['num_links'] = 3;
			$config['per_page'] = 6;
			$config['num_tag_open'] = '<li class="page-link">';
    		$config['num_tag_close'] = '</li>';
		    $config['next_tag_open'] = '<li class="page-link">';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_tag_open'] = '<li class="page-link">';
		    $config['prev_tag_close'] = '</li>';
			$config['cur_tag_open']	= '<li class="active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['page_query_string'] = TRUE;
			$config['total_rows'] = $this->gioithieu_model->counthome();
			$this->pagination->initialize($config);
			$offset = $this->input->get('per_page');

			$this->data['list_news'] = $this->gioithieu_model->getlisthome($offset,$config['per_page']);
            $this->layout->view(strtolower(__CLASS__).'/gioithieu',$this->data);

		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function chitietgioithieu()
    {
        try {
        	$this->layout->setLayout('home_layout');
    		
            $alias = $this->uri->segment(2);

            $this->data['dataset'] = $this->gioithieu_model->getbyslug($alias);
            if(!empty($this->data['dataset'])){
	            $this->data['title'] = $this->data['dataset']->title;
	    		$this->data['meta_des'] = $this->data['dataset']->meta_des;
	    		$this->data['meta_key'] = $this->data['dataset']->meta_key;
	    		$this->data['meta_title'] = $this->data['dataset']->title;
				$this->layout->view(strtolower(__CLASS__).'/chitietgioithieu',$this->data);
			}else{
				redirect(base_url(),'refresh');
			}	
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function chinhsach()
    {
        try {
        	$this->layout->setLayout('home_layout');
            $alias = $this->uri->segment(2);
            $this->data['dataset'] = $this->chinhsach_model->getbyslug($alias);
            if(!empty($this->data['dataset'])){
	            $this->data['title'] = $this->data['dataset']->title;
	    		$this->data['meta_des'] = $this->data['dataset']->meta_des;
	    		$this->data['meta_key'] = $this->data['dataset']->meta_key;
	    		$this->data['meta_title'] = $this->data['dataset']->meta_title;
				$this->layout->view(strtolower(__CLASS__).'/chinhsach',$this->data);
			}else{
				redirect(base_url(),'refresh');
			}	
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function donhang()
    {
    	$infoUser = $this->session->userdata('userlogin');
    	if(!$infoUser){
		    redirect(base_url(),'refresh');
		}
        try {
        	$this->layout->setLayout('home_layout');
        	$userid = (int)$infoUser->id;

            $this->data['title'] = 'Đơn hàng của bạn';
    		$this->data['meta_des'] = 'Đơn hàng của bạn';
    		$this->data['meta_key'] = 'Đơn hàng của bạn';
    		$this->data['meta_title'] = 'Đơn hàng của bạn';

        	$config['base_url'] = current_url().'?';
			$config['num_links'] = 3;
			$config['per_page'] = 10;
			$config['num_tag_open'] = '<li class="page-link">';
    		$config['num_tag_close'] = '</li>';
		    $config['next_tag_open'] = '<li class="page-link">';
		    $config['next_tag_close'] = '</li>';
		    $config['prev_tag_open'] = '<li class="page-link">';
		    $config['prev_tag_close'] = '</li>';
			$config['cur_tag_open']	= '<li class="active"><a href="#" class="page-link">';
			$config['cur_tag_close'] = '</a></li>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['page_query_string'] = TRUE;

			$config['total_rows'] = $this->order_model->countbyid($userid);
			$this->pagination->initialize($config);
			$offset = $this->input->get('per_page');
			$this->data['total_rows'] = $config['total_rows'];
            $this->data['dataset'] = $this->order_model->getlistbyid($userid,$offset,$config['per_page']);

			$this->layout->view(strtolower(__CLASS__).'/donhang',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function chitietdonhang()
    {
    	$infoUser = $this->session->userdata('userlogin');
    	if(!$infoUser){
		    redirect(base_url(),'refresh');
		}
        try {
        	$this->layout->setLayout('home_layout');
        	$userid = (int)$infoUser->id;

            $this->data['title'] = 'Đơn hàng của bạn';
    		$this->data['meta_des'] = 'Đơn hàng của bạn';
    		$this->data['meta_key'] = 'Đơn hàng của bạn';
    		$this->data['meta_title'] = 'Đơn hàng của bạn';

        	$id = $this->uri->segment(2); 
			$this->data['order'] = $this->order_model->getbyid($id);
			$this->data['detail'] = $this->detailorder_model->getall($id); 

			$this->layout->view(strtolower(__CLASS__).'/chitietdonhang',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function product(){
		try {
			$this->layout->setLayout('home_layout');
			$slug = $this->uri->segment(2);

			$this->load->model('comment_model');

			$this->data['products_detail'] = $this->product_model->getbyslug($slug);
			if (!$this->data['products_detail']) {
				redirect(base_url('hd'));
			}
			$this->data['comments'] = $this->comment_model->getlisthome($this->data['products_detail']->id, 0, 50);
			$parent_id = $this->data['products_detail']->parent_id;

			$this->data['products_lienquan'] = $this->product_model->get_lienquan($parent_id,$this->data['products_detail']->id,0,10);
			$this->data['title'] = $this->data['products_detail']->name;
			$this->layout->view(strtolower(__CLASS__).'/product',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function post($id){
		try {
			$this->layout->setLayout('home_layout');
			$this->data['dataset'] = $this->post_model->getbyid($id);
			$this->data['title'] = $this->data['dataset']->title;
			$this->data['meta_title'] = $this->data['dataset']->meta_title;
			$this->data['meta_des'] = $this->data['dataset']->meta_des;
			$this->data['meta_key'] = $this->data['dataset']->meta_key;
			$view = ($id == 1) ? '/post' : (($id == 2) ? '/thietke' : '/inan');
			$this->layout->view(strtolower(__CLASS__).$view,$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function register(){
		try {
			$this->layout->setLayout('home_layout');
			$this->data['meta_title'] = 'Đăng kí thành viên';
			$this->data['meta_key'] = 'Đăng kí thành viên';
			$this->data['meta_des'] = 'Đăng kí thành viên';
			$this->data['title'] = 'Đăng kí thành viên';
			$input = $this->input->post();
			
			if($input){
				$this->form_validation->set_message('required', 'Vui lòng nhập %s');
				$this->form_validation->set_message('is_natural', '%s không hợp lệ');
				$this->form_validation->set_message('min_length', '%s phải trên 6 số');
				$this->form_validation->set_message('valid_email', '%s không hợp lệ');
				$this->form_validation->set_message('matches', '%s không trùng khớp');

				$this->form_validation->set_rules('fullname', 'Họ tên', 'required|trim');
				$this->form_validation->set_rules('username', 'Tài khoản', 'required|trim|callback_username_check');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim|callback_email_check');
				$this->form_validation->set_rules('phone', 'Điện thoại', 'required|is_natural|trim');
				$this->form_validation->set_rules('password', 'Mật khẩu', 'required|trim');
				$this->form_validation->set_rules('repassword', 'Xác thực mật khẩu', 'required|matches[password]');
				
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/register',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('name' => $input['fullname'],
												'username' => $input['username'],
												'password' => md5($input['password']),
												'phone' => $input['phone'],
												'email' => $input['email'],
												'sex' => 1,
												'created' => $date,
												'lastvisited' => $date,
												'status' => 1
					);
					$insert_id = $this->clientuser_model->add($this->data['value']);	
					if ($insert_id && ($insert_id != 0)) {
						$this->_error_array = array();
    					$this->_field_data = array();
						$this->session->set_userdata('thanhcong', 'Cám ơn quý khách đã liên lạc. Chúng tôi sẽ liên hệ trong thời gian sớm nhất');
						redirect(current_url().'#registerForm', 'refresh');
					}
				}
			} else {
				$this->layout->view(strtolower(__CLASS__).'/register',$this->data);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function profile(){
		if(!$this->session->userdata('userlogin')){
		    redirect(base_url(),'refresh');
		}
		try {
			$this->layout->setLayout('home_layout');
			$this->data['meta_title'] = 'Cập nhật thông tin';
			$this->data['meta_key'] = 'Cập nhật thông tin';
			$this->data['meta_des'] = 'Cập nhật thông tin';
			$this->data['title'] = 'Cập nhật thông tin';
			$input = $this->input->post();
			
			if($input){
				$this->form_validation->set_message('required', 'Vui lòng nhập %s');
				$this->form_validation->set_message('is_natural', '%s không hợp lệ');
				$this->form_validation->set_message('min_length', '%s phải trên 6 số');
				$this->form_validation->set_message('valid_email', '%s không hợp lệ');
				$this->form_validation->set_message('matches', '%s không trùng khớp');

				$this->form_validation->set_rules('fullname', 'Họ tên', 'required|trim');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
				$this->form_validation->set_rules('phone', 'Điện thoại', 'required|is_natural|trim');
				$this->form_validation->set_rules('address', 'Địa chỉ', 'required|trim');
				$this->form_validation->set_rules('sex', 'Giới tính', 'required|trim');
				
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/profile',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('name' => $input['fullname'],
												'phone' => $input['phone'],
												'email' => $input['email'],
												'sex' => $input['sex'],
												'address' => $input['address'],
												'created' => $date,
												'lastvisited' => $date,
												'status' => 1
					);
					$userlogin = $this->session->userdata('userlogin');
					$res = $this->clientuser_model->update($userlogin->id, $this->data['value']);
					$clientuser = $this->clientuser_model->getinfo($userlogin->username);
					$this->_error_array = array();
    				$this->_field_data = array();
    				if ($res == 1) {
    					$this->session->set_userdata('userlogin',$clientuser);
    					$this->session->set_userdata('thanhcong', 'Cập nhật thông tin thành công!');
    				}
    				redirect(current_url().'#profileForm', 'refresh');
				}
			} else {
				$this->layout->view(strtolower(__CLASS__).'/profile',$this->data);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function changepass(){
		if(!$this->session->userdata('userlogin')){
		    redirect(base_url(),'refresh');
		}
		try {
			$this->layout->setLayout('home_layout');
			$this->data['meta_title'] = 'Đổi mật khẩu';
			$this->data['meta_key'] = 'Đổi mật khẩu';
			$this->data['meta_des'] = 'Đổi mật khẩu';
			$this->data['title'] = 'Đổi mật khẩu';
			$input = $this->input->post();
			
			if($input){
				$this->form_validation->set_message('required', 'Vui lòng nhập %s');
				$this->form_validation->set_message('is_natural', '%s không hợp lệ');
				$this->form_validation->set_message('min_length', '%s phải trên 6 số');
				$this->form_validation->set_message('valid_email', '%s không hợp lệ');
				$this->form_validation->set_message('matches', '%s không trùng khớp');

				$this->form_validation->set_rules('password_old', 'Mật khẩu cũ', 'required|trim|callback_password_check');
				$this->form_validation->set_rules('password', 'Mật khẩu', 'required|trim');
				$this->form_validation->set_rules('repassword', 'Xác thực mật khẩu', 'required|matches[password]');
				
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/changepass',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('password' => md5($input['password']),
												'lastvisited' => $date
					);
					$userlogin = $this->session->userdata('userlogin');
					$res = $this->clientuser_model->update($userlogin->id, $this->data['value']);
					$clientuser = $this->clientuser_model->getinfo($userlogin->username);
					$this->_error_array = array();
    				$this->_field_data = array();
    				if ($res == 1) {
    					$this->session->set_userdata('userlogin',$clientuser);
    					$this->session->set_userdata('thanhcong', 'Cập nhật thông tin thành công!');
    				}
    				redirect(current_url().'#changeForm', 'refresh');
				}
			} else {
				$this->layout->view(strtolower(__CLASS__).'/changepass',$this->data);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function login(){
		try {
			$this->layout->setLayout('home_layout');
			$this->data['meta_title'] = 'Đăng nhập tài khoản';
			$this->data['meta_key'] = 'Đăng nhập tài khoản';
			$this->data['meta_des'] = 'Đăng nhập tài khoản';
			$this->data['title'] = 'Đăng nhập tài khoản';
			$input = $this->input->post();
			
	        if($this->session->userdata('userlogin')){
	            redirect(base_url(), 'refresh');
	        }else{
				if($input){
					$this->form_validation->set_message('required', 'Vui lòng nhập %s');
					$this->form_validation->set_message('is_natural', '%s không hợp lệ');
					$this->form_validation->set_message('min_length', '%s phải trên 6 số');
					$this->form_validation->set_message('valid_email', '%s không hợp lệ');
					$this->form_validation->set_message('matches', '%s không trùng khớp');

					$this->form_validation->set_rules('username', 'Tài khoản', 'required|trim');
					$this->form_validation->set_rules('password', 'Mật khẩu', 'required|trim');
					
					if($this->form_validation->run()== FALSE){
						$this->layout->view(strtolower(__CLASS__).'/login',$this->data);
					} else {
						$username = $input['username'];
						$password = md5($input['password']);
						$checkLogin = $this->clientuser_model->checklogin($username,$password);
						if(!empty($checkLogin)){
							$this->session->set_userdata('userlogin',$checkLogin);
							redirect(base_url(), 'refresh');
						} else {
							$this->session->set_userdata('error_login', 'Tên đăng nhập hoặc mật khẩu sai');
							$this->layout->view(strtolower(__CLASS__).'/login',$this->data);
						}
					}
				} else {
					$this->layout->view(strtolower(__CLASS__).'/login',$this->data);
				}
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function logout()
	{
		if($this->session->userdata('userlogin'))
		{
			$this->session->unset_userdata('userlogin');
			redirect(base_url('dang-nhap'), 'refresh');
		}
	}
	function email_check($email){
        $checkEmail = $this->clientuser_model->getbyemail($email);
        if(count($checkEmail) > 0){
            $this->form_validation->set_message('email_check', '%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    function password_check($password){
    	$userlogin  = $this->session->userdata('userlogin');
		$username = $userlogin->username;
        $checkPass = $this->clientuser_model->getbyusernameandpass($username, $password);
        if(count($checkPass) > 0){
            return TRUE;
        } else {
            $this->form_validation->set_message('password_check', '%s không đúng');
            return FALSE;
        }
    }
    function username_check($username){
        $checkUsername = $this->clientuser_model->getbyusername($username);
        if(count($checkUsername) > 0){
            $this->form_validation->set_message('username_check', '%s đã tồn tại');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	function contact(){
		try {
			$this->layout->setLayout('home_layout');
			$this->data['active'] = 'contact';
			$this->data['meta_title'] = $this->data['config']['meta_contact_title'];
			$this->data['meta_key'] = $this->data['config']['meta_contact_des'];
			$this->data['meta_des'] = $this->data['config']['meta_contact_key'];
			$this->data['title'] = 'Liên hệ';
			$input = $this->input->post();
			
			if($input){
				$this->form_validation->set_message('required', 'Vui lòng nhập %s');
				$this->form_validation->set_message('is_natural', '%s không hợp lệ');
				$this->form_validation->set_message('min_length', '%s phải trên 6 số');
				$this->form_validation->set_message('valid_email', '%s không hợp lệ');
				$this->form_validation->set_rules('fullname', 'Họ tên', 'required|trim');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
				$this->form_validation->set_rules('phone', 'Điện thoại', 'required|is_natural|trim');
				$this->form_validation->set_rules('address', 'Địa chỉ', 'required|trim');
				$this->form_validation->set_rules('content', 'Nội dung', 'required|trim');
				
				if($this->form_validation->run()== FALSE){
					$this->layout->view(strtolower(__CLASS__).'/contact',$this->data);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('name' => $input['fullname'],
												'address' => $input['address'],
												'phone' => $input['phone'],
												'content' => $input['content'],
												'email' => $input['email'],
												'created' => $date,
												'modified' => $date,
												'status' => -1
					);
					$this->load->model('contact_model');
					$insert_id = $this->contact_model->add($this->data['value']);	
					if ($insert_id && ($insert_id != 0)) {
						$this->data['thanhcong'] = "Cám ơn quý khách đã liên lạc. Chúng tôi sẽ liên hệ trong thời gian sớm nhất";
						$this->layout->view(strtolower(__CLASS__).'/contact',$this->data);
					}
				}
			} else {
				$this->layout->view(strtolower(__CLASS__).'/contact',$this->data);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function recivemail(){
		try {
			$this->load->model('recivemail_model');
			$input = $this->input->post();
			if($input){
				$this->form_validation->set_message('required', 'Vui lòng nhập %s');
				$this->form_validation->set_message('is_natural', '%s không hợp lệ');
				$this->form_validation->set_message('min_length', '%s phải trên 6 số');
				$this->form_validation->set_message('valid_email', '%s không hợp lệ');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
				
				if($this->form_validation->run()== FALSE){
					$errors = validation_errors();
		            echo json_encode(['message'=>'Vui lòng nhập đúng yêu cầu.', 'code'=>'0']);
				} else {
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('email' => $input['email'],
												'created' => $date,
												'modified' => $date,
												'status' => -1
					);

					$insert_id = $this->recivemail_model->add($this->data['value']);
					echo json_encode(['message'=>'Cám ơn quý khách đã liên lạc.','code'=>'000']);
				}
			} else {
				echo json_encode(['message'=>'Vui lòng nhập đầy đủ.', 'code'=>'0']);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function comment(){
		try {
			$this->load->model('comment_model');
			$input = $this->input->post();
			if($input){
				$this->form_validation->set_message('required', 'Vui lòng nhập %s');
				$this->form_validation->set_message('is_natural', '%s không hợp lệ');
				$this->form_validation->set_message('min_length', '%s phải trên 6 số');
				$this->form_validation->set_message('valid_email', '%s không hợp lệ');
				$this->form_validation->set_rules('name', 'Họ tên', 'required|trim');
				$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
				$this->form_validation->set_rules('content', 'Nội dung ghi chú', 'required|trim');
				
				if($this->form_validation->run()== FALSE){
					$errors = validation_errors();
		            echo json_encode(['message'=>'Vui lòng nhập đúng yêu cầu.', 'code'=>'0']);
				} else {
					$str_img = null;
					$trimemail = trim($input['email']);
					$json = file_get_contents('http://picasaweb.google.com/data/entry/api/user/'.$trimemail.'?alt=json');
					$obj = json_decode($json);
					$arr = (array)$obj->entry;
					$arr_img = (array)$arr['gphoto$thumbnail'];
					$img = $arr_img['$t'];
					if (!empty($img)) {
						$str_img = $img;
					}
					$date = date("Y-m-d H:i:s");
					$this->data['value'] = array('email' => $input['email'],
												'name' => $input['name'],
												'rating' => (int)$input['rating'],
												'content' => $input['content'],
												'id_product' => (int)$input['id_product'],
												'name_product' => $input['name_product'],
												'image' => $str_img,
												'created' => $date,
												'modified' => $date,
												'status' => 0
					);
					$insert_id = $this->comment_model->add($this->data['value']);
					echo json_encode(['message'=>'Cám ơn quý khách đã liên lạc.','code'=>'000']);
				}
			} else {
				echo json_encode(['message'=>'Vui lòng nhập đầy đủ thông tin.', 'code'=>'0']);
			}
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function css() {
		$this->layout->setLayout('home_layout');
		$this->layout->view(strtolower(__CLASS__).'/css',$this->data);
	}
}