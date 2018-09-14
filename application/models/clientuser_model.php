<?php
class Clientuser_model extends CI_Model{

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
		$query = $this->db->get('clientuser');
		return $query->row();
	}
	function getinfo($log)
	{
		$condition = array(
			'username'=> $log
			,'status' => 1
		);
		$this->db->where($condition);
		$query = $this->db->get('clientuser');
		return $query->row();
	}
	function add($data){
		$this->db->insert('clientuser',$data);
		return $this->db->insert_id();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('clientuser', array('status' => 0));
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('clientuser', $data);
		return ($this->db->affected_rows() > 0) ? 1 : 0;
	}
	function getbyid($id){
		$this->db->where('id',$id);
		$query = $this->db->get('clientuser');
		return $query->row();
	}
	function getbyusername($username){
		$this->db->where('username',$username);
		$query = $this->db->get('clientuser');
		return $query->row();
	}
	function getbyusernameandpass($username, $password) {
		$this->db->where('username',$username);
		$this->db->where('password',md5($password));
		$query = $this->db->get('clientuser');
		return $query->row();
	}
	function getbyemail($email){
		$this->db->where('email',$email);
		$query = $this->db->get('clientuser');
		return $query->row();
	}
	function count($s){
		$this->db->select('clientuser.*');
		$this->db->from('clientuser');
		$this->db->where('status !=',0);
		$this->db->like('username', $s); 
		return $this->db->count_all_results();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('clientuser.*');
		$this->db->from('clientuser');
		$this->db->where('status !=',0);
		$this->db->order_by("name", "asc"); 
		$this->db->limit($limit,$offset);
		$this->db->like('username', $s); 
		$query = $this->db->get();
		return $query->result();
	}
}
