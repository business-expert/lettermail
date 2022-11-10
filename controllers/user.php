<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('user_model');
            $this->load->model('log_model');
            $data['user_status'] = $this->is_logged();

            if( $data['user_status']->logged_in == 0)
            {
                redirect('login');
            }
            
            if($data['user_status']->logged_in == "1")
            {
                $date = date("h:i:s d.m.Y");
                $updater['user_lastlogin'] = $date;
                $this->user_model->save_user($updater, $data['user_status']->user_id);
            }

       } 
        function _prep_password($password)
        {
             return sha1($password.$this->config->item('encryption_key'));
        }
        
	public function index()
	{

                 redirect(base_url());
           
	}
        public function detail($id) 
        {            
		$data['title']          = "e-oglasnik - Urejanje uporabniškega računa";
                $data['view']           = "/modules/edit_user.php";
                $data['sidebar']        = 1;
                $data['user_status']    = $this->is_logged();
                $data['user']           = $this->user_model->detail_id($id);
                if( $data['user_status']->user_id != $id)
                {
                    redirect(base_url());
                }
                $this->load->view("template.php", $data);
        }
        public function save()
        {
          $id                       = $this->input->post('id');
          $insert['user_name']      = $this->input->post('ime');
          $insert['user_surname']   = $this->input->post('priimek');
          $insert['user_email']     = $this->input->post('email');
          $insert['user_notify']    = $this->input->post('notify');
          
          if($this->input->post('geslo') != null)
          { 
          $insert['user_password']   = $this->_prep_password($this->input->post('geslo'));
          }
          
          $insert['user_address']   = $this->input->post('naslov');
          $insert['user_zip']       = $this->input->post('posta');
          $insert['user_city']      = $this->input->post('kraj');
          $insert['user_phone']     = $this->input->post('telefon');      
          
          $insert['user_regions']   = serialize($this->input->post('user_regions'));
          $insert['user_type']      = serialize($this->input->post('user_type'));
          
          $this->form_validation->set_rules('ime',  'Ime',  'required');
          $this->form_validation->set_rules('priimek',  'Priimek',  'required');
          $this->form_validation->set_rules('email',  'Email',  'required');
  
          $this->form_validation->set_message('required', 'To polje je obvezno!');
          
          if ($this->form_validation->run() == FALSE) {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe.');
           redirect('register');
           }
          else 
          {      
          if(!$res = $this->user_model->save_user($insert, $id))
          {
              $regije = unserialize($insert['user_regions']);
              $st     = count($regije);
              $cc     = 1;
              $regija = null;
              foreach($regije as $key=>$value):
                  if($cc == $st):
                  $regija .= $value.""; 
                  else:
                  $regija .= $value.";"; 
                  endif;                  
                  $cc++;
              endforeach;
              
                 $cookie = array(
                    'name'   => 'regija',
                    'value'  => $regija,
                    'expire' => '3456000'
                );

                $this->input->set_cookie($cookie); 
                
                $data['log_affected'] = "1";
                $data['log_type']     = "Uporabnik ".$insert['user_name']." ".$insert['user_surname']." je posodobil svoje podatke";
                $this->log_model->add_log($data);
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', 'Račun je bil posodobljen!');
          redirect('user/detail/'.$id);
          } else {
         redirect('user/detail/'.$id);
          }
        }

        }
        
        public function payments($id) 
        {
            
                $data['nakupi']    = $this->payments_model->user_payments($id);
            
		$data['title']          = "e-oglasnik - Pregled nakupov";
                $data['view']           = "/modules/payments_user.php";
                $data['sidebar']        = 1;
                $data['user_status']    = $this->is_logged();
                $data['user']           = $this->user_model->detail_id($id);
                if( $data['user_status']->user_id != $id)
                {
                    redirect(base_url());
                }
                $this->load->view("template.php", $data);
        }
}
