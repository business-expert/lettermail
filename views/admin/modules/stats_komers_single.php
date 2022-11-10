    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Vrsta');
  data.addColumn('number', 'Nakupov');
  data.addRows(2);
  data.setValue(0, 0, 'Rezerviranih kuponov');
  data.setValue(0, 1, <?php echo $rezerviranih;?>);
  data.setValue(1, 0, 'Potrjenih kuponov');
  data.setValue(1, 1, <?php echo $kupljenih;?>);

var options = {
  width: 500, height: 310,
  title: 'Realizacija kuponov v obdobju od <?php echo $od;?> do <?php echo $do; ?>',
  is3D: true, colors:['orange','#b60707']
};

  // Create and draw the visualization.
  new google.visualization.PieChart(document.getElementById('visualization')).
      draw(data,options);
}
</script>
<section id="main" class="column">
    
		<article class="module width_full">
			<header><h3>Poročilo uspešnosti za "<?php echo $komer->k_name." ".$komer->k_surname;?>", za obdobje od <?php echo $od;?> do <?php echo $do; ?></h3></header>
			<div class="module_content">
                            <h1>Komercialist: <?php echo $komer->k_name." ".$komer->k_surname;?></h1>
				<article class="stats_graph" id="visualization">

                                </article>
				
				<article class="stats_overview">                                   
                                    
                                    <div class="overview_today">
						<p class="overview_day"></p>
						<p class="overview_count"><?php echo $kupljenih;?></p>
						<p class="overview_type">Št. prodanih</p>
						<p class="overview_count"><?php echo $realizacija;?>€</p>
						<p class="overview_type">Realizacija</p>
					</div>
					<div class="overview_previous">
						<p class="overview_day"></p>
						<p class="overview_count"><?php echo $rezerviranih;?></p>
						<p class="overview_type">Št. rezerviranih</p>
						<p class="overview_count"><?php echo $rvc;?>€</p>
						<p class="overview_type">RVC</p>
					</div>
                                    <form action="<?php echo base_url("admin/pdfStatKomer");?>" name="stats" method="post">

                            <input type="hidden" value="<?php echo $od;?>" name="start">			
                            <input type="hidden" id="date_start"  value="<?php echo $do;?>" name="end">			
                            <input type="hidden" id="date_end"  value="<?php echo $komer->k_id;?>" name="commer">       
                            <input type="submit" value="Generiraj poročilo v PDF" style="width:232px; text-align: center;" class="pdfgenerate">
                                    </form> 
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
                
		<article class="module width_full">
		<header><h3>Pregled nakupov v izbranem obdobju</h3>
		</header>
			<div id="tabber1">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
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
    				<th>Možnosti</th> 
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
                                <td><a href="<?php echo base_url();?>admin/viewOffer/<?php echo $ponudba->offer_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteOffer/<?php echo $ponudba->offer_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a> <a href="<?php echo base_url();?>admin/paymentsOffer/<?php echo $ponudba->offer_id;?>" class="buttonLook"> Poglej nakupe</a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
                        
		</article><!-- end of content manager article -->
		

</section>