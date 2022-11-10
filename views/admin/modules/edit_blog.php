	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi vsebino na blogu</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/editBlog', $formarr); 
            ?>
                                       <input type="hidden" name="content_id" value="<?php echo $content->content_id;?>">
						<fieldset>
							<label>Naslov vsebine</label>
							<input name="content_title" value="<?php echo $content->content_title;?>" type="text">
						</fieldset>		            
                                                <fieldset>
                                                         <label>Žeton vsebine</label>
                                                          <input name="content_slug" value="<?php echo $content->content_slug;?>" type="text">
                                                </fieldset>      
                                             
                                                         <label><strong>Vsebina</strong></label>
							<textarea name="content_text" id="editor1" ><?php echo $content->content_text;?></textarea>
                                                		

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Uredi vsebino" class="alt_btn">
				</div>

			</footer>
                        
 <script type="text/javascript">
	window.onload = function()
	{
		CKEDITOR.replace( 'editor1' );

	};
</script>