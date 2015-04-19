<?php 
    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    class Search extends CI_Controller {

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
            $this->load->model('search_model');
            
             
                         
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
          
          $query="SELECT event_details.id as eventid, event_details.name as eventname, event_details.venue as venue, event_details.date as date, event_details.price as price, event_details.details as details, event_details.image1 as image1, special_events.offer_start as offerstart, special_events.offer_end as offerend FROM event_details left join special_events on event_details.id=special_events.event_id where event_details.date >= DATE_FORMAT(NOW(),'%y-%m-%d')";
          if($this->input->server('REQUEST_METHOD')=='POST')
          {
          if($this->input->post('designation') != "")
          {
           $typeid=$this->testinput($this->input->post('designation',TRUE));
           if(preg_match("/^[0-9]+$/",$typeid))
           {
           $query=$query." and type_id=".$typeid;
           }
          }
          if(!(empty($_POST["search"])))
           {
            $search=$this->testinput($this->input->post('search',TRUE));
            $query=$query." and name like '%".$search."%'";
           }
           $query=$query." ORDER BY date";
           $this->session->set_userdata('query',$query);
           $mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
           $flags=1;
           
           $result=$this->search_model->searchdata($query);
           $row_cnt = count($result);
           $extra= $row_cnt % 5;
                $search_count = floor($row_cnt / 5);
               
                if($extra > 0)
                   {
				$search_count=$search_count+1;
				}
$i=1;
$startindex=0;
$links="";			 
while($i <= $search_count)
 			{
			   $links = $links."<a class='linknav' href='search?startindex=".$startindex."'>".$i."</a>&nbsp;&nbsp;";
           $startindex=$startindex+5;
            $i++;
			  	
			}
			$this->session->set_userdata('link',$links);
			$query=$query." LIMIT 0 , 5";
			$result=$this->search_model->searchdata($query);
			$content="";
			foreach($result as $row)
			{
			$flags=0;
                   $arr = explode("-", $row['date']);
                   $month=$arr[1];
                   $month_name=$mons[$month];
                   $date=$month_name." ".$arr[2]." ".$arr[0];
                   $timenow=time();
                   $offer="";
                    if(!(empty($row['offerstart'])))
                   {
                   if(strtotime($row['offerstart']) <= $timenow && strtotime($row['offerend']) >= $timenow)
                    {
                   
                    $offer ="<div class='special'></div>";
                    
                    }
                    }
                    $content=$content."<br><br>";
                    $content=$content." <div id='detailevent' > <a href='details?q=".$row['eventid']."'><image class='imagediv' src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."'></a>";
                    $content=$content."<div id='detail2'>";
                    $content=$content.$offer."<br><a class='names' href='details?q=".$row['eventid']."'>".$row['eventname']."</a><br><br>";
                    
                    $content=$content." <label class='labels'>Where:</label>&nbsp;&nbsp;<label class='vals'>".$row['venue']."</label><br><br>";
                   $content=$content."<label class='labels'>When:</label>&nbsp;&nbsp;<label class='vals'>". $date."</label><br><br>";
                   $content=$content."<label class='labels' id='detail3' >Details:</label><br><label id='detail4' class='vals'>". $row['details']."</label><br><br>";
                   $content=$content."<a class='Buy' href='details?q=".$row['eventid']."'>BUY TICKETS</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    $content=$content."<input type='button' class='cart' value='ADD TO CART' id='".$row['eventid']."'  /><br><br>";
                    $content=$content."</div></div>";
                   $content=$content."<br>";
                    $content=$content."<hr>";
			}
			if($flags)
              {
              $content=$content."<br><br><label id='noresult'>No Results found</label>";
              }
          }
          else
            {
             if(isset($_GET['startindex']))
              {
              $startindex=$this->testinput($this->input->get('startindex',TRUE));
               if(!(preg_match("/^[0-9]+$/",$startindex)))
                {
                 exit();
                }
$mons = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");
             $flags=1;
                $query=$this->session->userdata('query');
                $query=$query." LIMIT ".$startindex." , 5";
                $content="";
                $result=$this->search_model->searchdata($query);
                foreach($result as $row)
                {
                $flags=0;
                   $arr = explode("-", $row['date']);
                   $month=$arr[1];
                   $month_name=$mons[$month];
                   $date=$month_name." ".$arr[2]." ".$arr[0];
                   $timenow=time();
                   $offer="";
                   if(!(empty($row['offerstart'])))
                   {
                   if(strtotime($row['offerstart']) <= $timenow && strtotime($row['offerend']) >= $timenow)
                    {
                    $offer ="<div class='special'></div>";
                    
                    }
                    }
                    
                    
                    
                    
                    
                     $content=$content."<br><br>";
                    $content=$content." <div id='detailevent' > <a href='details?q=".$row['eventid']."'><image class='imagediv' src='http://cs-server.usc.edu:65432/CodeIgniter/assets/".$row['image1']."'></a>";
                    $content=$content."<div id='detail2'>";
                    $content=$content.$offer."<br><a class='names' href='details?q=".$row['eventid']."'>".$row['eventname']."</a><br><br>";
                    
                    $content=$content." <label class='labels'>Where:</label>&nbsp;&nbsp;<label class='vals'>".$row['venue']."</label><br><br>";
                   $content=$content."<label class='labels'>When:</label>&nbsp;&nbsp;<label class='vals'>". $date."</label><br><br>";
                   $content=$content."<label class='labels' id='detail5'>Details:</label><br><label id='detail6' class='vals'>". $row['details']."</label><br><br>";
                   $content=$content."<a class='Buy' href='details?q=".$row['eventid']."'>BUY TICKETS</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                    $content=$content."<input type='button' class='cart' value='ADD TO CART' id='".$row['eventid']."'  /><br><br>";
                    $content=$content."</div></div>";
                   $content=$content."<br>";
                    $content=$content."<hr>";
                }
                if($flags)
              {
              $content=$content."<br><br><label id='noresult'style='font-size: 25px;margin-left: 200px;'>No Results found</label>";
              }
              }
else
{
header('Location: home');
}
}
$data['SESSION']=$this->session->all_userdata();
$data['content']=$content;
$data['result3']=$this->search_model->type();
$this->load->view('search_view', $data);
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
