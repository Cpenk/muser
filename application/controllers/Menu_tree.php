<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_tree extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->model('menu_tree_model');
                $this->load->library('form_validation');
                $this->load->library('session');
                $this->load->helper('select');
                $this->load->helper('select_icon');
                $this->load->helper('rp');
           }else{
             //Jika tidak ada session di kembalikan ke halaman login
             redirect('access', 'refresh');
           }

    }

    public function menu() {      
        $session_data = $this->session->userdata('logged_in');
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
        );
        $this->load->view('design/menu', $data);
    }

    public function index($rows_view = 10, $start = 0)
    {
        if(empty($_GET['q'])){
            $q = '';
        }else{
            $q = $_GET['q'];
        }

        $total_rows= $this->menu_tree_model->search_total_rows($q);
        $config['base_url'] = 'menu_tree/index/'.$rows_view.'/';
        $config['suffix'] = !empty($_GET['q']) ? '/?q='. $_GET['q'].'&p='.$_GET['p'] : '/?p='. $_GET['p'];
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $rows_view;
        $config["uri_segment"] = 4;

        $menu_tree = $this->menu_tree_model->search_index_limit($config['per_page'], $start, $q);
        $this->pagination->initialize($config);
        $session_data = $this->session->userdata('logged_in');

        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'perpage' => $rows_view,
            'q' => $q,
            'total_rows' => $total_rows,
            'menu_tree_data' => $menu_tree,
            'start' => $start
        );
            $this->load->view('menu_tree/menu_tree_list', $data);
    }

    public function read($id) 
    {
        $row = $this->menu_tree_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        if ($row) {
            $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
		'id_menu' => $row->id_menu,
		'menu' => $row->menu,
		'urut' => $row->urut,
		'logo' => $row->logo,
        'link' => $row->link,
		'status' => $row->status,
	    );
            $this->load->view('menu_tree/menu_tree_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_tree'));
        }
    }
    
    public function create() 
    {
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->menu_tree_model->get_page('menu_tree');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'button' => 'Create',
            'action' => site_url('menu_tree/create_action/?p='.$_GET['p']),
	    'id_menu' => set_value('id_menu'),
	    'menu' => set_value('menu'),
	    'urut' => set_value('urut'),
	    'logo' => set_value('logo'),
        'link' => set_value('link'),
	    'status' => set_value('status'),
	);      
            $this->load->view('menu_tree/menu_tree_form', $data);
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
    
    public function create_action() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'menu' => $this->input->post('menu',TRUE),
		'urut' => $this->input->post('urut',TRUE),
		'logo' => $this->input->post('logo',TRUE),
        'link' => $this->input->post('link',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->menu_tree_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('menu_tree/?p='.$this->input->post('p')));
        }
    }
    
    public function update($id) 
    {
        $row = $this->menu_tree_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->menu_tree_model->get_page('menu_tree');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
                'button' => 'Update',
                'action' => site_url('menu_tree/update_action/?p='.$_GET['p']),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'menu' => set_value('menu', $row->menu),
		'urut' => set_value('urut', $row->urut),
		'logo' => set_value('logo', $row->logo),
        'link' => set_value('link', $row->link),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('menu_tree/menu_tree_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_tree'));
        }
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
            $data = array(
		'menu' => $this->input->post('menu',TRUE),
		'urut' => $this->input->post('urut',TRUE),
		'logo' => $this->input->post('logo',TRUE),
        'link' => $this->input->post('link',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->menu_tree_model->update($this->input->post('id_menu', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('menu_tree/?p='.$this->input->post('p')));
        }
    }
    
    public function delete($id, $p) 
    {
        $row = $this->menu_tree_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->menu_tree_model->get_page('menu_tree');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $this->menu_tree_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('menu_tree/?p='.$p));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('menu_tree/?p='.$p));
        }

        } else {
            $this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('menu_tree/?p='.$p));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('menu', ' ', 'trim|required');
	$this->form_validation->set_rules('urut', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('logo', ' ', 'trim|required');
    $this->form_validation->set_rules('link', ' ', 'trim|required');
	$this->form_validation->set_rules('status', ' ', 'trim|required');

	$this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Menu_tree.php */
/* Location: ./application/controllers/Menu_tree.php */