<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Details extends CI_Controller {

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
         
            $this->load->model('details_model');
            
             
                         
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
         
            $data['SESSION']=$this->session->all_userdata();
            
            $data['result3']=$this->details_model->type();
            $productid=$this->input->get('q',TRUE);
            $data['productid']=$productid;
            if(!preg_match("/^[0-9]+$/",$productid))
            {
            exit();
            }
$mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
           $row= $this->details_model->getdata($productid);
           $data['row']=$row;
           $type=$row->type;
           $data['type']=$type;
           $arr = explode("-", $row->date);
                   $month=$arr[1];
                   $month_name=$mons[$month];
                   $date=$month_name." ".$arr[2]." ".$arr[0];
                   $data['date']=$date;
                   $timenow=time();
                   $offer="";
                   if(!(empty($row->offerstart)))
                   {
                   if(strtotime($row->offerstart) <= $timenow && strtotime($row->offerend) >= $timenow)
                    {
                    $offer=$row->disprice;
                    
                    }
                    }
                    $data['offer']=$offer;
                    
                    $result= $this->details_model->getspecial($type);
                    $data['result']=$result;
            $this->load->view('details_view', $data);
        }
    }
?>
