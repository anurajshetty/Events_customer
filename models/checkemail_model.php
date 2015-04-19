<?php 
    class Checkemail_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }
        
        function verifyemail($email)
        {
        $query = $this->db->get_where('Customer', array('emailid' => $email));
        return $query->num_rows();
        }
        }
