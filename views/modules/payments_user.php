<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">

          <h1>Pregled kuponov</h1>
                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
<?php if(!empty($nakupi)) : ?>
<table cellpadding="6" cellspacing="1" class="shoppingCart" style="width:100%" border="0">
    <thead>
<tr>
  <th>Količina</th>
  <th>Opis</th>
  <th style="text-align:right">Cena</th>
  <th style="text-align:right">Status</th>
</tr>
    </thead>
<?php $i = 1; ?>
    <tbody>
<?php foreach ($nakupi as $nakup): ?>
        <?php $sub_nakupi = $this->payments_model->user_payments_details($nakup->pay_id);?>
        <?php foreach($sub_nakupi as $sub) : ?>
	<tr>
	  <td><?php echo $sub->qty;?></td>
	  <td>
		<?php 
                $ponudba = $this->offers_model->detail($sub->offer_id);
                echo $ponudba->offer_head;
                ?>

	  </td>
	  <td style="text-align:right"><?php echo $sub->price; ?> €</td>
	  <td style="text-align:right">
          <?php 
          
          if($nakup->pay_status == 0)
          {
              echo "Rezervirano";
          }
          elseif ($nakup->pay_status == 1)
          {
              echo "Opravljeno";
          }
          elseif ($nakup->pay_status == 2)
          {
              echo "Preklicano";
          }
          ?> </td>
	</tr>
    <?php endforeach; ?>
        
<?php $i++; ?>

<?php endforeach; ?>
</tbody>
<tfoot>

</tfoot>
</table>

          
    <?php else :;?>

   <center><h3> Ni nakupov! </h3></center>
    <?php endif;?>
      </div>

  </div>
