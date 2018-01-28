<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->select("u.*, IF(u.status = 'Y', 'Aktif', 'Tidak Aktif') AS status_name");
        $this->db->from('users as u');
        $this->db->where('u.id', $id);
        return $this->db->get()->row();
    }

    function get_by_username($username = NULL)
    {
        $this->db->where('username', $username);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0) {
        $this->db->order_by($this->id, $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id', $keyword);
	$this->db->or_like('username', $keyword);
	$this->db->or_like('password', $keyword);
	$this->db->or_like('nama', $keyword);
	$this->db->or_like('level_user', $keyword);
	$this->db->or_like('access', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->select("u.*, IF(u.status = 'Y', 'Aktif', 'Tidak Aktif') AS status");
        $this->db->from('users as u');
        $this->db->order_by('u.id', $this->order);
        $this->db->like('u.id', $keyword);
	$this->db->or_like('u.username', $keyword);
	$this->db->or_like('u.password', $keyword);
	$this->db->or_like('u.nama', $keyword);
	$this->db->or_like('u.level_user', $keyword);
	$this->db->or_like('u.access', $keyword);
	$this->db->or_like('u.status', $keyword);
	$this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    // get page/module
    function get_page($link)
    {
        $this->db->where('link', $link);
        return $this->db->get('sub_menu')->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */