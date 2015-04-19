<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Delcart extends CI_Controller {

        public function __construct()
        {
        parent::__construct();
        $this->load->library('session');  
        $this->load->model('delitem_model');  
             
                         
        }

        function index()
        {   
         
            $SESSION=$this->session->all_userdata();
              $flag=1;
             $items=$SESSION['cart']; 
            if(isset($SESSION['name']))
            {
            foreach($items as $item)
            {
            $this->delitem_model->delete($item['id'],$SESSION['uid']);
            }
            }
            $items=array();
            
          
 $this->session->set_userdata('total',0);
$this->session->set_userdata('cart',$items);
$val=$this->session->userdata('cart');
echo count($val);
           
        }
    }
?>
