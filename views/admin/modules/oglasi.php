                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled oglasov</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Oglasi</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>ID</th> 
    				<th>Naziv</th> 
    				<th>Naročnik</th> 
    				<th>Komercialist</th> 
    				<th>Začetek</th> 
    				<th>Konec</th> 
    				<th>Status</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($oglasi as $o) :
                                
                                if($o->ad_active == "Čaka") :
                                    $color = "#F1A512";
                                elseif ($o->ad_active == "Konec") :
                                    $color = "#FF0000";
                                elseif ($o->ad_active == "Poteka") :
                                    $color = "#89C100";
                                elseif ($o->ad_active == "Obdelaj") :
                                    $color = "#D4B18B";
                                endif;
                                ?>
				<tr> 
    				<td><?php echo $o->ad_id;?></td> 
    				<td><?php echo $o->ad_title;?></td> 
    				<td><?php echo $o->ad_order;?></td> 
    				<td><?php echo $o->k_name." ".$o->k_surname;?></td> 
    				<td><?php echo $o->ad_start;?></td> 
    				<td><?php echo $o->ad_end;?></td> 
    				<td><span style="color: <?php echo $color;?> !important; font-weight: bold;"><?php echo $o->ad_active;?></span></td> 
    				<td><a href="<?php echo base_url();?>admin/viewOglas/<?php echo $o->ad_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteOglas/<?php echo $o->ad_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
