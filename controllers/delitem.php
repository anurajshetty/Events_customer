<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Delitem extends CI_Controller {

        public function __construct()
        {
        parent::__construct();
        $this->load->library('session');  
        $this->load->model('delitem_model');  
             
                         
        }

        function index()
        {
         
            $SESSION=$this->session->all_userdata();
            $q = $this->input->get('q', TRUE);
              $flag=1;
             $items=$SESSION['cart'];
               $i=0;
               if(preg_match("/^[0-9]+$/",$q))
               {
            if(isset($SESSION['name']))
            {
            $this->delitem_model->delete($q,$SESSION['uid']);
            }
            foreach($items as $item)
             {
           if($item['id']==$q)
            {
            $SESSION['total']= $SESSION['total']-($item['price']*$item['quantity']);
             unset($items[$i]);
            $items=array_values($items);
             break;
             }
          $i++;
          }
          }
 $this->session->set_userdata('total',$SESSION['total']);
$this->session->set_userdata('cart',$items);
$val=$this->session->userdata('cart');
echo count($val);
           
        }
    }
?>
