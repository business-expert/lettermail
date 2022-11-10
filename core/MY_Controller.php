<?php
class MY_Controller extends CI_Controller
{
         function __construct()
         {
         parent::__construct();
          $this->load->model('user_model');
        }
        
        
        function is_logged()
        {
            if( $this->session->userdata('logged_in') == 1)
            {
                
                $data = $this->user_model->detail($this->session->userdata('user_email'));
                $data->logged_in = "1";
                return $data;
            } else {
                $data->logged_in = "0";
                $data->Group = "none";
                return $data;
            }
        }
}
?>