<?php
class Detailorder_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	/*function count($s){
		$this->db->from('detailorder');
		$this->db->like('gh_name', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('detailorder');
		$this->db->like('gh_name', $s);
		$this->db->limit($limit,$offset);
		$this->db->detailorder_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status', 1);
		$query = $this->db->get('detailorder');
		return $query->row();
	}*/
	function add($data){
		$this->db->insert('detailorder',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('detailorder', $data);
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('detailorder', array('status' => 0));
	}
	function getall($id){
		$this->db->select('*');		
		$this->db->where('order_id', $id);
		$this->db->from('detailorder');
		$query = $this->db->get();
		return $query->result();
	}
}
