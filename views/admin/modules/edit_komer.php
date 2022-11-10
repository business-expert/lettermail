	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi komercialista</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/editKomer', $formarr); 
            ?>
                                    <input type="hidden" name="k_id" value="<?php echo $kategorija->k_id;?>">
						<fieldset>
							<label>Ime</label>
							<input name="ime" value="<?php echo $kategorija->k_name;?>" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Priimek</label>
                                                          <input name="priim" value="<?php echo $kategorija->k_surname;?>" type="text">
                                                </fieldset>
                                    		<fieldset>
							<label>Številka mobilnega telefona</label>
							<input name="mobi" value="<?php echo $kategorija->k_mobile;?>" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Telefonska številka</label>
                                                          <input name="tel" value="<?php echo $kategorija->k_phone;?>" type="text">
                                                </fieldset>
                                    		<fieldset>
							<label>Fax</label>
							<input name="fax" value="<?php echo $kategorija->k_fax;?>" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>E-mail</label>
                                                          <input name="mail" value="<?php echo $kategorija->k_email;?>" type="text">
                                                </fieldset>
                                    						<fieldset>
							<label>Skype</label>
							<input name="skype" value="<?php echo $kategorija->k_skype;?>" type="text">
						</fieldset>	
                                                <fieldset>
                                                    <input type="radio" name="employed" value="Zaposlen" <?php if($kategorija->k_employed == "Zaposlen") : echo "checked"; else: echo ""; endif;?>>Zaposlen<br>
                                                    <input type="radio" name="employed" value="Pogodbeni sodelavec" <?php if($kategorija->k_employed == "Pogodbeni sodelavec") : echo "checked"; else: echo ""; endif;?>>Pogodbeni sodelavec<br>
                                                </fieldset>
                                    		<fieldset>
							<label>Številka pogodbe</label>
							<input name="contract" value="<?php echo $kategorija->k_contract;?>" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Datum začetka sodelovanja</label>
                                                          <input name="start" value="<?php echo $kategorija->k_start;?>" type="text">
                                                </fieldset>
                                    						<fieldset>
							<label>Datum konca sodelovanja</label>
							<input name="end" value="<?php echo $kategorija->k_end;?>" type="text">
						</fieldset>

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Shrani komercialista" class="alt_btn">
				</div>

			</footer>