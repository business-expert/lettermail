	<section id="main" class="column">
         <script type="text/javascript">		
	$(function() {	
                $( "#date_start" ).datepicker({
                    numberOfMonths: 2,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });	
                $( "#date_final" ).datepicker({
                    numberOfMonths: 2,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });              
           

	});
	</script>	
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi oglas <?php echo $oglas->ad_title;?></h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open_multipart('admin/saveOglas', $formarr); 
            ?>
                                    <input type="hidden" name="oglas_id" value="<?php echo $oglas->ad_id;?>">
						<fieldset>
							<label>Naziv oglasa</label>
							<input name="title" value="<?php echo $oglas->ad_title;?>" type="text">
						</fieldset>
						<fieldset>
							<label>Slika oglasa</label>
							<input name="image" type="file"><br /><br />
                                                        <img style="margin-left:10px; margin-top: 15px;" src="<?php if(!empty($oglas->ad_image)) : echo base_url();?>thumb.php?h=180&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $oglas->ad_image; endif;?>"><br />
                                                        <?php if(!empty($oglas->ad_image)) :?><input type="radio" value="1" name="imageDelete"> Izbris slike<?php endif;?>
						</fieldset>
						<fieldset>
							<label>Začetek</label>
							<input name="start" id="date_start" value="<?php echo $oglas->ad_start;?>" type="text">
						</fieldset>
                                                <fieldset>
							<label>Konec</label>
							<input name="end" id="date_final" value="<?php echo $oglas->ad_end;?>" type="text">
						</fieldset>  
                                                <fieldset>
							<label>Naročnik</label>
							<input name="order" value="<?php echo $oglas->ad_order;?>" type="text">
						</fieldset> 
						<fieldset>
							<label>Komercialist</label>
							<select class="ponudnik" name="commer">
                                                            <?php foreach($komers as $komer) :?>
                                                            <option <?php if($oglas->ad_komer == $komer->k_id) { echo "selected='selected'"; } ?>  value="<?php echo $komer->k_id;?>"> <?php echo $komer->k_name.' '.$komer->k_surname;?></option>
                                                            <?php endforeach;?>
							</select>                                                       
						</fieldset>	
                                                     <fieldset>
							<label>URL naslov</label>
							<input name="url" value="<?php echo $oglas->ad_url;?>" type="text">
						</fieldset>    
                                                <fieldset>
							<label>Dodatni tekst</label>
							<input name="text" value="<?php echo $oglas->ad_text;?>" type="text">
						</fieldset>
						<fieldset>
							<label>Status</label><br />
                                                        <select name="status">
                                                            <option <?php if($oglas->ad_active == "Obdelaj") echo "selected='selected'";?> value="Obdelaj">Obdelaj</option>
                                                            <option <?php if($oglas->ad_active == "Poteka") echo "selected='selected'";?> value="Poteka">Poteka</option>
                                                            <option <?php if($oglas->ad_active == "Čaka") echo "selected='selected'";?> value="Čaka">Čaka</option>
                                                            <option <?php if($oglas->ad_active == "Konec") echo "selected='selected'";?> value="Konec">Konec</option>
                                                        </select>						</fieldset>
	

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Shrani" class="alt_btn">
				</div>

			</footer>