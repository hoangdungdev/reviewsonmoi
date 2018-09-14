<?php
class Config_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function getconfig(){
		$this->db->where('status =', 1);
		$query = $this->db->get('config');
		$result = $query->result();
		$arr = array();
		foreach($result as $row):
			$arr[$row->key] = $row->value;
		endforeach;
		return $arr;
	}
	function update($data){
		$this->db->update_batch('config', $data, 'key');
	}
}
