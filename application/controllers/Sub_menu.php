<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sub_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->model('sub_menu_model');
                $this->load->library('form_validation');
                $this->load->library('session');
                $this->load->helper('select');
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

        $total_rows= $this->sub_menu_model->total_rows($q);
        $config['base_url'] = 'sub_menu/index/'.$rows_view.'/';
        // $config['suffix'] = '/?p='.$_GET['p'];
        $config['suffix'] = !empty($_GET['q']) ? '/?q='. $_GET['q'].'&p='.$_GET['p'] : '/?p='. $_GET['p'];
        // $config['suffix'] = !empty($_GET['q']) ? '&?q='. $_GET['q'] : '';
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $rows_view;
        $config["uri_segment"] = 4;

        $sub_menu = $this->sub_menu_model->index_limit($config['per_page'], $start, $q);
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
            'sub_menu_data' => $sub_menu,
            'start' => $start
        );
            $this->load->view('sub_menu/sub_menu_list', $data);
    }

    public function read($id) 
    {
        $row = $this->sub_menu_model->get_by_id($id);
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
		'id_sub' => $row->id_sub,
		'id_menu' => $row->id_menu,
		'sub_menu' => $row->sub_menu,
		'logo' => $row->logo,
		'link' => $row->link,
		'urut' => $row->urut,
		'status' => $row->status,
	    );
            $this->load->view('sub_menu/sub_menu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_menu'));
        }
    }
    
    public function create() 
    {
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->sub_menu_model->get_page('sub_menu');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['input_data'])) or $session_data['level_user']=='administrator'){
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'button' => 'Create',
            'action' => site_url('sub_menu/create_action/?p='.$_GET['p']),
	    'id_sub' => set_value('id_sub'),
	    'id_menu' => set_value('id_menu'),
	    'sub_menu' => set_value('sub_menu'),
	    'logo' => set_value('logo'),
	    'link' => set_value('link'),
	    'urut' => set_value('urut'),
	    'status' => set_value('status'),
	);      
            $this->load->view('sub_menu/sub_menu_form', $data);
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
		'id_menu' => $this->input->post('id_menu',TRUE),
		'sub_menu' => $this->input->post('sub_menu',TRUE),
		'logo' => $this->input->post('logo',TRUE),
		'link' => $this->input->post('link',TRUE),
		'urut' => $this->input->post('urut',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->sub_menu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sub_menu/?p='.$this->input->post('p')));
        }
    }
    
    public function update($id) 
    {
        $row = $this->sub_menu_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->sub_menu_model->get_page('sub_menu');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['edit_data'])) or $session_data['level_user']=='administrator'){

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
                'action' => site_url('sub_menu/update_action/?p='.$_GET['p']),
		'id_sub' => set_value('id_sub', $row->id_sub),
		'id_menu' => set_value('id_menu', $row->id_menu),
		'sub_menu' => set_value('sub_menu', $row->sub_menu),
		'logo' => set_value('logo', $row->logo),
		'link' => set_value('link', $row->link),
		'urut' => set_value('urut', $row->urut),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('sub_menu/sub_menu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_menu'));
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
            $this->update($this->input->post('id_sub', TRUE));
        } else {
            $data = array(
		'id_menu' => $this->input->post('id_menu',TRUE),
		'sub_menu' => $this->input->post('sub_menu',TRUE),
		'logo' => $this->input->post('logo',TRUE),
		'link' => $this->input->post('link',TRUE),
		'urut' => $this->input->post('urut',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->sub_menu_model->update($this->input->post('id_sub', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sub_menu/?p='.$this->input->post('p')));
        }
    }

    private function delete_file($id)
    {
        $this->db->where('id_sub', $id);
        $query_file = $this->db->get('sub_menu');
        $rows_file = $query_file->row();
        #unlink ("./upload/news/".$rows_file->link);
        unlink("./application/controllers/".ucfirst($rows_file->link).".php");
        unlink("./application/models/".ucfirst($rows_file->link)."_model.php");
        array_map('unlink', glob("./application/views/".$rows_file->link."./*"));
        rmdir("./application/views/".$rows_file->link);
    }


    public function delete($id, $p) 
    {
        $row = $this->sub_menu_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->sub_menu_model->get_page('sub_menu');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $this->delete_file($id);
            $this->sub_menu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sub_menu/?p='.$p));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sub_menu/?p='.$p));
        }

        } else {
            $this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('Sub_menu/?p='.$p));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id_menu', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('sub_menu', ' ', 'trim|required');
	$this->form_validation->set_rules('logo', ' ', 'trim|required');
	$this->form_validation->set_rules('link', ' ', 'trim|required');
	$this->form_validation->set_rules('urut', ' ', 'trim|required|numeric');
	$this->form_validation->set_rules('status', ' ', 'trim|required');

	$this->form_validation->set_rules('id_sub', 'id_sub', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Sub_menu.php */
/* Location: ./application/controllers/Sub_menu.php */