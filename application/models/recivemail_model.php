<?php
class Recivemail_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('recivemail');
		$this->db->where('status !=',0);
		$this->db->like('email', $s);
		return $this->db->count_all_results();
	}
	function getall(){
		$this->db->select('*');
		$this->db->from('recivemail');
		$this->db->where('status !=',0);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getbyparent(){

		$this->db->where('status', 1);

		$query = $this->db->get('recivemail');

		return $query->result();

	}
	
	
	function likeparent($id=2){		
		$str = $this->getbyid($id);	
		$this->db->select('id');
		$this->db->from('recivemail');			
		$this->db->where('status !=', 0);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('recivemail');
		$this->db->where('status !=',0);
		$this->db->like('email', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function add($data){
		$this->db->insert('recivemail',$data);
		return $this->db->insert_id();
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->from('recivemail');
		$query = $this->db->get();
		return $query->row();
	}
		function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('recivemail', $data);
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('recivemail', array('status' => 0));
	}
	function getlist_country(){
		$this->db->select('*');
		$this->db->from('recivemail');
		$this->db->where('status !=',0);
		$query = $this->db->get();
		return $query->result();
	}
}
