
<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">
      <h1>Naroči se na obveščanje o ponudbi</h1>
      <h1><?php echo $ponudba->offer_head;?></h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<?php if($this->session->flashdata('type') != "success") : ?>   

<div id="register-divide" style="margin-top: -15px;">
    <?php 
$atributes = array('class' => 'login_form', 'id' => 'login_form');
echo form_open('ponudbe/addObvesti/'.$id.'', $atributes); 
?>
<p>
<?php
    echo form_label('E-mail naslov:', 'email');
    echo form_input('email');

 ?>
    </p>
<?php
 
echo '<button class="pass-button" type="submit">Naroči se!</button>';
echo form_close(); 
?>
</div>
      <?php endif;?>
      </div>

  </div>
