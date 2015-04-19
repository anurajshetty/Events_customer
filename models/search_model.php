<?php 
    class Search_model extends CI_Model {

        public function __construct()
        {   
            parent::__construct();
              $this->load->database();          
        }

      function searchdata($query)
      {
      $query= $this->db->query($query.";");
      return $query->result_array();
      }
        function type()
        {
        $query= $this->db->query("select id, type from event_type;");
        return $query->result_array();
        }
    }
?>
