 
  
  <footer>
      <div id="footer-inner">
          <div id="footer-payments"><img src="<?php echo base_url();?>assets/images/payments.png"> </div>
          <div id="footer-upper"><img src="<?php echo base_url();?>assets/images/up.png"></div>
          
      </div>
                  
		  <div id="footer-inner">
                      
                      <div id="footer-kolofon">
                          <img src="<?php echo base_url();?>assets/images/small_logo.png" alt="e-oglasnik" title="e-oglasnik">
                          <br />
                <?php
                         $kolofon = $this->offers_model->kolofon();
                         echo $kolofon->text;
                         
                         ?>

                      </div>
                      <?php 
                      $this->load->model('content_model'); 
                      $vsebina = $this->content_model->list_content();
                      foreach($vsebina as $vse) : ?>
                      <div class="footer-box">
                          <h3><?php echo $vse->content_title;?></h3>
                          <?php 
                          $podstrani = $this->content_model->list_content_child($vse->content_id);
                          foreach($podstrani as $podstran):?>
                          <li> - <a href="<?php if(empty($podstran->content_url)) : ?><?php echo base_url();?>vsebina/<?php echo $podstran->content_slug;?> <?php else: ?><?php echo $podstran->content_url;?>  <?php endif;?>"><?php echo $podstran->content_title;?> </a></li>
                          <?php endforeach;?>
                      </div>
                      <?php endforeach;?>
     
		   <img src="<?php echo base_url();?>assets/images/divider.png">
                   <center><span class="copyright">Vse pravice pridržane - © e-oglasnik</span></center>
		  </div>
  </footer>


<div id="footerSlideContainer">
	<div id="footerSlideButton" style="display:none;"></div>
	<div id="footerSlideContent">
		<div id="footerSlideText">

			<div id="regija-title" style="text-shadow: 0px 1px 1px #000;"></div>
                        <div id="loader"></div>
                        <div id="ponudbeFooter" style="display:none;">

                        </div>
		</div>
	</div>
</div>
  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="<?php echo base_url();?>assets/js/script.js"></script>
  <script defer src="<?php echo base_url();?>assets/js/plugins.js"></script>
  <script defer src="<?php echo base_url();?>assets/js/libs/jquery.progressbar.min.js"></script>
  <script defer src="<?php echo base_url();?>assets/js/libs/jquery.cycle.all.js"></script>


  <script type="text/javascript">
      
 $(document).ready(function() {
     

    $('#footer-upper').click(function () {
            $('body,html').animate({
                    scrollTop: 0
            }, 900);
            return false;
    });
    $('#product-images').cycle({
        fx:      'fade',
        prev:    '#prev',
        next:    '#next',
        pager:   '#nav-product',
        // callback fn that creates a thumbnail to use as pager anchor 
        pagerAnchorBuilder: function(idx, slide) { 
            return '<li><a href="#"><img src="' + slide.src + '" width="58" height="58" /></a></li>'; 
        } 
    });   
       
    $('.slidesOffers').cycle({
        fx:      'scrollHorz',
        timeout:  0,
        prev:    '#prevOffer',
        next:    '#nextOffer'
    });  
    

		$("#autoComplete").autocomplete({
			source: '<?php echo base_url();?>register/email_exist',
			minLength: 2,
			selectFirst: true,
			select: function( event, ui ) { 
                               alert("test");
			}
		})
                
 
    

    $('.active_tab').fadeIn('slow');  
  
    //when a tab link is clicked...  
    $('.tab_link').live('click', function(event){  
  
        event.preventDefault();  
  
        $('.tab_link_selected').removeClass('tab_link_selected');  
  
        $(this).addClass('tab_link_selected');  
  
        var container_id = $(this).attr('title');  
  
        $('.active_tab').animate({  
  
            height : 'toggle' , opacity : 'toggle'  
  
        },function(){  
  
            $(this).removeClass('active_tab');  
  
            $(container_id).addClass('active_tab');  
  
            $('.active_tab').animate({  
  
                height : 'toggle' , opacity : 'toggle'  
  
            });  
        });  
  
    }); 

	

 });
      </script>
  <!-- end scripts-->


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
	<!--[if lte IE 8]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
        
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://dev.armopelus.com/oglasnik/stats/" : "http://dev.armopelus.com/oglasnik/stats/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://dev.armopelus.com/oglasnik/stats/piwik.php?idsite=2" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

</body>
</html>