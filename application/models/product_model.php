<?php

class Product_model extends CI_Model{

	

	function __construct()

	{

		parent::__construct();

	}

	function count($s){

		$this->db->from('product');

		$this->db->where('status !=',0);

		$this->db->like('name', $s); 

		return $this->db->count_all_results();

	}
	function countbanchay($s){

		$this->db->from('product');

		$this->db->where('status !=',0);
		$this->db->where('banchay', 1);
		$this->db->like('name', $s); 

		return $this->db->count_all_results();

	}
	function countparent($id){

		$this->db->select('*');

		$this->db->from('product');

		$this->db->where('status !=',0);

		$this->db->where_in('parent_id', $id); 

		return $this->db->count_all_results();

	}
	function countgetbyparent($arr){

		$this->db->select('product.*');

		$this->db->where_in('product.parent_id',$arr);

		$this->db->where('product.status', 1);

		$this->db->join('category','product.parent_id = category.id','left');

		$this->db->from('product');

		return  $this->db->count_all_results();

	}
	function getlist($s,$offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');

		$this->db->where('product.status !=',0);

		$this->db->like('product.name', $s);

		$this->db->limit($limit,$offset);

		$this->db->order_by('created','desc');

		$query = $this->db->get();

		return $query->result();
	}
	function getlistwhere($s,$min,$max,$offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');

		$this->db->where('product.status',1);
		$this->db->where('product.price >=',$min);
		$this->db->where('product.price <=',$max);

		$this->db->like('product.name', $s);

		$this->db->limit($limit,$offset);

		$this->db->order_by('created','desc');

		$query = $this->db->get();

		return $query->result();

	}
	function getbyslug($slug){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');

		$this->db->where('product.status',1);
		$this->db->where('product.slug', $slug);
		$query = $this->db->get();

		return $query->row();

	}

	function getbyslug2($slug){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where('product.slug', $slug);

		$this->db->where('product.status', 1);

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');		
		
		$query = $this->db->get();

		return $query->row();

	}
	function add($data){

		$this->db->insert('product',$data);

		return $this->db->insert_id();

	}

	function getbyid($id){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where('product.id', $id);

		$this->db->where('product.status !=', 0);

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');		
		
		$query = $this->db->get();

		return $query->row();

	}

	function update($id,$data){

		$this->db->where('id', $id);

		$this->db->update('product', $data);

	}

	function delete($id){

		$this->db->where('id', $id);

		$this->db->update('product', array('status' => 0));

	}

	function countsale(){
		$this->db->from('product');
		$this->db->where('status !=',0);
		$this->db->where('sale', 1);
		$this->db->where('price >', 0);
		$this->db->where('price_sale >', 0);
		return $this->db->count_all_results();
	}
	function getsale($offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where('product.status', 1);

		$this->db->where('product.sale', 1);
		
		$this->db->where('product.price >', 0);

		$this->db->where('product.price_sale >', 0);

		$this->db->order_by('product.order desc, product.created desc'); 

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');

		$this->db->limit($limit,$offset);

		$this->db->order_by('created','desc');

		$query = $this->db->get();

		return $query->result();

	}
	function getsale2(){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where('product.status', 1);

		$this->db->where('product.sale', 1);
		
		$this->db->where('product.price >', 0);
		$this->db->limit(3);

		$this->db->order_by('product.order desc, product.created desc'); 

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');
		
		

		$query = $this->db->get();

		return $query->result();

	}

	function getnews(){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where('product.status', 1);

		$this->db->where('product.news', 1);

		$this->db->order_by('product.order desc, product.created desc'); 

		$this->db->from('product');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get();

		return $query->result();

	}
	function getbyparents($arr,$offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');
		$this->db->limit($limit,$offset);

		$this->db->where('product.parent_id',$arr);
		$this->db->where('product.status', 1);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();


	}
	function getbyparent($arr,$offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where_in('product.parent_id',$arr);

		$this->db->limit($limit,$offset);

		$this->db->where('product.status', 1);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();

	}
	function getbyparentid($arr,$offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->where('product.parent_id',$arr);

		$this->db->where('product.status', 1);

		$this->db->limit($limit,$offset);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();

	}
	function count1($arr){

		$this->db->from('product');

		$this->db->where_in('product.parent_id',$arr);

		$this->db->where('product.status', 1);

		$this->db->join('category','product.parent_id = category.id','left');

		return $this->db->count_all_results();

	}

	function getbyparent2($offset,$limit){

		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->limit($limit,$offset);

		$this->db->where('product.status', 1);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();

	}

	function count2(){

		$this->db->select('*');

		$this->db->from('product');

		$this->db->where('status', 1);

		return $this->db->count_all_results();

	}	
	function random($parent_id,$id){		
		$listid = array();
		foreach($parent_id as $parent_id1){
			foreach($parent_id1 as $parent_id2){				
				if($parent_id2 != $id)
					array_push($listid,$parent_id2);
			}
		}	
		$parent_id1 = implode (",",$listid);
		$query = $this->db->query("
			SELECT product.*, category.slug AS product_category_slug
			FROM `product` , `category`
			WHERE product.id >= (
			SELECT FLOOR( MAX( product.id ) * RAND( ) )
			FROM `product` )
			AND product.parent_id
			IN (
			'".$parent_id1."'
			)
			AND product.parent_id = category.id
			LIMIT 5 , 30
		");
		return $query->result();
	}
	
	function get_banchay($offset,$limit){
		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->limit($limit,$offset);

		$this->db->where('product.status', 1);
		$this->db->where('product.noibat !=', 1);
		$this->db->where('product.banchay', 1);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();

	}
	function get_noibat($offset,$limit){
		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->limit($limit,$offset);

		$this->db->where('product.status', 1);
		$this->db->where('product.banchay !=', 1);
		$this->db->where('product.noibat', 1);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();

	}
	function get_lienquan($parent_id,$id,$offset,$limit){
		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');
		
		$this->db->where('product.status', 1);
		$this->db->where('product.parent_id', $parent_id);
		$this->db->where('product.id !=', $id);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');
		$this->db->limit($limit,$offset);

		return $query->result();

	}
	function get_new($offset,$limit){
		$this->db->select('product.*, category.name as product_category_name, category.slug as product_category_slug');

		$this->db->limit($limit,$offset);

		$this->db->where('product.status', 1);
		$this->db->where('product.banchay !=', 1);

		$this->db->order_by('product.order desc, product.created desc');

		$this->db->join('category','product.parent_id = category.id','left');

		$query = $this->db->get('product');

		return $query->result();

	}
	/*

	

	

	function getbyparent($arr,$offset,$limit){

		$this->db->where_in('parent_id',$arr);

		$this->db->limit($limit,$offset);

		$this->db->where('status', 1);

		$query = $this->db->get('product');

		$this->db->order_by('created','desc');

		return $query->result();

	}

	

	

	function search($key,$fcat,$offset,$limit){

		$this->db->like('name', $key);

		$this->db->where('status !=', 0);

		$this->db->from('product');

		$this->db->where_in('parent_id',$fcat);

		$this->db->limit($limit,$offset);

		$this->db->order_by('created','desc');

		$query = $this->db->get();

		return $query->result();

	}

	function get_new($cat = null){

		$this->db->where('status !=', 0);

		$this->db->like('params', '"isNew":"on"');

		$this->db->from('product');

		if($cat != 0) $this->db->where('parent_id',$cat);

		$query = $this->db->get();

		return $query->result();

	}

	function get_hot($cat = null){

		$this->db->where('status !=', 0);

		$this->db->like('params', '"isHot":"on"');

		$this->db->from('product');

		if($cat != 0) $this->db->where('parent_id',$cat);

		$query = $this->db->get();

		return $query->result();

	}

	function get_promotion($cat = null){

		$this->db->where('status !=', 0);

		$this->db->where('promotion_price !=', 0);

		$this->db->from('product');

		if($cat != 0) $this->db->where('parent_id',$cat);

		$query = $this->db->get();

		return $query->result();

	}*/

}



