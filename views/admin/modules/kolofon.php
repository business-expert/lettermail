	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Uredi kolofon</header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open('admin/editKolofon', $formarr); 
            ?>                                             
                                                         <label><strong>Vsebina</strong></label>
							<textarea name="content" id="editor1" ><?php echo $content->text;?></textarea>
                                                		

						<div class="clear"></div>
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Uredi" class="alt_btn">
				</div>

			</footer>
                        
 <script type="text/javascript">
	window.onload = function()
	{
		CKEDITOR.replace( 'editor1' );

	};
</script>