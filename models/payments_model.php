<?php

class Payments_model extends CI_Model {
    
      function __construct()
        {
            parent::__construct();
        }  
       public function add_payment($data)
       {
           $query = $this->db->insert('payments', $data);
           return $this->db->insert_id();
       } 
       public function add_payment_detail($data)
       {
           $query = $this->db->insert('payments_products', $data);
           return $this->db->insert_id();

       }
       
       public function creditCardStatus($txId)
       {
           $query = $this->db->where("pay_reference", $txId);
           $query = $this->db->get('payments');
           $query = $query->row();
           return $query->cardtype;
       }
       
       public function updateCreditCard($txId, $data)
       {
            $this->db->where('pay_reference', $txId);
            $this->db->update('payments', $data);
       }
       
       public  function offer_payments($id)
       {        
         $query = $this->db->select("pd.*, p.*, u.*"); 
         $query = $this->db->where("offer_id", $id);
	 $query = $this->db->from("payments_products as pd");
	 $query = $this->db->join("payments as p","pd.payment_id = p.pay_id","left");
	 $query = $this->db->join("users as u","u.user_id = p.pay_user","left");
         $query = $this->db->get();

         return $query->result();
      
       }     
       
       public  function offer_paymentsAll()
       {        
         $query = $this->db->select("pd.*, p.*, u.*"); 
	 $query = $this->db->from("payments_products as pd");
	 $query = $this->db->join("payments as p","pd.payment_id = p.pay_id","left");
	 $query = $this->db->join("users as u","u.user_id = p.pay_user","left");
         $query = $this->db->get();

         return $query->result();
      
       }    
       
       public  function offer_payments_txID($id)
       {        
         $query = $this->db->select("pd.*, p.*, u.*"); 
         $query = $this->db->where("p.pay_reference", $id);
	 $query = $this->db->from("payments_products as pd");
	 $query = $this->db->join("payments as p","pd.payment_id = p.pay_id","left");
	 $query = $this->db->join("users as u","u.user_id = p.pay_user","left");
         $query = $this->db->get();

         return $query->result();
      
       } 
       

       
       
       public  function user_payments($id)
       {         
         $query = $this->db->where("pay_user", $id);
         $query = $this->db->get("payments");

         return $query->result();
       }  
       public  function user_payments_details($id)
       {         
         $query = $this->db->where("payment_id", $id);
         $query = $this->db->get("payments_products");

         return $query->result();
       }
       
       public function countQuanity($id)
       {
        $this->db->select_sum('qty');
        $this->db->where("payment_id", $id);
        $query = $this->db->get('payments_products');
        return $query->result();
       } 
       public function countCoupons($id)
       {
        $this->db->where("c_offer", $id);
        $query = $this->db->get('coupons');
        return $query->num_rows();
       }  
       public function countCouponsOffer($offer)
       {
        $this->db->select_sum('qty');
        $this->db->where("offer_id", $offer);
        $query = $this->db->get('payments_products');
        return $query->result();
       }
       
       public function getOfferCoupons($id)
       {
         $query = $this->db->select("c.*, pd.*, p.*, u.*"); 
         $query = $this->db->where("offer_id", $id);
	 $query = $this->db->from("coupons as c");
	 $query = $this->db->join("payments_products as pd","pd.payment_id = c.c_payment","left");
	 $query = $this->db->join("payments as p","pd.payment_id = p.pay_id","left");
	 $query = $this->db->join("users as u","u.user_id = p.pay_user","left");
         $query = $this->db->get();

         return $query->result();
       }   
       public function getOfferCouponsAll()
       {
         $query = $this->db->select("c.*, pd.*, p.*, u.*"); 
	 $query = $this->db->from("coupons as c");
	 $query = $this->db->join("payments_products as pd","pd.payment_id = c.c_payment","left");
	 $query = $this->db->join("payments as p","pd.payment_id = p.pay_id","left");
	 $query = $this->db->join("users as u","u.user_id = p.pay_user","left");
         $query = $this->db->get();

         return $query->result();
       }
             
       public function couponData($id)
       {
         $query = $this->db->select("c.*, pd.*, p.*, u.*"); 
         $query = $this->db->where("c_id", $id);
	 $query = $this->db->from("coupons as c");
	 $query = $this->db->join("payments_products as pd","pd.payment_id = c.c_payment","left");
	 $query = $this->db->join("payments as p","pd.payment_id = p.pay_id","left");
	 $query = $this->db->join("users as u","u.user_id = p.pay_user","left");
         $query = $this->db->get();

         return $query->row();
       }
       
       public function getOfferCouponsByOffer($pay)
       {
         $query = $this->db->select("p.*"); 
         $where = "p.pay_id = '$pay'";
         $query = $this->db->where($where);
	 $query = $this->db->from("payments as p");
         $query = $this->db->get();

         return $query->row();
       }
       
       public  function offerPayments($id)
       {      
         $query = $this->db->where("p.payment_id", $id);
	 $query = $this->db->from("payments_products as p");
	 $query = $this->db->join("offers as o","p.offer_id = o.offer_id","left");
         $query  = $this->db->get();
         return $query->result();
       }
       
       
       public function deleteCoupons($id)
       {
           $query = $this->db->where("c_payment", $id);
           $query = $this->db->delete("coupons");
       }

       public function listCoupons()
       {
         $query = $this->db->get('coupons');
           return $query->result();
       }
       
       public function addCoupon($data)
       {
           $query = $this->db->insert('coupons', $data);
           return $this->db->insert_id();
       }   
       
       public function confirmPayment($id, $data)
       {
            $this->db->where('pay_id', $id);
            $this->db->update('payments', $data);

       }     
       public function cancelPayment($id, $data)
       {
            $this->db->where('pay_id', $id);
            $this->db->update('payments', $data);

       }
       
}