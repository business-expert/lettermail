                        <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                          <?php endif;?>
<?php if(!empty($nakupi)) : ?>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled nakupov uporabnika <?php echo $uporabnik->user_name." ".$uporabnik->user_surname;?></h3>
		<ul class="tabs">
   		<li><a href="#tab1">Nakupi</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th>Količina </th>
                                     <th>Opis</th>
                                     <th>Cena</th>
                                     <th>Status</th>
				</tr> 
			</thead> 
			<tbody> 
<?php $i = 1; ?>

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
	  <td><?php echo $sub->price; ?> €</td>
	  <td>
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
			</table>
			</div><!-- end of #tab1 -->
                        
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
          
    <?php else :;?>

   <center><h3> Ni nakupov! </h3></center>
    <?php endif;?>
      </div>

  </div>
