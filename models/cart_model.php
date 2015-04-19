<?php 
    class Cart_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }

        function orderid($itemid)
        {
          $query= $this->db->query("select orderid from orderdetails where item_id=".$itemid.";");
          
          return $query->result_array();
        }
        
         function itemid($orderid)
        {
          $query= $this->db->query("select item_id from orderdetails where orderid=".$orderid.";");
          
          return $query->result_array();
        }
        
        function itemdetails($item)
        {
        $query= $this->db->query("select * from event_details where id=".$item.";");
        return $query->row();
        }
        
        function type()
        {
        $query= $this->db->query("select id, type from event_type;");
        return $query->result_array();
        }
    }
?>
