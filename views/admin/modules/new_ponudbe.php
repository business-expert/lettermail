<script type="text/javascript">
          $(document).ready(function() {
                function roundNumber(num, dec) {
                        var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
                        return result;
                }

              $('#offer_value').keyup(function(event) {
                  var popust = $('#offer_discount').val();
                 
                 popust = popust/100;
                 popust = $(this).val() * popust;
                 popust = popust.toFixed(2)
                 popust = popust.toLocaleString();
                 var final_price = $(this).val() - popust;
                 final_price = final_price.toFixed(2)
                 final_price = final_price.toLocaleString();
                 $('#offer_price').val(final_price);
                 $('#offer_save').val(popust);
             })
              $('#offer_discount').keyup(function(event) {
                  var popust = $(this).val();
                 
                 popust = popust/100;
                 popust = $('#offer_value').val() * popust;
                 popust = popust.toFixed(2)
                 popust = popust.toLocaleString();
                 
                 var final_price = $('#offer_value').val() - popust;
                 final_price = final_price.toFixed(2)
                 final_price = final_price.toLocaleString();
                 $('#offer_price').val(final_price);
                 $('#offer_save').val(popust);

             })
             
              $('#offer_price').keyup(function(event) {
                  value = $(this).val();
                  vrednost = $("#offer_value").val();
                  konc   = vrednost - value;
                  konc   = konc.toFixed(2);
                   c = vrednost/value;
                   d = c*100;
                   c = c.toFixed(2);
                  $('#offer_save').val(konc);
                  $('#offer_discount').val(c);
             })
             
             
             $('#offer_provisionoglasnik_percent').keyup(function(event) {
                 var popust = $(this).val();
                 
                 popust = popust/100;
                 popust = $('#offer_price').val() * popust;
                 popust = popust.toFixed(2)
                 var final_price = $('#offer_price').val() - popust;
                 final_price = final_price.toFixed(2)
                 $('#offer_provisionoglasnik').val(popust);

             })       
             $('#offer_provisionoglasnik').keyup(function(event) {
                 var  cena =  $('#offer_price').val();
                 var  prov =  $(this).val();
                 var fcena = prov / cena;
                 fcena = fcena * 100;
                 $('#offer_provisionoglasnik_percent').val(fcena.toFixed(2));


             })        
             
             $('#offer_provision_percent').keyup(function(event) {
                 var popust = $(this).val();
                 
                 popust = popust/100;
                 popust = $('#offer_provisionoglasnik').val() * popust;
                 popust = popust.toFixed(2)
                 var final_price = $('#offer_provisionoglasnik').val() - popust;
                 final_price = final_price.toFixed(2);
                 $('#offer_provision').val(popust);

             })       
             $('#offer_provision').keyup(function(event) {
                 var  cena =  $('#offer_provisionoglasnik').val();
                 var  prov =  $(this).val();
                 var fcena = prov / cena;
                 fcena = fcena * 100;
                 $('#offer_provision_percent').val(fcena.toFixed(2));


             })       
             
         
         $('#prestaviPodatke').live('click', function(event){
              var ponudnik_id = $(".ponudnik").val();
		$.ajax({
			type : 'POST',
			url : '<?php echo base_url();?>admin/checkPonudnikAjax',
			dataType : 'json',
			data: {
				id : ponudnik_id
			},
			success : function(data){
                               $("#offer_address").val(data.naslov);
                               $("#offer_zip").val(data.posta);
                               $("#offer_city").val(data.kraj);
                               $("#offer_email").val(data.email);
                               $("#offer_phone").val(data.telef);
                               $("#offer_fax").val(data.fax);
			}
		});
            event.preventDefault();
	});    
            var numero = 5555;
         $('#addLocation').live('click', function(event){
            var html = '<div id="loc'+numero+'"><hr /><label class="alone" for="offer_address"><strong>Naslov izvedbe:</strong></label>';
                html += '<input name="locations[]" value="'+numero+'" type="hidden">';
                html += '<input  name="address'+numero+'" id="offer_address" style="width:92%;" type="text">';
                html += '<label class="alone" for="offer_city"><strong>Kraj:</strong></label>';
                html += '<input  name="city'+numero+'" id="offer_city" style="width:92%;" type="text">';  
                html += '<label class="alone" for="offer_zip"><strong>Poštna št.:</strong></label>';
                html += '<input  name="zip'+numero+'" id="offer_zip" style="width:92%; margin-bottom: 5px;" type="text">';
                html += '<label class="alone" for="phone"><strong>Telefon:</strong></label>';
                html += '<input  name="phone'+numero+'" id="offer_phone" style="width:92%; margin-bottom: 5px;" type="text">'; 
                html += '<label class="alone" for="offer_worktime"><strong>Delovni čas:</strong></label>';
                html += '<input  name="time'+numero+'" id="offer_worktime" style="width:92%; margin-bottom: 5px;" type="text">';
                html += '<a href="#" style="margin-left: 14px;" place="'+numero+'" class="removeLocation buttonLook">Odstrani lokacijo</a></div>';
                                                                

            $("#addonLocations").append(html);
            numero++;
            event.preventDefault();
	});
        $('.removeLocation').live('click', function(event){
            
              $id = $(this).attr("place");
              $("#loc"+$id).slideToggle('slow', function() {
                  $(this).remove();
              })
              event.preventDefault();
       });
       
       })
         
	$(function() {	
                $( "#date_start" ).datetimepicker({
                    numberOfMonths: 2,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });	
                $( "#date_final" ).datetimepicker({
                    numberOfMonths: 2,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });              
                $( "#date_valid" ).datetimepicker({
                    numberOfMonths: 2,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                    
                });                 
                $( "#date_validuntil" ).datetimepicker({
                    numberOfMonths: 2,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });            

	});
        
	</script>
	<section id="main" class="column">
			
		
		
		<div class="clear"></div>
		
		<article class="module width_full">
			<header><h3>Ustvari novo ponudbo</h3></header>
				<div class="module_content">
            <?php
            $formarr = array('class' => 'offer-form', 'id' => 'offer-form');
            echo form_open_multipart('admin/addOffer', $formarr); 
            ?>

						<fieldset style="background-color: #3868A6; color:#FFF;">
							<label>Naziv ponudbe</label>
							<input name="offer_name" type="text">
						</fieldset>	
						<fieldset style="background-color: #3868A6; color:#FFF;">
                                                         <label>Glava ponudbe</label>
                                                          <input name="offer_head" type="text">
                                                </fieldset>		
						<fieldset style="background-color: #3868A6; color:#FFF;">
							<label>Pod-glava ponudbe</label>
							<input name="offer_subhead" type="text">
						</fieldset>
					
							<label><strong>Povzetek ponudbe</strong></label>
							<textarea name="offer_shortdesc" id="editor1" ></textarea>
							
                                              
							<label><strong>Opis ponudbe</strong></label>
							<textarea name="offer_longdesc" id="editor2" rows="12"></textarea>
								

                                                <fieldset style="background-color: #7DA63F; color:#FFF; width:48%; float:left;margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Vrednost ponudbe v €</label>
                                                <input name="offer_value" id="offer_value" style="width:92%;" type="text">

						</fieldset>	
                                                </fieldset>
                                                	<fieldset style="background-color: #7DA63F; color:#FFF; width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Popust na ponudbo v %</label>
                                                <input name="offer_discount" id="offer_discount" style="width:92%;" type="text">

						</fieldset> 
                                                   	<fieldset style="background-color: #7DA63F; color:#FFF; width:48%; float:left;margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Prihranek v €</label>
                                                <input name="offer_save" id="offer_save" style="width:92%;" type="text">

						</fieldset>	
                                                </fieldset>
                                                	<fieldset style="background-color: #7DA63F; color:#FFF; width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Končno plačilo v €</label>
                                                <input name="offer_price" id="offer_price" style="width:92%;" type="text">

						</fieldset>
                                             <fieldset style="background-color: #ADD0A6; color:#FFF; width:48%; float:left;margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Minimalen nakup kuponov</label>
                                                <input name="offer_minimal"  style="width:92%;" type="text">

						</fieldset>	
                                                </fieldset>
                                                	<fieldset style="background-color: #ADD0A6; color:#FFF; width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Maksimalno število kuponov</label>
                                                          <input name="offer_maximal"  style="width:92%; margin-bottom: 6px;" type="text">
                                                          <label>Maksimalno na osebo</label>
                                                          <input name="offer_maxperson" value=""   style="width:92%;" type="text">
						</fieldset>
                                                <fieldset style="background-color: #F2921D; color:#FFF;width:48%; float:left;margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Začetek ponudbe</label>
                                                <input name="offer_startstamp" id="date_start" style="width:92%;" type="text">

						</fieldset>	
                                                </fieldset>
                                                	<fieldset style="background-color: #F2921D; color:#FFF; width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Konec ponudbe</label>
                                                <input name="offer_endstamp" id="date_final" style="width:92%;" type="text">

						</fieldset>
                                                <fieldset style="background-color: #F2921D; color:#FFF;width:48%; float:left;margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Veljavnost kupona od</label>
                                                <input name="offer_validfrom" id="date_valid" style="width:92%;" type="text">

						</fieldset>	
                                                </fieldset>
                                                	<fieldset style="background-color: #F2921D; color:#FFF; width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Veljavnost kupona do</label>
                                                <input name="offer_validuntil" id="date_validuntil" style="width:92%;" type="text">

						</fieldset>
						<fieldset style="background-color: #BF4F26; color:#FFF; width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Kategorija ponudbe</label>
							<select name="offer_category" style="width:92%;">
                                                            <?php foreach($categories as $category) :?>
                                                            <option value="<?php echo $category->ocategory_id;?>"> <?php echo $category->ocategory_title;?></option>
                                                            <?php endforeach;?>
							</select>
						</fieldset>
						<fieldset style="background-color: #BF4F26; color:#FFF; width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Tip ponudbe</label>
							<select name="offer_type" style="width:92%;">
                                                            <?php foreach($types as $type) :?>
                                                            <option  value="<?php echo $type->otype_id;?>"> <?php echo $type->otype_title;?></option>
                                                            <?php endforeach;?>
							</select>
						</fieldset><div class="clear"></div>	
                                              <fieldset style="background-color: #BF4F26; color:#FFF; width:48%; float:left;margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
                                                    <label>Regija ponudbe</label>
							<select  name="offer_region" style="width:92%;">
                                                         <?php foreach($regije as $regija) :?>
                                                            <option value="<?php echo $regija->region_id;?>"> <?php echo $regija->region_title;?></option>
                                                            <?php endforeach;?>
							</select>
						</fieldset>
                                                <fieldset style="background-color: #1DADF2; color:#FFF; width:48%; float:left; "> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Ponudnik ponudbe</label>
							<select class="ponudnik" name="offer_ponudnik" style="width:92%;">
                                                            <?php foreach($ponudniki as $ponudnik) :?>
                                                            <option value="<?php echo $ponudnik->ponudnik_id;?>"> <?php echo $ponudnik->ponudnik_title;?></option>
                                                            <?php endforeach;?>
							</select>
						</fieldset>       

						<div class="roundedBoxTop roundedBoxBottom" style="margin-right: 3%;background-color: #1DADF2; color:#FFF;  border: 1px solid #CCCCCC; width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
						<label class="alone" for="offer_address"><strong>Naslov izvedbe:</strong></label>
                                                <input name="offer_address" id="offer_address" style="width:92%;" type="text">
                                                <label class="alone" for="offer_city"><strong>Kraj:</strong></label>
                                                <input name="offer_city" id="offer_city" style="width:92%;" type="text">  
                                                <label class="alone" for="offer_zip"><strong>Poštna št.:</strong></label>
                                                <input name="offer_zip" id="offer_zip" style="width:92%; margin-bottom: 5px;" type="text">
                                                <label class="alone" for="offer_email"><strong>Email:</strong></label>
                                                <input name="offer_email" id="offer_email" style="width:92%; margin-bottom: 5px;" type="text">
                                                <label class="alone" for="offer_phone"><strong>Telefonska št.:</strong></label>
                                                <input name="offer_phone" id="offer_phone" style="width:92%; margin-bottom: 5px;" type="text"> 
                                                <label class="alone" for="offer_fax"><strong>Fax.:</strong></label>
                                                <input name="offer_fax" id="offer_fax" style="width:92%; margin-bottom: 5px;" type="text">
                                                <label class="alone" for="offer_worktime"><strong>Delovni čas:</strong></label>
                                                <input name="offer_worktime" id="offer_worktime" style="width:92%; margin-bottom: 5px;" type="text">
                                                <a href="#" style="margin-left: 14px;" id="prestaviPodatke" class="buttonLook"> Kopiraj podatke ponudnika</a>
                                                <a href="#" style="margin-left: 14px;" id="addLocation" class="buttonLook">Dodaj novo lokacijo</a>
                                                <div id="addonLocations"style="background-color: #1DADF2; color:#FFF;">
                                                    
                                                </div>
 
                                                 <br />
                                                <strong><label class="alone" for="offer_featured">Izpostavljena ponudba:</label></strong><br />
                                                <input style="margin-left:14px;" type="radio" checked="checked" name="offer_featured" value="1" /> Da
                                                <input type="radio" name="offer_featured" value="0" /> Ne  
                                                <br />
                                                <?php if($user_status->user_group != "ponudnik") : ?>
                                               <strong><label class="alone" for="offer_active">Ponudba:</label></strong><br />
                                                <input style="margin-left:14px;" type="radio" name="offer_active" value="1" /> Aktivna
                                                <input type="radio" name="offer_active" value="0" /> Neaktivna    
                                                <br />
                                                <?php endif;?>
                                                        <strong><label class="alone" for="offer_lastminute">V zadnjem trenutku:</label></strong><br />
                                                <input style="margin-left:14px;" type="radio" name="offer_lastminute" value="1" /> Da
                                                <input type="radio" name="offer_lastminute" value="0" /> Ne
                                                 <br />
                                                        <strong><label class="alone" for="offer_showdone">Prikaži na strani ko je končana:</label></strong><br />
                                                <input style="margin-left:14px;" type="radio" name="offer_showdone" value="1" /> Da
                                                <input type="radio" name="offer_showdone" value="0" /> Ne
						</div>
                                                 <fieldset style="background-color: #63731B; color: white;width:48%; float:left; "> <!-- to make two field float next to one another, adjust values accordingly -->
                                                       <label>Provizija v % za e-oglasnik</label>
                                                       <input name="offer_provisionoglasnik_percent" id="offer_provisionoglasnik_percent" value="" style="width:92%;  margin-bottom: 5px;" type="text">  
                                                       <label>Provizija v € za e-oglasnik</label>
                                                       <input name="offer_provisionoglasnik" id="offer_provisionoglasnik" value="" style="width:92%; margin-bottom:6px;" type="text"> 
                                                      <label>Komercialist</label>
							<select class="ponudnik" name="offer_commer" style="width:92%; margin-bottom: 5px;">
                                                            <?php foreach($komers as $komer) :?>
                                                            <option value="<?php echo $komer->k_id;?>"> <?php echo $komer->k_name.' '.$komer->k_surname;?></option>
                                                            <?php endforeach;?>
							</select>	
                                                        <label>Provizija v %</label>
                                                       <input name="offer_provision_percent" id="offer_provision_percent" style="width:92%;  margin-bottom: 5px;" type="text">  
                                                       <label>Provizija v €</label>
                                                       <input name="offer_provision" id="offer_provision" style="width:92%;" type="text"> 
						</fieldset> 
                                                
						<fieldset style="background-color: #fff; color:black; width:48%; float:left;  margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label>Fotografije</label>
							<input name="offer_image1" type="file" style="width:92%;"><br />
							<input name="offer_image2" type="file" style="width:92%;"><br />
							<input name="offer_image3" type="file" style="width:92%;"><br />
							<input name="offer_image4" type="file" style="width:92%;">
						</fieldset>
                                               <div  style="width:48%;float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label><strong>Opombe</strong></label>
                                                    <textarea name="offer_notes" id="editor3" style="width:92%;" rows="5"></textarea>
						</div>
                                                
                                                <div class="clear"></div>

                                                
				</div>
			<footer>

				<div class="submit_link">
					<input type="submit" value="Objavi ponudbo" class="alt_btn">
				</div>

			</footer>
 <script type="text/javascript">
	window.onload = function()
	{
		CKEDITOR.replace( 'editor1' );
		CKEDITOR.replace( 'editor2' );	
                CKEDITOR.replace( 'editor3',
	{
		toolbar : 'Basic'
	});

	};
</script>