
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Rezultati iskanja za "<?php echo $term;?>"</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Rezultati</a></li>
		</ul>
		</header>
                    
                    

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
                            <?php
                            if($type == "users") :
                            ?>
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
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($results as $uporabnik) : ?>
				<tr> 
    				<td><?php echo $uporabnik->user_name;?></td> 
    				<td><?php echo $uporabnik->user_surname;?></td> 
    				<td><?php echo $uporabnik->user_email;?></td> 
    				<td><?php echo $uporabnik->user_phone;?></td> 
    				<td><?php echo $uporabnik->user_address;?></td> 
    				<td><?php echo $uporabnik->user_zip;?></td> 
    				<td><?php echo $uporabnik->user_city;?></td> 
    				<td><?php echo $uporabnik->user_group;?></td> 
    				<td> <a href="<?php echo base_url();?>admin/paymentsUser/<?php echo $uporabnik->user_id;?>" class="buttonLook"> Poglej nakupe</a> <a href="<?php echo base_url();?>admin/viewUporabnik/<?php echo $uporabnik->user_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteUporabnik/<?php echo $uporabnik->user_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
                             <?php
                            elseif($type == "ponudbe"):
                            ?>
			<thead> 
				<tr> 
    				<th>Naziv ponudbe</th> 
    				<th>Ponudnik</th> 
    				<th>Kategorija</th> 
    				<th>Tip</th> 
    				<th>Začetek</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php 
                            foreach($results as $ponudba) : ?>
				<tr> 
    				<td><?php echo $ponudba->offer_name;?></td> 
    				<td><?php echo $ponudba->ponudnik_title;?></td> 
    				<td><?php echo $ponudba->ocategory_title;?></td> 
    				<td><?php echo $ponudba->otype_title;?></td> 
    				<td><?php echo $ponudba->offer_startstamp;?></td> 
                                <td><a href="<?php echo base_url();?>admin/viewOffer/<?php echo $ponudba->offer_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteOffer/<?php echo $ponudba->offer_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a> <a href="<?php echo base_url();?>admin/paymentsOffer/<?php echo $ponudba->offer_id;?>" class="buttonLook"> Poglej nakupe</a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
                             <?php
                            elseif($type == "partnerji"):
                             ?>
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
                            <?php foreach($results as $category) : ?>
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
                            <?php
                            elseif($type == "komercialisti"):
                             ?>
			<thead> 
				<tr> 
    				<th>Ime</th> 
    				<th>Priimek</th> 
    				<th>Mobitel</th> 
    				<th>Email</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($results as $category) : ?>
				<tr> 
    				<td><?php echo $category->k_name;?></td> 
    				<td><?php echo $category->k_surname;?></td> 
    				<td><?php echo $category->k_mobile;?></td> 
    				<td><?php echo $category->k_email;?></td> 
    				<td><a href="<?php echo base_url();?>admin/viewKomer/<?php echo $category->k_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a href="<?php echo base_url();?>admin/deleteKomer/<?php echo $category->k_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
                            <?php
                            elseif($type == "vsebine"):
                             ?>
			<thead> 
				<tr> 
    				<th>Naslov</th> 
    				<th>Žeton</th> 
    				<th>Ustvarjeno</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($results as $category) : ?>
				<tr> 
    				<td><?php echo $category->content_title;?></td> 
    				<td><?php echo $category->content_slug;?></td> 
    				<td><?php echo $category->content_created;?></td> 
    				<td><a href="<?php echo base_url();?>admin/viewContent/<?php echo $category->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a href="<?php echo base_url();?>admin/deleteContent/<?php echo $category->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
                            <?php
                            endif;
                            ?>
                            
			</div><!-- end of #tab1 -->
			
                        
                        
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
