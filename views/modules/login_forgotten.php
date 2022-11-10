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
          <h1> Pozabljeno geslo </h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<?php if($this->session->flashdata('type') != "success") : ?>   
<div id="register-divide" class="border-right">
    <?php 
$atributes = array('class' => 'login_form', 'id' => 'login_form');
echo form_open('login/forgotten_password_send', $atributes); 
?>
<p>
<?php
    echo form_label('E-mail naslov:', 'email');
    echo form_input('email');

 ?>
    </p>
<?php
 
echo '<button class="pass-button" type="submit">Pošlji izgubljeno geslo</button>';
echo form_close(); 
?>
</div>
<?php endif;?>
      </div>

  </div>
