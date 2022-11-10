	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi uporabnika <?php echo $user->user_name." ".$user->user_surname;?></h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/saveUser', $formarr); 
            ?>
                                    <input type="hidden" name="user_id" value="<?php echo $user->user_id;?>">
						<fieldset>
							<label>Ime</label>
							<input name="user_name" value="<?php echo $user->user_name;?>" type="text">
						</fieldset>
						<fieldset>
							<label>Priimek</label>
							<input name="user_surname" value="<?php echo $user->user_surname;?>" type="text">
						</fieldset>
						<fieldset>
							<label>Email</label>
							<input name="user_email" value="<?php echo $user->user_email;?>" type="text">
						</fieldset>
                                                <fieldset>
							<label>Telefon</label>
							<input name="user_phone" value="<?php echo $user->user_phone;?>" type="text">
						</fieldset>  
                                                <fieldset>
							<label>Naslov</label>
							<input name="user_address" value="<?php echo $user->user_address;?>" type="text">
						</fieldset>   
                                                     <fieldset>
							<label>Kraj</label>
							<input name="user_city" value="<?php echo $user->user_city;?>" type="text">
						</fieldset>    
                                                <fieldset>
							<label>Pošta</label>
							<input name="user_zip" value="<?php echo $user->user_zip;?>" type="text">
						</fieldset>
						<fieldset>
							<label>Geslo</label>
							<input name="user_password" value="" type="text">
						</fieldset>
						<fieldset>
							<label>Funkcija uporabnika</label>
                                                        <select name="user_group">
                                                            <option <?php if($user->user_group == "pentadmin") echo "selected='selected'";?> value="pentadmin">Pentadmin</option>
                                                            <option <?php if($user->user_group == "urednik") echo "selected='selected'";?> value="urednik">Urednik</option>
                                                            <option <?php if($user->user_group == "ponudnik") echo "selected='selected'";?> value="urednik">Ponudnik</option>
                                                        </select>
						</fieldset>	
	

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Shrani" class="alt_btn">
				</div>

			</footer>