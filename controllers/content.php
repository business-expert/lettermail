<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class content extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('content_model');
            $data['user_status'] = $this->is_logged();

       } 
        function _prep_password($password)
        {
             return sha1($password.$this->config->item('encryption_key'));
        }
        
	public function index()
	{

                 redirect(base_url());
           
	}
        
        public function detail($slug) 
        {         
                $data['content']           = $this->content_model->detail_slug($slug);
                if(empty($data['content'])) { 
                 redirect(base_url());

                }
		$data['title']          = "e-oglasnik - ".$data['content']->content_title;
                $data['view']           = "/modules/content.php";
                $data['sidebar']        = 1;
                $data['user_status']    = $this->is_logged();
                $this->load->view("template.php", $data);
        }
        
        
}
