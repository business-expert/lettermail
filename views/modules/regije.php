  <div id="main" role="main" class="roundedCorners5">
      <h1> Ponudbe po regijah</h1>
      

          <?php foreach($regije as $regija) : ?>
          <?php $stevilo = $this->offers_model->count_region($regija->region_id);?>
         <div class="liner"><a class="green"href="<?php echo base_url();?>regija/<?php echo $regija->region_slug;?>"><?php echo $regija->region_title;?> (<?php echo $stevilo;?>)</a></div><br />
          <?php $stevilo = null;?>
          <?php endforeach;?>
        
 </div>

