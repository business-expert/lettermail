                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled uporabnikov</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Prikaz uporabnikov</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Ime</th> 
    				<th>Priimek</th> 
    				<th>Email</th> 
    				<th>Tel.</th> 
    				<th>Naslov</th> 
    				<th>Kraj</th> 
    				<th>Pošta</th> 
    				<th>Vloga</th> 
    				<th>Zadnja aktivnost</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($uporabniki as $uporabnik) : ?>
				<tr> 
    				<td><?php echo $uporabnik->user_name;?></td> 
    				<td><?php echo $uporabnik->user_surname;?></td> 
    				<td><?php echo $uporabnik->user_email;?></td> 
    				<td><?php echo $uporabnik->user_phone;?></td> 
    				<td><?php echo $uporabnik->user_address;?></td> 
    				<td><?php echo $uporabnik->user_zip;?></td> 
    				<td><?php echo $uporabnik->user_city;?></td> 
    				<td><?php echo $uporabnik->user_group;?></td> 
    				<td><?php echo $uporabnik->user_lastlogin;?></td> 
    				<td> <a href="<?php echo base_url();?>admin/paymentsUser/<?php echo $uporabnik->user_id;?>" class="buttonLook"> Poglej nakupe</a> <a href="<?php echo base_url();?>admin/viewUporabnik/<?php echo $uporabnik->user_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteUporabnik/<?php echo $uporabnik->user_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
