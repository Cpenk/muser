<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->model('users_model');
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

        $total_rows= $this->users_model->search_total_rows($q);
        $config['base_url'] = 'users/index/'.$rows_view.'/';
        $config['suffix'] = !empty($_GET['q']) ? '/?q='. $_GET['q'].'&p='.$_GET['p'] : '/?p='. $_GET['p'];
        $config['first_url'] = $config['base_url'] . $config['suffix'];
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $rows_view;
        $config["uri_segment"] = 4;

        $users = $this->users_model->search_index_limit($config['per_page'], $start, $q);
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
            'users_data' => $users,
            'start' => $start
        );
            $this->load->view('users/users_list', $data);
    }

    public function access($id) 
    {
        $row = $this->users_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->users_model->get_page('users');
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
            'action' => site_url('users/access_action'),
        'id' => $row->id,
        'username' => $row->username,
        'password' => $row->password,
        'nama' => $row->nama,
        'email' => $row->email,
        'level_user' => $row->level_user,
        'access_user' => $row->access,
        'input_user' => $row->input,
        'edit_user' => $row->edit,
        'delete_user' => $row->delete,
        'status' => $row->status,
        );
            $this->load->view('users/users_access', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
        }else{
            $this->load->view('errors/html/error_404');
        }
    }

    public function access_action() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');

            $data = array(
        'access' => $this->input->post('access_id'),
        'input' => $this->input->post('input_id'),
        'edit' => $this->input->post('edit_id'),
        'delete' => $this->input->post('delete_id'),
        );

            $this->users_model->update($this->input->post('id'), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('users/?p='.$this->input->post('p')));
        
    }

    public function read($id) 
    {
        $row = $this->users_model->get_by_id($id);
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
		'username' => $row->username,
		'password' => $row->password,
        'nama' => $row->nama,
        'email' => $row->email,
		'level_user' => $row->level_user,
		'access' => $row->access,
		'status' => $row->status_name,
	    );
            $this->load->view('users/users_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }
    
    public function create() 
    {
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->users_model->get_page('users');
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
            'action' => site_url('users/create_action/?p='.$_GET['p']),
	    'id' => set_value('id'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
        'nama' => set_value('nama'),
        'email' => set_value('email'),
	    'level_user' => set_value('level_user'),
	    'status' => set_value('status'),
	);      
            $this->load->view('users/users_form', $data);
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
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
        'nama' => $this->input->post('nama',TRUE),
        'email' => $this->input->post('email',TRUE),
		'level_user' => $this->input->post('level_user',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->users_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('users/?p='.$this->input->post('p')));
        }
    }
    
    public function update($id) 
    {
        $row = $this->users_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->users_model->get_page('users');
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
                'action' => site_url('users/update_action/?p='.$_GET['p']),
        'id' => set_value('id', $row->id),
        'username' => set_value('username', $row->username),
        'password' => NULL,
        'nama' => set_value('nama', $row->nama),
        'email' => set_value('email', $row->email),
        'level_user' => set_value('level_user', $row->level_user),
        'status' => set_value('status', $row->status),
        );
            $this->load->view('users/users_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
    
    public function profile($id) 
    {
        $row = $this->users_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->users_model->get_page('users');
        if($session_data['id'] == $id){

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
                'action' => site_url('users/update_profile'),
        'id' => set_value('id', $row->id),
        'username' => set_value('username', $row->username),
        'password' => NULL,
        'nama' => set_value('nama', $row->nama),
        'email' => set_value('email', $row->email),
        'level_user' => set_value('level_user', $row->level_user),
        'status' => set_value('status', $row->status),
        );
            $this->load->view('users/profile_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users/profile_form'));
        }
        }else{
            $this->load->view('errors/html/error_404');
        }
    }
    
    public function update_profile() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');
        if($this->input->post('password') == FALSE){
            if ($this->form_validation->run() == FALSE) {
                // $this->update($this->input->post('id', TRUE));
                $this->profile($this->input->post('id', TRUE));
            } else {
                $data = array(
            'username' => $this->input->post('username',TRUE),
#            'password' => md5($this->input->post('password',TRUE)),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            // 'level_user' => $this->input->post('level_user',TRUE),
            // 'group' => $this->input->post('group',TRUE),
            // 'departement' => $this->input->post('departement',TRUE),
            // 'lokasi' => $this->input->post('lokasi',TRUE),
            // 'status' => $this->input->post('status',TRUE),
            );

                $this->users_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('users/profile/'.$this->input->post('id')));
            }
        }else{

            if ($this->form_validation->run() == FALSE) {
                $this->profile($this->input->post('id', TRUE));
            } else {
                $data = array(
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            // 'level_user' => $this->input->post('level_user',TRUE),
            // 'group' => $this->input->post('group',TRUE),
            // 'departement' => $this->input->post('departement',TRUE),
            // 'lokasi' => $this->input->post('lokasi',TRUE),
            // 'status' => $this->input->post('status',TRUE),
            );

                $this->users_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('users/profile/'.$this->input->post('id')));
            }
        }
    }
    
    public function update_action() 
    {
        $this->_rules();
        $session_data = $this->session->userdata('logged_in');
        if($this->input->post('password') == FALSE){
            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
            'username' => $this->input->post('username',TRUE),
#            'password' => md5($this->input->post('password',TRUE)),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            'level_user' => $this->input->post('level_user',TRUE),
            'status' => $this->input->post('status',TRUE),
            );

                $this->users_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('users/?p='.$this->input->post('p')));
            }
        }else{

            if ($this->form_validation->run() == FALSE) {
                $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
            'username' => $this->input->post('username',TRUE),
            'password' => md5($this->input->post('password',TRUE)),
            'nama' => $this->input->post('nama',TRUE),
            'email' => $this->input->post('email',TRUE),
            'level_user' => $this->input->post('level_user',TRUE),
            'status' => $this->input->post('status',TRUE),
            );

                $this->users_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('users/?p='.$this->input->post('p')));
            }
        }
    }
    
    public function delete($id, $p) 
    {
        $row = $this->users_model->get_by_id($id);
        $session_data = $this->session->userdata('logged_in');
        $_idmenu = $this->users_model->get_page('users');
        if(in_array($_idmenu->id_sub, explode(',', $session_data['delete_data'])) or $session_data['level_user']=='administrator'){

        if ($row) {
            $this->users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users/?p='.$p));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users/?p='.$p));
        }
        } else {
            $this->session->set_flashdata('message', 'Ditolak Hak Akses');
            redirect(site_url('users/?p='.$p));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('username', ' ', 'trim|required');
	#$this->form_validation->set_rules('password', ' ', 'trim|required');
    $this->form_validation->set_rules('nama', ' ', 'trim|required');
    $this->form_validation->set_rules('email', ' ', 'trim|required');
	$this->form_validation->set_rules('level_user', ' ', 'trim|required');
	$this->form_validation->set_rules('status', ' ', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

};

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */