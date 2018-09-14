<?php
class Cart extends CI_Controller
{	var $data = array();
	function __construct(){		 
		parent::__construct();
		$this->layout->setLayout('home_layout');
		$this->data['controller'] = strtolower(__CLASS__);
		//init home data
		

		$this->data['cart'] = $this->cart->contents();
		$this->data['auth'] = $this->session->userdata('auth');
		// cart
		$this->data['total_items'] = $this->cart->total_items();
		
		$this->load->model('config_model');
		$this->load->model('product_model');
		$this->load->model('post_model');
		$this->load->model('category_model');
		$this->load->model('loaitintuc_model');
		$this->load->model('tintuc_model');
		$this->load->model('chinhsach_model');
		$this->load->model('clientuser_model');
		$this->load->model('gioithieu_model');
		$this->load->model('mausac_model');
		$this->load->model('size_model');
		$this->load->model('bank_model');
		$this->load->model('tinhthanhpho_model');
		$this->load->model('quanhuyen_model');
		$this->data['config'] = $this->config_model->getconfig();
		$this->data['menu_maus'] = $this->category_model->getbyparent();
		$this->data['menu_tintucs'] = $this->loaitintuc_model->getlisthome(0,10);
		$this->data['chinhsachs'] = $this->chinhsach_model->getlisthome(0,10);
		$this->data['gioithieus'] = $this->gioithieu_model->getlisthome(0,10);
		$this->data['tintucs'] = $this->tintuc_model->getlistnoibat(0,6);
		$this->data['banks'] = $this->bank_model->getlisthome(0,10);
		$this->data['tinhthanhphos'] = $this->tinhthanhpho_model->getlist();
	}
	function add(){
		try {			
			$id = $this->input->get('pid');
			$_qty = $this->input->get('qty');
			$_color = $this->input->get('color');
			$_size = $this->input->get('size');
			$sl = 1;
			$size = null;
			$color = null;
			$title_size = null;
			$title_color = null;
			$img_color = null;
			if (isset($_qty) && !empty($_qty)) {
				$sl = (int)$this->input->get('qty');
			}
			if (isset($_size) && !empty($_size)) {
				$size = (int)$this->input->get('size');
				$row_size = $this->size_model->getbyid($size);
				$title_size = $row_size->title;
			}
			if (isset($_color) && !empty($_color)) {
				$color = (int)$this->input->get('color');
				$row_color = $this->mausac_model->getbyid($color);
				$title_color = $row_color->title;
				$img_color = $row_color->image;
			}
			$product = $this->product_model->getbyid($id); 		
			if($product->sale == 1){
				$price = $product->price_sale;
			}else{
				$price = $product->price;
			}
			$flag = 1;
	        $dataTmp = $this->cart->contents();
	        foreach ($dataTmp as $item) {
	            if ($item['id'] == $id) {
	            	if ($item['options']['idsize'] == $_size && $item['options']['idcolor'] == $_color) {
	            		$qtyn = $item['qty'] + $sl;
		                $this->cart->update(array(
	                              'rowid' => $item['rowid'],
	                               'qty'   => $qtyn
	                    ));
		                $flag = 0;
		                break;
	            	}
	            }
	        }
	        if ($flag == 1) {
				if (!empty($product)){
					$data = array(
					   'id'   => $product->id,
					   'qty'  => $sl,
					   'price'=> (int)$price,
					   'name' => $product->name,
					   'options' => array(
					   		 'code' => $product->code,
							 'image'=> $product->image,
							 'slug' => $product->slug,						   
							 'idcolor' => $color,						   
							 'idsize' => $size,						   
							 'title_size' => $title_size,						   
							 'title_color' => $title_color,						   
							 'img_color' => $img_color,						   
							 'product_category_slug'=> $product->product_category_slug
					   )
					);
					$this->cart->insert($data); 
				}
			}
			redirect(strtolower(__CLASS__).'/index');
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function index(){
		try {			
            $this->data['site_title'] = "Giỏ hàng"; 
			//$this->data['guidenav'] = array((object) array('name'=>'Giỏ Hàng','slug'=>'#', 'type'=>'1'));
			$step = $this->input->get('step');
			$cartInfo = $this->session->userdata('cartInfo');
			
			$cart = $this->cart->contents(); 
			$this->data['total'] = $this->cart->total();
			
			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function destroy(){
		try { 
			//$this->cart->destroy();
			$id = $this->input->get('pid');
			if(!empty($id)){ 
				$sz = $this->cart->update(array(
						'rowid' => $id,
						'qty'   => '0'
				));
				$cart = $this->cart->contents();
			}
			redirect(strtolower(__CLASS__).'/index');
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}		
	}
	function update(){
		try { 
			$input = $this->input->post();  
			if(empty($input) || !isset($input['qty']) ){
				redirect('cart/index');
			} else {
                foreach( $input['qty'] as $key => $val ){
                    $this->cart->update(array(
                              'rowid' => $key,
                               'qty'   => $val
                    ));
                }
				//$cart = $this->cart->contents();
				//echo number_format($cart[$input['rowid']]['subtotal']);die;
			}
			redirect('cart/index');
			} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	function quanhuyen(){
		try { 
			$id = $this->input->post('pid');
			$quanhuyen = $this->quanhuyen_model->getlistparent($id);
			return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode(array(
                'data' => $quanhuyen
            )));
		} catch (Exception $e) {
			echo $e->getMessage(); die();
		}
	}
	
	function create_image() 
	{ 
		$md5_hash = md5(rand(0,999)); 
		$security_code = substr($md5_hash, 15, 4); 
		
		$this->session->set_userdata('security_code',$security_code);
		$width = 50; 
		$height = 25;  
		$image = ImageCreate($width, $height);  
		$white = ImageColorAllocate($image, 0, 0, 0); 
		$black = ImageColorAllocate($image, 255, 255, 255); 
		ImageFill($image, 0, 0, $black); 
		ImageString($image, 5, 10, 6, $security_code, $white); 
		header("Content-Type: image/jpeg"); 
		ImageJpeg($image); 
		ImageDestroy($image); 
	} 
	function checkout(){
		$this->data['site_title'] = "Thanh toán"; 
		$cart = $this->cart->contents();
		if(empty($cart)){
			redirect('cart/index');
		} else { 
			$input = $this->input->post(); 
			
			$this->data['total'] = $this->cart->total();
			$this->form_validation->set_message('required', 'Vui lòng nhập %s');
			$this->form_validation->set_message('is_natural', '%s không hợp lệ');
			$this->form_validation->set_message('min_length', '%s phải trên 6 số');
			$this->form_validation->set_message('valid_email', '%s không hợp lệ');
			$this->form_validation->set_rules('fullname', 'Tên', 'required|trim');
			$this->form_validation->set_rules('phone', 'Điện thoại', 'required|is_natural|min_length[6]');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('address', 'Địa chỉ', 'required|trim');
			$this->form_validation->set_rules('tinhthanhpho', 'Tỉnh/Thành phố', 'required|trim');
			$this->form_validation->set_rules('quanhuyen', 'Quận/Huyện', 'required|trim');
			// $this->form_validation->set_rules('content', 'Nội dung', 'required|trim');
			
			if($this->form_validation->run()== FALSE){				
				$this->layout->view(strtolower(__CLASS__).'/index',$this->data);
			} else {
				$this->load->model('config_model'); 
				$this->load->model('order_model'); 
				$this->load->model('detailorder_model'); 
				$site_config = $this->config_model->getconfig();  
				/////////////////////////////////////////////////////////////////////
				$date = date("Y-m-d H:i:s");
				$infoUser = $this->session->userdata('userlogin');
				$iduser = 0;
				if ($infoUser && !empty($infoUser->id)) {
					$iduser = $infoUser->id;
				}
				$total = $this->cart->total();
				$this->data['value'] = array('name' => $input['fullname'],
											'email' => $input['email'],
											'address' => $input['address'],
											'phone' => $input['phone'],
											'content' => $input['content'],
											'payment' => $input['payment'],
											'tinhthanhpho' => $input['tinhthanhpho'],
											'quanhuyen' => $input['quanhuyen'],
											'organ' => $input['organ'],
											'total_order' => $total,
											'created' => $date,
											'status' => 1,
											'userid' => (int)$iduser
				);
				$insert_id = $this->order_model->add($this->data['value']);				
				//var_dump($cart);
				foreach ( $cart as $p){
					$this->data['value_p'] = array('order_id' => $insert_id,
												'product_id' => $p['id'],													
												'name' => $p['name'],
												'price' => $p['price'],													
												'qty' => $p['qty'],													
												'total' => $p['subtotal'],													
												'code' => $p['options']['code'],
												'image' => $p['options']['image'],
												'parent_slug' => $p['options']['product_category_slug'],
												'slug' => $p['options']['slug'],
					);
					$this->detailorder_model->add($this->data['value_p']); 
				}			
				/////////////////////////////////////////////////////////////////////
					
					$this->data['name'] = set_value('name');
					$this->data['email'] = set_value('email');	 
					$this->data['address'] = set_value('address');	
					$this->data['phone'] = set_value('phone');
					$this->data['content'] = set_value('content');
									
					$this->data['order'] = $this->order_model->getbyid($insert_id);
					$this->data['detail'] = $this->detailorder_model->getall($insert_id);
					
					$this->cart->destroy();
					?>
						<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
						<script type="text/javascript">
							alert("Cám ơn quý khách đã đặt hàng thông tin. Chúng tôi sẽ liên lạc trong thời gian sớm.");
							window.location="<?php echo base_url();?>";
						</script>
					<?php
			}			
		}
	}
}
?>