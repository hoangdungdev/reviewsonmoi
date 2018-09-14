<?php
class Log_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('log');
		$this->db->where('status !=',0);
		$this->db->like('message', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->from('log');
		$this->db->where('status !=',0);
		$this->db->like('message', $s);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$this->db->from('log');
		$query = $this->db->get();
		return $query->row();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('log', array('status' => 0));
	}
	function insert($data){
		$this->db->insert('log',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('log', $data);
	}
}
