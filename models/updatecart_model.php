<?php 
    class Updatecart_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }

       public function updatecart($a,$b)
        {
         $this->db->query("INSERT INTO cart (product_id, quantity, customer_id) VALUES (".$a.", 1, ".$b.");");
          
         
        }
       public function getdata($q)
        {
        $query= $this->db->query("SELECT event_details.id as eventid, event_details.name as eventname, event_details.date as date, event_details.type_id as type, event_details.price as price,special_events.dis_price as disprice, special_events.offer_start as offerstart, special_events.offer_end as offerend FROM event_details left join special_events on event_details.id=special_events.event_id where event_details.id=".$q.";");
        
        return $query->row();
        }
       
    }
?>
