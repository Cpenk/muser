<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Valuation_type extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->model('valuation_type_model');
                $this->load->library('form_validation');
                $this->load->library('session');
                $this->load->helper('select');
                $this->load->helper('rp');
           }else{
             //Jika tidak ada session di kembalikan ke halaman login
             redirect('access', 'refresh');
           }

    }

    public function index()
    {
        $valuation_type = $this->valuation_type_model->get_all();
        $session_data = $this->session->userdata('logged_in');

        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
            'input_data' => $session_data['input_data'],
            'edit_data' => $session_data['edit_data'],
            'delete_data' => $session_data['delete_data'],
            'valuation_type_data' => $valuation_type
        );
            $this->load->view('design/header', $data);
            $this->load->view('valuation_type/valuation_type_list', $data);
            $this->load->view('design/footer');
    }

    public function read($id) 
    {
        $row = $this->valuation_type_model->get_by_id($id);
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
		'type' => $row->type,
	    );
            $this->load->view('design/header', $data);
            $this->load->view('valuation_type/valuation_type_read', $data);
            $this->load->view('design/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('valuation_type'));
        }
    }
    
    public function create() 
    {
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->valuation_type_model->get_page('valuation_type');
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
            'action' => site_url('valuation_type/create_action/?p='.$_GET['p']),
	    'id' => set_value('id'),
	    'type' => set_value('type'),
	);      
            $this->load->view('design/header', $data);
            $this->load->view('valuation_type/valuation_type_form', $data);
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
		'type' => $this->input->post('type',TRUE),
	    );

            $this->valuation_type_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('valuation_type/?p='.$this->input->post('p')));
        }
    }
    
    public function update($id) 
    {
        $row = $this->valuation_type_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->valuation_type_model->get_page('valuation_type');
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
                'action' => site_url('valuation_type/update_action/?p='.$_GET['p']),
		'id' => set_value('id', $row->id),
		'type' => set_value('type', $row->type),
	    );
            $this->load->view('design/header', $data);
            $this->load->view('valuation_type/valuation_type_form', $data);
            $this->load->view('design/footer');
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('valuation_type'));
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
		'type' => $this->input->post('type',TRUE),
	    );

            $this->valuation_type_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('valuation_type/?p='.$this->input->post('p')));
        }
    }
    
    public function delete($id, $p) 
    {
        $row = $this->valuation_type_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->valuation_type_model->get_page('valuation_type');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $this->valuation_type_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('valuation_type/?p='.$p));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('valuation_type/?p='.$p));
        }
        } else {
            $this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('valuation_type/?p='.$p));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('type', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Valuation_type.php */
/* Location: ./application/controllers/Valuation_type.php */