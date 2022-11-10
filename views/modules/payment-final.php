  <div id="main" role="main" class="roundedCorners5">
      <h1>Proces nakupa</h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif;?>
        </div>

