<?php

class Log_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
        

       public function add_log($data)
       {
           $query = $this->db->insert('log', $data);
       }
       
      public function list_logs() {
         $query = $this->db->order_by("log_date", "desc"); 
         $query = $this->db->get('log');
           return $query->result();
      } 
}
?>
