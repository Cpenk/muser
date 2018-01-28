<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->model('profile_model');
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

    public function index_()
    {
        $profile = $this->profile_model->get_all();
        $session_data = $this->session->userdata('logged_in');

        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'profile_data' => $profile
        );
            $this->load->view('design/header', $data);
            $this->load->view('profile/profile_list', $data);
            $this->load->view('design/footer');
    }

    public function read($id) 
    {
        $row = $this->profile_model->get_by_id($id);
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
            
		'id' => $row->id,
		'nama_aplikasi' => $row->nama_aplikasi,
		'nama_logo' => $row->nama_logo,
        'nama_kades' => $row->nama_kades,
        'nip' => $row->nip,
		'dashboard' => $row->dashboard,
		'copyright' => $row->copyright,
	    );
            $this->load->view('design/header', $data);
            $this->load->view('profile/profile_read', $data);
            $this->load->view('design/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile'));
        }
    }
    
    public function create() 
    {
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->profile_model->get_page('profile');
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
            'action' => site_url('profile/create_action/?p='.$_GET['p']),
	    'id' => set_value('id'),
	    'nama_aplikasi' => set_value('nama_aplikasi'),
	    'nama_logo' => set_value('nama_logo'),
        'nama_kades' => set_value('nama_kades'),
        'nip' => set_value('nip'),
	    'dashboard' => set_value('dashboard'),
        'copyright' => set_value('copyright'),
        'vertion' => set_value('vertion'),
	);      
            $this->load->view('design/header', $data);
            $this->load->view('profile/profile_form', $data);
            $this->load->view('design/footer');
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
		'nama_aplikasi' => $this->input->post('nama_aplikasi',TRUE),
		'nama_logo' => $this->input->post('nama_logo',TRUE),
		'dashboard' => $this->input->post('dashboard',FALSE),
		'copyright' => $this->input->post('copyright',TRUE),
	    );

            $this->profile_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('profile/?p='.$this->input->post('p')));
        }
    }
    
    public function index() 
    {
        $row = $this->profile_model->get_by_id(2);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->profile_model->get_page('profile');
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
                'action' => site_url('profile/update_action/?p='.$_GET['p']),
		'id' => set_value('id', $row->id),
		'nama_aplikasi' => set_value('nama_aplikasi', $row->nama_aplikasi),
		'nama_logo' => set_value('nama_logo', $row->nama_logo),
        'nama_kades' => set_value('nama_kades', $row->nama_kades),
        'nip' => set_value('nip', $row->nip),
		'dashboard' => set_value('dashboard', $row->dashboard),
        'copyright' => set_value('copyright', $row->copyright),
        'vertion' => set_value('vertion', $row->vertion),
	    );
            $this->load->view('profile/profile_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile'));
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
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_aplikasi' => $this->input->post('nama_aplikasi',TRUE),
        'nama_logo' => $this->input->post('nama_logo',TRUE),
        'nama_kades' => $this->input->post('nama_kades',TRUE),
		'nip' => $this->input->post('nip',TRUE),
		'dashboard' => $this->input->post('dashboard',FALSE),
        'copyright' => $this->input->post('copyright',TRUE),
        'vertion' => $this->input->post('vertion',TRUE),
	    );

            $this->profile_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success Please press F5 to view result');
            redirect(site_url('profile/?p='.$this->input->post('p')));
        }
    }
    
    public function delete($id, $p) 
    {
        $row = $this->profile_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->profile_model->get_page('profile');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $this->profile_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('profile/?p='.$p));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('profile/?p='.$p));
        }
        } else {
            $this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('profile/?p='.$p));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_aplikasi', ' ', 'trim|required');
	$this->form_validation->set_rules('nama_logo', ' ', 'trim|required');
	$this->form_validation->set_rules('dashboard', ' ', 'trim|required');
	$this->form_validation->set_rules('copyright', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */