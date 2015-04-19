<?php 
    class Viewdetails_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }
        
         function type()
        {
        $query= $this->db->query("select id, type from event_type;");
        return $query->result_array();
        }
        
        function getorders($uid)
        {
        $query=$this->db->query("SELECT * FROM `orders` WHERE userid =".$uid.";");
        return $query->result_array();
        }
        }
