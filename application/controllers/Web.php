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
class Web extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
          $this->load->model('users_model');
    }    
    
    public function index($username = null)
     {
        $this->load->view('design/header_web');
        $this->load->view('web/web');
        $this->load->view('design/footer_web');
     }

    public function user($username = null)
     {
      $row = $this->users_model->get_by_username($username);
        $data = array(
          'nama' => $row->nama,
          'email' => $row->password,
          );
       // $this->session->unset_userdata('logged_in');
       // session_destroy();
       // redirect('access', 'refresh');
        $this->load->view('design/header_web', $data);
        $this->load->view('web/web');
        $this->load->view('design/footer_web');
     }
}
