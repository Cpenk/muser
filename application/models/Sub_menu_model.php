<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_menu_model extends CI_Model
{

    public $table = 'sub_menu';
    public $id = 'id_sub';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->select('s.*, m.id_menu as id_m');
        $this->db->select("m.menu as nama_menu, if(s.status = 'Y', 'Aktif', 'Tidak aktif') as stts");
        $this->db->from('sub_menu s');
        $this->db->join('menu_tree m', 's.id_menu = m.id_menu');
        $this->db->order_by('s.id_menu', $this->order);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($keyword) {
        $this->db->select('s.*, m.id_menu as id_m');
        $this->db->select("m.menu as nama_menu, if(s.status = 'Y', 'Aktif', 'Tidak aktif') as stts");
        $this->db->from('sub_menu s');
        $this->db->join('menu_tree m', 's.id_menu = m.id_menu');
        $this->db->like('s.sub_menu', $keyword);
        $this->db->or_like('m.menu', $keyword);
        $this->db->order_by('s.id_menu', $this->order);
        return $this->db->count_all_results();
    }

    // get data with limit
    function index_limit($limit, $start = 0, $keyword) {
        $this->db->select('s.*, m.id_menu as id_m');
        $this->db->select("m.menu as nama_menu, if(s.status = 'Y', 'Aktif', 'Tidak aktif') as stts");
        $this->db->from('sub_menu s');
        $this->db->join('menu_tree m', 's.id_menu = m.id_menu');
        $this->db->like('s.sub_menu', $keyword);
        $this->db->or_like('m.menu', $keyword);
        $this->db->order_by('s.id_menu', $this->order);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }
    
    // get search total rows
    function search_total_rows($keyword = NULL) {
        $this->db->like('id_sub', $keyword);
	$this->db->or_like('id_menu', $keyword);
	$this->db->or_like('sub_menu', $keyword);
	$this->db->or_like('logo', $keyword);
	$this->db->or_like('link', $keyword);
	$this->db->or_like('urut', $keyword);
	$this->db->or_like('status', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_sub', $keyword);
	$this->db->or_like('id_menu', $keyword);
	$this->db->or_like('sub_menu', $keyword);
	$this->db->or_like('logo', $keyword);
	$this->db->or_like('link', $keyword);
	$this->db->or_like('urut', $keyword);
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

/* End of file Sub_menu_model.php */
/* Location: ./application/models/Sub_menu_model.php */