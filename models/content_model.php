<?php

class Content_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
        
        function generateSlug($phrase, $maxLength = 55)
        {
        $result = strtolower($phrase);
        $result = str_replace("š", "s", $result);
        $result = str_replace("Š", "s", $result);
        $result = str_replace("ž", "z", $result);
        $result = str_replace("Ž", "z", $result);
        $result = str_replace("č", "c", $result);
        $result = str_replace("Č", "c", $result);
        $result = preg_replace("/[^a-z0-9\s-]/", "", $result);
        $result = trim(preg_replace("/[\s-]+/", " ", $result));
        $result = trim(substr($result, 0, $maxLength));
        $result = preg_replace("/\s/", "-", $result);

        return $result;
        }
      public function list_content() {
           $query = $this->db->order_by("content_title", "asc");
           $query = $this->db->where('content_parent', "0");
	   $query = $this->db->get('content');
           return $query->result();
      }     
      public function list_content_child($parent) {
           $query = $this->db->order_by("content_title", "asc");
           $query = $this->db->where('content_parent', $parent);
	   $query = $this->db->get('content');
           return $query->result();
      }     
      public function detail_slug($slug) {
           $query = $this->db->where(array("content_slug" => $slug));
           $query = $this->db->limit(1);
           $query = $this->db->get('content');
           
           return $query->row();
      }
      public function detail_id($id) {
           $query = $this->db->where(array("content_id" => $id));
           $query = $this->db->limit(1);
           $query = $this->db->get('content');
           
           return $query->row();
      }
      public function  new_content($data)
      {
          $this->db->insert('content', $data);
      }    
      public function  save_content($data, $id)
      {
          $this->db->where("content_id", $id);
          $this->db->update('content', $data);
      }
      public function delete_content($id)
      {
         $this->db->delete('content', array('content_id' => $id)); 
          
      }
      
      
      
      
      
      
      
      
      
      
      public function list_blog() {
           $query = $this->db->order_by("content_id", "desc");
	   $query = $this->db->get('blog');
           return $query->result();
      }     
   
      public function detail_slug_blog($slug) {
           $query = $this->db->where(array("content_slug" => $slug));
           $query = $this->db->limit(1);
           $query = $this->db->get('blog');
           
           return $query->row();
      }
      public function detail_id_blog($id) {
           $query = $this->db->where(array("content_id" => $id));
           $query = $this->db->limit(1);
           $query = $this->db->get('blog');
           
           return $query->row();
      }
      public function  new_blog($data)
      {
          $this->db->insert('blog', $data);
      }    
      public function  save_blog($data, $id)
      {
          $this->db->where("content_id", $id);
          $this->db->update('blog', $data);
      }
      public function delete_blog($id)
      {
         $this->db->delete('blog', array('content_id' => $id)); 
          
      }
}
?>
