<?php
class Tintuc_model extends CI_Model{
	
	function __construct()
	{
		parent::__construct();
	}
	function count($s){
		$this->db->from('tintuc');
		$this->db->where('status !=',0);
		$this->db->like('title', $s); 
		return $this->db->count_all_results();
	}
	function counthomeparent($parent_id){
		$this->db->from('tintuc');
		$this->db->where('status',1);
		$this->db->where('parent_id',$parent_id);
		return $this->db->count_all_results();
	}
	 function get_random_news($alias)
    {
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(5);
        $this->db->where('status',1);
        $this->db->where_not_in('slug',$alias);
        $query = $this->db->get('tintuc');
        return $query->result();
    }
    function getlistrandom($offset,$limit){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status',1);
		$this->db->limit($limit,$offset);
        $this->db->order_by('id', 'RANDOM');
		$query = $this->db->get();
		return $query->result();
	}
	function getlist($s,$offset,$limit){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status !=',0);
		$this->db->like('tintuc.title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlisthome($s,$offset,$limit){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status',1);
		$this->db->like('tintuc.title', $s);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlisthomeparent($parent_id,$offset,$limit){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status',1);
		$this->db->where('tintuc.parent_id',$parent_id);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlistnoibat($offset,$limit){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status',1);
		$this->db->where('tintuc.noibat',1);
		$this->db->limit($limit,$offset);
		$this->db->order_by('order','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlisthomenoibat($offset,$limit){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status',1);
		$this->db->where('tintuc.noibat !=',1);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function getlistnoibatone(){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$this->db->where('tintuc.status',1);
		$this->db->where('tintuc.noibat',1);
		$this->db->limit(1);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->row();
	}
	function delete($id){
		$this->db->where('id', $id);
		$this->db->update('tintuc', array('status' => 0));
	}
	function add($data){
		$this->db->insert('tintuc',$data);
		return $this->db->insert_id();
	}
	function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('tintuc', $data);
	}
	function getbyparent($arr,$offset,$limit){
		$this->db->where_in('parent_id',$arr);
		$this->db->limit($limit,$offset);
		$this->db->where('status', 1);
		$query = $this->db->get('tintuc');
		$this->db->order_by('created','desc');
		return $query->result();
	}
	function getbyid($id){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->where('tintuc.id', $id);
		$this->db->where('tintuc.status !=', 0);
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$query = $this->db->get();
		return $query->row();
	}
	function getbyhomeslug($slug){
		$this->db->select('tintuc.*, loaitintuc.name as loaitintuc_name, loaitintuc.slug as loaitintuc_slug');
		$this->db->where('tintuc.slug', $slug);
		$this->db->where('tintuc.status', 1);
		$this->db->from('tintuc');
		$this->db->join('loaitintuc','tintuc.parent_id = loaitintuc.id','left');
		$query = $this->db->get();
		return $query->row();
	}
	function getbyslug($slug){
		$this->db->where('slug', $slug);
		$this->db->where('status', 1);
		$query = $this->db->get('tintuc');
		return $query->row();
	}
	function search($key,$fcat,$offset,$limit){
		$this->db->like('title', $key);
		$this->db->where('status !=', 0);
		$this->db->from('tintuc');
		$this->db->where_in('parent_id',$fcat);
		$this->db->limit($limit,$offset);
		$this->db->order_by('created','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function get_new($cat = null){
		$this->db->where('status !=', 0);
		$this->db->like('params', '"isNew":"on"');
		$this->db->from('tintuc');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
	function get_hot($cat = null){
		$this->db->where('status !=', 0);
		$this->db->like('params', '"isHot":"on"');
		$this->db->from('tintuc');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
	function get_promotion($cat = null){
		$this->db->where('status !=', 0);
		$this->db->where('promotion_price !=', 0);
		$this->db->from('tintuc');
		if($cat != 0) $this->db->where('parent_id',$cat);
		$query = $this->db->get();
		return $query->result();
	}
}
