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
class Logout extends CI_Controller{
    //put your code here
    public function __construct()
    {
        parent::__construct();
    }    
    
     function index()
     {
       $this->session->unset_userdata('logged_in');
       session_destroy();
       redirect('access', 'refresh');
     }
}
