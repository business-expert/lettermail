<?php

class User_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
        
      public function list_users() {
           $query = $this->db->order_by("user_name", "asc"); 
	   $query = $this->db->get('users');
           return $query->result();
      }    
      
      public function list_ponudniki() {
           $query = $this->db->where("user_group", "ponudnik"); 
           $query = $this->db->order_by("user_name", "asc"); 
	   $query = $this->db->get('users');
           return $query->result();
      }     
      
      public function detail($email) {
           $query = $this->db->where(array("user_email" => $email));
           $query = $this->db->limit(1);
           $query = $this->db->get('users');
           
           return $query->row();
      }
      public function detail_id($id) {
           $query = $this->db->where(array("user_id" => $id));
           $query = $this->db->limit(1);
           $query = $this->db->get('users');
           
           return $query->row();
      }
      public function  save_new($data)
      {
          $this->db->insert('users', $data);
      }    
      public function  save_user($data, $id)
      {
          $this->db->where("user_id", $id);
          $this->db->update('users', $data);
      }
      public function delete($id)
      {
         $this->db->delete('users', array('user_id' => $id)); 
          
      }
}
?>
