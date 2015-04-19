<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Home extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $site = site_url("home");
            $var=$this->session->all_userdata();
            if(!(isset($var['cart'])))
            {
            $cart=array();
            $this->session->set_userdata('cart',$cart);
            $this->session->set_userdata('total',0);
           }
            $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            
            $this->session->set_userdata('url',$url);
            
            
             
                         
        }

        function index()
        {
        if($this->session->userdata('name'))
        {
        $time= $this->session->userdata('time');
        $timenow=time();
        if($time < $timenow)
        {
        $this->load->library('session');
        $this->session->unset_userdata('name');
        $time=$this->session->userdata('time');
        $this->session->unset_userdata('uid');
         $this->session->unset_userdata('address');
         $this->session->unset_userdata('set');
         $this->session->unset_userdata('time');
         $this->session->unset_userdata('cart');
         $this->session->unset_userdata('total');
        header('Location: home');
        exit();
        }
        else
        {
        $this->session->set_userdata('time',$timenow+300);
        }
        
        }
        $this->load->model('home_model');
            $data['SESSION']=$this->session->all_userdata();
           
            $data['result3']=$this->home_model->type();
            $data['result2']=$this->home_model->special_sales();
            $data['result1']=$this->home_model->home_data();
            
            $this->load->view('home_view', $data);
        }
    }
?>
