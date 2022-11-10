                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
	<section id="main" class="column">
			
		
                <div style="width:95%; text-align: right;margin-top: 25px; margin-left: 25px; font-size: 13px; font-weight: bold;"> <a href="<?php echo base_url();?>admin/pdfNakupiAll/0"> Generiraj PDF seznam </a></div>
                
                <article class="module width_full">
		<header><h3>Pregled vseh kuponov</h3>
		</header>

			<div id="tabber1">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Št.</th> 
    				<th>Številka kupona</th> 
    				<th>Ponudba</th> 
    				<th>Ime</th> 
    				<th>Priimek</th> 
    				<th>Datum</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php 
                            $cc = 1;
                            foreach($kuponi as $kupon) : 
                                $ponudba = $this->offers_model->detail($kupon->c_offer);
                                ?>
				<tr> 
    				<td><?php echo $cc;?></td> 
    				<td><?php echo $kupon->c_value;?></td> 
    				<td><?php echo $ponudba->offer_name;?></td> 
    				<td><?php echo $kupon->user_name;?></td> 
    				<td><?php echo $kupon->user_surname;?></td> 
    				<td><?php echo $kupon->c_generated;?></td> 
    				<td><a href="<?php echo base_url()."admin/couponPrint/".$ponudba->offer_id."/".$kupon->c_id."";?>">Natisni</a></td> 

				</tr> 
                             <?php
                             $cc++;
                             endforeach;?>
                                
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->			
		
		</article><!-- end of content manager article -->
                
                <div style="width:95%; text-align: right; margin-top: 15px; margin-left: 25px; font-size: 13px; font-weight: bold;"> <a href="<?php echo base_url();?>admin/pdfNakupiAll/0"> Generiraj PDF seznam </a></div>
		
