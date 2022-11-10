<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {

   public function __construct()
   {
      session_start();
      parent::__construct();
      $this->load->model('login_model');
      $this->load->model('offers_model');
      $this->load->model('log_model');


   }
   
    function _prep_password($password)
    {
         return sha1($password.$this->config->item('encryption_key'));
    }
    

    public function index()
   {
       $data['user_status'] = $this->is_logged();
        if( $data['user_status']->logged_in == 1)
        {
            redirect(base_url());
        }
	$data['title']          = "e-oglasnik - Prijava uporabnika";
        $data['user_status'] = $this->is_logged();
        $data['view']           = "/modules/login.php";
        $data['sidebar']        = 1;

       $this->load->view("template.php", $data);

   }
    public function letmein()
   {
       $data['user_status'] = $this->is_logged();
       $redirect = $_GET['redir'];
       if(empty($redirect)) {
           $redirect = base_url();
       }
        if( $data['user_status']->logged_in == 1)
        {
            redirect(base_url());
        }
          $email    = $this->input->post('email');
          $password = $this->input->post('geslo');
          $param = array('user_email' => $email, 'user_password' => $this->_prep_password($password), 'user_active' => "1");
          $query_login = $this->login_model->login($param);
          
          if(empty($email) || empty($password))
          {
              $this->session->set_flashdata( 'message', 'Email ali geslo je prazno!');
              $this->session->set_flashdata( 'type', 'error');
              redirect('login');
          } else {
          
          if($query_login->num_rows() > 0){
                $pis_login = array(
                    'name'   => 'oglasnikuser',
                    'value'  => "yes",
                    'expire' => '10368000'
                );
                $this->input->set_cookie($pis_login); 
              $login_data = array(
                           'user_email' => $email,
                           'logged_in' => true
              );
              $this->session->set_userdata($login_data);   
                $userdata = $this->user_model->detail($email);
                
                $datas['log_affected'] = "1";
                $datas['log_type']     = "Prijava uporabnika ".$userdata->user_name." ".$userdata->user_surname;
                $this->log_model->add_log($datas);
                
              redirect($redirect);
                
          } 
          else {
              
              $this->session->set_flashdata( 'message', 'Napačni podatki za prijavo!');
              $this->session->set_flashdata( 'type', 'error');       
              redirect('login');
          }
          }
          ///$this->load->view('first_view', $data);

   }

   public function logout()
   {
        $this->session->sess_destroy();
        redirect('login');
   }
   public function forgotten_password()
   {
	$data['title']          = "e-oglasnik - Pozabljeno geslo";
        $data['user_status'] = $this->is_logged();
        $data['view']           = "/modules/login_forgotten.php";
        $data['sidebar']        = 1;

       $this->load->view("template.php", $data);

   }  
   public function forgotten_password_send()
   {
         
       $data['user_status'] = $this->is_logged();
       $this->load->model('login_model');
       $email = $this->input->post('email');
       $check = $this->login_model->check_email($email);
       if($check->num_rows() > 0)
       {
              $this->load->library('email');
              $config['mailtype'] = "html";
              $this->email->initialize($config);
          
              $this->email->from('no-reply@e-oglasnik.com', 'e-oglasnik');
              $this->email->to(''.$email.''); 
          
          $this->load->model('user_model');
          $user_details = $this->user_model->detail($email);
          $code = sha1($this->config->item('encryption_key'));
          $param = array("ID_USER" => $user_details->user_id, "Code" => $code, "Active" => "0");
          $email_send = $this->login_model->add_forgotten($param);
          
            /// Send activation code to user!
            $this->email->subject('e-oglasnik - Pozabljeno geslo');
            $this->email->message('
                Pozdravljeni '.$user_details->user_name. ' '.$user_details->user_surname.', <br />
                  Za pridobitev novega gesla morate potrditi aktivacijsko kodo tukaj:  <br />
                  '.base_url().'login/activate/'.$code.'
                 <br /> 
                 V primeru, da aktivacijska koda ne omogoča neposredne povezave jo kopirajte in
                prilepite v naslovno vrstico vašega brskalnika.<br />
                Koda je veljavna 6 ur.
                 <br />
                 <br />
                  Lep pozdrav, <br />
                  e-oglasnik
                ');
            $this->email->send();
                
                $datas['log_affected'] = "1";
                $datas['log_type']     = "Uporabnik ".$user_details->user_name." ".$user_details->user_surname." je zaprosil za novo geslo";
                $this->log_model->add_log($datas);
                
            $this->session->set_flashdata( 'type', 'success');
            $this->session->set_flashdata( 'message', 'Na e-poštni naslov '.$email.' smo vam poslali sporočilo, s katerim boste aktivirali novo geslo!');
            redirect('login/forgotten_password');         
       } else {
            $this->session->set_flashdata( 'type', 'error');
            $this->session->set_flashdata( 'message', 'Ta e-mail naslov ne obstaja!');
          redirect('login/forgotten_password');
       }

   }
   public function activate($code)
   {
       if($code == null){
           redirect(base_url());
       } else {
          $this->load->helper('string');
          $this->load->model('user_model');
          $this->load->model('login_model');
          $codeInfo = $this->login_model->codeInfo($code);
          if(!empty($codeInfo))
             {
              
              $this->load->library('email');
              $config['mailtype'] = "html";
              $this->email->initialize($config);
              
           $userId = $codeInfo->id_user;
           $user_details = $this->user_model->detail_id($userId);
           $this->login_model->codeStatus($code);
           $new_password = random_string('alpha', 6);
           $new_password_encrypt = $this->_prep_password($new_password);
           $param = array("user_id" => $userId);
           $this->login_model->set_pass($param, $new_password_encrypt);
           
            /// Send new password to user!
              $this->email->from('no-reply@e-oglasnik.com', 'e-oglasnik');
              $this->email->to(''.$user_details->user_email.''); 
            $this->email->subject('e-oglasnik - Novo geslo');
            $this->email->message('
                Pozdravljeni '.$user_details->user_name. ' '.$user_details->user_surname.'!
                    <br />
                  Vaše novo geslo je:<br />
                  '.$new_password.'
                  <br /> <br />
                  Prijavite se lahko <a href="'.base_url().'login">tukaj</a>. <br />
                  Po prijavi v spletni portal lahko geslo zamenjate v Nastavitvah računa -> Moji podatki.
                   <br /> <br />
                  Lep pozdrav,
                  e-oglasnik
                ');
            $this->email->send();
                $datas['log_affected'] = "1";
                $datas['log_type']     = "Uporabnik ".$user_details->user_name." ".$user_details->user_surname." je aktiviral kodo za geslo";
                $this->log_model->add_log($datas);
           $this->session->set_flashdata( 'type', 'success');
           $this->session->set_flashdata( 'message', 'Novo geslo je bilo poslano na vaš e-poštni naslov!');
           redirect('login/forgotten_password');      
            } else {
            $this->session->set_flashdata( 'type', 'error');
           $this->session->set_flashdata( 'message', 'Koda ne obstaja!');
           redirect('login/forgotten_password');
            }
       }
   }
}

?>
