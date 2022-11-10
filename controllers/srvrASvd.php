<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class srvrASvd extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('log_model');
            $this->load->model('ads_model');

       } 
       
	public function index()
	{
        
            redirect(base_url());
                
	}
        
        
        /// Ponudbe ki so potekle
        public function expiredOffers()
        {
            
            $data['log_affected'] = $this->offers_model->offers_expired();
            $data['log_type']     = "Preveri pretekle ponudbe in jih končaj";
            
            $this->log_model->add_log($data);
            
            echo "Interaction - ".$data['log_affected'];
            
        }
        
        /// Oglasi ki so pretekli
        public function expiredAds()
        {
            
            $data['log_affected'] = $this->ads_model->ads_expired();
            $data['log_type']     = "Preveri pretekle oglase in jih končaj";
            
            $this->log_model->add_log($data);
            
            echo "Interaction - ".$data['log_affected'];
        }   
        
        /// Oglasi ki se morajo prikazat
        public function startAds()
        {
            
            $data['log_affected'] = $this->ads_model->ads_start();
            $data['log_type']     = "Preveri kateri oglasi se morajo začeti";
            
            $this->log_model->add_log($data);
            
            echo "Interaction - ".$data['log_affected'];
        }

}