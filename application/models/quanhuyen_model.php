<?php
class Quanhuyen_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function getlist(){
		$this->db->select('*');
		$this->db->from('quanhuyen');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlistparent($id){
		$this->db->select('quanhuyen.*');
		$this->db->from('quanhuyen');
		$this->db->join('tinhthanhpho','quanhuyen.parent_id = tinhthanhpho.id','left');
		$this->db->where('quanhuyen.parent_id',$id);
		$this->db->order_by('quanhuyen.id','desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('quanhuyen');
		$query = $this->db->get();
		return $query->row();
	}
}
