<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Signup extends CI_Controller {

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
            
            
            
            
            
            $this->load->model('signup_model');
            $data['result3']=$this->signup_model->type();
             $error="";
             $data['error']=$error;
             $data['nameerr']="";
             $data['emailerr']="";
            
             
             
                         
        }
        function index()
        {
        $data['error']="";
             $data['nameerr']="";
             $data['emailerr']="";
        $flag1=0;
             $flag2=0;
             $flag3=0;
         $data['set']=0;
          $data['message']="";
           $data['nameerr']="";
            $data['emailerr']="";
            $data['adderr']="";
         if($this->session->userdata('name'))
        {
        header("Location: ".'home');
        exit();
        }
        if ($this->input->post('name1')==true)
        {//1
        $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric|min_length[4]|max_length[12]|xss_clean');
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
			$this->load->view('signup_view',$data);
		}
		else
		{//2
		$email=$this->input->post('email');
			$password=$this->input->post('password');
			$name =$this->input->post('name');
			$phone =$this->input->post('phone');
			$address =$this->input->post('address');
			$email=$this->testinput($email);
			$count=$this->signup_model->checkemail($email);
			if($count > 0)
			{
			$data['emailerr']="emailid aleady exist";
			$flag1=1;
			}
			
			if(!(preg_match("/^[a-zA-Z ]+$/",$name)))
		     {
		     $data['email']=$email;
		     
		     $data['name']=$name;
		     $data['phone']=$phone;
		     $data['address']=$address;
		    
		     $data['nameerr']="Invalid name";
		     $flag2=1;
			 
		     }
		     $address=$this->testinput($address);
		      if (preg_match("/[=;<>]/",$address))
		      {
		      $data['adderr']="Invalid charecters in address";
		      $flag3=1;
		      }
		     if($flag1==1 || $flag2==1 || $flag3==1)
		     {
		      $data['SESSION']=$this->session->all_userdata();
		     $this->load->view('signup_view',$data);
		     }
		    
		     
		     else
		     {//3
		     $this->signup_model->insert($name,$email,$phone,$password,$address);
		    
                  
                  $message="<label id='mess'>Your registered successfully</label><br><br><a id='login' href='login'>Click here to Login</a>";          $data['set']=1;
		      $data['message']=$message;
		      $data['SESSION']=$this->session->all_userdata();
		      $this->load->view('signup_view',$data);
		     }//3
		}//2
        
        }//1
        else
        {
        $data['SESSION']=$this->session->all_userdata();
	    $data['result3']=$this->signup_model->type();
	    $data['error']="";
	    $this->load->view('signup_view',$data);
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
