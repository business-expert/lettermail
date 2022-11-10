<?php

class Login_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
        
       
       public function login($param)
       {
            $this->
                    db->where($param);
            $this->
                    db->limit(1);
           return $this->
                    db->get('users');
       }
       public function check_email($email) 
       {
           $query = $this->db->where("user_email", $email);
           $query = $this->db->get('users');
           return $query;
       }
       public function add_forgotten($data)
       {
           $query = $this->db->insert('forgotten', $data);
       }
       public function codeInfo($code)
       {
           $query = $this->db->where(array("Code" => $code, "Active" => "0"));
           $query = $this->db->get('forgotten');
           return $query->row();
       }
       public function codeStatus($code)
       {
           $this->db->where('Code', $code);
           $this->db->delete('forgotten');
       }
       public function set_pass($param, $pass)
       {
           $this->db->where($param);
           $this->db->update('users', array("user_password" => $pass));
       }

}
?>
