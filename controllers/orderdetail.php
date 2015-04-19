<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Orderdetail extends CI_Controller {

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
        $content="";
        $content1="";
        $this->load->model('orderdetail_model');
        $data['result3']=$this->orderdetail_model->type();
        $q=$this->input->get('q',TRUE);
$mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
        if (preg_match("/^[0-9]+$/",$q))
        {
        $result=$this->orderdetail_model->getdata($q);
        }
        else
        {
        header("Location: ".'home');
        exit();
        }
         $total=0;
              $content=$content."<table style='text-align:left;border:1px solid grey;margin: auto;padding: 30px;'>";
              $content1=$content1."<table style='text-align:left;border:1px solid grey;margin: auto;padding: 10px;'>";
              $content1=$content1."<tr style='1px solid black;background-color:rgb(124, 7, 7);color:white;'><td style='padding:5px;border-bottom: 2px solid grey;'><b>Event Details</b>
                   </td><td style='padding:5px;border-bottom: 2px solid grey;'><b>Amount</b></td></tr>";
              foreach($result as $row)
              {
              $total=$total+($row['quantity']*$row['price']);
              $content=$content."<tr style='1px solid black;'><td style='padding:8px;border-bottom: 2px solid grey;'><div style='width:200px;height:200px;background-size:cover;background-image:url(\"http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."\");'></div></td><td style='padding:8px;border-bottom: 2px solid grey;'><b>".$row['name']."</b><br>Quantity: ".$row['quantity']."<br>Price: ".$row['price']."
                   </td><td style='padding:100px;border-bottom: 2px solid grey;'>$".$row['quantity']*$row['price']."</td></tr>";
                   $content1=$content1."<tr style='1px solid black;'><td style='padding:4px;border-bottom: 2px solid grey;'><b>".$row['name']."</b><br>Quantity: ".$row['quantity']."<br>Price: ".$row['price']."
                   </td><td style='padding:50px;border-bottom: 2px solid grey;'>$".$row['quantity']*$row['price']."</td></tr>";
                   
              }
              $content=$content."<tr style='1px solid black;'><td style='padding:8px;'></td><td style='vertical-align: top;'>TOTAL
                   </td><td style='vertical-align: top;padding-left: 100px;'><b>$".$total."</b></td></tr>";
                    $content1=$content1."<tr style='1px solid black;'><td style='vertical-align: top;'><b>TOTAL</b>
                   </td><td style='vertical-align: top;padding-left: 50px;'><b>$".$total."<b></td></tr>";
                $content=$content."</table>";
                $content1=$content1."</table>";
                $data['content1']=$content1;
                $data['content']=$content;
                   $data['SESSION']=$this->session->all_userdata();
                   $this->load->view('orderdetail_view',$data);
        }
        
        }
        ?>
