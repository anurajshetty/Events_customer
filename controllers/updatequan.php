<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Updatequan extends CI_Controller {

        public function __construct()
        {
        parent::__construct();
        $this->load->library('session');  
        $this->load->model('updatequan_model');  
             
                         
        }

        function index()
        {   
         
            $SESSION=$this->session->all_userdata();
            $q = $this->input->get('q', TRUE);
            $id=$this->input->get('i', TRUE);
             if(!preg_match("/^[0-9]+$/",$q))
             {
             exit();
             }
             elseif(!preg_match("/^[0-9]+$/",$id))
             {
             exit();
             }
             $flag=1;
$items=$SESSION['cart'];
$i=0;
if(isset($SESSION['name']))
{
  $this->updatequan_model->update($q,$id,$SESSION['uid']);
    
}
foreach($items as $item)
 {
  if($item['id']==$id)
   {
     if($item['quantity'] < $q )
	{
       $diff= $q-$item['quantity'];
    $SESSION['total']= $SESSION['total']+($item['price']*$diff);
     $index=$i;
      
      }
elseif($item['quantity'] > $q )
	{
      $diff= $item['quantity']-$q;
    $SESSION['total']= $SESSION['total']-($item['price']*$diff);
     $index=$i;
     
      }

     else
      {
      $index=$i;
      }
    break;  
   }
$i++;
 }
$val=$items[$index];
$val['quantity']=$q;
$items[$index]=$val;
$this->session->set_userdata('cart',$items);
$this->session->set_userdata('total',$SESSION['total']);
echo $SESSION['total'];
           
        }
    }
?>
