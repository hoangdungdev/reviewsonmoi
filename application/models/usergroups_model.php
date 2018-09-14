<?php
class Usergroups_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function get(){
		$query = $this->db->get('usergroups');
		return $query->result();
	}
}
