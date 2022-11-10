              <article class="module width_full">
		<header>
                    <?php if($all == 0) :?>
                    <h3>Pregled kuponov za ponudbo "<?php echo $ponudba->offer_name;?>", do dne <?php echo date("h:m:s d.m.Y");?></h3>
                    <?php
                    else :
                        ?>
                    <h3>Pregled vseh kuponov, do dne <?php echo date("h:m:s d.m.Y");?></h3>
                    <?php
                    endif;?>
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
    				<td width="360px;"><?php echo $ponudba->offer_name;?></td> 
    				<td><?php echo $kupon->user_name;?></td> 
    				<td><?php echo $kupon->user_surname;?></td> 
    				<td><?php echo $kupon->c_generated;?></td> 

				</tr> 
                             <?php
                             $cc++;
                             endforeach;?>
                                
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->		