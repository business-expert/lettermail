	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari uporabnika</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/saveUporabnik', $formarr); 
            ?>
						<fieldset>
							<label>Ime</label>
							<input name="user_name" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Priimek</label>
							<input name="user_surname" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Email</label>
							<input name="user_email" value="" type="text">
						</fieldset>
                                                <fieldset>
							<label>Telefon</label>
							<input name="user_phone" value="" type="text">
						</fieldset>  
                                                <fieldset>
							<label>Naslov</label>
							<input name="user_address" value="" type="text">
						</fieldset>   
                                                     <fieldset>
							<label>Kraj</label>
							<input name="user_city" value="" type="text">
						</fieldset>    
                                                <fieldset>
							<label>Pošta</label>
							<input name="user_zip" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Geslo</label>
							<input name="user_password" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Funkcija uporabnika</label>
                                                        <select name="user_group">
                                                            <option value="pentadmin">Pentadmin</option>
                                                            <option value="urednik">Urednik</option>
                                                            <option value="urednik">Ponudnik</option>
                                                        </select>
						</fieldset>	
	

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Shrani" class="alt_btn">
				</div>

			</footer>