                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled pogodb</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Pogodbe</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>ID</th> 
    				<th>Ponudba</th> 
    				<th>Partner</th> 
    				<th>Datum pogodbe</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($pogodbe as $category) : ?>
				<tr> 
    				<td><?php echo $category->c_id;?></td> 
    				<td><?php echo $category->offer_name;?></td> 
    				<td><?php echo $category->ponudnik_title;?></td> 
    				<td><?php echo $category->c_datum;?></td> 
    				<td><a href="<?php echo base_url();?>admin/genPogodbaUrl/<?php echo $category->ponudnik_id;?>/<?php echo $category->offer_id;?>/<?php echo $category->c_datum;?>" class="buttonLook"> PDF </a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deletePogodba/<?php echo $category->c_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
