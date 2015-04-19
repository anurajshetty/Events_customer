<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Checkemail extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            
         }
         
         function index()
        {
        $this->load->model('checkemail_model');
        $q=$this->input->get('q',TRUE);
        $count=$this->checkemail_model->verifyemail($q);
        echo $count;
        }
        
        }
