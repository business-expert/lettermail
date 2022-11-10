   <?php $this->load->view('static/header');?>

    <?php if(isset($headeroffer)) : 
         $this->load->model('offers_model'); 
         if(isset($_COOKIE['regija'])):
         $regije = explode(";", $_COOKIE['regija']);
         
         $ponudbe   = $this->offers_model->list_offers_featuredRegion($regije);
         $st_ponudb = $this->offers_model->count_featuredRegion($regije);
         else :
         $ponudbe   = $this->offers_model->list_offers_featured();
         $st_ponudb = $this->offers_model->count_featured();
         endif;
        
         if($st_ponudb > 0) :      
?>
    <style>
    .ui-progressbar { width: 100%;}
    </style>
    <div id="main-ponudba" class="main-ponudba"> 

       <div id="prevOffer">
             &nbsp; 
        </div>  
        <div id="nextOffer">
             &nbsp;    
        </div>
        
        <div class="slidesOffers">
         
            <?php 
        $counter = 5;    
        foreach($ponudbe as $ponudba) : 
                
      
        $start = $ponudba->offer_startstamp;
        $end = $ponudba->offer_endstamp;
        $start = strtotime($start);
        $end = strtotime($end);
        $current = date("Y-m-d H:s:i");
        $current = strtotime($current);




        $percentage = ($current-$start)/($end-$start);


        $prodanih = $this->offers_model->count_selled($ponudba->offer_id);
     ?>
            <div class="slide" style="display:none;">
            
        <div id="main-ponudba-inner">
            
            <div class="deal-image-main imgpost">
                <div id="slideshower<?php echo $counter;?>" style="height: 320px; overflow: hidden;" >

              
                    
                         <?php if(!empty($ponudba->offer_image1)) : ?>
                        <img src="<?php echo base_url();?>thumb.php?h=300&q=100&w=300&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;?>">
                        <?php endif;?>   
                       <?php if(!empty($ponudba->offer_image2)) : ?>
                        <img src="<?php echo base_url();?>thumb.php?h=300&q=100&w=300&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image2;?>">
                        <?php endif;?>           
                        <?php if(!empty($ponudba->offer_image3)) : ?>
                        <img src="<?php echo base_url();?>thumb.php?h=300&q=100&w=300&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image3;?>">
                        <?php endif;?>    
                        <?php if(!empty($ponudba->offer_image4)) : ?>
                        <img src="<?php echo base_url();?>thumb.php?h=300&q=100&w=300&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image4;?>">
                        <?php endif;?>
                    
             
                </div>
            </div>

        </div>
        <div id="main-ponudba-inner-right">
            <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"> <h1> <?php echo $ponudba->offer_head;?></h1>
            <h2> <?php echo $ponudba->offer_subhead;?></h2>
            </a>
            <div class="tabela-cen">          
				<div class="column-cen first"><strong>VREDNOST</strong><div class="price"><?php echo str_replace(".", ",",$ponudba->offer_value);?> €</div></div>
				<div class="column-cen first"><strong>POPUST</strong><div class="price"><?php echo $ponudba->offer_discount;?> %</div></div>
				<div class="column-cen first"><strong>PRIHRANEK</strong><div class="price"><?php echo str_replace(".", ",",$ponudba->offer_save);?> €</div></div>
				<div class="column-cen final"><span class="price-final"><?php echo str_replace(".", ",",$ponudba->offer_price);?> €</span> </div>

				<div class="column-cen last"><a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>" class="btn_mediumgray2">Poglej ponudbo</a></div>
            </div>
			<div class="nakupi-table">
			
			<div class="nakup-cen third"><span class="greenNakup"><?php echo $prodanih;?></span> <?php if($ponudba->offer_maximal > 1) :?> <span style="color:#5F736F; font-size: 30px;"> / </span> <span class="greenNakup"><?php echo $ponudba->offer_maximal;?></span> <?php endif;?><br /><div class="greenNakupBottom">prodanih <?php if($ponudba->offer_maximal == 0) :?>kuponov<?php endif;?> <?php if($ponudba->offer_maximal > 0) :?>  / razpoložljivih kuponov<?php endif;?>  <br /><?php if($ponudba->offer_maximal >= $prodanih OR $ponudba->offer_maximal == 0) :?>Lahko še nakupujete!<?php else :?>kuponi so pošli! <?php endif;?></div></div>
			<div class="nakup-cen fourth"><a href="<?php echo base_url();?>kupi/<?php echo $ponudba->offer_id;?>/gift"><img src="<?php echo base_url();?>assets/images/friend.png" alt="Podari prijatelju"></a></div>
			<div class="nakup-cen last-nakup talar" talar-text="Ostala ponudba iz te regije"><a href="<?php echo base_url();?>regija/<?php echo $ponudba->region_slug;?>" class="btn_mediumgray3"><?php echo $ponudba->region_title;?></a> </div>

			</div>
                                                         
                                                        <?php
                                                            $valueer = str_replace('%', '',  $percentage * 100);
                                                        ?> 
                                                        <span class="progressBar" rel="<?php echo $valueer;?>"></span>

                                                        	<script>

                                                                $(document).ready(function() {
                                                                        $(".progressBar").each (function () {
                                                                            var element = this;

                                                                        $(element).progressbar({
                                                                                value: parseInt($(element).attr("rel"))
                                                                            });
                                                                        });
                                                                });
                                                                </script>
							<div class="countdowncontainer" id="countdowncontainer<?php echo $counter;?>"></div>
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
            <script type="text/javascript">
                $(document).ready(function() {

                    $('#slideshower<?php echo $counter;?>').cycle({
                        fx:      'fade'
                    });  
                })
            </script>
            </div>

            <?php  
            $counter++;
            $valueer = null;
            endforeach;
            ?>
        </div>

    </div>

    <?php endif;?>
    

    <?php endif; ?>
<?php if(!isset($headerOffer)): echo "<div class='main-ponudba'></div>"; endif;?>
<?php $this->load->view('modules/karta'); ?>
<div class="minimal_wrapper">
<?php $this->load->view($view);?>
</div>
          
 
          
         <?php if(isset($sidebar)) : 
         $this->load->model('offers_model'); 
         $ponudbe   = $this->offers_model->list_offers_lastminutes();
         $st_ponudb = $this->offers_model->count_lastminutes();     
           ?>
       <?php if($st_ponudb != 0) : ?>
      <div id="sidebar" <?=($this->uri->segment(1, 0)=== 0)?'style="margin-top: 25px !important;"':''?> class="roundedCorners5">
	<h2>Ponudbe v zadnjem trenutku</h2>
        <?php foreach($ponudbe as $ponudba) : ?>
        <div class="side-ponudba">
            <div class="side-image">
                <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"> <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=180&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>"> </a>
            </div>
            <div class="side-content">
             <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"> <?php echo $ponudba->offer_head;?> </a>
            </div>
        </div>

        <?php 
        endforeach; ?>
        </div>
        <?php endif;?>
    
    <div class="sidebar-jak">
          <?php
          $counter = 15;
          $oglasi = $this->ads_model->get_ads();
          foreach($oglasi as $oglas):
              ?>
            <div class="ads">
            <div class="oglas-<?php echo $counter;?>">
                <a target="_blank" href="<?php echo $oglas->ad_url;?>"><img alt="<?php echo $oglas->ad_text;?>" src="<?php echo base_url();?>thumb.php?q=100&w=316&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $oglas->ad_image;?>" /></a>
            <div class="side-content" style="width:100% !important; margin-left: 0;-webkit-border-radius: 0px;border-radius: 0px; ">
             <a target="_blank" href="<?php echo $oglas->ad_url;?>"> <?php echo $oglas->ad_text;?> </a>
            </div>
            </div>  
         </div>
            <?php
            $counter++;
          endforeach;
          ?>
<div class="fb-like-box" style="float:right; margin-left: 21px; margin-top: 12px; background-color: #FFF;" data-href="http://www.facebook.com/pages/e-oglasnik/141057262673275" data-width="319" data-height="370" data-show-faces="true" data-border-color="#FF9B03" data-stream="false" data-header="true"></div>
    </div>    
    <?php
        
        endif; ?>
    

            <div class="news_box">
                <div class="left">
                    <h3>Zadnje novice iz bloga: </h3>
                   <p><?php
                       $blogs = $this->content_model->list_blog();
                       $cc     = 0;
                       foreach($blogs as $b):
                       if($cc == 1) : break; endif;
                       $content = strip_tags($b->content_text);
                       $content = substr($content,0,200);
                       echo $content."...";
                       ?>
                       <br />
                         <a href="<?php echo base_url();?>blog/<?php echo $b->content_slug;?>">Preberi več...</a>
                       <?php
                       $cc++;
                       endforeach;
                       ?>
                    </p>     
                </div>
            </div> <!-- news box #end -->
  </div> <!--! end of #container -->
  
  <?php $this->load->view('/static/footer');?>