<?php
class Users_model extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}
	function checklogin($log,$pwd)
	{
		$condition = array(
			'username'=> $log
			,'password' => $pwd
			,'status' => 1
		);
		$this->db->where($condition);
		$query = $this->db->get('users');
		return $query->row();
	}
	function add($data){
		$this->db->insert('users',$data);
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('users', array('status' => 0));
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
	function getbyid($id){
		$this->db->where('id',$id);
		$query = $this->db->get('users');
		return $query->row();
	}
	function getbyusername($username){
		$this->db->where('username',$username);
		$query = $this->db->get('users');
		return $query->row();
	}
	function getbyemail($email){
		$this->db->where('email',$email);
		$query = $this->db->get('users');
		return $query->row();
	}
	function count($s){
		$this->db->select('users.*, usergroups.name as groupname');
		$this->db->from('users');
		$this->db->join('usergroups','users.usertype = usergroups.name');
		$this->db->where('users.status !=',0);
		$this->db->like('users.username', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('users.*, usergroups.name as groupname');
		$this->db->from('users');
		$this->db->join('usergroups','users.usertype = usergroups.name');
		$this->db->where('users.status !=',0);
		$this->db->order_by("name", "asc"); 
		$this->db->limit($limit,$offset);
		$this->db->like('users.username', $s); 
		$query = $this->db->get();
		return $query->result();
	}
}
