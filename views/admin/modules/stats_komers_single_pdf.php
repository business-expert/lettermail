<section id="main" class="column">
    
		<article class="module width_full">
			<header><h1>Poročilo uspešnosti za "<?php echo $komer->k_name." ".$komer->k_surname;?>", za obdobje od <?php echo $od;?> do <?php echo $do; ?></h3></header>
			<div class="module_content">
                            <h2>Komercialist: <?php echo $komer->k_name." ".$komer->k_surname;?></h1>
                            <div align="left" style="float:left; width: auto;">                               
Št. prodanih:  <strong><?php echo $kupljenih;?></strong><br />
Št. rezerviranih:<strong> <?php echo $rezerviranih;?></strong><br />
Skupaj:<strong> <?php echo $kupljenih+$rezerviranih;?></strong><br />
Realizacija: <strong><?php echo $realizacija;?>€</strong><br />
RVC: <strong><?php echo $rvc;?>€</strong><br />
                            </div>
 
		<article class="module width_full">
		<header><h3>Pregled nakupov v izbranem obdobju</h3>
		</header>
			<div id="tabber1">
			<table class="tablesorter" cellspacing="0"> 
			<thead style="background-color: rgb(212, 208, 200);"> 
				<tr> 
    				<th>Ime</th> 
    				<th>Priimek</th> 
    				<th>Ponudba</th> 
    				<th>Količina</th> 
    				<th>Datum</th> 
    				<th>Način plačila</th> 
    				<th>Status</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php 
                            foreach($nakupi as $nakup) : ?>
				<tr> 
    				<td><?php echo $nakup->user_name;?></td> 
    				<td><?php echo $nakup->user_surname;?></td> 
    				<td><?php echo $nakup->offer_name;?></td> 
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
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
                        
			
		
		</article><!-- end of content manager article -->	
                <article class="module width_full">
		<header><h3>Pregled ponudb komercialista</h3>

		</header>

			<div id="tabber2">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Naziv ponudbe</th> 
    				<th>Ponudnik</th> 
    				<th>Kategorija</th> 
    				<th>Tip</th> 
    				<th>Začetek</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php 
                            foreach($ponudbe as $ponudba) : ?>
				<tr> 
    				<td><?php echo $ponudba->offer_name;?></td> 
    				<td><?php echo $ponudba->ponudnik_title;?></td> 
    				<td><?php echo $ponudba->ocategory_title;?></td> 
    				<td><?php echo $ponudba->otype_title;?></td> 
    				<td><?php echo $ponudba->offer_startstamp;?></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
                        
		</article><!-- end of content manager article -->
       

</section>