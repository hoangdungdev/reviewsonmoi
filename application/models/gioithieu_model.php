<?php
class Gioithieu_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('gioithieu');
		$this->db->where('status !=',0);
		$this->db->like('title', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('gioithieu');
		$this->db->where('gioithieu.status !=',0);
		$this->db->like('gioithieu.title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function counthome(){
		$this->db->from('gioithieu');
		$this->db->where('status',1);
		return $this->db->count_all_results();
	}
	function getlisthome($offset,$limit){
		$this->db->select('*');
		$this->db->from('gioithieu');
		$this->db->where('status',1);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlienquan($s,$id,$offset,$limit){
		$this->db->select('*');
		$this->db->from('gioithieu');
		$this->db->where('gioithieu.status !=',0);
		$this->db->where('gioithieu.id !=',$id);
		$this->db->like('gioithieu.title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('gioithieu', array('status' => 0));
	}
	function add($data){
		$this->db->insert('gioithieu',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('gioithieu', $data);
	}
	function getbyparent($arr,$offset,$limit){
		$this->db->where_in('parent_id',$arr);
		$this->db->limit($limit,$offset);
		$this->db->where('status', 1);
		$query = $this->db->get('gioithieu');
		$this->db->order_by('created','desc');
		return $query->result();
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('gioithieu.id', $id);
		$this->db->where('gioithieu.status !=', 0);
		$this->db->from('gioithieu');
		$query = $this->db->get();
		return $query->row();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status', 1);
		$query = $this->db->get('gioithieu');
		return $query->row();
	}
}
