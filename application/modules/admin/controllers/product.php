<?php

class Product extends CI_Controller
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

			$this->load->model('category_model');

			$this->load->model('product_model');
			$this->data['auth'] = $auth;

			$this->data['controller'] = strtolower(__CLASS__);

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

			$config['total_rows'] = $this->product_model->count($key);

			$this->pagination->initialize($config);

			// load data with parameters

			$offset = $this->input->get('per_page');

			$this->data['total_rows'] = $config['total_rows'];

			$this->data['dataset'] = $this->product_model->getlist($key,$offset,$config['per_page']);

			$this->layout->view(strtolower(__CLASS__).'/index',$this->data);

		} catch (Exception $e) {

			echo $e->getMessage(); die();

		}

	}

	function generateSlug($title){

		$slug = url_title(trim($title), 'dash', true);

		$suffix = 0;

		while($this->product_model->getbyslug($slug)){

			if ($suffix)

				$slug = preg_replace ('/[0-9]+$/', ++$suffix, $slug );

			else

				$slug .= '-' . ++$suffix;

		}

		return $slug;

	}
	
	

	function add(){

		try {

			$this->data['action'] = strtolower(__FUNCTION__);

			$this->data['categories'] = $this->category_model->getmenu();
			$input = $this->input->post();

			//------------------

			if (!$input){			

				$this->layout->view($this->data['controller'].'/modify',$this->data);

			} else {

				$this->form_validation->set_rules('name', 'Name', 'min_length[1]|max_length[255]|trim|required');

				$this->form_validation->set_rules('code', 'Mã sản phẩm', 'min_length[1]|max_length[255]|trim|required');

				$this->form_validation->set_rules('parent', 'Category', '');

				$this->form_validation->set_rules('price', 'Price', '');

				$this->form_validation->set_rules('rating', 'Rating', '');				

				$this->form_validation->set_rules('description', 'Description', '');

				

				if($this->form_validation->run()== FALSE){

					$this->form_validation->set_message('is_unique', '%s đã được sử dụng');	

					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);

				} else {

					$date = date("Y-m-d H:i:s");
					
					$slug = $this->generateSlug($input['name']);
					

					$this->data['value_slug'] = array('slug' => $slug,

												'fun' => 'product',

												'created' => $date,

												'status' => '1'

					);

					$this->data['value'] = array('name' => $input['name'],
												'slug' => $slug,
												'code' => $input['code'],
												'meta_key' => $input['meta_key'],
												'meta_des' => $input['meta_des'],
												'parent_id' => $input['parent'],

												'description' => $input['description'],
												'content' => $input['content'],

												'price' => $input['price'],

												'rating' => $input['rating'],

												'order' => $input['order'],

												'sale' => $input['sale'],
												'noibat' => $input['noibat'],

												'created' => $date,

												'created_by' => $this->data['auth']->username,

												'modified' => $date,

												'modified_by' => $this->data['auth']->username,

												'status' => $input['status'],
												'hethang' => $input['hethang'],
												'banchay' => $input['banchay'],
												
												'price_sale' => $input['price_sale'],

					);

					$insert_id = $this->product_model->add($this->data['value']);

					// -------- Image Upload -----------

						if($_FILES['product-image']['name']){
							$config['upload_path'] = 'upload/product/home/';
							if (!file_exists($config['upload_path'])) {
								mkdir($config['upload_path']);
								mkdir($config['upload_path'].'/thumb');								
							}
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['encrypt_name'] = FALSE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							//-------- upload file -----------
							$upload_data = null;
							if (!$this->upload->do_upload('product-image')){
								$this->data['error'] = $this->upload->display_errors();
							} else {
								$upload_data =  $this->upload->data();
								$this->data['value']['image'] = $upload_data['file_name'];
								$this->load->library('image_lib');
								$iconfig['image_library'] = 'GD2';
								$iconfig['maintain_ratio'] = TRUE;
								$iconfig['source_image']= $upload_data['full_path'];
								$iconfig['new_image']= $config['upload_path'];
								$this->image_lib->initialize($iconfig);
								if ( !$this->image_lib->resize()){
									$this->data['error'] = $this->upload->display_errors();
								}
								$iconfig['create_thumb'] = TRUE;
								$iconfig['width']     = 300;
								$iconfig['height']    = 400;
								$iconfig['new_image'] = $config['upload_path']."/thumb";
								$this->image_lib->initialize($iconfig);
								if ( ! $this->image_lib->resize()){
									$this->data['error'] = $this->upload->display_errors();
								}
							}
							if(!empty($this->data['error'])){
								$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
							} else {
								$this->product_model->update($insert_id, array('image' => $upload_data['file_name']));
							}

						}
						if($_FILES['product-image-hover']['name']){
							$config['upload_path'] = 'upload/product/hover/';
							if (!file_exists($config['upload_path'])) {
								mkdir($config['upload_path']);
								mkdir($config['upload_path'].'/thumb');								
							}
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['encrypt_name'] = FALSE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							//-------- upload file -----------
							$upload_data = null;
							if (!$this->upload->do_upload('product-image-hover')){
								$this->data['error'] = $this->upload->display_errors();
							} else {
								$upload_data =  $this->upload->data();
								$this->data['value']['image'] = $upload_data['file_name'];
								$this->load->library('image_lib');
								$iconfig['image_library'] = 'GD2';
								$iconfig['maintain_ratio'] = TRUE;
								$iconfig['source_image']= $upload_data['full_path'];
								$iconfig['new_image']= $config['upload_path'];
								$this->image_lib->initialize($iconfig);
								if ( !$this->image_lib->resize()){
									$this->data['error'] = $this->upload->display_errors();
								}
								$iconfig['create_thumb'] = TRUE;
								$iconfig['width']     = 300;
								$iconfig['height']    = 400;
								$iconfig['new_image'] = $config['upload_path']."/thumb";
								$this->image_lib->initialize($iconfig);
								if ( ! $this->image_lib->resize()){
									$this->data['error'] = $this->upload->display_errors();
								}
							}
							if(!empty($this->data['error'])){
								$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
							} else {
								$this->product_model->update($insert_id, array('image2' => $upload_data['file_name']));
							}

						}

						//----------- Images Upload ----------
						if($_FILES['image-upload']['name'][0]){
							$config['upload_path'] = './upload/product/show/';
							if (!file_exists($config['upload_path'])) {
								mkdir($config['upload_path']);
								mkdir($config['upload_path'].'/min');
							}
							$config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['encrypt_name'] = FALSE;
							$this->load->library('upload', $config);
							$this->upload->initialize($config);
							$upload_data = null;
							$images = array();

							for($i=0;$i<count($_FILES['image-upload']['name']); $i++){
								$_FILES['userfile']['name']    = $_FILES['image-upload']['name'][$i];
								$_FILES['userfile']['type']    = $_FILES['image-upload']['type'][$i];
								$_FILES['userfile']['tmp_name']= $_FILES['image-upload']['tmp_name'][$i];
								$_FILES['userfile']['error']   = $_FILES['image-upload']['error'][$i];
								$_FILES['userfile']['size']    = $_FILES['image-upload']['size'][$i];
								if (!$this->upload->do_upload()){
									$this->data['error'] = $this->upload->display_errors();
								} else {
									$upload_data =  $this->upload->data();
									// thumbnail
									$this->load->library('image_lib');
									$iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2
									$iconfig['maintain_ratio'] = TRUE;
									$iconfig['source_image']= $upload_data['full_path'];
									$iconfig['width']     = 100;
									$iconfig['height']    = 100;
									$iconfig['new_image'] = $config['upload_path']."/min/";
									$this->image_lib->initialize($iconfig);
									if ( ! $this->image_lib->resize())
									{
										$this->data['error'] = $this->upload->display_errors();
									}
									$this->image_lib->initialize($iconfig);
									if ( ! $this->image_lib->resize()){
										$this->data['error'] = $this->upload->display_errors();
									}
									array_push($images,$upload_data['file_name']);
									$this->image_lib->clear();
								}

							}

							if(!empty($this->data['error'])){
								$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
							} else {
								$this->product_model->update($insert_id,array('list_img' => json_encode($images)));
							}
						}
						
						// ---------- end Images Upload ------------------
					if(empty($this->data['error'])) redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=add");
					// -------- end Image Upload -----------
				}

			}

		} catch (Exception $e) {

			echo $e->getMessage(); die();

		}

	}

	function livestatus(){

		try {

			$id = $this->input->post('id');

			$product = $this->product_model->getbyid($id);

			if(!empty($product)){

				if($product->status == 1 || $product->status == -1) $this->product_model->update($id,array('status' => -$product->status));

				$message = array('status' => -$product->status, 'content' => ($product->status == 1)?'Draff':'Public');

				echo json_encode($message);

			}

		} catch (Exception $e) {

			echo $e->getMessage(); die();

		}

	}

	function livesale(){

		try {

			$id = $this->input->post('id');

			$product = $this->product_model->getbyid($id);

			if(!empty($product)){

				if($product->sale == 1 || $product->sale == -1) $this->product_model->update($id,array('sale' => -$product->sale));

				$message = array('sale' => -$product->sale, 'content' => ($product->sale == 1)?'No':'Yes');

				echo json_encode($message);

			}

		} catch (Exception $e) {

			echo $e->getMessage(); die();

		}

	}

	function livenews(){

		try {

			$id = $this->input->post('id');

			$product = $this->product_model->getbyid($id);

			if(!empty($product)){

				if($product->news == 1 || $product->news == -1) $this->product_model->update($id,array('news' => -$product->news));

				$message = array('news' => -$product->news, 'content' => ($product->news == 1)?'No':'Yes');

				echo json_encode($message);

			}

		} catch (Exception $e) {

			echo $e->getMessage(); die();

		}

	}

	function edit(){

		try {

			$id = $this->uri->segment(4);

			if (isset($id)){

				$this->data['action'] = strtolower(__FUNCTION__);

				$this->data['product'] = $this->product_model->getbyid($id);

				$this->data['categories'] = $this->category_model->getmenu();

				$input = $this->input->post();

				//----------------------

				if (empty($input)){

					$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);

				} else {

					$this->form_validation->set_rules('name', 'Name', 'min_length[1]|max_length[255]|trim|required');

					$this->form_validation->set_rules('code', 'Mã sản phẩm', 'min_length[1]|max_length[255]|trim|required');

					$this->form_validation->set_rules('parent', 'Category', '');

					$this->form_validation->set_rules('price', 'Price', '');

					$this->form_validation->set_rules('rating', 'Rating', '');				

					$this->form_validation->set_rules('description', 'Description', '');

					if($this->form_validation->run()== FALSE){

						$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);

					} else {

						$date = date("Y-m-d H:i:s");
						$this->data['value'] = array('name' => $input['name'],

													'code' => $input['code'],
													'meta_key' => $input['meta_key'],
													'meta_des' => $input['meta_des'],

													'parent_id' => $input['parent'],

													'description' => $input['description'],

													'price' => $input['price'],

													'rating' => $input['rating'],	
													'sale' => $input['sale'],
													'content' => $input['content'],
													'modified' => $date,
													'noibat' => $input['noibat'],
													'modified_by' => $this->data['auth']->username,

													'order' => $input['order'],

													'status' => $input['status'],
													'hethang' => $input['hethang'],
													'banchay' => $input['banchay'],
													
													'price_sale' => $input['price_sale'],

						);

						$this->product_model->update($id,$this->data['value']);

						$insert_id = $id;

						// -------- Image Upload -----------

						if($_FILES['product-image']['name']){
                            $config['upload_path'] = './upload/product/home/';
                            if (!file_exists($config['upload_path'])) {
                                mkdir($config['upload_path']);
                                mkdir($config['upload_path'].'/thumb');                                
                            }

                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            $config['encrypt_name'] = FALSE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            //-------- upload file -----------
                            $upload_data = null;
                            if (!$this->upload->do_upload('product-image')){
                                $this->data['error'] = $this->upload->display_errors();
                            } else {
                                $upload_data =  $this->upload->data();
                                $this->data['value']['image'] = $upload_data['file_name'];
                                //-------- resize image and create thumbnail -----------
                                $this->load->library('image_lib');

                                $iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2

                                $iconfig['maintain_ratio'] = TRUE;
                                $iconfig['source_image']= $upload_data['full_path'];

                                $iconfig['new_image']= $config['upload_path'];

                                $this->image_lib->initialize($iconfig);

                                if ( !$this->image_lib->resize()) {
                                    $this->data['error'] = $this->upload->display_errors();
                                }
                                $iconfig['create_thumb'] = TRUE;
                                $iconfig['width']     = 300;
                                $iconfig['height']    = 400;
                                $iconfig['new_image'] = $config['upload_path']."/thumb";
                                $this->image_lib->initialize($iconfig);

                                if ( ! $this->image_lib->resize()) {
                                    $this->data['error'] = $this->upload->display_errors();
                                }
                            }
                            if(!empty($this->data['error'])){
                                $this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
                            } else {
                                $this->product_model->update($insert_id, array('image' => $upload_data['file_name']));
                            }
                        }

                        if($_FILES['product-image-hover']['name']){
                            $config['upload_path'] = './upload/product/hover/';
                            if (!file_exists($config['upload_path'])) {
                                mkdir($config['upload_path']);
                                mkdir($config['upload_path'].'/thumb');                                
                            }

                            $config['allowed_types'] = 'gif|jpg|png|jpeg';
                            $config['encrypt_name'] = FALSE;
                            $this->load->library('upload', $config);
                            $this->upload->initialize($config);
                            //-------- upload file -----------
                            $upload_data = null;
                            if (!$this->upload->do_upload('product-image-hover')){
                                $this->data['error'] = $this->upload->display_errors();
                            } else {
                                $upload_data =  $this->upload->data();
                                $this->data['value']['image'] = $upload_data['file_name'];
                                //-------- resize image and create thumbnail -----------
                                $this->load->library('image_lib');

                                $iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2

                                $iconfig['maintain_ratio'] = TRUE;
                                $iconfig['source_image']= $upload_data['full_path'];

                                $iconfig['new_image']= $config['upload_path'];

                                $this->image_lib->initialize($iconfig);

                                if ( !$this->image_lib->resize()) {
                                    $this->data['error'] = $this->upload->display_errors();
                                }
                                $iconfig['create_thumb'] = TRUE;
                                $iconfig['width']     = 300;
                                $iconfig['height']    = 400;
                                $iconfig['new_image'] = $config['upload_path']."/thumb";
                                $this->image_lib->initialize($iconfig);

                                if ( ! $this->image_lib->resize()) {
                                    $this->data['error'] = $this->upload->display_errors();
                                }
                            }
                            if(!empty($this->data['error'])){
                                $this->layout->view(strtolower(__CLASS__).'/modify',$this->data);
                            } else {
                                $this->product_model->update($insert_id, array('image2' => $upload_data['file_name']));
                            }
                        }
						//----------- Images Upload ----------

						if($_FILES['image-upload']['name'][0]){

							$config['upload_path'] = './upload/product/show/';

							if (!file_exists($config['upload_path'])) {
								mkdir($config['upload_path']);
								mkdir($config['upload_path'].'/min');
							}

							$config['allowed_types'] = 'gif|jpg|png|jpeg';

							$config['encrypt_name'] = FALSE;

							$this->load->library('upload', $config);

							$this->upload->initialize($config);

							$upload_data = null;

							$images = array();

							

							for($i=0;$i<count($_FILES['image-upload']['name']); $i++){

								$_FILES['userfile']['name']    = $_FILES['image-upload']['name'][$i];

								$_FILES['userfile']['type']    = $_FILES['image-upload']['type'][$i];

								$_FILES['userfile']['tmp_name'] = $_FILES['image-upload']['tmp_name'][$i];

								$_FILES['userfile']['error']       = $_FILES['image-upload']['error'][$i];

								$_FILES['userfile']['size']    = $_FILES['image-upload']['size'][$i];

								if (!$this->upload->do_upload())

								{

									$this->data['error'] = $this->upload->display_errors();

								} else {

									$upload_data =  $this->upload->data();
									// thumbnail
									$this->load->library('image_lib');
									$iconfig['image_library'] = 'GD2'; //i also wrote GD/gd2
									$iconfig['maintain_ratio'] = TRUE;
									$iconfig['source_image']= $upload_data['full_path'];
									$iconfig['width']     = 100;
									$iconfig['height']    = 100;
									$iconfig['new_image'] = $config['upload_path']."/min/";
									$this->image_lib->initialize($iconfig);
									if ( ! $this->image_lib->resize())
									{
										$this->data['error'] = $this->upload->display_errors();
									}
									$this->image_lib->initialize($iconfig);
									if ( ! $this->image_lib->resize()){
										$this->data['error'] = $this->upload->display_errors();
									}
									array_push($images,$upload_data['file_name']);
									$this->image_lib->clear();
								}

							}

							if(!empty($this->data['error'])){

								$this->layout->view(strtolower(__CLASS__).'/modify',$this->data);

							} else {

								$this->product_model->update($insert_id,array('list_img' => json_encode($images)));

							}

						}

						// ---------- end Images Upload ------------------

							

						if(empty($this->data['error'])) redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=edit");

						// -------- end Image Upload -----------

					}

				}

			} else {

				show_404();

			}

		} catch (Exception $e) {

			echo $e->getMessage();die();

		}

	}	

	function delete(){

		try {

			$id = $this->input->post('list');

			if(!empty($id)){

				foreach ($id as $row):

				$this->product_model->delete($row);

				endforeach;

			}

			else{

				$id = $this->uri->segment(4);

				if (!empty($id)) $this->product_model->delete($id);

			}

			redirect($this->data['module'].'/'.strtolower(__CLASS__)."?update=del");

		} catch (Exception $e) {

			echo $e->getMessage(); die();

		}

	}

	function live_generateSlug(){

		$slug = $this->generateSlug($this->input->post('title'));

		echo $slug;

	}

	function liveprice(){	
		try {			
			$input = $this->input->post();			
			$value = $input['value']; 			
			$value1 = str_replace(array('.',','), "", $value); 	 			
			$value2 = intval($value1);			
			$id = $input['id'];					
			$this->data['value'] = array('id' => $id, 'price' => $value2,);
			$this->product_model->update($id,$this->data['value']);						
			$product = $this->product_model->getbyid($id);			
			$message = number_format($product->price, 0, ',', '.');			
			echo json_encode($message);				
		} catch (Exception $e) {
			echo $e->getMessage(); die();		
		}	
	}

}