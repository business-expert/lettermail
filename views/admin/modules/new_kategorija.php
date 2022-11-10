	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari kategorijo</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/addCategory', $formarr); 
            ?>
						<fieldset>
							<label>Naziv kategorije</label>
							<input name="ocategory_title"  type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Žeton kategorije</label>
                                                          <input name="ocategory_slug" type="text">
                                                </fieldset>		

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Ustvari kategorijo" class="alt_btn">
				</div>

			</footer>