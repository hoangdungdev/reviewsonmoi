<?php
class Post_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('post');
		$this->db->where('status !=',0);
		$this->db->like('title', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('post');
		$this->db->where('status !=',0);
		$this->db->like('title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('post', array('status' => 0));
	}
	function add($data){
		$this->db->insert('post',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('post', $data);
	}
	function getbyparent($arr,$offset,$limit){
		$this->db->where_in('parent_id',$arr);
		$this->db->limit($limit,$offset);
		$this->db->where('status', 1);
		$query = $this->db->get('post');
		$this->db->order_by('created','desc');
		return $query->result();
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('status !=', 0);
		$this->db->from('post');
		$query = $this->db->get();
		return $query->row();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status', 1);
		$query = $this->db->get('post');
		return $query->row();
	}
	function search($key,$fcat,$offset,$limit){
		$this->db->like('title', $key);
		$this->db->where('status !=', 0);
		$this->db->from('post');
		$this->db->where_in('parent_id',$fcat);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function get_new($cat = null){
		$this->db->where('status !=', 0);
		$this->db->like('params', '"isNew":"on"');
		$this->db->from('post');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
	function get_hot($cat = null){
		$this->db->where('status !=', 0);
		$this->db->like('params', '"isHot":"on"');
		$this->db->from('post');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
	function get_promotion($cat = null){
		$this->db->where('status !=', 0);
		$this->db->where('promotion_price !=', 0);
		$this->db->from('post');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
}
