<?php 
    class Checkout_model extends CI_Model {

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
        function orderinsert($id, $name , $date , $address, $total, $number)
        {
        
        $data = array(
   'userid' => $id ,
   'ordername' => $name ,
   'orderdate' => $date,
   'address' => $address,
   'amount' => $total,
   'cardnumber' => $number
      );
      $this->db->trans_start();
      $this->db->insert('orders', $data);
      $id=$this->db->insert_id();
      $this->db->trans_complete();
       return $id;
        }
        
        function detailinsert($orderid,$itemid,$itemtype,$itemoffer,$itemquantity,$itemprice,$date)
        {
        
        $data=array('orderid'=>$orderid, 'item_id' => $itemid, 'item_type' => $itemtype, 'offer' => $itemoffer, 'item_quantity' => $itemquantity, 'item_price' => $itemprice, 'date' => $date);
        $this->db->insert('orderdetails', $data);
        }
        
        function deletecart($id)
        {
        $this->db->query("delete from cart where customer_id=".$id.";");
        }
        
    }
