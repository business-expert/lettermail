	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi kategorijo</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/editCategory', $formarr); 
            ?>
                                    <input type="hidden" name="ocategory_id" value="<?php echo $kategorija->ocategory_id;?>">
						<fieldset>
							<label>Naziv kategorije</label>
							<input name="ocategory_title" value="<?php echo $kategorija->ocategory_title;?>" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Žeton kategorije</label>
                                                          <input name="ocategory_slug" value="<?php echo $kategorija->ocategory_slug;?>" type="text">
                                                </fieldset>		

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Shrani kategorijo" class="alt_btn">
				</div>

			</footer>