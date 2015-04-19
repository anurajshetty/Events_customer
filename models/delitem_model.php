<?php 
    class Delitem_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }
        
         function delete($itemid,$userid)
        {
          $this->db->delete('cart', array('product_id' => $itemid,'customer_id' => $userid)); 
        }
        }
