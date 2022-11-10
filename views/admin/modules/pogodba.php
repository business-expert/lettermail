<script type="text/javascript">
$(document).ready(function (){
	$(function() {	
                $( "#date" ).datepicker({
                    numberOfMonths: 1,
                    showAnim: "drop",
                    dateFormat: "dd.mm.yy"
                });	
     
                $(".ponudnik").live('change', function() {
                    var ponudnik = $(this).val();
                    
                        var form_data = {
                        id : ponudnik,
                        ajax     : '1'
                        };
                            return $.ajax({
                                    url: base_url+'admin/ajaxPonudnikOffers',
                                    type: 'POST',
                                    async : false,
                                    data: form_data,
                                    dataType: "html",
                                    success: function(msg) 
                                    {
                                        console.log("Oglasnik Database Interaction!")    
                                        $("#ponudbe").fadeOut('slow', function() {
                                            $(this).html(msg).fadeIn('slow');
                                        })
                                        
                                        
                                    }

                            });
                    
                })

	});
})
</script>
<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Izberite podatke za generiranje pogodbe</h3></header>
			<div class="module_content">
                            <form action="<?php echo base_url("admin/genPogodba");?>" name="stats" method="post">
                            <label>Partner</label>
                            <select class="ponudnik" name="partner" style="margin-bottom: 5px; width:98%;">
                                <option> Izberite partnerja </option>
                                <?php foreach($categories as $cat) :?>
                                <option value="<?php echo $cat->ponudnik_id;?>"> <?php echo $cat->ponudnik_title;?></option>
                                <?php endforeach;?>
                            </select>	
                            <div id="ponudbe">
         
                            </div>
                            <label>Datum pogodbe</label>
                            <input type="text" id="date" name="datum" style="margin-bottom: 5px;">
				<div class="submit_link">
					<input type="submit" value="Generiraj pogodbo" class="alt_btn">
				</div>
                        </form>
                        </div>
		</article><!-- end of stats article -->

</section>