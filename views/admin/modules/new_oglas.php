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
			<header><h3>Ustvari oglas</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open_multipart('admin/addOglas', $formarr); 
            ?>
						<fieldset>
							<label>Naziv oglasa</label>
							<input name="title" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Slika oglasa</label>
							<input name="image" type="file"><br />
						</fieldset>
						<fieldset>
							<label>Začetek</label>
							<input name="start" id="date_start" value="" type="text">
						</fieldset>
                                                <fieldset>
							<label>Konec</label>
							<input name="end" id="date_final" value="" type="text">
						</fieldset>  
                                                <fieldset>
							<label>Naročnik</label>
							<input name="order" value="" type="text">
						</fieldset> 
						<fieldset>
							<label>Komercialist</label>
							<select class="ponudnik" name="commer">
                                                            <?php foreach($komers as $komer) :?>
                                                            <option value="<?php echo $komer->k_id;?>"> <?php echo $komer->k_name.' '.$komer->k_surname;?></option>
                                                            <?php endforeach;?>
							</select>                                                       
						</fieldset>	
                                                     <fieldset>
							<label>URL naslov</label>
							<input name="url" value="" type="text">
						</fieldset>    
                                                <fieldset>
							<label>Dodatni tekst</label>
							<input name="text" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Status</label><br />
                                                        <select name="status">
                                                            <option value="Obdelaj">Obdelaj</option>
                                                            <option value="Poteka">Poteka</option>
                                                            <option value="Čaka">Čaka</option>
                                                            <option value="Konec">Konec</option>
                                                        </select>					
                                                </fieldset>
	

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Ustvari" class="alt_btn">
				</div>

			</footer>