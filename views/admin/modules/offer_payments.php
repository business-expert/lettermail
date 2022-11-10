                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3>Pregled nakupov ponudbe "<?php echo $ponudba->offer_name;?>"</h3>

		</header>

			<div id="tab1">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Ime</th> 
    				<th>Priimek</th> 
    				<th>Količina</th> 
    				<th>Datum</th> 
    				<th>Način plačila</th> 
    				<th>Status</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($nakupi as $nakup) : ?>
				<tr> 
    				<td><?php echo $nakup->user_name;?></td> 
    				<td><?php echo $nakup->user_surname;?></td> 
    				<td><?php echo $nakup->qty;?></td> 
    				<td><?php echo $nakup->date;?></td> 
    				<td><?php echo $nakup->pay_option;?></td> 
    				<td><?php           
                                  if($nakup->pay_status == 0)
                                  {
                                      echo "Rezervirano";
                                  }
                                  elseif ($nakup->pay_status == 1)
                                  {
                                      echo "Opravljeno";
                                  }
                                  elseif ($nakup->pay_status == 2)
                                  {
                                      echo "Preklicano";
                                  }
                                  ?></td> 
                                <td>
                                    <?php
                                   if($nakup->pay_status == 0) :?>
                                  <a href="<?php echo base_url();?>admin/confirmPayment/<?php echo $nakup->pay_id;?>/<?php echo $nakup->offer_id;?>"> Potrdi nakup </a>
                                  <?php elseif($nakup->pay_status == 1) : ?>
                                  <a href="<?php echo base_url();?>admin/cancelPayment/<?php echo $nakup->pay_id;?>/<?php echo $nakup->offer_id;?>"> Storniraj nakup </a> | | <a href="<?php echo base_url();?>admin/couponPDF/<?php echo $nakup->pay_id;?>/<?php echo $nakup->offer_id;?>"> PDF </a>
                                  <?php endif;?>
                                  
                                </td>
				</tr> 
                             <?php endforeach;?>
                                
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
                        
			
		
		</article><!-- end of content manager article -->
		
                <div style="width:95%; text-align: right;margin-top: 25px; margin-left: 25px; font-size: 13px; font-weight: bold;"> <a href="<?php echo base_url();?>admin/pdfNakupi/<?php echo $ponudba->offer_id;?>"> Generiraj PDF seznam </a></div>
                
                <article class="module width_full">
		<header><h3>Pregled kuponov za ponudbo "<?php echo $ponudba->offer_name;?>"</h3>
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
                            foreach($kuponi as $kupon) : ?>
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
                
                <div style="width:95%; text-align: right; margin-top: 15px; margin-left: 25px; font-size: 13px; font-weight: bold;"> <a href="<?php echo base_url();?>admin/pdfNakupi/<?php echo $ponudba->offer_id;?>"> Generiraj PDF seznam </a></div>
		
