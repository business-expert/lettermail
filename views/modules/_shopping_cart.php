<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">

          <h1>Košarica</h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<?php if($this->cart->total_items() > 0) : ?>
<?php
$attributes = array('class' => 'shoppingForm');
echo form_open('shopping/update', $attributes); ?>
<table cellpadding="6" cellspacing="1" class="shoppingCart" style="width:100%" border="0">
    <thead>
<tr>
  <th>Količina</th>
  <th>Opis</th>
  <th style="text-align:right">Cena</th>
  <th style="text-align:right">Skupaj</th>
</tr>
    </thead>
<?php $i = 1; ?>
    <tbody>
<?php foreach ($this->cart->contents() as $items): ?>

	<?php echo form_hidden('rowid[]', $items['rowid']); ?>

	<tr>
	  <td>            <?php echo form_input(array('name' => 'qty[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '3')); ?>  </td>
	  <td>
			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                            <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                            <?php if($option_name == "type" AND $option_value == "gift"):?>
                                <img src="<?php echo base_url();?>assets/images/friend.jpg" width="20" height="20">
                             <?php endif;?>

                            <?php endforeach; ?>                        
                        
                            
			<?php endif; ?>
              <?php echo $items['name']; ?>



	  </td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?> €</td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['subtotal']); ?> €</td>
	</tr>

<?php $i++; ?>

<?php endforeach; ?>
</tbody>
<tfoot>
<tr>
    <td colspan="3"><?php echo form_submit('', 'Osveži košarico'); ?></td>
</tr>
</tfoot>
</table>

<div class="shoppingTotal">
    Skupaj za plačilo: <strong><?php echo $this->cart->format_number($this->cart->total()); ?> €</strong>
    <br />
  <div class="button-ponudba-nakup">
    <a href="<?php echo base_url();?>kosarica/naprej"> Na blagajno</a>
  </div>
    
  <div class="button-ponudba-nakup">
    <a href="<?php echo base_url();?>trenutna-ponudba"> Nadaljuj z nakupi</a>
  </div>

</div>
          
    <?php else :;?>

   <center><h3> Košarica je prazna! </h3></center>
    <?php endif;?>
      </div>

  </div>
