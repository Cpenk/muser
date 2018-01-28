<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ***************************************************************
 * Script : 
 * Version : 
 * Date :
 * Author : Pudyasto Adi W.
 * Email : mr.pudyasto@gmail.com
 * Description : 
 * ***************************************************************
 */

/**
 * Description of Dashboard
 *
 * @author Pudyasto
 */
class Dashboard extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
           if($this->session->userdata('logged_in'))
           {
             $session_data = $this->session->userdata('logged_in');
             $data['username'] = $session_data['username'];
             //isi
                $this->load->library('form_validation');
                $this->load->library('session');
                $this->load->helper('select');
                $this->load->helper('rp');
           }else{
             //Jika tidak ada session di kembalikan ke halaman login
             redirect('access', 'refresh');
           }
    }    
    
    public function index() {      
        $session_data = $this->session->userdata('logged_in');
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
        );
        $this->load->view('design/header', $data);
        $this->load->view('dashboard/admin', $data);
        $this->load->view('design/footer');
    }

    public function dashboard() {      
        $session_data = $this->session->userdata('logged_in');
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
        );
        $this->load->view('dashboard/admin', $data);
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

    public function cannot_access() {      
        $session_data = $this->session->userdata('logged_in');
        $data = array(
            'id_user' => $session_data['id'],
            'nama_user' => $session_data['nama'],
            'level_user' => $session_data['level_user'],
            'access' => $session_data['access'],
        );
        $this->load->view('design/header', $data);
        $this->load->view('access/blank_page', $data);
        $this->load->view('design/footer');
    }
}
