<?php
class Loaitintuc_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->select('*');
		$this->db->from('loaitintuc');
		$this->db->where('status !=',0);
		$this->db->like('name', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('*');
		$this->db->from('loaitintuc');
		$this->db->where('status !=',0);
		$this->db->like('name', $s);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	function getlisthome($offset,$limit){
		$this->db->select('loaitintuc.name as loaitintuc_name,loaitintuc.slug as loaitintuc_slug, count(*) as sotin');
		$this->db->from('loaitintuc');
		$this->db->join('tintuc','loaitintuc.id = tintuc.parent_id');
		$this->db->where('loaitintuc.status',1);
		$this->db->group_by('tintuc.parent_id');
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	function getlisthome2($offset,$limit){
		$this->db->select('loaitintuc.name as loaitintuc_name,loaitintuc.slug as loaitintuc_slug');
		$this->db->from('loaitintuc');
		$this->db->where('status',1);
		$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result();
	}
	function getbyparent($id = 0){
		$this->db->where('parent_id',$id);
		$this->db->where('status !=', 0);
		$query = $this->db->get('loaitintuc');
		return $query->result();
	}
	function getbyid($id){
		$this->db->where('id', $id);
		$this->db->where('status !=', 0);
		$query = $this->db->get('loaitintuc');
		return $query->row();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status !=', 0);
		$query = $this->db->get('loaitintuc');
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
		Get all child loaitintuc include parent loaitintuc
		Return: array id of loaitintuc
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
		$this->db->update('loaitintuc', array('status' => 0));
	}
	function add($data){
		$this->db->insert('loaitintuc',$data);
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('loaitintuc', $data);
	}
	/*
		Get all child loaitintuc
		Return: array object loaitintuc
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
