              <?php foreach($ponudbe as $ponudba) : ?>
                        <div class="ponudbaFooter" style="float:left; width: 285px; margin-right: 5px;">

            <div class="side-image">
                <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"> <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=180&w=285&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>"> </a>
            </div>
             <a style="font-size: 13px; color: #fff; text-decoration: none; text-align: center;" href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"> <?php echo $ponudba->offer_head;?> </a>

                        
               <?php endforeach;?>