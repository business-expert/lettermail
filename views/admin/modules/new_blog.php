	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari vsebino na blogu</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/addBlog', $formarr); 
            ?>
						<fieldset>
							<label>Naslov vsebine</label>
							<input name="content_title"  type="text">
						</fieldset>		            
                                                <fieldset>
                                                         <label>Žeton vsebine</label>
                                                          <input name="content_slug" type="text">
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