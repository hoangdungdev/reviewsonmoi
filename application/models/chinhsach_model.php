<?php
class Chinhsach_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('chinhsach');
		$this->db->where('status !=',0);
		$this->db->like('title', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('chinhsach');
		$this->db->where('chinhsach.status !=',0);
		$this->db->like('chinhsach.title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlisthome($offset,$limit){
		$this->db->select('*');
		$this->db->from('chinhsach');
		$this->db->where('status',1);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlienquan($s,$id,$offset,$limit){
		$this->db->select('*');
		$this->db->from('chinhsach');
		$this->db->where('chinhsach.status !=',0);
		$this->db->where('chinhsach.id !=',$id);
		$this->db->like('chinhsach.title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('chinhsach', array('status' => 0));
	}
	function add($data){
		$this->db->insert('chinhsach',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('chinhsach', $data);
	}
	function getbyparent($arr,$offset,$limit){
		$this->db->where_in('parent_id',$arr);
		$this->db->limit($limit,$offset);
		$this->db->where('status', 1);
		$query = $this->db->get('chinhsach');
		$this->db->order_by('created','desc');
		return $query->result();
	}
	function getbyid($id){
		$this->db->select('*');
		$this->db->where('chinhsach.id', $id);
		$this->db->where('chinhsach.status !=', 0);
		$this->db->from('chinhsach');
		$query = $this->db->get();
		return $query->row();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status', 1);
		$query = $this->db->get('chinhsach');
		return $query->row();
	}
	function search($key,$fcat,$offset,$limit){
		$this->db->like('title', $key);
		$this->db->where('status !=', 0);
		$this->db->from('chinhsach');
		$this->db->where_in('parent_id',$fcat);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function get_new($cat = null){
		$this->db->where('status !=', 0);
		$this->db->like('params', '"isNew":"on"');
		$this->db->from('chinhsach');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
	function get_hot($cat = null){
		$this->db->where('status !=', 0);
		$this->db->like('params', '"isHot":"on"');
		$this->db->from('chinhsach');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
	function get_promotion($cat = null){
		$this->db->where('status !=', 0);
		$this->db->where('promotion_price !=', 0);
		$this->db->from('chinhsach');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
}
