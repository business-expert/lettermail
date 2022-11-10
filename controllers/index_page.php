<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index_page extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('offers_model');
            $user = $this->is_logged();
            if($user->logged_in == "1")
            {
                $date = date("h:i:s d.m.Y");
                $data['user_lastlogin'] = $date;
                $this->user_model->save_user($data, $user->user_id);
            }

       } 
       
	public function index()
	{
		$data['title']          = "e-oglasnik - Vaša najboljša ponudba!";
                $data['user_status']    = $this->is_logged();
                $data['view']           = "/modules/first_page.php";
                $data['headeroffer']    = 1;
                $data['sidebar']        = 1;
                $data['ponudbe_t']        = $this->offers_model->list_offers_current();
                $data['ponudbe_e']        = $this->offers_model->list_offers_ending();
                $data['ponudbe_c']        = $this->offers_model->list_offers_coming();
                

                
                if(isset($_COOKIE['st_prikazov_reg']))
                {
                $st_prikazov_reg = $_COOKIE['st_prikazov_reg'];
                $st_prikazov_reg = $st_prikazov_reg + 1;
                } 
                if(!isset($st_prikazov_reg))
                {
                    $st_prikazov_reg = 0;
                }
                $pis_register = array(
                    'name'   => 'st_prikazov_reg',
                    'value'  => $st_prikazov_reg,
                    'expire' => '2592000'
                );
                $this->input->set_cookie($pis_register); 
                

                if(!isset($_COOKIE['oglasnikuser']))
                {
                    $pis_login = array(
                        'name'   => 'oglasnikuser',
                        'value'  => "unknown",
                        'expire' => '2592000'
                    );
                    $this->input->set_cookie($pis_login); 
                }

                $this->load->view("template.php", $data);
                
	}

        public function nastaviRegijo()
        {
                 $cookie = array(
                    'name'   => 'regija',
                    'value'  => $this->input->post("region_input"),
                    'expire' => '3456000'
                );

                $this->input->set_cookie($cookie); 
                redirect(base_url());
        }
}
