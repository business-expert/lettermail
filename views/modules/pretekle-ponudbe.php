  <div id="main" role="main" class="roundedCorners5">
      <h1> Pretekle ponudbe</h1>
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
                        <a style="text-decoration: none !important;" href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"><h2><?php echo $ponudba->offer_head;?></h2></a>
                        <a style="text-decoration: none !important;" href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"><h3><?php echo $ponudba->offer_subhead;?></h3></a>
            <div class="tabela-cen-sub" style="width:205px !important; ">          
				<div class="column-cen-sub first-sub"><strong>VREDNOST</strong><div class="price-sub"><?php echo $ponudba->offer_value;?> €</div></div>
				<div class="column-cen-sub first-sub"><strong>POPUST</strong><div class="price-sub"><?php echo $ponudba->offer_discount;?> %</div></div>
				<div class="column-cen-sub first-sub"><strong>PRODANO</strong><div class="price-sub">0</div></div>
            </div>
                    </div>
 
                </div>
           
               <?php 
               $counter++;
               endforeach;?>
                
            </div>
        
        </div>


  </div>