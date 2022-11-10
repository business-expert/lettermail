	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari tip ponudbe</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/addType', $formarr); 
            ?>
						<fieldset>
							<label>Naziv tipa</label>
							<input name="otype_title" type="text">
						</fieldset>	
                                                <fieldset>
                                                         <label>Žeton tipa</label>
                                                          <input name="otype_slug" type="text">
                                                </fieldset>		

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Ustvari tip" class="alt_btn">
				</div>

			</footer>