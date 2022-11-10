    


    <div id="main-ponudba-single"> 
        <div id="main-obroc">
       <!--
       <div id="prevOffer">
             &nbsp; 
        </div>  
        <div id="nextOffer">
             &nbsp;    
        </div>
       -->
                 
            <?php 
        $counter = 5;    
                
        $start = $ponudba->offer_startstamp;
        $end = $ponudba->offer_endstamp;
        $start = strtotime($start);
        $end = strtotime($end);
        $current = date("Y-m-d H:s:i");
        $current = strtotime($current);




        $percentage = ($current-$start)/($end-$start);



        $prodanih = $this->offers_model->count_selled($ponudba->offer_id);
     ?>
 
            
        <div id="main-ponudba-inner">
            <div style="width: 330px; text-align: right;"><img src="<?php echo base_url();?>assets/images/fb-ponudba.png" style="margin-right: 5px;"/><img src="<?php echo base_url();?>assets/images/tw-ponudba.png" style="margin-right: 5px;"/><img src="<?php echo base_url();?>assets/images/m-ponudba.png"/></div>
               <div class="deal-image-main imgpost" id="product-images">
                   <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=340&w=305&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>thumb.php?h=340&q=100&w=305&src=<?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>" class="imgpost">
                          
                  <?php if(!empty($ponudba->offer_image2)) : ?>
                   <img src="<?php echo base_url();?>thumb.php?h=340&q=100&w=305&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image2;?>" class="imgpost">
                           <?php endif; ?>
                           
                 <?php if(!empty($ponudba->offer_image3)) : ?>
                          <img src="<?php echo base_url();?>thumb.php?h=340&q=100&w=305&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image3;?>" class="imgpost"> 
                          <?php endif; ?>
                          
                 <?php if(!empty($ponudba->offer_image4)) : ?>
                          <img src="<?php echo base_url();?>thumb.php?h=340&w=305&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image4;?>" class="imgpost"> 
                           <?php endif; ?>

                          
                  </div>
                  <div id="nav-product"></div>       
                      
        </div>
        <div id="main-ponudba-inner-right-smaller">
            <h1> <?php echo $ponudba->offer_head;?></h1>
            <h2> <?php echo $ponudba->offer_subhead;?></h2>
            <div class="tabela-cen-single">          
				<div class="column-cen first-single"><strong>VREDNOST</strong><div class="price-single"><?php echo $ponudba->offer_value;?> €</div></div>
				<div class="column-cen first-single"><strong>POPUST</strong><div class="price-single"><?php echo $ponudba->offer_discount;?> %</div></div>
				<div class="column-cen first-single"><strong>PRIHRANEK</strong><div class="price-single"><?php echo $ponudba->offer_save;?> €</div></div>
				<div class="column-cen final-single"><span class="price-final-single"><?php echo $ponudba->offer_price;?> €</span> </div>

            </div>
			<div class="nakupi-table">
			
			<div class="nakup-cen third"><span class="greenNakup"><?php echo $prodanih;?></span> <?php if($ponudba->offer_maximal > 1) :?> <span style="color:#5F736F; font-size: 30px;"> / </span> <span class="greenNakup"><?php echo $ponudba->offer_maximal;?></span> <?php endif;?><br /><div class="greenNakupBottom">prodanih <?php if($ponudba->offer_maximal == 0) :?>kuponov<?php endif;?> <?php if($ponudba->offer_maximal > 0) :?>  / razpoložljivih kuponov<?php endif;?>  <br /><?php if($ponudba->offer_maximal >= $prodanih) :?>Lahko še nakupujete!<?php else :?>kuponi so pošli! <?php endif;?></div></div>
			<div class="nakup-cen fourth"><a href="<?php echo base_url();?>kupi/<?php echo $ponudba->offer_id;?>/gift"><img src="<?php echo base_url();?>assets/images/friend.png" alt="Podari prijatelju"></a></div>
			<div class="nakup-cen last-nakup"><a href="<?php echo base_url();?>kupi/<?php echo $ponudba->offer_id;?>" class="btn_mediumgray3">NAKUP</a></div>

			</div>
                                                         
                                                         
                                                       <span class="progressBar" id="main-deal"></span>
                                                        <style>
                                                        .ui-progressbar { width: 100%;}
                                                        </style>
                                                        	<script>
                                                                    <?php
                                                                    $valueer = str_replace('%', '',  $percentage * 100);
                                                                    ?>
                                                                $(function() {
                                                                        $( ".progressBar" ).progressbar({
                                                                                value: <?php echo $valueer;?>
                                                                        });
                                                                });
                                                                </script>							<div class="countdowncontainer" id="countdowncontainer<?php echo $counter;?>"></div>
                                                         <?php
                                                           $readable = $ponudba->offer_endstamp;
                                                           $readable = strtotime($readable);
                                                           $readable = date("F d, Y G:i:s", $readable);
                                                           ?>
							<script type="text/javascript">
							var dealexpire=new cdtime("countdowncontainer<?php echo $counter;?>", "<?php echo $readable;?>")
							dealexpire.displaycountdown("days", formatresults)
							</script>
                                                        
        </div>
       <div style="clear:both;"></div>
              <div id="main-ponudba-inner">
                <div class="product-notes" style="background-color: white; border: 1px solid #ccc; float:left; width:300px; float:left;">
                     <h3>Opombe</h3>
                     <div class="product-notes-content">
                     <?php echo $ponudba->offer_notes;?>
                         <li>Veljavnost kupona: <?php echo date("d.m.Y", strtotime($ponudba->offer_validuntil));?></li>
                     </div>
                </div>  
                  
                  <div class="product-notes" style="background-color: white; border: 1px solid #ccc; float:left; width:300px; float:left; margin-top: 10px;">
                     <h3>Naslov izvedbe</h3>
                     <div class="product-notes-content">
                     <ul>
                     <li>Naslov: <?php echo $ponudba->offer_address;?></li>
                     <li>Pošta: <?php echo $ponudba->offer_zip;?></li>
                     <li>Kraj: <?php echo $ponudba->offer_city;?></li>
                     <li>Email: <?php echo $ponudba->offer_email;?></li>
                     <li>Telefon: <?php echo $ponudba->offer_phone;?></li>
                     <li>Fax: <?php echo $ponudba->offer_fax;?></li>
                     <li>Delovni čas: <?php echo $ponudba->offer_worktime;?></li>
                     </ul>
                     </div>
                </div>
                  <?php
                  foreach($lokacije as $loc):?>
                  <div class="product-notes" style="background-color: white; border: 1px solid #ccc; float:left; width:300px; float:left; margin-top: 10px;">
                     <h3>Naslov izvedbe</h3>
                     <div class="product-notes-content">
                     <ul>
                     <li>Naslov: <?php echo $loc->location_address;?></li>
                     <li>Pošta: <?php echo $loc->location_zip;?></li>
                     <li>Kraj: <?php echo $loc->location_city;?></li>
                     <li>Email: <?php echo $loc->location_email;?></li>
                     <li>Telefon: <?php echo $loc->location_phone;?></li>
                     <li>Fax: <?php echo $loc->location_fax;?></li>
                     <li>Delovni čas: <?php echo $loc->location_worktime;?></li>
                     </ul>
                     </div>
                </div>
                  <?php endforeach;?>
                  
              </div>     
       


                <div id="main-ponudba-inner-right-smaller" class="roundedCorners5" style="overflow: auto;padding: 14px; background-color: white; border: 1px solid #ccc;float:left; margin-top: -120px;">
                   
                    <div id="glavni-opis">
                        <style>
                            #glavni-opis h1 {
                                font-size: 14px;
                                font-weight: bold;
                                font-family: 'Arial';
                                color: #333333;
                                margin-bottom: -18px;
                                margin-top: 5px;
                            }   
                            #glavni-opis h2 {
                                font-size: 14px;
                                font-weight: bold;
                                font-family: 'Arial';
                                color: #FF9B03;
                                margin-bottom: -18px;
                                margin-top: 5px;
                            }
                        </style>
                    <?php echo $ponudba->offer_shortdesc;?>
                    <?php if(!empty($ponudba->offer_shortdesc)) :?><hr /> <?php endif;?>
                    <?php echo $ponudba->offer_longdesc;?>
                    </div>
                    <br />
                    
                    <h2>Plačaj <?php echo $ponudba->offer_price;?> € za ponudbo v vrednosti <?php echo $ponudba->offer_value;?> €! <a href="<?php echo base_url();?>kupi/<?php echo $ponudba->offer_id;?>" style="color: orange !important;">NAKUP!</a></h2>
                </div>
                <input id="address" type="hidden" value="<?php echo $ponudba->offer_address;?>, <?php echo $ponudba->offer_city;?>">
                <div id="map_canvas" class="mapa" >
                </div>
<div class="comments roundedCorners5">
    <h2 style="color:#80AC24;">Komentarji ( <?php echo $komentarji_st;?> )</h2>
    <hr />
<ol class="slats">
    <?php
    foreach($komentarji as $k): 
   ?>
	<li class="group">		
		<p><?php echo $k->comment_body;?>
                    <span class="meta"><?php echo date("d.m.Y", strtotime($k->comment_created)); ?> - <?php echo $k->user_name;?> <?php echo $k->user_surname;?></span></p>
	</li>			
				
   <?php
    endforeach;
    ?>
</ol>			
	
    <div id="comment-holder">
    <h3>Napišite svoje mnenje</h3>
    <textarea id="comment" style="width: 100%; height: 145px; border:1px solid #ccc;"></textarea>
  <div class="button-ponudba-nakup">
    <a href="" id="post-comment"> Objavi mnenje</a>
  </div>
    </div>
    
</div>
<div class="clearfix"></div>


        </div>
    </div>

<script type="text/javascript"
    src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBqi8sY9_7RKxaidjangqwXKXXOLH6Spqo&sensor=false">
</script>
<script type="text/javascript">
    
  var geocoder;
  var map;

  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(46.231018, 15.260294);
    var myOptions = {
      zoom: 15,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);   
    
  }
  
  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        jQuery("#map_canvas").remove();
      }
    });
  }
    <?php if($user_status->logged_in == "1"):?>
   $(document).ready(function() {
       var comment_holder = $("#comment-holder");
       $("#post-comment").live('click',function(e) {
           
           var comment = $("#comment").val();
           
            var form_data = {
            offer   : '<?php echo $ponudba->offer_id;?>',
            user    : '<?php echo $user_status->user_id;?>',
            comment : comment,
            ajax     : '1'
            };
               $.ajax({
                        url: base_url+'ponudbe/ajaxComment',
                        type: 'POST',
                        async : false,
                        data: form_data,
                        dataType: "text",
                        success: function(msg) 
                        {
                            console.log("Oglasnik Database Interaction!")    
                                comment_holder.slideUp('slow', function() {
                                    if(msg == "Succes") {
                                      $(this).html("<b>Vaš komentar je bil objavljen!</b>");
                                    }else if(msg == "Error") {
                                      $(this).html("<b>Prišlo je do napake!</b>");
                                    }
                                    $(this).slideDown('slow')
                                });


                        }

                });

           e.preventDefault();
       })
       
   })
   <?php endif;?>
 initialize(); 
 codeAddress()
</script>