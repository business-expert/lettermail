<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php echo $title ?></title>
  <meta name="description" content="">

  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <script src="<?php echo base_url();?>assets/js/libs/modernizr-2.0.6.min.js"></script>
      
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
   <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
   <link REL="SHORTCUT ICON" HREF="<?php echo base_url();?>assets/images/favicon.ico"> 
    <script type="text/javascript">
        var base_url = "<?php echo base_url();?>";
        <?php if($user_status->logged_in == 0 AND $this->uri->segment(1, 0) === 0)
        {
            echo "var registered = 0;";
        } else {
            echo "var registered = 1;";

        }
        ?>
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
    <script defer src="<?php echo base_url();?>assets/js/libs/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/casovnik.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/payment.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/regije.js"></script>


</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/sl_SI/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

        <script type="text/javascript">
         $(document).ready(function(){

           var dialog = $( "#dialog-regions" ).dialog({
                    autoOpen: false,
                    show: "fade",
                    hide: "fade",
                    width: "auto",
                    height: "auto",
                    position: "top"
            })  
   

            $("#regija_show").live('click', function() {
                $( "#dialog-regions" ).dialog( "open" );
            })
         })
            
        </script>
        <?php
        if($user_status->logged_in == 1 && !isset($_COOKIE['regija'])):
        ?>
        <script type="text/javascript">
         $(document).ready(function(){
             $( "#dialog-regions" ).dialog( "open" );
         })   
        </script>
        <?php
        endif;
        ?>

        <div id="dialog-regions" style="display:none;" title="Izberite vašo regijo">
                <?php
                $formarr = array('class' => 'register-form', 'id' => 'register-form');
                echo form_open('nastaviRegijo', $formarr); 
        ?>
            <select style="border: 1px solid grey;color:#80AC24;width:100%; height: 30px; font-size: 18px; padding-left: 5px;" id="region_chooser_select" name="region_input">
                <?php 
                $regije  = $this->offers_model->list_regions();
                foreach($regije as $r) :
                  echo "<option value='".$r->region_id."'>".$r->region_title."</option>";
                endforeach;
                ?>
                <option value="drzave">----------------</option>
                <?php 
                $drzave  = $this->offers_model->list_countries();
                foreach($drzave as $r) :
                  echo "<option value='".$r->region_id."'>".$r->region_title."</option>";
                endforeach;
                ?>
            </select>
            <br />
        <input type="submit" name="submit" id="region_chooser" class="register-button" value="Nastavi!"  />
        <?php
        echo form_close();
        ?>
        </div>
        <?php
        
        if(!isset($_COOKIE['oglasnikuser']))
        {
          $pisk_login    = "unknown";
        } else {
            $pisk_login    = $_COOKIE['oglasnikuser'];
        }
        
        if(isset($_COOKIE['st_prikazov_reg']))
        {
        $pisk_register = $_COOKIE['st_prikazov_reg'];
        

        }
        else {
        $pisk_register = "0";

        }
        if($user_status->logged_in == 0 AND $this->uri->segment(1, 0)=== 0 AND $pisk_register <= 1 AND $pisk_login != "yes") : ?>
          <script>
          $(document).ready(function(){
            $("#register-form").validate({       
            rules: {
                ime: {
                    required: true
                },      
                priimek: {
                    required: true
                },     
                geslo: {
                    required: true
                } ,
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "<?php echo base_url(); ?>register/email_exists",
                        type: "post"
                    }
                }
               }, messages: {
                email: {
                    email: 'Prosimo vpišite veljaven E-mail!',
                    remote: 'Ta E-mail naslov je že v uporabi!'
                }
            }
           });

          });
          </script> 
        <div id="dialog" style="display:none;" title="Registracija uporabnika">
                 <h1> Registracija </h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                <div id="register-divide" class="border-right">
                <?php
                $formarr = array('class' => 'register-form', 'id' => 'register-form');
                echo form_open('register/save', $formarr); 

                echo form_label('Vaše ime<em>*</em>', 'ime');
                echo form_input('ime', set_value('ime'));

                echo form_label('Vaš priimek<em>*</em>', 'priimek');
                echo form_input('priimek', '');

                echo form_label('Vaš e-mail<em>*</em>', 'email');
                echo form_input('email', '');

                echo form_label('Geslo<em>*</em>', 'geslo');
                echo form_password('geslo', '');



                ?>

                </div>
                <div id="register-divide" class="border-left">
                <?php
                echo form_label('Naslov:', 'naslov');
                echo form_input('naslov', '');

                echo form_label('Kraj:', 'kraj');
                echo form_input('kraj', '');

                echo form_label('Poštna številka:', 'posta');
                echo form_input('posta', '');

                echo form_label('Telefonska:', 'telefon');
                echo form_input('telefon', '');

                ?>
          </div> 
<br /><br />
<input type="submit" name="submit" class="register-button" value="Registracija!"  />
<br /><br />
Polja označena z <em>*</em> so obvezna! Registracija vam omogoča kupovanje  kuponov e-oglasnika.
<?php
echo form_close();
?>
    	<p>Z registracijo pridobite več funkcionalnosti e-oglasnika!</p>
</div>
        <?php endif;  ?>

          
          
          
          
          
          
          
          
    <?php 
          
        if($user_status->logged_in == 0 AND $this->uri->segment(1, 0)=== 0 AND $pisk_login == "yes") : ?>
        <div id="dialog" style="display:none;" title="Prijava uporabnika">
          <h1> Prijava </h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<div id="register-divide" style="width:260px !important;">
<?php
if(isset($_GET['redir'])) {
$action = $_GET['redir'];
} else {
$action = null;
}

$formarr = array('class' => 'register-form', 'id' => 'register-form');
echo form_open('login/letmein?redir='.$action, $formarr); 

echo form_label('Email', 'email');
echo form_input('email', set_value('email'));

echo form_label('Geslo', 'geslo');
echo form_password('geslo', set_value('geslo'));

?>
</div>
<br /><br/>
<input type="submit" name="submit" style="margin-left:45px !important;" class="register-button" value="Prijava!"  />
<?php
echo form_close();
?>

</div>
        <?php endif;  ?>
          

   <div id="head-trak">

   
        <div id="head-trak-inner">
        
        
            <div id="header-credentials-left">
                 Prihranjenih eurov: <strong>1256 €</strong> 
                <br />
                Prodanih kuponov: <strong>256</strong> 
            </div>    
            <div id="header-credentials-right">
                <?php if($user_status->logged_in == 1) :;?>
                <strong><?php echo $user_status->user_name." ".$user_status->user_surname;?></strong>
                 <?php if($user_status->user_group == "admin" or $user_status->user_group == "pentadmin") : ?>
                - <a href="<?php echo base_url();?>admin">Administracija</a>
                <?php endif;?>    
               <?php if($user_status->user_group == "ponudnik") : ?>
                - <a href="<?php echo base_url();?>ponudnik">Ponudnik</a>
                <?php endif;?>
                - <a class="<?=($this->uri->segment(1, 0)=== 'kosarica')?'current':''?>" href="<?php echo base_url();?>kosarica">Košarica (<strong><?php echo $this->cart->total_items();?></strong>)</a>
                - <a class="<?=($this->uri->segment(1, 0)=== 'uporabnik' AND $this->uri->segment(2, 0)=== 'podatki')?'current':''?>" href="<?php echo base_url();?>uporabnik/podatki/<?php echo $user_status->user_id;?>">Moji podatki</a>
                - <a class="<?=($this->uri->segment(1, 0)=== 'uporabnik' AND $this->uri->segment(2, 0)=== 'nakupi')?'current':''?>" href="<?php echo base_url();?>uporabnik/nakupi/<?php echo $user_status->user_id;?>">Moji kuponi</a>
                - <a href="<?php echo base_url();?>odjavi-me">Odjava</a>
                <?php else: ?>
                <a class="<?=($this->uri->segment(1, 0)=== 'kosarica')?'current':''?>" href="<?php echo base_url();?>kosarica">Košarica (<strong><?php echo $this->cart->total_items();?></strong>)</a> -
                <a href="<?php echo base_url();?>registracija"> Registracija </a> | <a id="open-login" href="<?php echo base_url();?>login">Prijava</a>
                <?php endif; ?>
            </div>
               
            </div>
    </div>

    <div id="background-center"><div id="oglasnik-background"></div></div> 
    
  <div id="container">
  
    <header>
        <div id="logo">
            <a href="<?php echo base_url();?>"> <img src="<?php echo base_url();?>assets/images/logo.png" alt="Najboljše ponudbe!" title="Najboljše ponudbe!"></a>
        </div>
        <?php if(isset($_COOKIE['regija'])): ?>
        <div id="regija_show" class="roundedCorners10">
            <?php
            $regije = explode(";", $_COOKIE['regija']);
            $st = count($regije);
            if($st == 1) :
            $regija = $this->offers_model->region_detail($_COOKIE['regija']);
            echo $regija->region_title;
            else:
            echo "Več regij";
            endif;

            ?>
        </div>
        <?php endif;?>
        <div id="navigation-top">
        <div id="navigation">
            <ul id="nav">
                    <li class="<?=($this->uri->segment(1, 0)=== 0)?'current':''?>"><a href="<?php echo base_url();?>">Domov</a></li>
                    <li class="headlink <?=($this->uri->segment(1)==='trenutna-ponudba')?'current':''?>"><a href="<?php echo base_url();?>trenutna-ponudba" class="talar" talar-text="V tem trenutku so vam na voljo spodnje ponudbe">Trenutna ponudba</a></li>
                    <li class="headlink <?=($this->uri->segment(1)==='prihajajoce-ponudbe')?'current':''?>"><a href="<?php echo base_url();?>prihajajoce-ponudbe" class="talar" talar-text="Naročite se in
            obvestili vas bomo, ko bodo ponudbe aktivirane">Prihajajoče ponudbe</a></li>	
                    <li class="headlink <?=($this->uri->segment(1)==='v-izteku')?'current':''?>"><a href="<?php echo base_url();?>v-izteku" class="talar" talar-text="Do izteka ponudbe je še 12 ur ali manj. Pohitite!">Ponudbe v izteku</a></li>	
                    <li class="headlink <?=($this->uri->segment(1)==='regije')?'current':''?>"><a href="<?php echo base_url();?>regije" id="<?=($this->uri->segment(1, 0)=== 0)?'prikazi-regije':''?>">Regije</a></li>
                    <li class="headlink <?=($this->uri->segment(1)==='vsebina_kontakt')?'current':''?>"><a href="<?php echo base_url();?>vsebina_kontakt">Kontakt</a></li>
            </ul>

                    </div>   
       <div  id="navigation-search">
           <form id="searchPonudbe" type="post" action="<?php echo site_url("iskalnik");?>">
               <input type="text" class="talar" talar-text="Iskalnik išče po nazivu in opisu ponudbe!" name="searchTerm" id="iskalniNiz">
           </form>

        </div>
        </div>

    </header>
       
