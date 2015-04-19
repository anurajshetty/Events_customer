<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Logout extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->library('session');                
        }

        function index()
        { 
         if($this->session->userdata('name'))
         {
         $this->session->unset_userdata('name');
         $this->session->unset_userdata('uid');
         $this->session->unset_userdata('address');
         $this->session->unset_userdata('set');
         $this->session->unset_userdata('time');
         $this->session->unset_userdata('cart');
         $this->session->unset_userdata('total');
         header('Location: home');
         exit();
         }
        }
    }
?>
