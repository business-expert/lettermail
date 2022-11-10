  <div id="main" role="main" <?=($this->uri->segment(1, 0)=== 0)?'style="margin-top: 25px !important;"':''?> class="roundedCorners5">
<div id="tabs_wrapper">  
            <!--  the tab links  -->  
            <a class="roundedCorners5 tab_link tab_link_selected" title="#ponudbe" href="">Trenutne ponudbe</a>  
            <a class="roundedCorners5 tab_link" title="#vizteku" href="">Ponudbe v izteku</a>  
            <a class="roundedCorners5 tab_link" title="#prihajajoce" href="">Prihajajoče ponudbe</a>  
            <!--  end tab links  -->  

            <!--  clear it  -->  

            <!-- start tab text containers  -->  

        </div>  
        <!-- end the tabs wrapper -->  
        <div id="ponudbe-offers">
            <div id="ponudbe" class="tab_text active_tab">  
                <?php 
                $counter = 0;
                foreach($ponudbe_t as $ponudba) : ?>
                <div class="ponudba">
                    <div class="image-ponudba">
                       <div class='bottomImageOffer' style="position:relative;"> <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=180&q=100&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>">
                       </div>
                    </div>
                    <div class="content-ponudba">
                        <h2><?php echo $ponudba->offer_head;?></h2>
                        <h3><?php echo $ponudba->offer_subhead;?></h3>
            <div class="tabela-cen-sub">          
				<div class="column-cen-sub first-sub"><strong>VREDNOST</strong><div class="price-sub"><?php echo $ponudba->offer_value;?> €</div></div>
				<div class="column-cen-sub first-sub"><strong>POPUST</strong><div class="price-sub"><?php echo $ponudba->offer_discount;?> %</div></div>
				<div class="column-cen-sub first-sub"><strong>PRIHRANEK</strong><div class="price-sub"><?php echo $ponudba->offer_save;?> €</div></div>
				<div class="column-cen-sub final-sub"><span class="price-final-sub"><?php echo $ponudba->offer_price;?> €</span> </div>
            </div>
                    </div>
                    <div class="clock-timer" id="bottomCounter<?php echo $counter;?>">

                    </div>
                     <?php
                       $readable = $ponudba->offer_endstamp;
                       $readable = strtotime($readable);
                       $readable = date("F d, Y G:i:s", $readable);
                       ?>
                    <script type="text/javascript">
                    var dealexpire=new cdtime("bottomCounter<?php echo $counter;?>", "<?php echo $readable;?>")
                    dealexpire.displaycountdown("days", formatresultsBottom)
                    </script>
                  <div class="button-ponudba">
                      <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>">Poglej ponudbo</a>
                    </div>
                </div>
           
               <?php 
               $counter++;
               endforeach;?>
                
            </div>
            <div id="vizteku" class="tab_text">  
                <?php foreach($ponudbe_e as $ponudba) : ?>
                 <div class="ponudba">
                    <div class="image-ponudba">
                       <div class='bottomImageOffer' style="position:relative;"> <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=180&q=100&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>">
                       </div>
                    </div>
                    <div class="content-ponudba">
                        <h2><?php echo $ponudba->offer_head;?></h2>
                        <h3><?php echo $ponudba->offer_subhead;?></h3>
            <div class="tabela-cen-sub">          
				<div class="column-cen-sub first-sub"><strong>VREDNOST</strong><div class="price-sub"><?php echo $ponudba->offer_value;?> €</div></div>
				<div class="column-cen-sub first-sub"><strong>POPUST</strong><div class="price-sub"><?php echo $ponudba->offer_discount;?> %</div></div>
				<div class="column-cen-sub first-sub"><strong>PRIHRANEK</strong><div class="price-sub"><?php echo $ponudba->offer_save;?> €</div></div>
				<div class="column-cen-sub final-sub"><span class="price-final-sub"><?php echo $ponudba->offer_price;?> €</span> </div>
            </div>
                    </div>
                    <div class="clock-timer" id="bottomCounter<?php echo $counter;?>">

                    </div>
                     <?php
                       $readable = $ponudba->offer_endstamp;
                       $readable = strtotime($readable);
                       $readable = date("F d, Y G:i:s", $readable);
                       ?>
                    <script type="text/javascript">
                    var dealexpire=new cdtime("bottomCounter<?php echo $counter;?>", "<?php echo $readable;?>")
                    dealexpire.displaycountdown("days", formatresultsBottom)
                    </script>
                  <div class="button-ponudba">
                      <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>">Poglej ponudbo</a>
                    </div>
                </div>
           
               <?php 
               $counter++;
               endforeach;?>
                
                           
            </div>  
            <div id="prihajajoce" class="tab_text">  
                <?php foreach($ponudbe_c as $ponudba) : ?>
                <div class="ponudba">
                    <div class="image-ponudba">
                       <div class='bottomImageOffer' style="position:relative;"> <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=180&q=100&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>">
                       </div>
                    </div>
                    <div class="content-ponudba">
                        <h2><?php echo $ponudba->offer_head;?></h2>
                        <h3><?php echo $ponudba->offer_subhead;?></h3>
            <div class="tabela-cen-sub">          
				<div class="column-cen-sub first-sub"><strong>VREDNOST</strong><div class="price-sub"><?php echo $ponudba->offer_value;?> €</div></div>
				<div class="column-cen-sub first-sub"><strong>POPUST</strong><div class="price-sub"><?php echo $ponudba->offer_discount;?> %</div></div>
				<div class="column-cen-sub first-sub"><strong>PRIHRANEK</strong><div class="price-sub"><?php echo $ponudba->offer_save;?> €</div></div>
				<div class="column-cen-sub final-sub"><span class="price-final-sub"><?php echo $ponudba->offer_price;?> €</span> </div>
            </div>
                    </div>

                  <div class="button-ponudba">
                      <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>">Poglej ponudbo</a>
                    </div>
                </div>
           
               <?php 
               $counter++;
               endforeach;?>
                
           
            </div>  
        </div>
        
        </div>

