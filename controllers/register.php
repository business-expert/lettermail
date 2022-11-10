<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class register extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('register_model');
            $this->load->model('log_model');
            $data['user_status'] = $this->is_logged();

            if( $data['user_status']->logged_in == 1)
            {
                redirect(base_url());
            }
       } 
        function _prep_password($password)
        {
             return sha1($password.$this->config->item('encryption_key'));
        }
       public function email_exists()
       {	
           $email_content = trim($this->input->post('email'));
           $param=array("user_email"=>$email_content);
           $email = $this->register_model->email_exists($param);
           if($email->num_rows() > 0){
               echo "false";
           }
            else{
               echo "true";
                 }
       }
       
	public function index()
	{
		$data['title']          = "e-oglasnik - Registracija!";
                $data['view']           = "/modules/register.php";
                $data['sidebar']        = 1;
                $data['user_status'] = $this->is_logged();
                $this->load->view("template.php", $data);
                
	}

        public function save()
        {
          $insert['user_name']     = $this->input->post('ime');
          $insert['user_surname'] = $this->input->post('priimek');
          $insert['user_email']   = $this->input->post('email');
          $insert['user_password']   = $this->_prep_password($this->input->post('geslo'));
          $insert['user_address']  = $this->input->post('naslov');
          $insert['user_zip']   = $this->input->post('posta');
          $insert['user_city']    = $this->input->post('kraj');
          $insert['user_phone'] = $this->input->post('telefon');
          $insert['user_code'] = sha1($this->config->item('encryption_key'));

          $this->form_validation->set_rules('ime',  'Ime',  'required');
          $this->form_validation->set_rules('priimek',  'Priimek',  'required');
          $this->form_validation->set_rules('email',  'Email',  'required');
          $this->form_validation->set_rules('geslo',  'Geslo',  'required');
  
          $this->form_validation->set_message('required', 'To polje je obvezno!');
          
          if ($this->form_validation->run() == FALSE) {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe.');
           redirect('register');
           }
          else 
          {      
          if(!$res = $this->register_model->new_user($insert))
          {
              
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', 'Uspešno ste se registrirali kot uporabnik. Na poštni naslov  '.$insert['user_email'].' smo vam poslali sporočilo. Po potrditvi naslova se boste lahko prijavili v e-oglasnik. ');
          
            $this->load->library('email');
            $config['mailtype'] = 'html';
            $config['newline']  = '\n';

            $this->email->initialize($config); 
            $this->email->from('info@e-oglasnik.com', 'e-oglasnik');
            $this->email->to($this->input->post('email'));

            $this->email->subject('Uspešna registracija na e-oglasniku!');
            $this->email->message('
                Dobrodošli na spletnem portalu e-oglasnik, kjer za vas izbiramo najboljše ponudbe.
                 <br />
                 Prosimo vas, da s klikom na povezavo potrdite svoj e-poštni naslov.
                 <br /> 
                 '.base_url().'register/activate/'.$insert['user_code'].'
                 <br /> 
                 V primeru, da aktivacijska koda ne omogoča neposredne povezave jo kopirajte in
                prilepite v naslovno vrstico vašega brskalnika.<br />
                Koda je veljavna 6 ur.
                 <br />
                 <br />
                Lep pozdrav,
                <br />
                e-oglasnik!
                ');

            $this->email->send();
            
                $datas['log_affected'] = "1";
                $datas['log_type']     = "".$insert['user_name']." ".$insert['user_surname']." se je registriral";
                $this->log_model->add_log($datas);
                
          redirect('register');
          } else {
          $data['view'] = "register";
          $this->load->view('first_view', $data);
          }
        }

        }

      public function activate($code)
      {
           $res = $this->register_model->activate($code);
          
           if($res)
           {
           $this->session->set_flashdata( 'type', 'success');
           $this->session->set_flashdata( 'message', 'Vaš račun je bil potrjen!');
           redirect('login');      
            } else {
            $this->session->set_flashdata( 'type', 'error');
           $this->session->set_flashdata( 'message', 'Koda ne obstaja!');
           redirect('login');
            }
      }
}
