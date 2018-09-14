<?php
class Contact_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('contact');
		$this->db->where('status !=',0);
		$this->db->like('name', $s); 
		return $this->db->count_all_results();
	}
	function getall(){
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('status !=',0);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getbyparent(){

		$this->db->where('status', 1);

		$query = $this->db->get('contact');

		return $query->result();

	}
	
	
	function likeparent($id=2){		
		$str = $this->getbyid($id);	
		$this->db->select('id');
		$this->db->from('contact');			
		$this->db->where('status !=', 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('status !=',0);
		$this->db->like('name', $s);
		$this->db->limit($limit,$offset);
		//$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function add($data){
		$this->db->insert('contact',$data);
		return $this->db->insert_id();
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('contact');
		$query = $this->db->get();
		return $query->row();
	}
		function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('contact', $data);
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('contact', array('status' => 0));
	}
	function getlist_country(){
		$this->db->select('*');
		$this->db->from('contact');
		$this->db->where('status !=',0);
		$query = $this->db->get();
		return $query->result();
	}
	// function getbyslug($slug){

	// 	$this->db->where('slug', $slug);

	// 	$this->db->where('status !=', 0);

	// 	$query = $this->db->get('contact');

	// 	return $query->row();

	// }
}
