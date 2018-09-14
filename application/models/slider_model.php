<?php
class Slider_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('slider');
		$this->db->where('status !=',0);
		$this->db->like('title', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('status !=',0);
		$this->db->like('title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getliststatus($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('status',1);
		$this->db->like('title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','asc');
		$query = $this->db->get();
		return $query->result();
	}
	function add($data){
		$this->db->insert('slider',$data);
		return $this->db->insert_id();
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('status !=', 0);
		$this->db->from('slider');
		$query = $this->db->get();
		return $query->row();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('slider', $data);
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('slider', array('status' => 0));
	}
	
	
	// ================= view ====================
	function getall(){
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->where('status',1);
		$this->db->order_by('order desc, created desc'); 	
		$query = $this->db->get();
		return $query->result();
	}
}
