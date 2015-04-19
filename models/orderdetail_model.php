<?php 
    class Orderdetail_model extends CI_Model {

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
        
        function getdata($q)
        {
        $query=$this->db->query("SELECT event_details.name as name, event_details.image1 as image1, orderdetails.item_quantity as quantity, orderdetails.item_price as price  FROM event_details inner join orderdetails on event_details.id=orderdetails.item_id where orderdetails.orderid=".$q.";");
        return $query->result_array();
        }
        }
