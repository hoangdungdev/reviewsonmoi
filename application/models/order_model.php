<?php
class Order_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('order');
		$this->db->where('status !=', 0);
		$this->db->like('phone', $s); 
		return $this->db->count_all_results();
	}
	function countbyid($userid){
		$this->db->from('order');
		$this->db->where('userid !=', 0);
		$this->db->where('userid', $userid);
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('status !=', 0);
		$this->db->like('phone', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlistbyid($userid,$offset,$limit){
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('userid !=', 0);
		$this->db->where('userid', $userid);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function add($data){
		$this->db->insert('order',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('order', $data);
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('status !=', 0);
		$this->db->from('order');
		$query = $this->db->get();
		return $query->row();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('order', array('status' => 0));
	}
	function getall(){
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('status !=',0);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
}
