<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller {

   public function __construct()
   {
      session_start();
      parent::__construct();
        $data['user_status'] = $this->is_logged();
        $this->load->model('offers_model');
        $this->load->model('content_model');
        $this->load->model('payments_model');
        $this->load->model('user_model');
        $this->load->model('komer_model');
        $this->load->model('ads_model');
        $this->load->model('log_model');
        if( $data['user_status']->logged_in == 0)
        {
            redirect(base_url());
        } elseif( $data['user_status']->user_group == "member")
        {
            redirect(base_url());
        }
        
        if($data['user_status']->logged_in == 1)
        {
            $date = date("h:i:s d.m.Y");
            $updater['user_lastlogin'] = $date;
            $userid = $data['user_status']->user_id;
            $this->user_model->save_user($updater, $userid);
        }

        
   }
   
    function _prep_password($password)
    {
         return sha1($password.$this->config->item('encryption_key'));
    }

    public function index()
   {
        redirect('admin/ponudbe');

   }
   
   
   public function uporabniki()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator uporabnikov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/uporabniki.php";
        $data['uporabniki']        = $this->user_model->list_users();
        $this->load->view("template_admin.php", $data);
  
   }  
   
   public function uporabnikAdd()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator uporabnikov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/uporabnikiAdd.php";
        $this->load->view("template_admin.php", $data);
  
   }  
   
   public function saveUporabnik()
        {
          $insert['user_name']      = $this->input->post('user_name');
          $insert['user_surname']   = $this->input->post('user_surname');
          $insert['user_email']     = $this->input->post('user_email');
          $insert['user_address']   = $this->input->post('user_address');
          $insert['user_city']      = $this->input->post('user_city');
          $insert['user_zip']       = $this->input->post('user_zip');
          $insert['user_phone']     = $this->input->post('user_phone');
          $insert['user_password']  = $this->_prep_password($this->input->post('user_password'));
          $insert['user_group']     = $this->input->post('user_group');
          if(!$res = $this->user_model->save_new($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Uporabnik je bil posodobljen!');
          redirect('admin/uporabniki');
          } 
        }
        
   public function ponudnik()
   {
       $data['user_status'] = $this->is_logged();
	$data['title']          = "e-oglasnik - Ponudnik";
        $data['user_status'] = $this->is_logged();
        $data['view']           = "/admin/first_view.php";

       $this->load->view("template_admin.php", $data);
  
   }
   public function ponudbe()
   {
        $data['user_status']    = $this->is_logged();
        $user                   = $data['user_status'];
	$data['title']          = "e-oglasnik - Administrator ponudb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/ponudbe.php";
        
        if($user->user_group == "ponudnik")
        {
        $data['ponudbe']        = $this->offers_model->list_offers($user->user_id);
        $data['ponudbe_t']      = $this->offers_model->list_offers_current($user->user_id);
        $data['ponudbe_e']      = $this->offers_model->list_offers_ending($user->user_id);
        $data['ponudbe_c']      = $this->offers_model->list_offers_coming($user->user_id);  
        }elseif($user->user_group == "pentadmin" or $user->user_group == "urednik" or $user->user_group == "admin")
        {
        $data['ponudbe']        = $this->offers_model->list_offers();
        $data['ponudbe_t']      = $this->offers_model->list_offers_current();
        $data['ponudbe_e']      = $this->offers_model->list_offers_ending();
        $data['ponudbe_c']      = $this->offers_model->list_offers_coming();
        }

        
        $this->load->view("template_admin.php", $data);

   }
   
   public function trenutnePonudbe()
   {
        $data['user_status']    = $this->is_logged();
        $user                   = $data['user_status'];
	$data['title']          = "e-oglasnik - Administrator trenutnih ponudb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/trenutne-ponudbe.php";
        

        $data['ponudbe']        = $this->offers_model->list_offers_current();


        
        $this->load->view("template_admin.php", $data);

   }  
   
   public function preteklePonudbe()
   {
        $data['user_status']    = $this->is_logged();
        $user                   = $data['user_status'];
	$data['title']          = "e-oglasnik - Administrator preteklih ponudb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/pretekle-ponudbe.php";
        

        $data['ponudbe']        = $this->offers_model->done_offers();
        $data['ponudbe_rdece']  = $this->offers_model->done_offers_hidden();


        
        $this->load->view("template_admin.php", $data);

   }
   
   public function content()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator vsebine";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/content.php";
        $data['content']        = $this->content_model->list_content();
        $this->load->view("template_admin.php", $data);
  
   }
   
   public function couponPrint($ponudba, $kupon)
   {
    $this->load->library('mpdf');
    $data['coupon']  = $this->payments_model->couponData($kupon);
    $data['ponudba'] = $this->offers_model->detail($ponudba);
    $html = $this->load->view("/coupon/coupon.php", $data, TRUE);
    $noga = $this->load->view("/coupon/noga.php", $data, TRUE);
    $this->mpdf->WriteHTML($html);
    $this->mpdf->SetHTMLFooter($noga);
    $this->mpdf->Output();
   }
   
   public function blankOffer()
   {
	redirect(base_url()."uploads-ponudbe/Narocilnica-prazna.pdf");
   }
   public function newoffer()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator ponudb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_ponudbe.php";
        $data['categories']     = $this->offers_model->list_categories();
        $data['types']          = $this->offers_model->list_types();
        $data['ponudniki']      = $this->offers_model->list_ponudniki();
        $data['regije']         = $this->offers_model->list_regions();
        $data['komers']         = $this->offers_model->list_komers();
        $this->load->view("template_admin.php", $data);

   }
   public function addOffer()
   {
	    $config['upload_path'] = './uploads-ponudbe/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '9000';
            $config['max_width']  = '2500';
            $config['max_height']  = '2508';
            $config['encrypt_name']  = true;
            $this->load->library('upload', $config);
            

            foreach($_FILES as $key => $value)
            {
                if(!empty($value['name']))
                {
                if( ! empty($key['name']))
                {
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload($key))
                    {
                        $errors[] = $this->upload->display_errors();
                    }    
                    else
                    {

                     $data = $this->upload->data();
                     $insert[$key] = $data['file_name'];

                    }
                 }
                }

            }       
          $data['user_status'] = $this->is_logged();

          $insert['offer_name']       = $this->input->post('offer_name');
          $insert['offer_slug']       = $this->offers_model->generateSlug($this->input->post('offer_head'));
          $insert['offer_head']       = $this->input->post('offer_head');
          $insert['offer_subhead']    = $this->input->post('offer_subhead');
          $insert['offer_shortdesc']  = $this->input->post('offer_shortdesc');
          $insert['offer_longdesc']   = $this->input->post('offer_longdesc');
          $insert['offer_notes']      = $this->input->post('offer_notes');
          $insert['offer_type']       = $this->input->post('offer_type');
          $insert['offer_category']   = $this->input->post('offer_category');
          $insert['offer_address']    = $this->input->post('offer_address');
          $insert['offer_zip']        = $this->input->post('offer_zip');
          $insert['offer_city']       = $this->input->post('offer_city');
          $insert['offer_email']      = $this->input->post('offer_email');
          $insert['offer_phone']      = $this->input->post('offer_phone');
          $insert['offer_fax']        = $this->input->post('offer_fax');
          $insert['offer_worktime']   = $this->input->post('offer_worktime');
          $insert['offer_region']     = $this->input->post('offer_region');
          $insert['offer_ponudnik']   = $this->input->post('offer_ponudnik');
          $insert['offer_value']      = $this->input->post('offer_value');
          $insert['offer_discount']   = $this->input->post('offer_discount');
          $insert['offer_save']       = $this->input->post('offer_save');
          $insert['offer_price']      = $this->input->post('offer_price');
          $insert['offer_minimal']    = $this->input->post('offer_minimal');
          $insert['offer_maximal']    = $this->input->post('offer_maximal');
          $insert['offer_maxperson']    = $this->input->post('offer_maxperson');
          $insert['offer_startstamp'] = $this->input->post('offer_startstamp');
          $insert['offer_endstamp']   = $this->input->post('offer_endstamp');
          $insert['offer_validfrom']  = $this->input->post('offer_validfrom');
          $insert['offer_validuntil'] = $this->input->post('offer_validuntil');
          $insert['offer_active']     = $this->input->post('offer_active');
          $insert['offer_featured']   = $this->input->post('offer_featured');
          $insert['offer_lastminute'] = $this->input->post('offer_lastminute');
          $insert['offer_showdone']   = $this->input->post('offer_showdone');
          $insert['offer_adder']      = $data['user_status']->user_id;
          $insert['offer_commer']     = $this->input->post('offer_commer');
          $insert['offer_provision']  = $this->input->post('offer_provision');
          $insert['offer_provision_percent']   = $this->input->post('offer_provision_percent');      
          $insert['offer_provisionoglasnik']  = $this->input->post('offer_provisionoglasnik');
          $insert['offer_provisionoglasnik_percent']   = $this->input->post('offer_provisionoglasnik_percent');
          
          $res = $this->offers_model->new_offer($insert);
          if(isset($_POST['locations'])) :
                foreach($_POST['locations'] as $value) :
                    $loyal['location_offer']         = $res;
                    $loyal['location_address']       = $this->input->post("address".$value);
                    $loyal['location_city']          = $this->input->post("city".$value);
                    $loyal['location_zip']           = $this->input->post("zip".$value);
                    $loyal['location_phone']         = $this->input->post("phone".$value);
                    $loyal['location_worktime']      = $this->input->post("time".$value);
                    $this->offers_model->add_location($loyal);
                endforeach; 
                
             endif;
          
          if($res)
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Ponudba je bila dodana!');
          redirect('admin/ponudbe');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/ponudbe');
          }
          
   }
  
   public function viewOffer($id)
   {
        $data['ponudba'] = $this->offers_model->detail($id);
	$data['title']          = "e-oglasnik - Administrator ponude - ".$data['ponudba']->offer_name;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_ponudbe.php";
        $data['categories']     = $this->offers_model->list_categories();
        $data['types']          = $this->offers_model->list_types();
        $data['ponudniki']      = $this->offers_model->list_ponudniki();
        $data['regije']         = $this->offers_model->list_regions();
        $data['komers']         = $this->offers_model->list_komers();

        $this->load->view("template_admin.php", $data);
   }   
   
   public function previewOffer($id)
   {
        $data['ponudba'] = $this->offers_model->detail($id);
	$data['title']          = "e-oglasnik - Administrator ponude - ".$data['ponudba']->offer_name;
        $data['view']           = "/admin/modules/edit_ponudbe.php";

        $this->load->library('mpdf');
        $html = $this->load->view("/ponudba/ponudba.php", $data, TRUE);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output("Predogled ponudbe - ".$data['ponudba']->offer_name.".pdf", "D");
        
        $this->load->view("template_admin.php", $data);
   }  
   
   public function copyOffer($id)
   {
        $data['ponudba'] = $this->offers_model->detail($id);
	$data['title']          = "e-oglasnik - Kopiraj ponudbo - ".$data['ponudba']->offer_name;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/copy_ponudbe.php";
        $data['categories']     = $this->offers_model->list_categories();
        $data['types']          = $this->offers_model->list_types();
        $data['ponudniki']      = $this->offers_model->list_ponudniki();
        $data['regije']         = $this->offers_model->list_regions();
        $data['komers']         = $this->offers_model->list_komers();

        $this->load->view("template_admin.php", $data);
   }
   public function editOffer()
   {
	    $config['upload_path'] = './uploads-ponudbe/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '9000';
            $config['max_width']  = '2500';
            $config['max_height']  = '2508';
            $config['encrypt_name']  = true;
            $this->load->library('upload', $config);
            

            foreach($_FILES as $key => $value)
            {
                if(!empty($value['name']))
                {
                if( ! empty($key['name']))
                {
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload($key))
                    {
                        $errors[] = $this->upload->display_errors();
                    }    
                    else
                    {

                     $data = $this->upload->data();
                     $insert[$key] = $data['file_name'];

                    }
                 }
                }

            }    
            

          $data['user_status'] = $this->is_logged();
          $id                         = $this->input->post('offer_id');    
          $insert['offer_name']       = $this->input->post('offer_name');
          $insert['offer_slug']       = $this->offers_model->generateSlug($this->input->post('offer_head'));
          $insert['offer_head']       = $this->input->post('offer_head');
          $insert['offer_subhead']    = $this->input->post('offer_subhead');
          $insert['offer_shortdesc']  = $this->input->post('offer_shortdesc');
          $insert['offer_longdesc']   = $this->input->post('offer_longdesc');
          $insert['offer_notes']      = $this->input->post('offer_notes');
          $insert['offer_type']       = $this->input->post('offer_type');
          $insert['offer_category']   = $this->input->post('offer_category');
          $insert['offer_address']    = $this->input->post('offer_address');
          $insert['offer_zip']        = $this->input->post('offer_zip');
          $insert['offer_city']       = $this->input->post('offer_city');
          $insert['offer_email']      = $this->input->post('offer_email');
          $insert['offer_phone']      = $this->input->post('offer_phone');
          $insert['offer_fax']        = $this->input->post('offer_fax');
          $insert['offer_worktime']   = $this->input->post('offer_worktime');
          $insert['offer_region']     = $this->input->post('offer_region');
          $insert['offer_ponudnik']   = $this->input->post('offer_ponudnik');
          $insert['offer_value']      = $this->input->post('offer_value');
          $insert['offer_discount']   = $this->input->post('offer_discount');
          $insert['offer_save']       = $this->input->post('offer_save');
          $insert['offer_price']      = $this->input->post('offer_price');
          $insert['offer_minimal']    = $this->input->post('offer_minimal');
          $insert['offer_maximal']    = $this->input->post('offer_maximal');
          $insert['offer_maxperson']  = $this->input->post('offer_maxperson');
          $insert['offer_startstamp'] = $this->input->post('offer_startstamp');
          $insert['offer_endstamp']   = $this->input->post('offer_endstamp');
          $insert['offer_validfrom']  = $this->input->post('offer_validfrom');
          $insert['offer_validuntil'] = $this->input->post('offer_validuntil');
          $insert['offer_active']     = $this->input->post('offer_active');
          $insert['offer_featured']   = $this->input->post('offer_featured');
          $insert['offer_lastminute'] = $this->input->post('offer_lastminute');
          $insert['offer_showdone']   = $this->input->post('offer_showdone');
          $insert['offer_adder']      = $data['user_status']->user_id;
          $insert['offer_commer']     = $this->input->post('offer_commer');
          $insert['offer_provision']  = $this->input->post('offer_provision');
          $insert['offer_provision_percent']   = $this->input->post('offer_provision_percent');
          $insert['offer_provisionoglasnik']  = $this->input->post('offer_provisionoglasnik');
          $insert['offer_provisionoglasnik_percent']   = $this->input->post('offer_provisionoglasnik_percent');
          if( $this->input->post('imageDelete1') == 1) : $insert['offer_image1'] = ""; endif;
          if( $this->input->post('imageDelete2') == 1) : $insert['offer_image2'] = ""; endif;
          if( $this->input->post('imageDelete3') == 1) : $insert['offer_image3'] = ""; endif;
          if( $this->input->post('imageDelete4') == 1) : $insert['offer_image4'] = ""; endif;
          
          
          if(isset($_POST['locations'])) :
                foreach($_POST['locations'] as $value) :
                    $loyal['location_offer']         = $id;
                    $loyal['location_address']       = $this->input->post("address".$value);
                    $loyal['location_city']          = $this->input->post("city".$value);
                    $loyal['location_zip']           = $this->input->post("zip".$value);
                    $loyal['location_phone']         = $this->input->post("phone".$value);
                    $loyal['location_worktime']      = $this->input->post("time".$value);
                    $this->offers_model->add_location($loyal);
                endforeach; 
                
             endif;
          
          if(isset($_POST['locationsSave'])) :
                foreach($_POST['locationsSave'] as $value) :
                    $loyal['location_offer']         = $id;
                    $loyal['location_address']       = $this->input->post("address".$value);
                    $loyal['location_city']          = $this->input->post("city".$value);
                    $loyal['location_zip']           = $this->input->post("zip".$value);
                    $loyal['location_phone']         = $this->input->post("phone".$value);
                    $loyal['location_worktime']      = $this->input->post("time".$value);
                    $this->offers_model->edit_location($loyal, $value);
                endforeach; 
                
             endif;   
             
             if(isset($_POST['locationsDelete'])) :
                foreach($_POST['locationsDelete'] as $value) :
                    $this->offers_model->delete_location($value);
                endforeach; 
                
             endif;
             
          if(!$res = $this->offers_model->save_offer($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Ponudba je bila posodobljena!');
          redirect('admin/ponudbe');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/ponudbe');
          }
   }
   public function deleteOffer($id)
   {
          if(!$res = $this->offers_model->delete_offer($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Ponudba je bila izbrisana!');
          redirect('admin/ponudbe');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/ponudbe');
          }
   }
   
   public function listnakupi() 
  {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Pregled vseh nakupov";
        $data['user_status']    = $this->is_logged();
        $data['nakupi']         = $this->payments_model->offer_paymentsAll();
        $data['view']           = "/admin/modules/list_nakupi.php";
        $this->load->view("template_admin.php", $data);  
   }  
   
   public function listkuponi() 
  {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Pregled vseh kuponov";
        $data['user_status']    = $this->is_logged();
        $data['kuponi']         = $this->payments_model->getOfferCouponsAll();
        $data['view']           = "/admin/modules/list_kuponi.php";
        $this->load->view("template_admin.php", $data);  
   }
   
   public function kategorije()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator kategorij";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/kategorije.php";
        $data['categories']        = $this->offers_model->list_categories();
        $this->load->view("template_admin.php", $data);

   }
   public function newCategory()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator kategorij";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_kategorija.php";
        
       $this->load->view("template_admin.php", $data);

   }
   public function addCategory()
   {
                       $insert['ocategory_title']   = $this->input->post('ocategory_title');
          $insert['ocategory_slug']    = $this->offers_model->generateSlug($this->input->post('ocategory_slug'));

          
          if(!$res = $this->offers_model->new_category($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Kategorija je bila posodobljena!');
          redirect('admin/kategorije');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/kategorije');
          }
   }
   
   public function viewCategory($id)
   {
        $data['kategorija']        = $this->offers_model->detail_category($id);
	$data['title']          = "e-oglasnik - Administrator ponude - ".$data['kategorija']->ocategory_title;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_kategorija.php";
        $this->load->view("template_admin.php", $data);
   }
   
   public function editCategory()
   {
             
          $id                          = $this->input->post('ocategory_id');    
          $insert['ocategory_title']   = $this->input->post('ocategory_title');
          $insert['ocategory_slug']    = $this->offers_model->generateSlug($this->input->post('ocategory_slug'));

          
          if(!$res = $this->offers_model->save_category($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Kategorija je bila posodobljena!');
          redirect('admin/kategorije');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/kategorije');
          }
   }
   
   public function deleteCategory($id)
   {
          if(!$res = $this->offers_model->delete_category($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Kategorija bila izbrisana!');
          redirect('admin/kategorije');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/kategorije');
          }
   }
   
  public function tipi()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator tipov ponudb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/tipi.php";
        $data['categories']        = $this->offers_model->list_types();
       $this->load->view("template_admin.php", $data);

   }
   public function newType()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator tipov ponudb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_type.php";
        
       $this->load->view("template_admin.php", $data);

   }
   public function addType()
   {
          $insert['otype_title']   = $this->input->post('otype_title');
          $insert['otype_slug']    = $this->offers_model->generateSlug($this->input->post('otype_slug'));

          
          if(!$res = $this->offers_model->new_type($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Tip ponudbe je bil posodobljen!');
          redirect('admin/tipi');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/tipi');
          }
   }
   
   public function viewType($id)
   {
        $data['kategorija']        = $this->offers_model->detail_type($id);
	$data['title']          = "e-oglasnik - Administrator tipa ponudbe - ".$data['kategorija']->otype_title;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_type.php";
        $this->load->view("template_admin.php", $data);
   }
   
   public function editType()
   {
             
          $id                          = $this->input->post('otype_id');    
          $insert['otype_title']   = $this->input->post('otype_title');
          $insert['otype_slug']    = $this->offers_model->generateSlug($this->input->post('otype_slug'));

          
          if(!$res = $this->offers_model->save_type($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Tip ponudbe je bil posodobljen!');
          redirect('admin/tipi');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/tipi');
          }
   }
   
   public function deleteType($id)
   {
          if(!$res = $this->offers_model->delete_type($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Tip ponudbe je bil izbrisan!');
          redirect('admin/tipi');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/tipi');
          }
   }
   
   
  public function ponudniki()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator ponudnikov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/ponudniki.php";
        $data['categories']        = $this->offers_model->list_ponudniki();
       $this->load->view("template_admin.php", $data);

   } 
   public function genPogodba()
   {
        $partner = $this->input->post("partner");
        $ponudba = $this->input->post("ponudba");
        $data['datum']   = $this->input->post("datum");
        $data['part'] = $this->offers_model->detail_ponudnik($partner);
        $data['ponudba'] = $this->offers_model->detail($ponudba);
        
        $insert['c_partner']  = $partner;
        $insert['c_offer']    = $ponudba;
        $insert['c_datum']    = $data['datum'];
        
        $this->offers_model->new_pogodba($insert);
        $this->load->library('mpdf');
        $html = $this->load->view("/pogodba/pogodba.php", $data, TRUE);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output("Pogodba.pdf", "D");
   }
   public function genPogodbaUrl($partner, $ponudba, $datum)
   {
        $data['datum']   = $datum;
        $data['part']    = $this->offers_model->detail_ponudnik($partner);
        $data['ponudba'] = $this->offers_model->detail($ponudba);

        $this->load->library('mpdf');
        $html = $this->load->view("/pogodba/pogodba.php", $data, TRUE);
        $this->mpdf->WriteHTML($html);
        $this->mpdf->Output("Pogodba.pdf", "D");
   }
   public function pogodba()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator pogodbe";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/pogodba.php";
        $data['categories']        = $this->offers_model->list_ponudniki();
        $data['ponudbe']        = $this->offers_model->list_offers();
       $this->load->view("template_admin.php", $data);

   }
   
   public function pogodbe()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator pogodb";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/pogodbe.php";
        $data['pogodbe']        = $this->offers_model->list_contracts();
       $this->load->view("template_admin.php", $data);

   }
   
   public function deletePogodba($id)
   {
          if(!$res = $this->offers_model->delete_contract($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Pogodba je bila izbrisana!');
          redirect('admin/pogodbe');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/pogodbe');
          }
   }
   
   
   public function newPonudnik()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator ponudnikov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_ponudnik.php";
        $data['ponudniki']      = $this->user_model->list_ponudniki();
         $this->load->view("template_admin.php", $data);

   }
   public function addPonudnik()
   {
          $insert['ponudnik_user']      = $this->input->post('ponudnik_user');
          $insert['ponudnik_title']     = $this->input->post('ponudnik_title');
          $insert['ponudnik_address']   = $this->input->post('ponudnik_address');
          $insert['ponudnik_zip']       = $this->input->post('ponudnik_zip');
          $insert['ponudnik_city']      = $this->input->post('ponudnik_city');    
          $insert['ponudnik_country']   = $this->input->post('ponudnik_country');    
          $insert['ponudnik_trr']       = $this->input->post('ponudnik_trr');    
          $insert['ponudnik_gsm']       = $this->input->post('ponudnik_gsm');    
          $insert['ponudnik_legal']     = $this->input->post('ponudnik_legal');    
          $insert['ponudnik_person']    = $this->input->post('ponudnik_person');    
          $insert['ponudnik_davc']      = $this->input->post('ponudnik_davc');    
          $insert['ponudnik_mat']       = $this->input->post('ponudnik_mat');    
          $insert['ponudnik_tax']       = $this->input->post('ponudnik_tax');    
          $insert['ponudnik_url']       = $this->input->post('ponudnik_url');
          $insert['ponudnik_email']     = $this->input->post('ponudnik_email');
          $insert['ponudnik_phone']     = $this->input->post('ponudnik_phone');
          $insert['ponudnik_fax']       = $this->input->post('ponudnik_fax');

          
          if(!$res = $this->offers_model->new_ponudnik($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong>  Ponudnik je bil dodan!');
          redirect('admin/ponudniki');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/ponudniki');
          }
   }
   
   public function ajaxPonudnikOffers()
   {
       $ponudnikid = $_POST['id'];
       $ponudbe = $this->offers_model->list_offers_ponudnik($ponudnikid);
      ?>
            <label>Ponudba</label>
            <select name="ponudba" style="margin-bottom: 5px; width:98%;">
                <?php foreach($ponudbe as $cat) :?>
                <option value="<?php echo $cat->offer_id;?>"> <?php echo $cat->offer_name;?> - <?php echo $cat->offer_head;?> - <?php echo $cat->offer_startstamp;?></option>
                <?php endforeach;?>
            </select>
    <?php
   }

   public function checkPonudnikAjax()
   {
          $ponudnikid = $_POST['id'];
          $ponudnik = $this->offers_model->detail_ponudnik($ponudnikid);
          $return['naslov'] = $ponudnik->ponudnik_address;
          $return['kraj']   = $ponudnik->ponudnik_city; 
          $return['posta']  = $ponudnik->ponudnik_zip; 
          $return['email']  = $ponudnik->ponudnik_email; 
          $return['telef']  = $ponudnik->ponudnik_phone; 
          $return['fax']    = $ponudnik->ponudnik_fax; 

          echo json_encode($return);
           
   }
   public function viewPonudnik($id)
   {
        $data['kategorija']     = $this->offers_model->detail_ponudnik($id);
	$data['title']          = "e-oglasnik - Administrator ponudnika - ".$data['kategorija']->ponudnik_title;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_ponudnik.php";
        $data['ponudniki']      = $this->user_model->list_ponudniki();
        $this->load->view("template_admin.php", $data);
   }
   
   public function editPonudnik()
   {
             
          $id                           = $this->input->post('ponudnik_id');    
          $insert['ponudnik_user']      = $this->input->post('ponudnik_user');
          $insert['ponudnik_title']     = $this->input->post('ponudnik_title');
          $insert['ponudnik_address']   = $this->input->post('ponudnik_address');
          $insert['ponudnik_zip']       = $this->input->post('ponudnik_zip');
          $insert['ponudnik_city']      = $this->input->post('ponudnik_city');    
          $insert['ponudnik_country']   = $this->input->post('ponudnik_country');    
          $insert['ponudnik_trr']       = $this->input->post('ponudnik_trr');    
          $insert['ponudnik_gsm']       = $this->input->post('ponudnik_gsm');    
          $insert['ponudnik_legal']     = $this->input->post('ponudnik_legal');    
          $insert['ponudnik_person']    = $this->input->post('ponudnik_person');    
          $insert['ponudnik_davc']      = $this->input->post('ponudnik_davc');    
          $insert['ponudnik_mat']       = $this->input->post('ponudnik_mat');    
          $insert['ponudnik_tax']       = $this->input->post('ponudnik_tax');    
          $insert['ponudnik_url']       = $this->input->post('ponudnik_url');
          $insert['ponudnik_email']     = $this->input->post('ponudnik_email');
          $insert['ponudnik_phone']     = $this->input->post('ponudnik_phone');
          $insert['ponudnik_fax']       = $this->input->post('ponudnik_fax');
          
          if(!$res = $this->offers_model->save_ponudnik($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong>  Ponudnik je bil posodobljen!');
          redirect('admin/ponudniki');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/ponudniki');
          }
   }
   
   public function deletePonudnik($id)
   {
          if(!$res = $this->offers_model->delete_ponudnik($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Ponudnik je bil izbrisan!');
          redirect('admin/ponudniki');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/ponudniki');
          }
   }
   
   
   
   
   
   
   
   
   
   
 
   public function newContent()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator vsebine";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_content.php";
        $data['parents']        =  $this->content_model->list_content();
       $this->load->view("template_admin.php", $data);

   }
   public function addContent()
   {
          $insert['content_title']      = $this->input->post('content_title');
          $insert['content_text']       = $this->input->post('content_text');
          $insert['content_slug']       = $this->content_model->generateSlug($this->input->post('content_slug'));
          $insert['content_parent']     = $this->input->post('content_parent');
          $insert['content_url']        = $this->input->post('content_url');

          if(!$res = $this->content_model->new_content($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Vsebina je bila posodobljena!');
          redirect('admin/content');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/content');
          }
   }
   
   public function viewContent($id)
   {
        $data['content']        = $this->content_model->detail_id($id);
	$data['title']          = "e-oglasnik - Administrator ponude - ".$data['content']->content_title;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_content.php";
        $data['parents']        =  $this->content_model->list_content();

        $this->load->view("template_admin.php", $data);
   }
   
   public function editContent()
   {
             
          $id                          = $this->input->post('content_id');    
          $insert['content_title']     = $this->input->post('content_title');
          $insert['content_parent']    = $this->input->post('content_parent');
          $insert['content_slug']      = $this->content_model->generateSlug($this->input->post('content_slug'));
          $insert['content_text']       = $this->input->post('content_text');
          $insert['content_url']        = $this->input->post('content_url');
          
          if(!$res = $this->content_model->save_content($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Vsbina je bila posodobljena!');
          redirect('admin/content');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/contente');
          }
   }
   
   public function deleteContent($id)
   {
          if(!$res = $this->content_model->delete_content($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Vsebinabila izbrisana!');
          redirect('admin/content');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/content');
          }
   }
   
   public function paymentsOffer($id)
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Pregled nakupov ponudbe";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/offer_payments.php";
        $data['ponudba']        = $this->offers_model->detail($id);
        $data['nakupi']         = $this->payments_model->offer_payments($id);
        $data['kuponi']         = $this->payments_model->getOfferCoupons($id);
        $this->load->view("template_admin.php", $data);
   }
   public function couponPDF($payId, $offer_id)
   {
       
       

        $nakupi       = $this->payments_model->offerPayments($payId);
        $podatki      = $this->payments_model->getOfferCouponsByOffer($payId);
        
        $this->load->library('pdf');
// set document (meta) information
$this->pdf->SetAuthor('e-oglasnik');
$this->pdf->SetTitle('Kupon');

 
// add a page
$this->pdf->AddPage();
 
// create address box
$this->pdf->CreateTextBox($podatki->user_name." ".$podatki->user_surname, 0, 60, 80, 10, 10);
$this->pdf->CreateTextBox($podatki->user_address, 0, 65, 80, 10, 10);
$this->pdf->CreateTextBox($podatki->user_zip. " ".$podatki->user_city, 0, 70, 80, 10, 10);
 
// invoice title / number
$this->pdf->CreateTextBox('Račun #201012345', 0, 90, 120, 20, 16);
 
// date, order ref
$this->pdf->CreateTextBox('Datum generiranja: '.date('Y-m-d'), 0, 100, 0, 10, 10, '', 'R');
$this->pdf->CreateTextBox('Referenca.: #6765765', 0, 105, 0, 10, 10, '', 'R');
// list headers
$this->pdf->CreateTextBox('Količina', 0, 120, 20, 10, 10, 'B', 'C');
$this->pdf->CreateTextBox('Produkt', 20, 120, 90, 10, 10, 'B');
$this->pdf->CreateTextBox('Cena', 110, 120, 30, 10, 10, 'B', 'R');
$this->pdf->CreateTextBox('Skupaj', 140, 120, 30, 10, 10, 'B', 'R');
 
$this->pdf->Line(20, 129, 195, 129);
 
 
$currY = 128;
$total = 0;
foreach ($nakupi as $row) {
    
        $total = $total + $row->qty * $row->offer_price;
        
	$this->pdf->CreateTextBox($row->qty, 0, $currY, 20, 10, 10, '', 'C');
	$this->pdf->CreateTextBox($row->offer_name, 20, $currY, 90, 10, 10, '');
	$this->pdf->CreateTextBox($row->offer_price.' €', 110, $currY, 30, 10, 10, '', 'R');
	$this->pdf->CreateTextBox($row->qty * $row->offer_price.' €', 140, $currY, 30, 10, 10, '', 'R');
	$currY = $currY+5;
}
$this->pdf->Line(20, $currY+4, 195, $currY+4);
// output the total row
$this->pdf->CreateTextBox('Skupaj', 20, $currY+5, 135, 10, 10, 'B', 'R');
$this->pdf->CreateTextBox($total.' €', 140, $currY+5, 30, 10, 10, 'B', 'R');
 
// some payment instructions or information
$this->pdf->setXY(20, $currY+30);
$this->pdf->SetFont("freeserif", '', 10);
$this->pdf->MultiCell(175, 10, '<em>Lorem ipsum dolor sit amet, consectetur adipiscing elit</em>. <br />
Vestibulum sagittis venenatis urna, in pellentesque ipsum pulvinar eu. In nec <a href="http://www.google.com/">nulla libero</a>, eu sagittis diam. Aenean egestas pharetra urna, et tristique metus egestas nec. Aliquam erat volutpat. Fusce pretium dapibus tellus.', 0, 'L', 0, 1, '', '', true, null, true);
 
//Close and output PDF document
$this->pdf->Output('test.pdf', 'D');
   }
   
   
   
   public function confirmPayment($id,$offer)
   {
          $data = array("pay_status" => "1");
          
          if(!$res = $this->payments_model->confirmPayment($id, $data))
          {
          $quanity = $this->payments_model->countQuanity($id);
          $kuponov_count =  $this->payments_model->countCoupons($offer);

          for ( $counter = 1; $counter <= $quanity[0]->qty; $counter += 1) {
          $kuponov =  $this->payments_model->countCoupons($offer);
          $stevilo = $kuponov + 1;
          $coupon['c_value']     = "K".date("m")."-".$stevilo." ".rand("100", "500");
          $coupon['c_offer']     = $offer;
          $coupon['c_payment']   = $id;
          $this->payments_model->addCoupon($coupon);
            }
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Plačilo je bilo potrjeno!');
          redirect('admin/paymentsOffer/'.$offer);
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/paymentsOffer/'.$offer);
          }
   } 
   public function cancelPayment($id,$offer)
   {
          $data = array("pay_status" => "2");
          if(!$res = $this->payments_model->cancelPayment($id, $data))
          {
              $this->payments_model->deleteCoupons($id);
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Plačilo je bilo stornirano!');
          redirect('admin/paymentsOffer/'.$offer);
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/paymentsOffer/'.$offer);
          }
   }
      public function paymentsUser($id)
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Pregled nakupov ponudbe";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/user_payments.php";
        $data['uporabnik']      = $this->user_model->detail_id($id);
        $data['nakupi']         = $this->payments_model->user_payments($id);
        $this->load->view("template_admin.php", $data);
   }
   
  public function oglasi()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator oglasov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/oglasi.php";
        $data['oglasi']         = $this->ads_model->list_ads();
        $this->load->view("template_admin.php", $data);
  
   }  
   
   public function newOglas() 
   {            
        $data['title']          = "e-oglasnik - Nov oglas";
        $data['view']           = "/admin/modules/new_oglas.php";
        $data['user_status']    = $this->is_logged();
        $data['komers']         = $this->offers_model->list_komers();
        $this->load->view("template_admin.php", $data);
   } 
   
   public function addOglas()
   {
       
        $config['upload_path'] = './uploads-ponudbe/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '9000';
        $config['max_width']  = '2500';
        $config['max_height']  = '2508';
        $config['encrypt_name']  = true;
        $this->load->library('upload', $config);
            
          $insert['ad_title']      = $this->input->post('title');
          $insert['ad_start']      = $this->input->post('start');
          $insert['ad_end']        = $this->input->post('end');
          $insert['ad_order']      = $this->input->post('order');
          $insert['ad_komer']      = $this->input->post('commer');
          $insert['ad_url']        = $this->input->post('url');
          $insert['ad_text']       = $this->input->post('text');
          $insert['ad_active']     = $this->input->post('status');
          
            foreach($_FILES as $key => $value)
            {
                if(!empty($value['name']))
                {
                if( ! empty($key['name']))
                {
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload($key))
                    {
                        $errors[] = $this->upload->display_errors();
                    }    
                    else
                    {

                     $data = $this->upload->data();
                     $insert['ad_image'] = $data['file_name'];

                    }
                 }
                }

            }    

          
          if(!$res = $this->ads_model->new_ad($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Oglas je bil dodan!!');
          redirect('admin/oglasi');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/oglasi');
          }
   }
  
   
   
   public function viewOglas($id) 
   {            
        $data['title']          = "e-oglasnik - Urejanje oglasa";
        $data['view']           = "/admin/modules/edit_oglas.php";
        $data['user_status']    = $this->is_logged();
        $data['oglas']           = $this->ads_model->detail($id);
        $data['komers']         = $this->offers_model->list_komers();
        $this->load->view("template_admin.php", $data);
   } 
   
   public function saveOglas()
   {
       
        $config['upload_path'] = './uploads-ponudbe/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '9000';
        $config['max_width']  = '2500';
        $config['max_height']  = '2508';
        $config['encrypt_name']  = true;
        $this->load->library('upload', $config);
        
          $id                     = $this->input->post('oglas_id');
            
          $insert['ad_title']      = $this->input->post('title');
          $insert['ad_start']      = $this->input->post('start');
          $insert['ad_end']        = $this->input->post('end');
          $insert['ad_order']      = $this->input->post('order');
          $insert['ad_komer']      = $this->input->post('commer');
          $insert['ad_url']        = $this->input->post('url');
          $insert['ad_text']       = $this->input->post('text');
          $insert['ad_active']     = $this->input->post('status');
          
            foreach($_FILES as $key => $value)
            {
                if(!empty($value['name']))
                {
                if( ! empty($key['name']))
                {
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload($key))
                    {
                        $errors[] = $this->upload->display_errors();
                    }    
                    else
                    {

                     $data = $this->upload->data();
                     $insert['ad_image'] = $data['file_name'];

                    }
                 }
                }

            }   
            
          if( $this->input->post('imageDelete') == 1) : $insert['ad_image'] = ""; endif;
          
          if(!$res = $this->ads_model->save_ad($insert, $id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Oglas je bil dodan!!');
          redirect('admin/oglasi');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/oglasi');
          }
   }
   
   
   public function deleteOglas($id)
   {
          if(!$res = $this->ads_model->delete($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Oglas izbrisan!');
          redirect('admin/oglasi');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/oglasi');
          }
   }
   
   
   public function viewUporabnik($id) 
   {            
        $data['title']          = "e-oglasnik - Urejanje uporabniškega računa";
        $data['view']           = "/admin/modules/edit_user.php";
        $data['user_status']    = $this->is_logged();
        $data['user']           = $this->user_model->detail_id($id);
        $this->load->view("template_admin.php", $data);
   }
        public function saveUser()
        {
          $id                       = $this->input->post('user_id');
          
          $insert['user_name']      = $this->input->post('user_name');
          $insert['user_surname']   = $this->input->post('user_surname');
          $insert['user_email']     = $this->input->post('user_email');
          $insert['user_address']   = $this->input->post('user_address');
          $insert['user_city']      = $this->input->post('user_city');
          $insert['user_zip']       = $this->input->post('user_zip');
          $insert['user_phone']     = $this->input->post('user_phone');
          $geslo                    = $this->input->post('user_password');
          if(!empty($geslo)):
          $insert['user_password']  = $this->_prep_password($this->input->post('user_password'));
          endif;
          $insert['user_group']     = $this->input->post('user_group');
          if(!$res = $this->user_model->save_user($insert, $id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Uporabnik je bil posodobljen!');
          redirect('admin/uporabniki');
          } 
        }
   
   public function deleteUporabnik($id)
   {
          if(!$res = $this->user_model->delete($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Uporabnik izbrisan!');
          redirect('admin/uporabniki');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/uporabniki');
          }
   }
   
   
    public function komers()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator komercialistov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/komers.php";
        $data['categories']        = $this->offers_model->list_komers();
        $this->load->view("template_admin.php", $data);

   }   
   public function statKomer()
   {
        if ( ! isset($_POST['start']))
        {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Poročilo o uspešnosti";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/stats_komers.php";
        $data['komers']        = $this->offers_model->list_komers();
        $this->load->view("template_admin.php", $data);
        }
        else
        {
        $od                     = $this->input->post("start");
        $do                     = $this->input->post("end");
        $komer                  = $this->input->post("commer");
        $data['od']             = $this->input->post("start");
        $data['do']             = $this->input->post("end");
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Poročilo o uspešnosti";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/stats_komers_single.php";
        $data['data']           = $this->komer_model->report($od, $do, $komer);
        $data['ponudbe']        = $this->komer_model->komerOffers($komer);
        $data['nakupi']         = $this->komer_model->komerPayments($komer, $od, $do);
        $data['rezerviranih']   = 0;
        $data['kupljenih']      = 0;
        $data['realizacija']    = 0;
        $data['rvc']             = 0;
        foreach($data['nakupi'] as $number)
        {
              if($number->pay_status == 0)
              {
                  $data['rezerviranih'] = $data['rezerviranih'] + $number->qty;
              }
              elseif ($number->pay_status == 1)
              {
                  $data['kupljenih'] = $data['kupljenih']  + $number->qty;
                  $real = $number->qty * $number->offer_price;
                  $data['realizacija'] = $data['realizacija'] + $real;    
                  
                  $real_rvc = $number->qty * $number->offer_provision;
                  $data['rvc'] = $data['rvc'] + $real_rvc;
              }
       
        }
        $data['komer']          = $this->offers_model->detail_komer($komer);
        $this->load->view("template_admin.php", $data);
        }


   }
   public function pdfStatKomer()
   {
        $od                     = $this->input->post("start");
        $do                     = $this->input->post("end");
        $komer                  = $this->input->post("commer");
        $data['od']             = $this->input->post("start");
        $data['do']             = $this->input->post("end");
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Poročilo o uspešnosti";
        $data['user_status']    = $this->is_logged();
        $data['data']           = $this->komer_model->report($od, $do, $komer);
        $data['ponudbe']        = $this->komer_model->komerOffers($komer);
        $data['nakupi']         = $this->komer_model->komerPayments($komer, $od, $do);
        $data['rezerviranih']   = 0;
        $data['kupljenih']      = 0;
        $data['realizacija']    = 0;
        $data['rvc']             = 0;
        foreach($data['nakupi'] as $number)
        {
              if($number->pay_status == 0)
              {
                  $data['rezerviranih'] = $data['rezerviranih'] + $number->qty;
              }
              elseif ($number->pay_status == 1)
              {
                  $data['kupljenih'] = $data['kupljenih']  + $number->qty;
                  $real = $number->qty * $number->offer_price;
                  $data['realizacija'] = $data['realizacija'] + $real;    
                  
                  $real_rvc = $number->qty * $number->offer_provision;
                  $data['rvc'] = $data['rvc'] + $real_rvc;
              }
       
        }
        $data['komer']          = $this->offers_model->detail_komer($komer);
        $data['pdf']            = "1";
	$tbl = $this->load->view('/admin/modules/stats_komers_single_pdf.php', $data, true);	
        $this->load->library('pdf');
        $this->pdf->SetFont('freeserif', 'B', 20);        
        // add a page
        $this->pdf->AddPage();
        
        $this->pdf->SetFont('freeserif', '', 8);

		// -----------------------------------------------------------------------------
		$filename = $data['komer']->k_name."".$data['komer']->k_surname." - ".$od. "-".$do.".pdf";
		$this->pdf->writeHTML($tbl, true, false, false, false, '');
                $this->pdf->Output($filename, 'D'); 
   }
   
   public function pdfNakupi($id)
   {

        $data['user_status']    = $this->is_logged();
        $data['ponudba']        = $this->offers_model->detail($id);
        $data['nakupi']         = $this->payments_model->offer_payments($id);
        $data['kuponi']         = $this->payments_model->getOfferCoupons($id);
        $data['pdf']            = "1";
	$tbl = $this->load->view('/admin/modules/pdf_nakupi.php', $data, true);	
        $this->load->library('pdf');
        $this->pdf->SetFont('freeserif', 'B', 20);        
        // add a page
        $this->pdf->AddPage();
        
        $this->pdf->SetFont('freeserif', '', 8);

		// -----------------------------------------------------------------------------
		$filename = "Kuponi_".$data['ponudba']->offer_name.".pdf";
		$this->pdf->writeHTML($tbl, true, false, false, false, '');
                $this->pdf->Output($filename, 'D'); 
   } 
   
   public function pdfNakupiAll()
   {

        $data['user_status']    = $this->is_logged();
        $data['nakupi']         = $this->payments_model->offer_paymentsAll();
        $data['kuponi']         = $this->payments_model->getOfferCouponsAll();
        $data['pdf']            = "1";
        $data['all']            = "1";
	$tbl = $this->load->view('/admin/modules/pdf_nakupi.php', $data, true);	
        $this->load->library('pdf');
        $this->pdf->SetFont('freeserif', 'B', 20);        
        // add a page
        $this->pdf->AddPage();
        
        $this->pdf->SetFont('freeserif', '', 8);

		// -----------------------------------------------------------------------------
		$filename = "Vsi_Kuponi.pdf";
		$this->pdf->writeHTML($tbl, true, false, false, false, '');
                $this->pdf->Output($filename, 'D'); 
   }
   
   public function newKomer()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator komercialistov";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_komer.php";
        
       $this->load->view("template_admin.php", $data);

   }
   public function addKomer()
   {
          $insert['k_name']       = $this->input->post('ime');
          $insert['k_surname']    = $this->input->post('priim');
          $insert['k_mobile']     = $this->input->post('mobi');
          $insert['k_phone']      = $this->input->post('tel');
          $insert['k_fax']        = $this->input->post('fax');
          $insert['k_email']      = $this->input->post('mail');     
          $insert['k_skype']      = $this->input->post('skype');
          $insert['k_employed']   = $this->input->post('employed');
          $insert['k_contract']   = $this->input->post('contract');
          $insert['k_start']      = $this->input->post('start');
          $insert['k_end']        = $this->input->post('end');
          if(!$res = $this->offers_model->new_komer($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Komercialist je bil dodan!');
          redirect('admin/komers');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/komers');
          }
   }
   
   public function viewKomer($id)
   {
        $data['kategorija']        = $this->offers_model->detail_komer($id);
	$data['title']          = "e-oglasnik - Administrator komercialista  - ".$data['kategorija']->k_name." ".$data['kategorija']->k_surname;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_komer.php";
        $this->load->view("template_admin.php", $data);
   }
   
   public function editKomer()
   {
             
          $id                          = $this->input->post('k_id');    
          $insert['k_name']       = $this->input->post('ime');
          $insert['k_surname']    = $this->input->post('priim');
          $insert['k_mobile']     = $this->input->post('mobi');
          $insert['k_phone']      = $this->input->post('tel');
          $insert['k_fax']        = $this->input->post('fax');
          $insert['k_email']      = $this->input->post('mail');     
          $insert['k_skype']      = $this->input->post('skype');
          $insert['k_employed']   = $this->input->post('employed');
          $insert['k_contract']   = $this->input->post('contract');
          $insert['k_start']      = $this->input->post('start');
          $insert['k_end']        = $this->input->post('end');
          
          if(!$res = $this->offers_model->save_komer($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Komercialist je bil posodobljen!');
          redirect('admin/komers');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/komers');
          }
   }
   
   public function deleteKomer($id)
   {
          if(!$res = $this->offers_model->delete_komer($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Komercialist je bil izbrisan!');
          redirect('admin/komers');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/komers');
          }
   }
   
   public function search()
   {
        $data['term']           = $this->input->post("term");
        $data['type']           = $this->input->post("type");
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Iskalnik";
        $data['results']        =
        $data['view']           = "/admin/modules/search.php";
        $data['results']        = $this->offers_model->searchEngine($data['term'], $data['type']);
        $this->load->view("template_admin.php", $data);
   }
   
   
   public function kolofon()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Kolofon";
        $data['view']           = "/admin/modules/kolofon.php";
        $data['content']        = $this->offers_model->kolofon();
        $this->load->view("template_admin.php", $data);
   }
      public function editKolofon()
   {
          $insert['text']       = $this->input->post('content');
          
          if(!$res = $this->offers_model->kolofon_update($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong>Kolofon je bil posodobljen!');
          redirect('admin/kolofon');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/kolofon');
          }
   }
   
   public function komentarji()
   {
        $data['user_status']        = $this->is_logged();
	$data['title']              = "e-oglasnik - Komentarji";
        $data['view']               = "/admin/modules/komentarji.php";
        $data['content']            = $this->offers_model->kolofon();
        $data['komentarji_cak']     = $this->offers_model->list_comments_waiting();
        $data['komentarji_zav']     = $this->offers_model->list_comments_denied();
        $data['komentarji_akt']     = $this->offers_model->list_comments_active();
        
        
        $this->load->view("template_admin.php", $data);   
        
  }
  
   public function acceptKomentar($id)
   {
          if(!$res = $this->offers_model->accept_comment($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Komentar je bil potrjen!');
          redirect('admin/komentarji');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/komentarji');
          }
   }
   public function cancelKomentar($id)
   {
          if(!$res = $this->offers_model->cancel_comment($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Komentar je bil zavrnjen!');
          redirect('admin/komentarji');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/komentarji');
          }
   }
  public function deleteKomentar($id)
   {
          if(!$res = $this->offers_model->delete_comment($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Komentar je bil izbrisan!');
          redirect('admin/komentarji');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/komentarji');
          }
   }
   
   
   
   
   
   public function blog()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator bloga";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/blog.php";
        $data['content']        = $this->content_model->list_blog();
        $this->load->view("template_admin.php", $data);
  
   }
   
   
   public function newBlog()
   {
        $data['user_status']    = $this->is_logged();
	$data['title']          = "e-oglasnik - Administrator bloga";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/new_blog.php";
        $data['parents']        =  $this->content_model->list_content();
       $this->load->view("template_admin.php", $data);

   }
   public function addBlog()
   {
          $insert['content_title']      = $this->input->post('content_title');
          $insert['content_text']       = $this->input->post('content_text');
          $insert['content_slug']       = $this->content_model->generateSlug($this->input->post('content_slug'));

          if(!$res = $this->content_model->new_blog($insert))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Vsebina je bila posodobljena!');
          redirect('admin/blog');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/blog');
          }
   }
   
   public function viewBlog($id)
   {
        $data['content']        = $this->content_model->detail_id_blog($id);
	$data['title']          = "e-oglasnik - Administrator bloga - ".$data['content']->content_title;
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/edit_blog.php";

        $this->load->view("template_admin.php", $data);
   }
   
   public function editBlog()
   {
             
          $id                          = $this->input->post('content_id');    
          $insert['content_title']     = $this->input->post('content_title');
          $insert['content_slug']      = $this->content_model->generateSlug($this->input->post('content_slug'));
          $insert['content_text']       = $this->input->post('content_text');

          
          if(!$res = $this->content_model->save_blog($insert,$id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Vsebina je bila posodobljena!');
          redirect('admin/blog');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/blog');
          }
   }
   
   public function deleteBlog($id)
   {
          if(!$res = $this->content_model->delete_blog($id))
          {
          $this->session->set_flashdata('type', 'success');
          $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Vsebina je bila izbrisana!');
          redirect('admin/blog');
          } else {
          $this->session->set_flashdata('type', 'error');
          $this->session->set_flashdata('message', '<strong>Napaka!</strong> Nekaj je šlo narobe!!');
          redirect('admin/blog');
          }
   }
   
   public function stats()
   {
	$data['title']          = "e-oglasnik - Statistika obiskovalcev";
        $data['user_status']    = $this->is_logged();
        $this->load->view("/admin/modules/stats.php", $data);
   }
   
   
   public function log()
   {
        $data['user_status']    = $this->is_logged();
        $user                   = $data['user_status'];
	$data['title']          = "e-oglasnik - Pregled zapisnika";
        $data['user_status']    = $this->is_logged();
        $data['view']           = "/admin/modules/zapisnik.php";
        

        $data['zapisnik']       = $this->log_model->list_logs();


        
        $this->load->view("template_admin.php", $data);

   }  
   
}

?>
