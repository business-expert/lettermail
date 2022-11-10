<?php

class Komer_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
        
      public function komerOffers($komer)
      {
         
         $query = $this->db->select("o.*, c.*, p.*, t.*, r.*"); 
         $where = "o.offer_commer = '$komer' ";
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("offer_category as c","c.ocategory_id = o.offer_category","left");
	 $query = $this->db->join("ponudniki as p","p.ponudnik_id = o.offer_ponudnik","left");
	 $query = $this->db->join("offer_type as t","t.otype_id = o.offer_type","left");
	 $query = $this->db->join("regions as r","r.region_id = o.offer_region","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
         return $query->result();
      }
      public function komerPayments($komer, $od, $do)
      {
         $od = strtotime($od);
         $od = date("Y-m-d H:i", $od);    
         $do = strtotime($do);
         $do = date("Y-m-d H:i", $do);
         $query = $this->db->select("o.*, pp.*, p.*"); 
         $where = "o.offer_commer = '$komer' AND pp.date > '$od' AND pp.date < '$do'";
         $query = $this->db->where($where);
	 $query = $this->db->from("offers as o");
	 $query = $this->db->join("payments_products as pp","pp.offer_id = o.offer_id","left");
	 $query = $this->db->join("payments as p","p.pay_id = pp.payment_id","left");
         $query = $this->db->order_by("o.offer_startstamp", "desc"); 
         $query = $this->db->get();
     
         return $query->result();
      }
      public function report($od, $do, $komer)
      {
          
      }
}
?>
