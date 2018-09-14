<?php 
class hd extends CI_Controller 
{
    public function __construct() 
    {
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
        $this->data['config'] = $this->config_model->getconfig();
        $this->data['menu_maus'] = $this->category_model->getbyparent();
        $this->data['menu_tintucs'] = $this->loaitintuc_model->getlisthome(0,10);
        $this->data['chinhsachs'] = $this->chinhsach_model->getlisthome(0,10);
        $this->data['gioithieus'] = $this->gioithieu_model->getlisthome(0,10);
        $this->data['tintucs'] = $this->tintuc_model->getlistnoibat(0,6);
        $this->data['tags'] = $this->tags_model->getlisthome(0,20);
    } 

    public function index() 
    { 
        $this->layout->setLayout('loi_layout');
        $this->layout->view(strtolower(__CLASS__).'/index',$this->data);      
    } 
} 
?> 