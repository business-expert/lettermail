                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled ponudnikov</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Prikaz ponudnikov</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Naziv ponudnika</th> 
    				<th>Naslov ponudnika</th> 
    				<th>Pošta ponudnika</th> 
    				<th>Kraj ponudnika</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($categories as $category) : ?>
				<tr> 
    				<td><?php echo $category->ponudnik_title;?></td> 
    				<td><?php echo $category->ponudnik_address;?></td> 
    				<td><?php echo $category->ponudnik_zip;?></td> 
    				<td><?php echo $category->ponudnik_city;?></td> 
    				<td><a href="<?php echo base_url();?>admin/viewPonudnik/<?php echo $category->ponudnik_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deletePonudnik/<?php echo $category->ponudnik_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
