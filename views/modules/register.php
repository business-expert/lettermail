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
<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">
          <h1> Registracija </h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<?php if($this->session->flashdata('type') != "success") : ?>   
<div id="register-divide">
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

<input type="submit" name="submit" class="register-button" value="Registracija!"  />
<br /><br />
Polja označena z <em>*</em> so obvezna! Registracija vam omogoča kupovanje  kuponov e-oglasnika.
<?php
echo form_close();
?>
<?php endif;?>
      </div>

  </div>
