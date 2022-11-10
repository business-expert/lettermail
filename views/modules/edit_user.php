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
        email: {
            required: true,
            email: true
        }
    }});
    
  });
  </script> 
  <?php
  $zregije = unserialize($user->user_regions);
  $ztipi   = unserialize($user->user_type);
  
  ?>
<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">
          <h1> Moji podatki </h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<?php if($this->session->flashdata('type') != "success") : ?>   

          <div id="register-divide" class="">
<?php
$formarr = array('class' => 'register-form', 'id' => 'register-form');
echo form_open('user/save', $formarr); 
?>
   <input type="hidden" name="id" value="<?php echo $user->user_id;?>"> 
<label for="ime">Vaše ime<em>*</em></label>
<input type="text" name="ime" class="capitalize" value="<?php echo $user->user_name;?>"/>
<label for="priimek">Vaš priimek<em>*</em></label>
<input type="text" name="priimek" class="capitalize" value="<?php echo $user->user_surname;?>"  />
<?php

echo form_label('Vaš e-mail<em>*</em>', 'email');
echo form_input('email',  $user->user_email);

echo form_label('Geslo', 'geslo');
?>
<input type="password" name="geslo" class="talar" autocomplete="off" talar-text="Tu lahko spremenite geslo. Če tega ne želite, pustite polje prazno." value=""  />
<?php
echo form_label('Dovoli obveščanje preko e-maila', 'notify');
?>
<input type="radio" name="notify" <?php if($user->user_notify == 1): echo "checked='checked'"; endif;?> value="1"  /> Da <br />
<input type="radio" name="notify" <?php if($user->user_notify == 0): echo "checked='checked'"; endif;?>  value="0"  /> Ne<br />

          </div>
          <div id="register-divide" class="">
<label for="naslov">Naslov:</label>
<input type="text" name="naslov" class="capitalize" value="<?php echo $user->user_address;?>"  />
<label for="kraj">Kraj:</label>
<input type="text" name="kraj" class="capitalize" value="<?php echo $user->user_city;?>"  />
<?php

echo form_label('Poštna številka:', 'posta');
echo form_input('posta',  $user->user_zip);

echo form_label('Telefonska:', 'telefon');
echo form_input('telefon',  $user->user_phone);

?>

          </div> 
          <br />
          <h1> Zanimajo me ponudbe... </h1>
          <div id="register-divide" class="border-left" style="margin-bottom: 14px;">
              <center><h3>Regije</h3></center>
              <?php 
              $regije = $this->offers_model->list_regions();
              foreach($regije as $regija) :
                  ?>
              <input class="regije_checks" type="checkbox" <?php if(is_array($zregije)) { if(in_array($regija->region_id, $zregije)) { echo " checked='checked' "; } } ?>name="user_regions[]" value="<?php echo $regija->region_id;?>" /> <?php echo $regija->region_title;?><br />
              <?php
              endforeach;
              ?>
              <a href="#" id="checkRegije" style="color:#88B826;"> Označi vse regije </a>
              |
              <a href="#" id="uncheckRegije" style="color:#88B826;"> Odznači vse regije </a>
              <br />
          </div>      
          <div id="register-divide" class="border-left">
              <center><h3>Sosednje države</h3></center>
              <?php 
              $tipi = $this->offers_model->list_countries();
              foreach($tipi as $tip) :
                  ?>
                <input class="tipi_checks" type="checkbox" <?php if(is_array($zregije)) { if(in_array($tip->region_id, $zregije)) { echo " checked='checked' "; } } ?>name="user_regions[]" value="<?php echo $tip->region_id;?>" /> <?php echo $tip->region_title;?><br />
              <?php
              endforeach;
              ?>              
              <center><h3>Tip</h3></center>
              <?php 
              $tipi = $this->offers_model->list_types();
              foreach($tipi as $tip) :
                  ?>
                <input class="tipi_checks" type="checkbox" <?php if(is_array($ztipi)) { if(in_array($tip->otype_id, $ztipi)) { echo " checked='checked' "; } } ?>name="user_type[]" value="<?php echo $tip->otype_id;?>" /> <?php echo $tip->otype_title;?><br />
              <?php
              endforeach;
              ?>
              <a href="#" id="checkTipi" style="color:#88B826;"> Označi vse tipe </a>
              |
              <a href="#" id="uncheckTipi" style="color:#88B826;"> Odznači vse tipe </a>
          </div> <br />
<input type="submit" name="submit" class="register-button" value="Uredi račun!"  />
<br /><br />
Polja označena z <em>*</em> so obvezna! Ostala polja izboljšujejo funkcionalnosti e-oglasnika.
<?php
echo form_close();
?>
<script type="text/javascript">
    $("#checkRegije").click(function (event){
        $.each($(".regije_checks"), function() {
            $(this).attr('checked','checked')

        })
       event.preventDefault();
    }) 
    $("#uncheckRegije").click(function (event){
        $.each($(".regije_checks"), function() {
            $(this).attr('checked', false)

        })
       event.preventDefault();
    })  
    
    $("#checkTipi").click(function (event){
        $.each($(".tipi_checks"), function() {
            $(this).attr('checked','checked')

        })
       event.preventDefault();
    }) 
    $("#uncheckTipi").click(function (event){
        $.each($(".tipi_checks"), function() {
            $(this).attr('checked', false)

        })
       event.preventDefault();
    })
</script>
<?php endif;?>
      </div>

  </div>
