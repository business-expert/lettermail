<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ponudbe extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $user = $this->is_logged();
            $this->load->model('log_model');
            if($user->logged_in == "1")
            {
                $date = date("h:i:s d.m.Y");
                $data['user_lastlogin'] = $date;
                $this->user_model->save_user($data, $user->user_id);
            }

       } 
       
	public function index()
	{
        
		$data['title']          = "e-oglasnik - Ponudbe!";
                $data['view']           = "/modules/ponudbe.php";
                $data['user_status']    = $this->is_logged();
                $this->load->view("template.php", $data);
                
	}
        
        /// Let's show current offers
        public function currentOffers()
        {
		$data['title']          = "e-oglasnik - Trenutna ponudba";
                $data['view']           = "/modules/trenutna-ponudba.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $data['ponudbe_t']        = $this->offers_model->list_offers_current();
                $this->load->view("template.php", $data);
        }  
        
        /// Let's show coming offers
        public function comingOffers()
        {
		$data['title']          = "e-oglasnik - Prihajajoče ponudbe";
                $data['view']           = "/modules/prihajajoce-ponudbe.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $data['ponudbe_t']        = $this->offers_model->list_offers_coming();
                $this->load->view("template.php", $data);
        }
        
        /// Let's show ending offers
        public function endingOffers()
        {
		$data['title']          = "e-oglasnik - Ponudbe v izteku";
                $data['view']           = "/modules/vizteku-ponudbe.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $data['ponudbe_t']        = $this->offers_model->list_offers_ending();
                $this->load->view("template.php", $data);
        }
        
        /// Let's show current new offers
        public function newOffers()
        {
		$data['title']          = "e-oglasnik - Danes novo";
                $data['view']           = "/modules/danes-novo.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $regije = explode(";", $_COOKIE['regija']);
                $data['ponudbe_t']        = $this->offers_model->list_offers_current_today($regije);
                $this->load->view("template.php", $data);
        }  
        
        /// Let's show done offers
        public function doneOffers()
        {
		$data['title']          = "e-oglasnik - Pretekle ponudbe";
                $data['view']           = "/modules/pretekle-ponudbe.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $data['ponudbe_t']        = $this->offers_model->done_offers();
                $this->load->view("template.php", $data);
        }  
        
        public function ajaxComment()
        {
              $data['comment_user']  = $this->input->post('user');
              $data['comment_offer'] = $this->input->post('offer');
              $data['comment_body']  = $this->input->post('comment');
            
              $upor     = $this->user_model->detail_id($data['comment_user']);
              $ponudba  = $this->offers_model->detail($data['comment_offer']);
              
              $res = $this->offers_model->new_comment($data);
              if($res > 0):
                $datas['log_affected'] = "1";
                $datas['log_type']     = "Uporabnik ".$upor->user_name." ".$upor->user_surname." je komentiral ponudbo ".$ponudba->offer_head." ";
                $this->log_model->add_log($datas);         
                
                echo "Succes";
              else:
                  echo "Error";
              endif;
        }
        
        
        public function ajaxPonudbe()
        {

            $term = $_GET['term'];
            $return_arr = array();
            $row_array = array();
            $query = $this->offers_model->ajax_ponudbe($term);
            foreach ($query as $row) {

            $row_array['id']         = $row->offer_id;             
            $row_array['head']       = $row->offer_head;  
            $row_array['subhead']    = $row->offer_subhead;  
            $row_array['linker']     = site_url("ponudba/".$row->offer_slug);  
            array_push($return_arr,$row_array);
            }
	    echo json_encode($return_arr);
        }
        
        /// Let's show single offer
        public function det($slug = null)
        {
                $data['ponudba']        = $this->offers_model->detail_slug($slug);
                if(empty($data['ponudba'])) :
                      redirect(base_url());       
                endif;
                
		$data['title']          = "e-oglasnik - ".$data['ponudba']->offer_head." - ".$data['ponudba']->offer_subhead;
                $data['view']           = "/modules/ponudba.php";
                $data['user_status']    = $this->is_logged();
                $data['komentarji']     = $this->offers_model->list_comments_active_offer($data['ponudba']->offer_id);
                $data['komentarji_st']  = $this->offers_model->list_comments_count($data['ponudba']->offer_id);
                $data['lokacije']       = $this->offers_model->list_locations($data['ponudba']->offer_id);
                $this->load->view("template.php", $data);
        }    
        
        /// Let's show single offer based on an ID
        public function detID($slug = null)
        {
                $data['ponudba']        = $this->offers_model->detail($slug);
                if(empty($data['ponudba'])) :
                      redirect(base_url());       
                endif;
                
		$data['title']          = "e-oglasnik - ".$data['ponudba']->offer_head." - ".$data['ponudba']->offer_subhead;
                $data['view']           = "/modules/ponudba.php";
                $data['user_status']    = $this->is_logged();
                $data['komentarji']     = $this->offers_model->list_comments_active_offer($data['ponudba']->offer_id);
                $data['komentarji_st']  = $this->offers_model->list_comments_count($data['ponudba']->offer_id);
                $data['lokacije']       = $this->offers_model->list_locations($data['ponudba']->offer_id);
                $this->load->view("template.php", $data);
        }
        
        public function regions($region =  null)
        {
            /// Region is empty, so show list of regions to user.
            if($region == null)
            {
                
		$data['title']          = "e-oglasnik - Ponudbe po regijah";
                $data['view']           = "/modules/regije.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $data['regije']         = $this->offers_model->list_regions();
                $this->load->view("template.php", $data);
                
                
           /// User requested specific region. Show offers from that region!     
            } else {
                $data['regija']        = $this->offers_model->region_slug($region);
                
                if(empty($data['regija'])) :
                      redirect(base_url());       
                endif;
                
                $region_id              = $data['regija']->region_id;
                $data['ponudbe']        = $this->offers_model->list_offers_region($region_id);
		$data['title']          = "e-oglasnik - ".$data['regija']->region_title;
                $data['view']           = "/modules/regija.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $this->load->view("template.php", $data);
            }
        }
        
        public function pokaziRegijo()
        {
                $region = $_POST['regija'];
            
                $data['regija']         = $this->offers_model->region_slug($region);
                $region_id              = $data['regija']->region_id;
                $data['ponudbe']        = $this->offers_model->list_offers_region($region_id);
                return $this->load->view("/modules/regija_ajax.php", $data);
                
        }
        
        public function obvesti($id = null)
        {
                
		$data['title']          = "e-oglasnik - Obvesti me";
                $data['view']           = "/modules/obvesti-ponudba.php";
                $data['user_status']    = $this->is_logged();
                $data['sidebar']        = 1;
                $data['id']             = $id;
                $data['ponudba']        = $this->offers_model->detail($id);
                $this->load->view("template.php", $data);
                
        }
        
        public function addObvesti($id)
        {
             $this->load->library('encrypt');
              $this->load->library('email');
              $this->load->helper('string');
              $config['mailtype'] = 'html';
              $config['newline']  = '\n';
              $this->email->initialize($config); 
              $data['user_status']    = $this->is_logged();
              $ponudba = $this->offers_model->detail($id);
                    $this->email->from('info@e-oglasnik.com', 'e-oglasnik');
                    $this->email->to($this->input->post("email"));

                    $this->email->subject('Uspešno naročanje na obveščanje!!');
                    $this->email->message('
                            Pozdravljeni '.$data['user_status']->user_name.' '.$data['user_status']->user_surname.'!
                             <br />   <br />
                            Prejeli smo vaše naročilo, da vas obvestimo o začetku ponudbe "<a href="'.base_url()."ponudba/".$ponudba->offer_slug.'">'.$ponudba->offer_head.'</a>". Ko bo ponudba začela teči, vas bomo o tem takoj obvestili.
                             <br /><br />
                            Lep pozdrav, <br />
                            Ekipa e-oglasnik!
                        ');

                    $this->email->send();
              $this->session->set_flashdata('type', 'success');
              $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Uspešno ste se naročili na obveščanje!');
              redirect("ponudbe/obvesti/".$id."");
        }
}
