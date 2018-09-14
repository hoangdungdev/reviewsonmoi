<?php
class Tinhthanhpho_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function getlist(){
		$this->db->select('*');
		$this->db->from('tinhthanhpho');
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('tinhthanhpho');
		$query = $this->db->get();
		return $query->row();
	}
}
