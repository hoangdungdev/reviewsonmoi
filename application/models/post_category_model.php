<?php
class Post_category_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->select('*');
		$this->db->from('post_category');
		$this->db->where('status !=',0);
		$this->db->like('name', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('post_category');
		$this->db->where('status !=',0);
		$this->db->like('name', $s);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	function getbyparent($id = 0){
		$this->db->where('parent_id',$id);
		$this->db->where('status !=', 0);
		$query = $this->db->get('post_category');
		return $query->result();
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$this->db->where('status !=', 0);
		$query = $this->db->get('post_category');
		return $query->row();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status !=', 0);
		$query = $this->db->get('post_category');
		return $query->row();
	}
	/*
		Return: guide line object
	*/
	function getguide($id, $trees = NULL)
	{
		if(!$trees){
			$trees = array();
		}
    	$query = $this->getbyid(intval($id));
		if (!empty($query)){
			array_push($trees,$query);
			$trees = $this->getguide($query->parent_id, $trees);
		}
		return $trees;
	}
	/*
		Get all child post_category include parent post_category
		Return: array id of post_category
	*/
	function getfamily($id, $trees = NULL){
		if(!$trees){
			$trees = array();
			array_push($trees,$id);
		}
    	$query = $this->getbyparent(intval($id));
    	foreach ($query as $row):
    		array_push($trees,$row->id);
	    	$trees = $this->getfamily($row->id, $trees);
    	endforeach;
    	return $trees;
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('post_category', array('status' => 0));
	}
	function add($data){
		$this->db->insert('post_category',$data);
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('post_category', $data);
	}
	/*
		Get all child post_category
		Return: array object post_category
	*/
	function getmenu($parentid = 0,$space = '', $trees = NULL){
    	if(!$trees) $trees = array();
    	$query = $this->getbyparent(intval($parentid));
    	foreach ($query as $row):
    		$row->name = $space.' '.$row->name;
    		array_push($trees,$row);
	    	$trees = $this->getmenu($row->id,'--'.$space,$trees);
    	endforeach;
    	return $trees;
    }
}
