                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3>Pregled vseh nakupov"</h3>

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
                                  <a href="<?php echo base_url();?>admin/cancelPayment/<?php echo $nakup->pay_id;?>/<?php echo $nakup->offer_id;?>"> Storniraj nakup </a>
                                  <?php endif;?>
                                  
                                </td>
				</tr> 
                             <?php endforeach;?>
                                
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
                        
			
		
		</article><!-- end of content manager article -->
		

                
		
