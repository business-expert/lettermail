	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi ponudnika</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/editPonudnik', $formarr); 
            ?>                                  
                                    <input type="hidden" name="ponudnik_id" value="<?php echo $kategorija->ponudnik_id;?>">

						<fieldset>
							<label>Naziv ponudnika</label>
							<input name="ponudnik_title"  value="<?php echo $kategorija->ponudnik_title;?>"  type="text">
						</fieldset>
                                                <fieldset>
							<label>Uporabnik e-oglasnika</label>
                                                        <select name="ponudnik_user">
                                                            <option selected="selected" value="0">Izberite ponudnika...</option>
                                                            <?php foreach($ponudniki as $ponudnik) :?>
                                                            <option <?php if($ponudnik->user_id == $kategorija->ponudnik_user): echo "selected='selected'"; endif;?> value="<?php echo $ponudnik->user_id;?>"> <?php echo $ponudnik->user_name." ".$ponudnik->user_surname;?> </option> 
                                                            <?php endforeach;?>
                                                        </select>
						</fieldset>	
                                                <fieldset>
                                                         <label>Naslov ponudnika</label>
                                                          <input name="ponudnik_address"  value="<?php echo $kategorija->ponudnik_address;?>" type="text">
                                                </fieldset>	
                                               <fieldset>
                                                         <label>Pošta ponudnika</label>
                                                          <input name="ponudnik_zip"  value="<?php echo $kategorija->ponudnik_zip;?>" type="text">
                                                </fieldset>	
                                                <fieldset>
                                                         <label>Kraj ponudnika</label>
                                                          <input name="ponudnik_city"  value="<?php echo $kategorija->ponudnik_city;?>" type="text">
                                                </fieldset>
                                                 <fieldset>
                                                         <label>Država</label>
                                                          <input name="ponudnik_country" value="<?php echo $kategorija->ponudnik_country;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>TRR</label>
                                                          <input name="ponudnik_trr" value="<?php echo $kategorija->ponudnik_trr;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Telefon</label>
                                                          <input name="ponudnik_phone" value="<?php echo $kategorija->ponudnik_phone;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Fax</label>
                                                          <input name="ponudnik_fax" value="<?php echo $kategorija->ponudnik_fax;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>GSM</label>
                                                          <input name="ponudnik_gsm" value="<?php echo $kategorija->ponudnik_gsm;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Zakoniti zastopnik</label>
                                                          <input name="ponudnik_legal" value="<?php echo $kategorija->ponudnik_legal;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Kontaktna oseba</label>
                                                          <input name="ponudnik_person" value="<?php echo $kategorija->ponudnik_person;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Davčni zavezanec</label>
                                                         <input type="radio" name="ponudnik_davc" <?php if($kategorija->ponudnik_davc == 1): echo "checked='checked'"; endif;?> value="1"> Da <br/>
                                                         <input type="radio" name="ponudnik_davc" <?php if($kategorija->ponudnik_davc == 0): echo "checked='checked'"; endif;?> value="0"> Ne <br/>
                                                </fieldset>
                                                <fieldset>
                                                         <label>Matična številka</label>
                                                          <input name="ponudnik_mat" value="<?php echo $kategorija->ponudnik_mat;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Davčna številka</label>
                                                          <input name="ponudnik_tax" value="<?php echo $kategorija->ponudnik_tax;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>Spletna stran</label>
                                                          <input name="ponudnik_url" value="<?php echo $kategorija->ponudnik_url;?>" type="text">
                                                </fieldset>
                                                <fieldset>
                                                         <label>E-pošta</label>
                                                          <input name="ponudnik_email" value="<?php echo $kategorija->ponudnik_email;?>" type="text">
                                                </fieldset>
						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Shrani ponudnika" class="alt_btn">
				</div>

			</footer>