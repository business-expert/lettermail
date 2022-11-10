                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
	<section id="main" class="column">
<script>
    $(function() {
            $( "#dialog" ).dialog({ autoOpen: false, minWidth: 400 })
    });
    $(document).ready(function(){
        
        $(".previewOffer").live('click', function(e) {
            $("#previewLink").attr("value", $(this).attr("link"));
            $( "#dialog" ).dialog('open');
            e.preventDefault();
        })
        
    });
</script>
<div id="dialog" title="Predogled ponudbe">
	<input id="previewLink" style="width: 95%; height: 40px; padding: 5px;"/>
</div>
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled vseh ponudb</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Vse ponudbe</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Glava ponudbe</th> 
    				<th>Ponudnik</th> 
    				<th>Kategorija</th> 
    				<th>Tip</th> 
    				<th>Začetek</th> 
    				<th>Konec</th> 
    				<th>Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php 
                            foreach($ponudbe as $ponudba) : ?>
				<tr> 
    				<td><?php echo $ponudba->offer_head;?></td> 
    				<td><?php echo $ponudba->ponudnik_title;?></td> 
    				<td><?php echo $ponudba->ocategory_title;?></td> 
    				<td><?php echo $ponudba->otype_title;?></td> 
    				<td><?php echo $ponudba->offer_startstamp;?></td> 
    				<td><?php echo $ponudba->offer_endstamp;?></td> 
                                <td>
                                <a style="font-size: 12px !important; width: 95% !important; text-align: center;" href="<?php echo base_url();?>admin/viewOffer/<?php echo $ponudba->offer_id;?>" class="buttonLook"> Uredi</a> 
                                <a style="font-size: 12px !important; width: 95% !important; text-align: center;" onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')"  href="<?php echo base_url();?>admin/deleteOffer/<?php echo $ponudba->offer_id;?>" class="buttonLook">Izbriši</a><br /> 
                                <a style="font-size: 12px !important; width: 95% !important; text-align: center;" href="<?php echo base_url();?>admin/paymentsOffer/<?php echo $ponudba->offer_id;?>" class="buttonLook"> Poglej nakupe</a><br />
                                <a style="font-size: 12px !important; width: 95% !important; text-align: center;" href="<?php echo base_url();?>admin/copyOffer/<?php echo $ponudba->offer_id;?>" class="buttonLook"> Kopiraj ponudbo</a>
                                <a style="font-size: 12px !important; width: 95% !important; text-align: center;" href="#" link="<?php echo base_url();?>predogled/<?php echo $ponudba->offer_id;?>" class="buttonLook previewOffer"> Predogled ponudbe</a></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
                        
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
