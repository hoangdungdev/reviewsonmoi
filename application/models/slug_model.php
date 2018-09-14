<?php
class Slug_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}	
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$query = $this->db->get('slug');
		return $query->row();
	}	function add($data){		$this->db->insert('slug',$data);		return $this->db->insert_id();	}
}
