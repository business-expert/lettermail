<?php

class Ads_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
        
      public function get_ads() {
           $query = $this->db->where("ad_active", "Poteka");
           $query = $this->db->order_by("ad_end", "desc");
	   $query = $this->db->get('ads');
           return $query->result();
      }  
      public function list_ads() {
           $query = $this->db->select("a.*, k.*"); 
           $query = $this->db->from("ads as a");
           $query = $this->db->join("komercialisti as k","a.ad_komer = k.k_id","left");
           $query = $this->db->order_by("ad_active", "asc");
	   $query = $this->db->get();
           return $query->result();
      }       
      public function detail($id) {
           $query = $this->db->where(array("ad_id" => $id));
           $query = $this->db->limit(1);
           $query = $this->db->get('ads');
           
           return $query->row();
      }
      public function  new_ad($data)
      {
          $this->db->insert('ads', $data);
      }    
      public function  save_ad($data, $id)
      {
          $this->db->where("ad_id", $id);
          $this->db->update('ads', $data);
      }
      public function delete($id)
      {
         $this->db->delete('ads', array('ad_id' => $id)); 
          
      }
      
      public function ads_expired() {
            $today = date("Y-m-d H:i");
            $where = "STR_TO_DATE(ad_end, '%d.%m.%Y %H:%i') <= '$today' AND ad_done = '0'";
            $query = $this->db->where($where);
            $query = $this->db->update('ads', array("ad_done" => "1", "ad_active" => "Konec"));

            return $this->db->affected_rows();
      } 
      
      public function ads_start() {
            $today = date("Y-m-d H:i");
            $where = "STR_TO_DATE(ad_start, '%d.%m.%Y %H:%i') <= '$today' AND ad_active = 'Obdelaj' AND ad_done = '0'";
            $query = $this->db->where($where);
            $query = $this->db->update('ads', array("ad_done" => "0", "ad_active" => "Poteka"));

            return $this->db->affected_rows();
      }  
}
?>
