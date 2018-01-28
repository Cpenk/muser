<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_model extends CI_Model
{

    public $table = 'melting_detail';
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
        $this->db->like('id', $keyword);
	$this->db->or_like('no_trans', $keyword);
	$this->db->or_like('ingot', $keyword);
	$this->db->or_like('external_scrapt', $keyword);
	$this->db->or_like('internal_scrapt', $keyword);
	$this->db->or_like('buth_end_cutt', $keyword);
	$this->db->or_like('buth_end_ext', $keyword);
	$this->db->or_like('Puing', $keyword);
	$this->db->or_like('HGA', $keyword);
	$this->db->or_like('cover_flux', $keyword);
	$this->db->or_like('alsi', $keyword);
	$this->db->or_like('healting_AF', $keyword);
	$this->db->or_like('silikon_metal', $keyword);
	$this->db->or_like('nitrogen', $keyword);
	$this->db->or_like('magnesium', $keyword);
	$this->db->or_like('injection_flux', $keyword);
	$this->db->or_like('titanium_boron', $keyword);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get search data with limit
    function search_index_limit($limit, $start = 0, $keyword = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $keyword);
	$this->db->or_like('no_trans', $keyword);
	$this->db->or_like('ingot', $keyword);
	$this->db->or_like('external_scrapt', $keyword);
	$this->db->or_like('internal_scrapt', $keyword);
	$this->db->or_like('buth_end_cutt', $keyword);
	$this->db->or_like('buth_end_ext', $keyword);
	$this->db->or_like('Puing', $keyword);
	$this->db->or_like('HGA', $keyword);
	$this->db->or_like('cover_flux', $keyword);
	$this->db->or_like('alsi', $keyword);
	$this->db->or_like('healting_AF', $keyword);
	$this->db->or_like('silikon_metal', $keyword);
	$this->db->or_like('nitrogen', $keyword);
	$this->db->or_like('magnesium', $keyword);
	$this->db->or_like('injection_flux', $keyword);
	$this->db->or_like('titanium_boron', $keyword);
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

/* End of file M_model.php */
/* Location: ./application/models/M_model.php */