<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Vieworders extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $var=$this->session->all_userdata();
            if(!(isset($var['cart'])))
            {
            $cart=array();
            $this->session->set_userdata('cart',$cart);
            $this->session->set_userdata('total',0);
           }
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
        
        if(!($this->session->userdata('name')))
        {
        header("Location: ".'home');
        exit();
        }
        
        
        else
        {
        $content="";
        $content1="";
        $this->load->model('viewdetails_model');
        $data['result3']=$this->viewdetails_model->type();
        $mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
          $uid=$this->session->userdata('uid');
          $result=$this->viewdetails_model->getorders($uid);
          $k=1;
               $flag=1;
               foreach($result as $row)
               {
                 if($flag)
                    {
                    
                    $content=$content."<table style='text-align:left;border:1px solid grey;margin: auto;'><tr style='background-color: grey;'><th style='padding:8px;'>ORDER PLACED</th><th style='padding:8px;'>ORDER NUMBER</th><th style='padding:8px;'>RECIPIENT</th><th style='padding:8px;'>ADDRESS SHIPPED</th><th style='padding:8px;'>AMOUNT</th><th style='padding:8px;'>DETAILS</th></tr>";
                    $flag=0;
                    }
                   
                   $arr = explode("-", $row['orderdate']);
                   $month=$arr[1];
                   $month_name=$mons[$month];
                   $date=$month_name." ".$arr[2]." ".$arr[0];
                   $content1=$content1."<table style='text-align:left;border:1px solid grey:margin:auto;'>";
                   $content1=$content1."<tr><td style='padding:4px'>Order Date</td><td style='padding:4px'>".$date."</td></tr>";
                   $content1=$content1."<tr><td style='padding:4px'>Order No</td><td style='padding:4px'>".$row['id']."</td></tr>";
                   $content1=$content1."<tr><td style='padding:4px'>Address</td><td style='padding:1px'>".$row['address']."</td></tr>";
                   $content1=$content1."<tr><td style='padding:4px'>Amount</td><td style='padding:4px'>".$row['amount']."</td></tr>";
                   $content1=$content1."<tr><td style='padding:4px'></td><td style='padding:4px;'><a class='details' style='color:white;text-decoration:none;background-color:rgb(124, 7, 7);padding:4px;' href='orderdetail?q=".$row['id']."'>Details</a></td></tr>";
                   $content1=$content1."</table>";
                   $content1=$content1."<hr>";
                   
                   $content=$content."<tr><td style='padding:8px;'>".$date."</td><td style='padding:8px;'>".$row['id']."</td><td style='padding:8px;'>".$row['ordername']."</td><td style='padding:8px;'>".$row['address']."</td><td style='padding:8px;'>".$row['amount']."</td><td style='padding:8px;'><a class='details' href='orderdetail?q=".$row['id']."'>Details</a></td></tr>";
               
               }
                if($flag)
                   {
                   $content1=$content1."<label>You dont have Order history</label>";
                   $content=$content."<label style='font-size:30px;'>You dont have Order history</label>";
                   }
                   else
                   {
                   
                   $content=$content."</table>";
                   }
                   $data['content1']=$content1;
                   $data['content']=$content;
                   $data['SESSION']=$this->session->all_userdata();
                   $this->load->view('viewdetails_view',$data);
                  }
        }
}
