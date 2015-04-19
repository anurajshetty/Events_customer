<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Checkout extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $var=$this->session->all_userdata();
            if(!($this->session->userdata('cart')))
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
           
           $url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
           $this->session->set_userdata('url',$url);
           if(!($this->session->userdata('cart')))
            {
            $cart=array();
            $this->session->set_userdata('cart',$cart);
            $this->session->set_userdata('total',0);
           }
           $content="";
        if(!($this->session->userdata('name')))
        {
        header("Location: ".'login');
        exit();
        }
        $data['message']="";
        $data['exerr']="";
        $data['namerr']="";
        $data['adderr']="";
        $data['flag']=0;
        $id=$this->session->userdata('uid');
$name=$this->session->userdata('name');
$address=$this->session->userdata('address');
$total=$this->session->userdata('total');
$data['id']=$id;
$data['name']=$name;
$data['address']=$address;
$data['total']=$total;
$data['SESSION']=$this->session->all_userdata();
 $this->load->model('checkout_model');
$data['result3']=$this->checkout_model->type();
       
        $itemlist =$this->session->userdata('cart');
$content=$content."<table style='margin: auto;color:white'><tr style='background-color:grey'><th style='padding:8px;'>Description</th><th style='padding:8px;'>Amount</th></tr>";
foreach($itemlist as $item)
{
$amount=$item['quantity']*$item['price'];
$content=$content."<tr><td style='padding:8px;'>".$item['name']."<br>Price: ".$item['price']."<br>Quantity: ".$item['quantity']."<br>"."</td><td style='padding:8px;'>$".$amount."</td></tr>";
$content=$content."<tr><td><hr></td><td><hr></td></tr>";
}
$content=$content."<tr><td>Total</td><td>$".$this->session->userdata('total')."</td></tr></table>";
$data['content']=$content;
        
        if ($this->input->post('submit')==true)
        {//1
         $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('number', 'Card Number', 'trim|required|numeric|exact_length[16]|xss_clean');
		$this->form_validation->set_rules('month', 'Month', 'trim|required|numeric|exact_length[2]|xss_clean');
		$this->form_validation->set_rules('year', 'Year', 'trim|required|numeric|exact_length[2]|xss_clean');
        $this->form_validation->set_rules('csv', 'CSV', 'trim|required|numeric|exact_length[3]|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE)
		{//false   
		 
	    $data['error']="";
	    $this->load->view('checkout_view',$data);
		
		}  //false
		else
		{//2
		$exerr="Enter valid Card expiry date";$namerr="Enter valid name";$adderr="Enter valid address";
		$flag1=$flag2=$flag3=0;
		$month=$this->input->post('month');
		$year=$this->input->post('year');
		$csv=$this->input->post('csv');
		$number=$this->input->post('number');
		$name=$this->input->post('name');
		$address=$this->input->post('address');
		$adress=$this->testinput($address);
		if($month <= 12)
		{
		$year="20".$year."-".$month."-"."28";
		$time=strtotime($year);
		$timenow=time();
		if($time > $timenow)
		{
		$flag1=1;
		$exerr="";
		}
		}
		 if (preg_match("/^[a-zA-Z ]*$/",$name))
		 {
		 $flag2=1;
		 $namerr="";
		 }
		  if (!(preg_match("/[=;<>]/",$address)))
		  {
		  $adderr="";
		  $flag3=1;
		  } 
		if($flag1==1 && $flag2==1 && $flag3==1)
		{
		$date=date("Y-m-d");
		$orderid=$this->checkout_model->orderinsert($id, $name , $date , $address, $total, $number);
		$message= "<label style='font-size: 25px;'>Your Oder has been Placed Successfully</label><br><br><label style='font-size: 22px;'>your Order id is : ".$orderid."</label>"; 
		$data['message']=$message;
		$items=$this->session->userdata('cart');
        foreach($items as $item)
         {
          $this->checkout_model->detailinsert($orderid,$item['id'],$item['type'],$item['offer'],$item['quantity'],$item['price'],$date);
          
         }
         $this->checkout_model->deletecart($id);
         $this->session->set_userdata('cart',array());
         $this->session->set_userdata('total',0);
        $data['SESSION']=$this->session->all_userdata();
         $data['flag']=1;
         $this->load->view('checkout_view',$data);
		}
		else
		{
		$data['exerr']=$exerr;
		$data['namerr']=$namerr;
		$data['adderr']=$adderr;
		$this->load->view('checkout_view',$data);
		}
		}//2
         }//1 
         else
         {
         $data['SESSION']=$this->session->all_userdata();
	    $data['result3']=$this->checkout_model->type();
	    
	    $this->load->view('checkout_view',$data);
         }
       }
       function testinput($data)
        {
        $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
        }
        
 }
     
