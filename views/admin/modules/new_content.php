	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari vsebino</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/addContent', $formarr); 
            ?>
						<fieldset>
							<label>Naslov vsebine</label>
							<input name="content_title"  type="text">
						</fieldset>	
						<fieldset>
							<label>Nadmenu</label>
							<select name="content_parent" style="width:92%;">
                                                            <option selected='selected' value="0"> Brez starša </option>
                                                            <?php foreach($parents as $parent) :?>
                                                            <option value="<?php echo $parent->content_id;?>"> <?php echo $parent->content_title;?></option>
                                                            <?php endforeach;?>
							</select>
						</fieldset>	            
                                                <fieldset>
                                                         <label>Žeton vsebine</label>
                                                          <input name="content_slug" type="text">
                                                </fieldset>  
                                                <fieldset>
                                                    <label>Link vsebine</label>
                                                          <input name="content_url" value="<?php echo $content->content_url;?>" type="text">
                                                </fieldset>     
                                             
                                                         <label><strong>Vsebina</strong></label>
							<textarea name="content_text" id="editor1" ></textarea>
                                                		

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Ustvari vsebino" class="alt_btn">
				</div>

			</footer>
                        
 <script type="text/javascript">
	window.onload = function()
	{
		CKEDITOR.replace( 'editor1' );

	};
</script>