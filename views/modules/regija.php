  <div id="main" role="main" class="roundedCorners5">
      <h1>Ponudbe iz regije <?php echo $regija->region_title;?></h1>
        <div id="ponudbe-offers">
                <?php foreach($ponudbe as $ponudba) : ?>
                <div class="ponudba">
                    <div class="image-ponudba">
                        <img class="roundedCorners5"  src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=180&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>">
                    </div>
                    <div class="content-ponudba">
                        <h2><?php echo $ponudba->offer_head;?></h2>
                        <h3><?php echo $ponudba->offer_subhead;?></h3>
            <div class="tabela-cen-side">
				<div class="prices-side first">
				<strong>Vrednost</strong>
				<span class="price-side value">
				<?php echo $ponudba->offer_value;?> €
                                </span>
				</div>
				<div class="prices-side discount">
				<strong>Popust</strong>
                                <span class="price-side"><?php echo $ponudba->offer_discount;?>%</span>
				</div>
                                <div class="prices-side last">
				<strong>Prihranek</strong>
				<span class="price-side">
				<?php echo $ponudba->offer_save;?> €</span>
                                </div>
				<div class="prices-side last">
				<strong>Plačilo</strong>
				<span class="price-side">
				<?php echo $ponudba->offer_price;?> €
                                </span>
				</div>
            </div>
                    </div>
                    
                  <div class="button-ponudba">
                      <a href="<?php echo base_url();?>ponudbe/det/<?php echo $ponudba->offer_slug;?>">Poglej ponudbo ➜</a>
                    </div>
                </div>
           
               <?php endforeach;?>
                
          

        </div>
        
        </div>

