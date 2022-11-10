  <script>
  $(document).ready(function(){
    $("#register-form").validate({       
    rules: {
        email: {
            required: true,
            email: true
        },    
        geslo: {
            required: true
        } 
    }});
    
  });
  </script> 
<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">
          <h1> Prijava </h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<div id="register-divide" class="border-right">
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

<input type="submit" name="submit" class="register-button" value="Prijava!"  />
<br /><br />
Ste pozabili geslo? <a class="green-small" href="<?php echo base_url();?>login/forgotten_password"> Pošlji izgubljeno geslo</a>!<br />
Še nimate računa? Registrirajte se <a class="green-small" href="<?php echo base_url();?>registracija">tukaj</a>!<br />
<?php
echo form_close();
?>

      </div>

  </div>
