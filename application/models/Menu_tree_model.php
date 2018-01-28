<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_tree_model extends CI_Model
{

    public $table = 'menu_tree';
    public $id = 'id_menu';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('mt.*, i.icon as logo_');
        $this->db->from('menu_tree mt');
        $this->db->join('icon i', 'mt.logo = i.id', 'left');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
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
        $this->db->like('id_menu', $keyword);
	$this->db->or_like('menu', $keyword);
	$this->db->or_like('urut', $keyword);
	$this->db->or_like('logo', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->join('icon', $this->table.'.logo = icon.id');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_menu', $keyword);
	$this->db->or_like('menu', $keyword);
	$this->db->or_like('urut', $keyword);
	$this->db->or_like('logo', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Menu_tree_model.php */
/* Location: ./application/models/Menu_tree_model.php */