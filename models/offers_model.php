<?php

class Offers_model extends CI_Model {
    
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
        
      public function list_offers_featured() {
         $today = date("Y-m-d H:i");
         
         $query = $this->db->select("o.*, c.*, p.*, t.*, r.*"); 
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') >= '$today' AND o.offer_active = '1' AND o.offer_featured = '1' AND o.offer_done = '0' ";
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
	 $query = $this->db->join("regions as r","r.region_id = o.offer_region","left");
         $query = $this->db->order_by("o.offer_created", "desc"); 
         $query =  $this->db->limit(5);
         $query = $this->db->get();
     
           return $query->result();
                      
      } 
      public function list_offers_featuredRegion($region) {
         $today = date("Y-m-d H:i");
         
         $query = $this->db->select("o.*, c.*, p.*, t.*, r.*"); 
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') >= '$today' AND o.offer_active = '1' AND o.offer_featured = '1' AND o.offer_done = '0'";
         foreach($region as $key=>$value):
             
         $where .= ' OR o.offer_region = '.$value.' ';
         
         endforeach;           $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
	 $query = $this->db->join("regions as r","r.region_id = o.offer_region","left");
         $query = $this->db->order_by("o.offer_created", "desc"); 
         $query =  $this->db->limit(5);
         $query = $this->db->get();
     
           return $query->result();
                      
      } 
      
       function count_featuredRegion($region)
        {
         $today = date("Y-m-d H:i");
         
         $query = $this->db->select("o.*, c.*, p.*, t.*, r.*"); 
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') >= '$today' AND o.offer_active = '1' AND o.offer_featured = '1' AND o.offer_done = '0'";
         foreach($region as $key=>$value):
             
         $where .= ' OR o.offer_region = '.$value.' ';
         
         endforeach;         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
	 $query = $this->db->join("regions as r","r.region_id = o.offer_region","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
         return $query->num_rows();
           
       }
       
       function count_featured()
        {
         $today = date("Y-m-d H:i");
         
         $query = $this->db->select("o.*, c.*, p.*, t.*, r.*"); 
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') >= '$today' AND o.offer_active = '1' AND o.offer_featured = '1' AND o.offer_done = '0'";
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
	 $query = $this->db->join("regions as r","r.region_id = o.offer_region","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
         return $query->num_rows();
           
       } 
      public function list_offers($ponudnik = null) {
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         
         if($ponudnik != null) :
         $query = $this->db->where("offer_adder", $ponudnik);
         endif;
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      } 
      
      public function offers_expired() {
         $today = date("Y-m-d H:i");
         $where = "STR_TO_DATE(offer_endstamp, '%d.%m.%Y %H:%i') <= '$today' AND offer_done = '0'";
         $query = $this->db->where($where);
         $query = $this->db->update('offers', array("offer_active" => "0", "offer_done" => "1"));
     
           return $this->db->affected_rows();
      } 
      
      public function list_offers_ponudnik($ponudnik) {
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         $query = $this->db->where("offer_ponudnik", $ponudnik);
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      } 
      
      
      
      public function list_offers_current($ponudnik = null) {
          
         $today = date("Y-m-d H:i");
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND o.offer_active = '1' AND o.offer_done = '0' ";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         if($ponudnik != null) :
         $query = $this->db->where("offer_adder", $ponudnik);
         endif;
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
          return $query->result();
      }
      
      public function list_offers_current_today($region) {
          
         $today = date("Y-m-d");
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y') = '$today' AND o.offer_active = '1' AND o.offer_done = '0' ";
 
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
          return $query->result();
      }
      
      
      public function list_offers_ending($ponudnik = null) {
          
         $today = date("Y-m-d H:i");        
         $nextdays = strtotime('+12 hours');
         $nextdays = date('Y-m-d H:i', $nextdays);
                
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') <= '$nextdays' AND STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND o.offer_active = '1' AND o.offer_done = '0'";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         if($ponudnik != null) :
         $query = $this->db->where("offer_adder", $ponudnik);
         endif;
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      }
      
      public function list_offers_coming($ponudnik = null) {
          
         $today = date("Y-m-d H:i");

         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') > '$today' AND o.offer_active = '1' AND o.offer_done = '0'";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         if($ponudnik != null) :
         $query = $this->db->where("offer_adder", $ponudnik);
         endif;
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      }
      
       public function list_offers_lastminutes($ponudnik = null) {
          
         $nextdays = strtotime('+1 days');
         $nextdays = date('Y-m-d H:i', $nextdays);
                
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "o.offer_active = '1' AND o.offer_done = '0' AND o.offer_lastminute = '1'";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         if($ponudnik != null) :
         $query = $this->db->where("offer_adder", $ponudnik);
         endif;
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      }
      
       function count_lastminutes()
        {
         $nextdays = strtotime('+1 days');
         $nextdays = date('Y-m-d H:i', $nextdays);
                
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "o.offer_active = '1' AND o.offer_done = '0' AND o.offer_lastminute = '1'";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");

         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
         return $query->num_rows();
           
       }
       public function list_offers_region($rid)
       {
          $today = date("Y-m-d H:i");
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "o.offer_region = '$rid' AND  STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') > '$today' AND o.offer_active = '1' AND o.offer_done = '0' ";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");

         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
         return $query->result();
       }
       
       
       public function done_offers() {
          
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         $where = "o.offer_done = '1' AND o.offer_showdone = '1'";
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      }
      
       public function done_offers_hidden() {
          
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         $where = "o.offer_done = '1' AND o.offer_showdone = '0'";
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
           return $query->result();
      }
       
        public function ajax_ponudbe($kewy)
        {
                $this->db->select();
                $this->db->like('offer_head', $kewy);
                $query = $this->db->get('offers');
                return $query->result();
        }
       
      public function list_categories() {
           $query = $this->db->get('offer_category');
           return $query->result();
      }   
      public function list_types() {
           $query = $this->db->get('offer_type');
           return $query->result();
      }  
      public function list_ponudniki() {
           $query = $this->db->order_by("ponudnik_title", "asc"); 
           $query = $this->db->get('ponudniki');
           return $query->result();
      }  
      
      public function  new_offer($data)
      {
           $query = $this->db->insert('offers', $data);
            return $this->db->insert_id();
      }   
      
      public function list_locations($id)
      {
           $query = $this->db->where("location_offer",$id); 
           $query = $this->db->get('offer_locations');
           return $query->result();
      }
      
      public function  add_location($data)
      {
           $query = $this->db->insert('offer_locations', $data);
            return $this->db->insert_id();
      }   
      public function  edit_location($data, $id)
      {
          $this->db->where("location_id", $id);
          $this->db->update('offer_locations', $data);
      }  
      public function  delete_location($id)
      {
          $this->db->where("location_id", $id);
          $this->db->delete('offer_locations');
      } 
      public function save_offer($data, $id)
      {
          $this->db->where("offer_id", $id);
          $this->db->update('offers', $data);
      }
      public function detail($id)
       {
         $query = $this->db->select("o.*,  c.*, p.*, k.*"); 
         $query = $this->db->where("o.offer_id", $id);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("komercialisti as k","k.k_id = o.offer_commer","left");
         $query =  $this->db->limit(1);
         $query =  $this->db->get();
         
         return  $query->row();
         
       }   
       public  function detail_slug($slug)
       {
         $query = $this->db->where("o.offer_slug", $slug);
         $query = $this->db->select("o.*, c.*, p.*, t.*, r.*", FALSE); 
         $query = $this->db->where("o.offer_slug", $slug);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
	 $query = $this->db->join("regions as r","r.region_id = o.offer_region","left");
         $query =  $this->db->limit(1);
         $query =  $this->db->get();
         
         return  $query->row();
       }
      public function count_selled($id)
       {
         $query = $this->db->select("o.*,  p.*"); 
         $query = $this->db->where("p.offer_id", $id);
	 $query = $this->db->from("payments_products as p");
	 $query = $this->db->join("offers as o","p.offer_id = o.offer_id","left");
         $query =  $this->db->get();
         
         return  $query->num_rows();
         
       }
       
       public function delete_offer($id)
       {
           $query = $this->db->where("offer_id", $id);
           $query = $this->db->delete("offers");
       }

       
      public function detail_category($id)
       {
         $query = $this->db->where("ocategory_id", $id);
         $query =  $this->db->limit(1);
         $query =  $this->db->get('offer_category');
         
         return  $query->row();
         
       }
      public function  new_category($data)
      {
           $query = $this->db->insert('offer_category', $data);
      } 
      
      public function save_category($data, $id)
      {
          $this->db->where("ocategory_id", $id);
          $this->db->update('offer_category', $data);
      }
      
      public function delete_category($id)
       {
           $query = $this->db->where("ocategory_id", $id);
           $query = $this->db->delete("offer_category");
       }
    
      public function detail_type($id)
       {
         $query = $this->db->where("otype_id", $id);
         $query =  $this->db->limit(1);
         $query =  $this->db->get('offer_type');
         
         return  $query->row();
         
       }
      public function  new_type($data)
      {
           $query = $this->db->insert('offer_type', $data);
      } 
      
      public function save_type($data, $id)
      {
          $this->db->where("otype_id", $id);
          $this->db->update('offer_type', $data);
      }
      
      public function delete_type($id)
       {
           $query = $this->db->where("otype_id", $id);
           $query = $this->db->delete("offer_type");
       }  
       
      public function detail_ponudnik($id)
       {
         $query = $this->db->where("ponudnik_id", $id);
         $query =  $this->db->limit(1);
         $query =  $this->db->get('ponudniki');
         
         return  $query->row();
         
       }
      public function  new_ponudnik($data)
      {
           $query = $this->db->insert('ponudniki', $data);
      } 
      
      public function save_ponudnik($data, $id)
      {
          $this->db->where("ponudnik_id", $id);
          $this->db->update('ponudniki', $data);
      }
      
      public function delete_ponudnik($id)
       {
           $query = $this->db->where("ponudnik_id", $id);
           $query = $this->db->delete("ponudniki");
       }  
       public function list_komers() {
         $query = $this->db->order_by("k_name", "asc"); 
         $query = $this->db->get('komercialisti');
           return $query->result();
      }   
       
      public function detail_komer($id)
       {
         $query = $this->db->where("k_id", $id);
         $query =  $this->db->limit(1);
         $query =  $this->db->get('komercialisti');
         
         return  $query->row();
         
       }
      public function  new_komer($data)
      {
           $query = $this->db->insert('komercialisti', $data);
      } 
      
      public function save_komer($data, $id)
      {
          $this->db->where("k_id", $id);
          $this->db->update('komercialisti', $data);
      }
      
      public function delete_komer($id)
       {
           $query = $this->db->where("k_id", $id);
           $query = $this->db->delete("komercialisti");
       }  
       
       public function list_regions() {
         $query = $this->db->where("region_type", "regija"); 
         $query = $this->db->order_by("region_title", "asc"); 
         $query = $this->db->get('regions');
           return $query->result();
      }   
      
      public function list_countries() {
         $query = $this->db->where("region_type", "drzava"); 
         $query = $this->db->order_by("region_title", "asc"); 
         $query = $this->db->get('regions');
           return $query->result();
      } 
       public  function region_detail($id)
       {
         $query = $this->db->where("region_id", $id);
         $query =  $this->db->limit(1);
         $query =  $this->db->get('regions');
         
         return  $query->row();
       }   
       public  function region_slug($slug)
       {
         $query = $this->db->where("region_slug", $slug);
         $query =  $this->db->limit(1);
         $query =  $this->db->get('regions');
         
         return  $query->row();
       }  
       public  function count_region($rid)
       {
          
         $today = date("Y-m-d H:i");
         $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
         
         $where = "o.offer_region = '$rid' AND  STR_TO_DATE(o.offer_startstamp, '%d.%m.%Y %H:%i') <= '$today' AND STR_TO_DATE(o.offer_endstamp, '%d.%m.%Y %H:%i') > '$today' AND o.offer_active = '1' AND o.offer_done = '0' ";
         
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");

         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();

         return $query->num_rows();
       }
       
       
       public function searchEngine($kewy, $type)
       {
           if($type == "users") :
                $this->db->select();
                $this->db->like('user_name', $kewy);
                $this->db->or_like('user_surname', $kewy);
                $this->db->or_like('user_address', $kewy);
                $this->db->or_like('user_id', $kewy);
                $query = $this->db->get('users');
                return $query->result();
           elseif($type == "ponudbe"):
                $query = $this->db->select("o.*, c.*, p.*, t.*", FALSE); 
                $query = $this->db->like('offer_name', $kewy);
                $query = $this->db->or_like('offer_head', $kewy);
                $query = $this->db->or_like('offer_subhead', $kewy);
                $query = $this->db->or_like('offer_longdesc', $kewy);
                $query = $this->db->from("offers as o");
                $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
                $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
                $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
                $query = $this->db->order_by("o.offer_startstamp", "desc"); 
                $query = $this->db->get();
                        return $query->result();
           elseif($type == "komercialisti"):
                $this->db->select();
                $this->db->like('k_name', $kewy);
                $this->db->or_like('k_surname', $kewy);
                $this->db->or_like('k_mobile', $kewy);
                $this->db->or_like('k_email', $kewy);
                $query = $this->db->get('komercialisti');
                return $query->result();     
                
          elseif($type == "partnerji"):
                $this->db->select();
                $this->db->like('ponudnik_title', $kewy);
                $this->db->or_like('ponudnik_address', $kewy);
                $this->db->or_like('ponudnik_email', $kewy);
                $this->db->or_like('ponudnik_tax', $kewy);
                $query = $this->db->get('ponudniki');
                return $query->result();
          elseif($type == "vsebine"):
                $this->db->select();
                $this->db->like('content_title', $kewy);
                $this->db->or_like('content_text', $kewy);
                $query = $this->db->get('content');
                return $query->result();
           endif;    
           }
       
   
      public function  new_pogodba($data)
      {
           $query = $this->db->insert('contracts', $data);
            return $this->db->insert_id();
      }   
      
      public function list_contracts() {
                $query = $this->db->select("po.*, pa.*, o.*", FALSE); 
                $query = $this->db->from("contracts as po");
                $query = $this->db->join("ponudniki as pa","pa.ponudnik_id = po.c_partner","left");
                $query = $this->db->join("offers as o","o.offer_id = po.c_offer","left");
                $query = $this->db->order_by("po.c_partner", "desc"); 
                $query = $this->db->get();
                        return $query->result();
      } 
      
       public function delete_contract($id)
       {
           $query = $this->db->where("c_id", $id);
           $query = $this->db->delete("contracts");
       }
       
      public function kolofon()
       {
         $query = $this->db->where("id", "1");
         $query =  $this->db->limit(1);
         $query =  $this->db->get("kolofon"); 
         return  $query->row();
         
       }
       
      public function kolofon_update($data)
       {
         $query = $this->db->where("id", "1");
         $query =  $this->db->update("kolofon", $data); 
         
       }
      public function list_comments_all() {
                $query = $this->db->select("c.*, u.*", FALSE); 
                $query = $this->db->from("offer_comments as c");
                $query = $this->db->join("users as u","c.comment_user = u.user_id","left");
                $query = $this->db->get();
                return $query->result();
      } 
      
      public function list_comments_waiting() {
                $query = $this->db->select("c.*, u.*", FALSE); 
                $query = $this->db->from("offer_comments as c");
                $query = $this->db->join("users as u","c.comment_user = u.user_id","left");
                $query = $this->db->where("comment_waiting", "yes");
                $query = $this->db->get();
                return $query->result();
      }    
      
      public function list_comments_denied() {
                $query = $this->db->select("c.*, u.*", FALSE); 
                $query = $this->db->from("offer_comments as c");
                $query = $this->db->join("users as u","c.comment_user = u.user_id","left");
                $query = $this->db->where("comment_waiting", "no");
                $query = $this->db->where("comment_active", "no");
                $query = $this->db->get();
                return $query->result();
      }  
      
      public function list_comments_active() {
                $query = $this->db->select("c.*, u.*", FALSE); 
                $query = $this->db->from("offer_comments as c");
                $query = $this->db->join("users as u","c.comment_user = u.user_id","left");
                $query = $this->db->where("comment_active", "yes");
                $query = $this->db->where("comment_waiting", "no");
                $query = $this->db->get();
                return $query->result();
      }   
      
      public function list_comments_active_offer($id) {
                $query = $this->db->select("c.*, u.*", FALSE); 
                $query = $this->db->from("offer_comments as c");
                $query = $this->db->join("users as u","c.comment_user = u.user_id","left");
                $query = $this->db->where("comment_offer", $id);
                $query = $this->db->where("comment_active", "yes");
                $query = $this->db->get();
                return $query->result();
      } 
      public function list_comments_count($id) {
                $query = $this->db->select("c.*, u.*", FALSE); 
                $query = $this->db->from("offer_comments as c");
                $query = $this->db->join("users as u","c.comment_user = u.user_id","left");
                $query = $this->db->where("comment_offer", $id);
                $query = $this->db->where("comment_active", "yes");
                $query = $this->db->get();
                return $query->num_rows();
      } 
      
      public function  new_comment($data)
      {
           $query = $this->db->insert('offer_comments', $data);
            return $this->db->insert_id();
      } 
      
      public function accept_comment($id)
       {
         $query = $this->db->where("comment_id", $id);
         $query =  $this->db->update("offer_comments", array("comment_active" => "yes", "comment_waiting" => "no")); 
         
       }    
      public function cancel_comment($id)
       {
         $query = $this->db->where("comment_id", $id);
         $query =  $this->db->update("offer_comments", array("comment_active" => "no", "comment_waiting" => "no")); 
         
       }    
       
       public function delete_comment($id)
       {
         $query = $this->db->where("comment_id", $id);
         $query =  $this->db->delete("offer_comments"); 
         
       }
}
?>
