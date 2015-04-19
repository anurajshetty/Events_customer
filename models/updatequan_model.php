<?php 
    class Updatequan_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }
        
         function update($value,$itemid,$userid)
        {
        $this->db->query("UPDATE cart SET quantity=".$value." WHERE product_id=".$itemid." and customer_id=".$userid.";");
          
        }
        }
