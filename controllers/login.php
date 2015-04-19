<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Login extends CI_Controller {

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
            $var=$this->session->all_userdata();
            
            
            
            $this->load->model('login_model');
            $data['result3']=$this->login_model->type();
             $error="";
             $data['error']=$error;
                         
        }

        function index()
        {
        $this->load->library('session');
        if($this->session->userdata('name'))
        {
        header("Location: ".'home');
        exit();
        }
        if ($this->input->post('submit')==true)
        {
        $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

	    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|alpha_numeric|min_length[4]|max_length[12]|xss_clean');
		if ($this->form_validation->run() == FALSE)
		{   $data['SESSION']=$this->session->all_userdata();
		    $data['error']="";
			$this->load->view('login_view',$data);
		}
		else
		{
			$email=$this->input->post('email');
			$email=$this->testinput($email);
			$password=$this->input->post('password');
			$row=$this->login_model->verifyuser($email,$password);
			$count=count($row);
			if($count != 1)
			{
			 $data['SESSION']=$this->session->all_userdata();
	    $data['result3']=$this->login_model->type();
			$data['error']="Invalid emailid or password";
			$this->load->view('login_view',$data);
			}
			else
			{
			$this->session->set_userdata('name',$row->Name);
			$this->session->set_userdata('uid',$row->id);
			$this->session->set_userdata('address',$row->address);
			$this->session->set_userdata('set',1);
			$this->session->set_userdata('time',time()+10);
             if(count($this->session->userdata('cart'))>0)
              { 
              $items=$this->session->userdata('cart');
              foreach($items as $item)
                 {
                 $count=$this->login_model->quantity($item['id'],$row->id);
                  if($count > 0)
                  {
                  $this->login_model->update($item['quantity'],$item['id'],$row->id);
                  }
                  else
                  {
                  $this->login_model->insert($item['quantity'],$item['id'],$row->id);
                  }
                 }
  			  }
  			  
  			  $vals=array();
              $newitem=array('id'=>'','name'=>'','price'=>'','quantity'=>1,'offer'=>0,'type'=>0);
  			  $total=0;
  			  $cart=$this->login_model->cartitems($row->id);
  			  foreach($cart as $row1)
  			  {
  			   $row2=$this->login_model->eventdetails($row1['product_id']);
  			   $offer=100;
  			   $timenow=time();
  $newitem['id']=$row2->eventid;
  $newitem['name']=$row2->eventname;
  $newitem['type']=$row2->type;
  $offer=$row2->price;
  			         if(!(empty($row2->offerstart)))
                   {
                   if(strtotime($row2->offerstart) <= $timenow && strtotime($row2->offerend) >= $timenow)
                    {
                    $offer =$row2->disprice;
                     $newitem['offer']=1;
                    }
                    }
 $newitem['quantity']=$row1['quantity'];
 $newitem['price']=$offer;
$total= $total+($offer*$row1['quantity']);
array_push($vals,$newitem);
            }
$this->session->set_userdata('total',$total);            
$this->session->set_userdata('cart',$vals);
header("Location: ".$this->session->userdata('url'));
exit();
}
		}//else
	    
	    }
	    else
	    {
	    $data['SESSION']=$this->session->all_userdata();
	    $data['result3']=$this->login_model->type();
	    $data['error']="";
	    $this->load->view('login_view',$data);
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
?>
