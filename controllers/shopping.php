<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class shopping extends My_Controller {

       public function __construct()
       {
            parent::__construct();
            $this->load->model('offers_model');
            $this->load->library('cart');
            $data['user_status'] = $this->is_logged();
       } 
       
	public function index()
	{
             redirect('kosarica');

	}
        
        public function add($id, $type = "buy")
        {
            $ponudba = $this->offers_model->detail($id);
            $today = date("Y-m-d H:i");
            $start = $ponudba->offer_startstamp;
            $end   = $ponudba->offer_endstamp;
            $start = date("Y-m-d H:i", strtotime($start));
            $end   = date("Y-m-d H:i", strtotime($end));
            $prodanih = $this->offers_model->count_selled($id);
            if(empty($ponudba)) {
              $this->session->set_flashdata('type', 'error');
              $this->session->set_flashdata('message', '<strong>Napaka!</strong> Ta ponudba je obstaja!');
              redirect('kosarica');
            } elseif($start > $today) {
              $this->session->set_flashdata('type', 'error');
              $this->session->set_flashdata('message', '<strong>Napaka!</strong> Ta ponudba se še ni začela!');
              redirect('kosarica');
            } elseif($end < $today) {
              $this->session->set_flashdata('type', 'error');
              $this->session->set_flashdata('message', '<strong>Napaka!</strong> Ta ponudba je potekla!');
              redirect('kosarica');  
            } 
             else {
            
            $data = array(
                           'id'      => $ponudba->offer_id,
                           'qty'     => $ponudba->offer_minimal > 0 ? $ponudba->offer_minimal : 1,
                           'price'   => $ponudba->offer_price,
                           'name'    => $ponudba->offer_head,
                          'options' => array('type' => $type)
                    );

             $rez =$this->cart->insert($data);
             if($rez){
              redirect('kosarica'); 
             }
           
            }      
            
        }
        
        
        public function view()
        {
		$data['title']          = "e-oglasnik - Košarica!";
                $data['user_status']    = $this->is_logged();
                $data['view']           = "/modules/shopping_cart.php";
                $data['sidebar']        = 1;
                $this->load->view("template.php", $data);
        }
        
        public function update()
        {


		// Get the total number of items in cart
		$total = $this->cart->total_items();

		// Retrieve the posted information
		$item = $this->input->post('rowid');
                $qty = $this->input->post('qty');

		// Cycle true all items and update them
                 for($i=0;$i < count($item);$i++) 
                 {
			// Create an array with the products rowid's and quantities.
		$data = array(
               'rowid' => $item[$i],
               'qty'   => $qty[$i]
                  );

                // Update the cart with the new information
			$this->cart->update($data);
		}
                redirect('kosarica');
	}

        public function next()
        {
            $data['user_status']    = $this->is_logged();
            
            if($this->cart->total_items() == 0) :
                redirect('kosarica');
            endif;
            
            if( $data['user_status']->logged_in == 0)
            {
                redirect('login?redir=kosarica/naprej');
            }
            
		$data['title']          = "e-oglasnik - Nakup kuponov";
                $data['view']           = "/modules/shopping_cart_next.php";
                $data['sidebar']        = 1;
                $this->load->view("template.php", $data);
        }
        
        public function finish()
        {
              $this->load->library('encrypt');
              $this->load->library('email');
              $this->load->helper('string');
              $config['mailtype'] = 'html';
              $config['newline']  = '\n';
              $this->email->initialize($config); 
              $data['user_status']    = $this->is_logged();
              ///$stkupon = $this->offers_model->count_bought();
              $reference = random_string('numeric', 5);
              
              $insert['pay_uniqer']             = $this->encrypt->sha1($this->input->post('user_name'));
              $insert['pay_user']               = $this->input->post('pay_user');
              $insert['pay_option']             = $this->input->post('pay_option');
              $insert['pay_reference']          = $reference;
            
              $insert['user_name']            = $this->input->post('user_name');
              $insert['user_surname']         = $this->input->post('user_surname');
              $insert['user_email']           = $this->input->post('user_email');
              $insert['user_address']         = $this->input->post('user_address');
              $insert['user_zip']             = $this->input->post('user_zip');
              $insert['user_city']            = $this->input->post('user_city');
              $insert['user_phone']           = $this->input->post('user_phone');
              
              $insert['rec_name']            = $this->input->post('rec_name');
              $insert['rec_surname']         = $this->input->post('rec_surname');
              $insert['rec_email']           = $this->input->post('rec_email');
              $insert['rec_address']         = $this->input->post('rec_address');
              $insert['rec_zip']             = $this->input->post('rec_zip');
              $insert['rec_city']            = $this->input->post('rec_city');
              $insert['rec_phone']           = $this->input->post('rec_phone');    
                            
              $insert['pay_total']           = $this->cart->format_number($this->cart->total());
              $res = $this->payments_model->add_payment($insert);

              foreach ($this->cart->contents() as $items):
                  $product['payment_id']    =  $res;
                  $product['offer_id']      =  $items['id'];
                  $product['name']          =  $items['name'];
                  $product['price ']        =  $this->cart->format_number($items['subtotal']);
                  $product['qty']           =  $items['qty'];
                  
                    $ponudba = $this->offers_model->detail($product['offer_id']);
                    
                    $this->email->from('info@e-oglasnik.com', 'e-oglasnik');
                    $this->email->to($data['user_status']->user_email);

                    $this->email->subject('Potrdilo rezervacije e-oglasnik kupona');
                    $this->email->message('
                            Pozdravljeni '.$data['user_status']->user_name.' '.$data['user_status']->user_surname.'!
                             <br />   <br />
                            Uspešno ste rezervirali kupone za "<a href="'.base_url()."ponudba/".$ponudba->offer_slug.'">'.$ponudba->offer_head.'</a>" na spletni strani e-oglasnik!
                             <br />
                             Prosimo, da položnico poravnate v roku 2 delovnih dni, sicer bo rezervacija kuponov izbrisana. Do plačila naročila kuponi ne bodo poslani.
                            <br />                            
                            Položnico lahko poravnate na pošti, banki ali preko elektronskega bančništva. 
                            <br />
                            <br />
                            <strong>Podatki za plačilo vašega kupona:</strong>
                             <br /> <br />
                            IBAN: SI56 0600 0011 8837 230 <br />
                            Referenca: SI 000 '.$reference.' <br />
                            Ime in priimek /naziv: Pentagrama d.o.o. <br />
                            Ulica in hišna številka: Cesta Dolomitskega odreda 10 <br />
                            Pošta in kraj: 1000 Ljubljana <br />
                             <br />
                            Znesek: <strong>'.$this->cart->format_number($items['subtotal']).' €</strong>
                             <br />   <br />
                            Ko bo vaš kupon aktiviran oz. bomo zbrali dovolj naročil za potrditev ponudbe vas bomo o tem tudi obvestili.
                             <br />  
                            V primeru, da ponudba ne bo uspela, vam bomo kupnino vrnili v roku 2 delovnih dni na TRR s katerega je bilo opravljeno plačilo kuponov.<br />
                            <br />
                            Lep pozdrav, <br />
                            Ekipa e-oglasnik!
                        ');

                    $this->email->send();
                  
                  $res_2 = $this->payments_model->add_payment_detail($product);

              endforeach;
              
              $total = $this->cart->format_number($this->cart->total());
              $this->session->set_flashdata('type', 'success');
              $this->session->set_flashdata('message', '<strong>Uspeh!</strong> Kuponi so bili rezervirani!');
		$data['title']          = "e-oglasnik - Rezervacija kuponov";
                $data['user_status']    = $this->is_logged();
                $data['view']           = "/modules/shopping_cart_upn.php";
                $data['sidebar']        = 1;
                $data['reference']      = $reference;
                $data['vsota']          = $total;
                $this->load->view("template.php", $data);
              
        }
}
