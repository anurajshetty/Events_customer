<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Profile extends CI_Controller {

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
            
            
            
            
            
            $this->load->model('profile_model');
            $data['result3']=$this->profile_model->type();
             $error="";
             $data['error']=$error;
             $data['nameerr']="";
            
             
             
                         
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
        
        $data['name']="";
        $data['phone']="";
        $data['address']="";
        $data['error']="";
             $data['nameerr']="";
        $flag1=0;
             $flag2=0;
             $flag3=0;
         $data['set']=0;
          $data['message']="";
           $data['nameerr']="";
            $data['adderr']="";
         if(!($this->session->userdata('name')))
        {
        header("Location: ".'login');
        exit();
        }
        if ($this->input->post('name1')==true)
        {//1
        $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'trim|alpha_numeric|min_length[4]|max_length[12]|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|exact_length[10]|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE)
		{   
		/*$data['email']=$this->input->post('email');
			
			$data['name'] =$this->input->post('name');
			 $data['phone'] =$this->input->post('phone');
			$data['address'] =$this->input->post('address');*/
		$data['SESSION']=$this->session->all_userdata();
		    $data['error']="";
			$this->load->view('profile_view',$data);
		}
		else
		{//2
			$password=$this->input->post('password');
			$name =$this->input->post('name');
			$phone =$this->input->post('phone');
			$address =$this->input->post('address');
			$address=$this->testinput($address);
			$id=$this->session->userdata('uid');
			$sql="UPDATE Customer SET Name='".$name."', ";
			if($password != "")
			{
			$sql=$sql."password=PASSWORD('".$password."'), ";
			}
			$sql=$sql."phone='".$phone."', address='".$address."' where id=".$id.";";
			if(!(preg_match("/^[a-zA-Z ]+$/",$name)))
		     {
		     
		     
		     $data['name']=$name;
		     $data['phone']=$phone;
		     $data['address']=$address;
		    
		     $data['nameerr']="Invalid name";
		     $flag2=1;
			 
		     }
		      if (preg_match("/[=;<>]/",$address))
		      {
		      $data['adderr']="Invalid charecters in address";
		      $flag3=1;
		      }
		     if($flag2==1 || $flag3==1)
		     {
		      $data['SESSION']=$this->session->all_userdata();
		     $this->load->view('profile_view',$data);
		     }
		    
		     
		     else
		     {//3
		     $this->profile_model->update($sql);
		    
                  
                  $message="<label id='mess'>Your Details updated successfully</label><br><br>";         
              $data['set']=1;
		      $data['message']=$message;
		      $data['SESSION']=$this->session->all_userdata();
		      $this->load->view('profile_view',$data);
		     }//3
		}//2
        
        }//1
        else
        {
        $id=$this->session->userdata('uid');
        $result=$this->profile_model->getdata($id);
        $data['name']=$result->Name;
        $data['phone']=$result->phone;
        $data['address']=$result->address;
        $data['SESSION']=$this->session->all_userdata();
	    $data['result3']=$this->profile_model->type();
	    $data['error']="";
	    $this->load->view('profile_view',$data);
        }
        
        } //index
        
         function testinput($data)
        {
        $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
        }
        
        
        }
        ?>
