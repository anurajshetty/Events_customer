<?php 
    class Login_model extends CI_Model {

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
        function verifyuser($email,$passwd)
        {
        $query= $this->db->query("SELECT id,Name,emailid,address FROM Customer where emailid='".$email."' and password=PASSWORD('".$passwd."');");
        return $query->row();
        
        }
        
        function quantity($itemid,$userid)
        {
        $query=$this->db->query("select quantity from cart where product_id=".$itemid." and customer_id=".$userid.";");
        return $query->num_rows();
        }
        
        function update($quantity,$itemid,$userid)
        {
        $query=$this->db->query("UPDATE cart SET quantity=".$quantity." WHERE product_id=".$itemid." and customer_id=".$userid.";");
        }
        
        function insert($quantity,$itemid,$userid)
        {
        $query=$this->db->query("INSERT INTO cart (product_id, quantity, customer_id) VALUES (".$itemid.", ".$quantity.", ".$userid.");");
        }
        
        function cartitems($userid)
        {
        $query=$this->db->query("SELECT product_id,quantity FROM cart where customer_id=".$userid.";");
        return $query->result_array();
        }
        
        function eventdetails($productid)
        {
        $query=$this->db->query("SELECT event_details.id as eventid, event_details.name as eventname, event_details.venue as venue, event_details.date as date, event_details.organiser as organiser, event_details.type_id as type, event_details.price as price, event_details.details as details, event_details.entries as entry, event_details.image1 as image1,special_events.dis_price as disprice, special_events.offer_start as offerstart, special_events.offer_end as offerend FROM event_details left join special_events on event_details.id=special_events.event_id where event_details.id=".$productid.";");
         return $query->row();
        }
    }
?>
