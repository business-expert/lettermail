<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditcard extends MY_Controller {

   public function __construct()
   {
      session_start();
      parent::__construct();
      $this->load->model('login_model');
      $this->load->model('offers_model');
      $this->load->model('payments_model');
      
        $this->store_id = 'test';

        $this->status_url= base_url()."creditcard/status";
        $this->update_url= base_url()."creditcard/update";

        $this->client = new SoapClient("certifications/megapos_v3_test.wdsl", array('local_cert' => "certifications/test_php.pem"));
        // $client = new SoapClient("megapos_v3_production.wdsl", array('local_cert' => "test_php.pem"));
        //$client = new SoapClient("megapos_v3_test.wdsl", array('local_cert' => "test_php.pem", 'cache_wsdl' => WSDL_CACHE_NONE, 'trace' => 1));
        //if set, then we print whole response from gateway in authorize call
        $this->gateway_id_array = array ("ACTIVA_PGW" => "402883870d9e7520010d9e755a310001",
					"BANKART_PGW" => "2c9185d12f3709c4012f4eb6c792151a",
					"DINERS" => "000000002214c84a01222b95c1a10632",
					"EFUNDS" => "40288387102d176501102f23aa990015",
					"MONETA" => "FD2F2E6D-AD1F-4D55-AADE-835344DF0AE5"
                                    );
        $this->debug=1;
        
   }

    public function index()
   {

            redirect(base_url());
   }
   
   public function purchase() 
   {
              $data['user_status'] = $this->is_logged(); 
              if( $data['user_status']->logged_in == 0)
                {
                redirect('login?redir=kosarica/naprej');
                }
              $this->load->library('email');
              $this->load->library('encrypt');
              $this->load->helper('string');
              $config['mailtype'] = 'html';
              $config['newline']  = '\n';
              $this->email->initialize($config);
              $reference = random_string('numeric', 5);
              $transaction_id = "txid-".rand();
              $insert['pay_uniqer']             = $this->encrypt->sha1($this->input->post('user_name'));
              $insert['pay_user']               = $this->input->post('pay_user');
              $insert['pay_option']             = $this->input->post('pay_option');
              $insert['pay_reference']          = $transaction_id;
            
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

                    $this->email->subject('Uspešna rezervacija kupona!');
                    $this->email->message('
                            Pozdravljeni '.$data['user_status']->user_name.'!
                             <br />   <br />
                            Uspešno ste rezervirali kupone za "<a href="'.base_url()."ponudba/".$ponudba->offer_slug.'">'.$ponudba->offer_head.'</a>" na spletni strani e-oglasnik!
                             <br />
                            Referenčna številka: <strong>'.$reference.'</strong>
                             <br />
                            Plačilo: <strong>'.$this->cart->format_number($items['subtotal']).' €</strong>
                             <br />   <br />
                            Lep pozdrav, <br />
                            Ekipa e-oglasnik!
                        ');

                    $this->email->send();
                  
                  $res_2 = $this->payments_model->add_payment_detail($product);

              endforeach;
       
        $customer_name = trim($this->input->post('user_name'));
        $customer_surname = trim($this->input->post('user_surname'));
        $amount = trim($this->cart->format_number($this->cart->total()));
        $transaction_type = "PURCHASE";
        $language = "SLV";
        $gateway = "ACTIVA_PGW";
        $gateway_id = $this->gateway_id_array[$gateway];
        $currency = 'EUR';
        $redirect =  "1";

        $id_data = array(
                'store-id'=>$this->store_id, 
                'transaction-id'=>$transaction_id
        );

        $amount_data = array(
                'amount'=>$amount, 
                'currency'=>$currency
        );
        $init_data = array(
                'status-url'=>$this->status_url, 
                'update-url'=>$this->update_url, 
                'gateway-id'=>$gateway_id, 
                'transaction-type'=>$transaction_type
        );

        if (isset($language)){
                $init_data['language'] = $language;
        }
        if (isset($currency)){
                $init_data['currency'] = $currency;
        }
        if (isset($customer_name)){
                $init_data['customer-name'] = $customer_name;
        }
        if (isset($customer_surname)){
                $init_data['customer-surname'] = $customer_surname;
        }
        if (isset($additional_info)){
                $init_data['additional-info'] = $additional_info;
        }
        if (isset($email)){
                $init_data['email'] = $email;
        }


        $init_data_merged = array_merge($id_data, $amount_data, $init_data);

        // classic redirect mode, result of init() is url, where we redirect customer
        if (!isset($redirect) OR $redirect=='1'){
                try {
                        $result = $this->client->init($init_data_merged);  
                        $result_url=$result->{'active-state'}->result;
                         header('location:'.$result_url);
                }
                catch (SoapFault $e) {
                        echo "ERROR: ";
                        print_r($e->getMessage());
                }
        }

        // 			echo "REQUEST:\n" . htmlentities($client->__getLastRequest()) . "\n";  
   }
   
   public function status() 
   {
            if (isset($_GET['txId'])){
                    $data['user_status'] = $this->is_logged();
                    $transaction_state = $this->payments_model->creditCardStatus($_GET['txId']);
                    if ($transaction_state=="INITIALIZING"){
                            $data['status'] = "<div class='notification'> <p>Transakcija je še v teku...</p> </div>";		//Transaction still running... this status should never show
                            }
                    elseif ($transaction_state=="INITIALIZED"){
                            $data['status'] = "<div class='notification success'> <p>Transakcija uspešno avtorizirana</p> </div>";	//Transaction sucessfully authorized
                    }	
                    elseif ($transaction_state=="PROCESSED"){
                            $data['status'] = "<div class='notification success'> <p>Transakcija je uspešno zaključena. Podatki so bili poslani na vaš e-mail.</p> </div>";	//Transaction sucessfully finished
                            $this->load->library('email');
                            $config['mailtype'] = 'html';
                            $config['newline']  = '\n';
                            $this->email->initialize($config);
                            $this->email->from('info@e-oglasnik.com', 'e-oglasnik');
                            $this->email->to($data['user_status']->user_email);

                            $this->email->subject('Uspešno plačilo kupona!');
                            $this->email->message('
                                    Pozdravljeni '.$data['user_status']->user_name.'!
                                    <br />   <br />
                                    Uspešno ste opravili nakup kuponov na spletni strani e-oglasnik! Vaši kuponi so bili generirani.
                                    <br />
                                    Ko bo vaš kupon aktiviran oz. bomo zbrali dovolj naročil za potrditev ponudbe vas bomo o tem tudi obvestili.
                                    <br />   <br />
                                    Lep pozdrav, <br />
                                    Ekipa e-oglasnik!
                                ');

                            $this->email->send();
                            
                            
                    }	
                    elseif ($transaction_state=="AWAITING_CONFIRMATION"){		//Temp status that Klik gateway has untill it sends confirmation xml, after which transaction goes to PROCESSED state.
                            $data['status'] = "<div class='notification'> <p>Transakcija čaka na potrditev banke</p> </div>";	//If you so choose, you can  print "Transaction sucessfully finished"
                    }
                    elseif ($transaction_state=="FAILED"){
                            $data['status'] = "<div class='notification error'> <p>Transakcija ni uspela</p> </div>";			//Transaction failed
                    }	
                    elseif ($transaction_state=="ABORTED"){
                            $data['status'] = "<div class='notification error'> <p>Transakcija je bila preklicana</p> </div>";	//Transaction was aborted (by user)
                    }	
                    
                    $data['user_status']    = $this->is_logged();

                    $data['title']          = "e-oglasnik - Nakup kuponov s kreditno kartico";
                    $data['view']           = "/modules/shopping_cart_cc.php";
                    $data['sidebar']        = 1;
                    $this->load->view("template.php", $data);
            }
            else{
                    echo "<meta http-equiv=\"refresh\" content=\"5\">";
            }
   }
   
   public function update()
   {
        $transaction_id = trim($_GET['txId']);
        

        
        $id_data = array(
                'store-id'=>$this->store_id, 
                'transaction-id'=>$transaction_id
        );

        try {
                $result = $this->client->load($id_data); 
                $active_state_type = $result->{'active-state'}->type;
                $data['cardtype'] = $active_state_type;
                $dater = $this->payments_model->offer_payments_txID($transaction_id);
                $id    = $dater[0]->pay_id;
                $offer = $dater[0]->offer_id;
                $ime   = $dater[0]->user_name;

                if($active_state_type == "PROCESSED") :
                    $data['pay_status'] = "1";
                    $quanity = $this->payments_model->countQuanity($id);
                    $kuponov_count =  $this->payments_model->countCoupons($offer);
                    
                    $ponudba = $this->offers_model->detail($offer);
                    

                            
                    $this->load->library('mpdf');
                    
                    $this->load->library('email');
                            $config['mailtype'] = 'html';
                            $this->email->initialize($config);

                            $this->email->from('e-oglasnik@pentagrama.si', 'e-oglasnik');
                            $this->email->to('keglic@gmail.com');

                            $this->email->subject('Vaš kupon je prispel!');
                            $this->email->message('
                                Pozdravljeni '.$ime.'!
                            <br/> 
                                Vaše naročilo je bilo potrjeno. V priponki lahko najdete vaš kupon za ponudbo "'.$ponudba->offer_head.'"
                                <br/><br/>
                                Lep pozdrav,<br/>
                                e-oglasnik
                                ');
                    
                    for ( $counter = 1; $counter <= $quanity[0]->qty; $counter += 1) {
                    $kuponov =  $this->payments_model->countCoupons($offer);
                    $stevilo = $kuponov + 1;
                    $coupon['c_value']     = "K".date("m")."-".$stevilo." ".rand("100", "500");
                    $coupon['c_offer']     = $offer;
                    $coupon['c_payment']   = $id;
                    $kupon = $this->payments_model->addCoupon($coupon);
                    
                    
                    
                    
                    ///////////////
                    //
                    //  ORDER IS OK AND SUCCEDED, LET'S SEND COUPON
                    //  
                    ///////////////
                    $filename = "Kupon-".$coupon['c_value'].".pdf";  
                    $pdf['coupon']  = $this->payments_model->couponData($kupon);
                    $pdf['ponudba'] = $this->offers_model->detail($coupon['c_offer']);
                    $html = $this->load->view("/coupon/coupon.php", $pdf, TRUE);
                    $noga = $this->load->view("/coupon/noga.php", $pdf, TRUE);
                    $this->mpdf->WriteHTML($html);
                    $this->mpdf->SetHTMLFooter($noga);
                    $this->mpdf->Output('./kuponi/'.$filename, 'F'); 
                            
                    $this->email->attach('./kuponi/'.$filename);
                    ///////////// 
                    ///////////// 
                    ///////////// 
                   
                    
                    }
                    

                    $this->email->send();
                  
                endif;
                $this->payments_model->updateCreditCard($transaction_id, $data);

        } catch (SoapFault $e) {
                print_r($e->getMessage());
        }
   }

}

?>
