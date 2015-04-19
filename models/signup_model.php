<?php 
    class Signup_model extends CI_Model {

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
        function insert($name,$email,$phone,$password,$address)
        {
        $this->db->query("INSERT INTO Customer (Name, emailid, password, phone,address) VALUES ('$name','$email',PASSWORD('$password'),'$phone','$address')");
        
        }
        function checkemail($email)
        {
        $query=$this->db->query("select Name from Customer where emailid='".$email."';");
        return $query->num_rows();
        }


        }
        
