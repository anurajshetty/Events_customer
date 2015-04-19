<?php 
    class Profile_model extends CI_Model {

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
        function update($query)
        {
        $this->db->query($query);
        
        }
        function getdata($id)
        {
        $query=$this->db->query("select Name, phone, address from Customer where id=".$id.";");
        return $query->row();
        }


        }
