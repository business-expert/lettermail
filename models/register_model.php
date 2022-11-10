<?php

 class Register_model extends CI_Model 
 {
      function __construct()
        {
            parent::__construct();
        }    
       
     public function new_user($data)
      {
          $this->db->insert('users', $data);
      }
     
     public function email_exists($param)
     {
         $this->db->where($param);
         return $this->db->get('users');
     }
     
     public function activate($code)
     {
         $query = $this->db->where("user_code", $code);
         $query = $this->db->update("users", array("user_active" => "1"));
           return $query;
     }
   
 }
?>
