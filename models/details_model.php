<?php 
    class Details_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }

        function getspecial($type)
        {
          $query= $this->db->query("SELECT event_details.id as eventid, event_details.image1 as image1 FROM event_details inner join special_events on event_details.id=special_events.event_id where event_details.type_id=".$type." ORDER BY date LIMIT 0 , 4;");
          
          return $query->result_array();
        }
        function getdata($eventid)
        {
        $query= $this->db->query("SELECT event_details.id as eventid, event_details.name as eventname, event_details.venue as venue, event_details.date as date, event_details.organiser as organiser, event_details.type_id as type, event_details.price as price, event_details.details as details, event_details.entries as entry, event_details.image1 as image1,special_events.dis_price as disprice, special_events.offer_start as offerstart, special_events.offer_end as offerend FROM event_details left join special_events on event_details.id=special_events.event_id where event_details.id=".$eventid." ORDER BY date LIMIT 0 , 4;");
        
        return $query->row();
        }
        function type()
        {
        $query= $this->db->query("select id, type from event_type;");
        return $query->result_array();
        }
    }
?>
