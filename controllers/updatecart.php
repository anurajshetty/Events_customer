<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Updatecart extends CI_Controller {

        public function __construct()
        {
            parent::__construct();
            
         }
          function index()
        {  
        $this->load->library('session'); 
         $this->load->model('updatecart_model');   
            $q = $this->input->get('q', TRUE);
            $flag=1;
             if(preg_match("/^[0-9]+$/",$q))
             {
             $SESSION=$this->session->all_userdata();
           if(count($SESSION['cart']) > 0)
             {
              $vals=$SESSION['cart'];
              foreach($vals as $item)
              {
               if($item['id']==$q)
                {
                 $flag=0;
                 }
                }
               }
               else
                {
                 $SESSION['total']=0;
                 $vals=array();
                }
                }
                else
                {
                $flag=0;
                }
if($flag)
{
$newitem=array('id'=>'','name'=>'','type'=>0,'offer'=>0,'price'=>'','quantity'=>1);
$row=array();
$row=$this->updatecart_model->getdata($q);
$offer=100;
   $timenow=time();
  $newitem['id']=$row->eventid;
  $newitem['name']=$row->eventname;
  $newitem['type']=$row->type;
  $offer=$row->price;
                   if(!(empty($row->offerstart)))
                   {
                   if(strtotime($row->offerstart) <= $timenow && strtotime($row->offerend) >= $timenow)
                    {
                    $offer =$row->disprice;
                    $newitem['offer']=1;
                    }
                   }
 $newitem['price']=$offer;
$SESSION['total']= $SESSION['total']+$offer;
$this->session->set_userdata('total',$SESSION['total']);

if(isset($SESSION['name']))
{
$this->updatecart_model->updatecart($row->eventid,$SESSION['uid']);
}

array_push($vals,$newitem);
$this->session->set_userdata('cart',$vals);
}
else
{
$this->session->set_userdata('cart',$vals);

}
$items=$this->session->userdata('cart');
echo count($items);
                

        }
}
 ?>
