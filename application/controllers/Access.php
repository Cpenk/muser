<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Access_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }  
    
    public function index()
    {
         $this->load->view('access/login');
    }
    
    public function validate() { 
       $this->form_validation->set_rules('username', 'Username', 'trim|required');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('access/login');
        }else{
            redirect('dashboard');
        }
    }

     function check_database($password)
     {
       //validasi field terhadap database 
       $username = $this->input->post('username');

       //query ke database
       $result = $this->Access_model->login($username, $password);

       if($result)
       {
         $sess_array = array();
         foreach($result as $row)
         {
           $sess_array = array(
             'id' => $row->id,
             'username' => $row->username,
             'nama' => $row->nama,
             'level_user' => $row->level_user,
             'access' => $row->access,
             'input_data' => $row->input,
             'edit_data' => $row->edit,
             'delete_data' => $row->delete
           );
           $this->session->set_userdata('logged_in', $sess_array);
         }
         return TRUE;
       }
       else
       {
         $this->form_validation->set_message('check_database', 'Kesalahan Pada Username atau Password');
         return false;
       }
     }
}
