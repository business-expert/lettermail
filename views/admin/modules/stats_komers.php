<script type="text/javascript">
$(document).ready(function (){
	$(function() {	
                $( "#date_start" ).datepicker({
                    numberOfMonths: 3,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });	
                $( "#date_end" ).datepicker({
                    numberOfMonths: 3,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });            

	});
})
</script>
<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Izberite podatke za prikaz poročila o uspešnosti</h3></header>
			<div class="module_content">
                            <form action="<?php echo base_url("admin/statKomer");?>" name="stats" method="post">
                            <label>Komercialist</label>
                            <select class="ponudnik" name="commer" style="margin-bottom: 5px; width:98%;">
                                <?php foreach($komers as $komer) :?>
                                <option value="<?php echo $komer->k_id;?>"> <?php echo $komer->k_name.' '.$komer->k_surname;?></option>
                                <?php endforeach;?>
                            </select>	
                            <label>Obdobje od</label>
                            <input type="text" id="date_start" value="<?php echo date("d.m.Y");?>" name="start" style="margin-bottom: 5px;">			
                            <label>Obdobje do</label>
                            <input type="text" id="date_end" name="end" style="margin-bottom: 5px;">

				<div class="submit_link">
					<input type="submit" value="Prikaži poročilo komercialista" class="alt_btn">
				</div>
                        </form>
                        </div>
		</article><!-- end of stats article -->

</section>