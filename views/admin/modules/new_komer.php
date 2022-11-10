	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari komercialista</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/addKomer', $formarr); 
            ?>
						<fieldset>
							<label>Ime</label>
							<input name="ime" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Priimek</label>
                                                          <input name="priim" type="text">
                                                </fieldset>	
                                    		<fieldset>
							<label>Številka mobilnega telefona</label>
							<input name="mobi" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Telefonska številka</label>
                                                          <input name="tel" type="text">
                                                </fieldset>
                                    		<fieldset>
							<label>Fax</label>
							<input name="fax" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>E-mail</label>
                                                          <input name="mail" type="text">
                                                </fieldset>
                                    						<fieldset>
							<label>Skype</label>
							<input name="skype" type="text">
						</fieldset>	
                                                <fieldset>
                                                    <input type="radio" name="employed" value="Zaposlen">Zaposlen<br>
                                                    <input type="radio" name="employed" value="Pogodbeni sodelavec" checked>Pogodbeni sodelavec<br>
                                                </fieldset>
                                    		<fieldset>
							<label>Številka pogodbe</label>
							<input name="contract" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Datum začetka sodelovanja</label>
                                                          <input name="start" type="text">
                                                </fieldset>
                                    						<fieldset>
							<label>Datum konca sodelovanja</label>
							<input name="end" type="text">
						</fieldset>	


						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Ustvari komercialista" class="alt_btn">
				</div>

			</footer>