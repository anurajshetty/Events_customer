<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Cart extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $SESSION['url']="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            
            $this->session->set_userdata($SESSION['url']);
            $this->load->model('cart_model');
            
             
                         
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
          $SESSION=$this->session->all_userdata();
            $data['SESSION']=$this->session->all_userdata();
            
            $data['result3']=$this->cart_model->type();
            $sug1="";
        $sug="";    
if(count($SESSION['cart']) > 0)
{
$items=$SESSION['cart'];
$item=$items[0];
$orderid=$this->cart_model->orderid($item['id']);
$sug1="";
 $temp=array();
 $suggestion=array();
 $count=count($items);
 foreach ($orderid as $row)
 {
 $itemid=$this->cart_model->itemid($row['orderid']);
 $count1=0;
 $k=1;
 $flg=1;
 foreach ($itemid AS $row1)
 {

 
  foreach($items as $list)
  {
  
  if($list['id'] == $row1['item_id'])
  {
  
  $count1=$count1+1;
  }
  else
  {
   array_push($temp,$row1['item_id']);
  }
  }
 }
 if($count1==$count)
  {
  foreach($temp as $val)
  {
  foreach($suggestion as $copy)
  {
  if($val == $copy)
  {
  $flg=0;
  }
  }
  if($flg)
  {
  array_push($suggestion,$val);
  }
  $flg=1;
 
  }
  $temp=array();
  }
  else
  {
  $temp=array();
  }
 }
 $sug1="";
 $sug="";
  $hh=1;
 $c=1;
 foreach($suggestion as $item)
 {
 if($hh)
 {
 $sug=$sug. "<label style='font-size:25px;'>People are attending below events along with these events.. </label><br><hr><br><table style='margin:auto'><tr>";
 $sug1=$sug1."<label style='font-size:25px;'>People are also attending </label><hr><br>";
 $hh=0;
 }
 $flag=1;
 $items=$SESSION['cart'];
 foreach($items as $item2)
   {
   if($item2['id']== $item)
   {
   $flag=0;
   }
   }
   if($flag && $c <= 4)
   {
   $row=$this->cart_model->itemdetails($item);
   
   
   $c=$c+1;
   $sug=$sug. "<td><a style='text-align:left;' href='details?q=".$row->id."'><img style='border:1px solid red;' src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row->image1."' alt='HTML tutorial' width='200px' height='200px'></a></td>";
   $sug1=$sug1."<a style='text-align:left;' href='details?q=".$row->id."'><img style='border:1px solid red;' src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row->image1."' alt='HTML tutorial' width='350px' height='200px'></a>";
   }
   
 }
 if($hh==0)
 {
 $sug=$sug. "</tr></td></tabel>";
 }           
            
 }          $data['sug1']=$sug1; 
           $data['sug']= $sug;
            $this->load->view('cart_view', $data);
        }
    }
?>
