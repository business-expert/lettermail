                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Zapisnik strežnika</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Prikaz zapisov</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th>Operacija</th> 
    				<th>Najdenih recordov</th> 
    				<th>Datum</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($zapisnik as $z) :
                                
                                if($z->log_affected == 0):
                                    $color = "#F0E9CF";
                                elseif($z->log_affected >= 1):
                                    $color = "#9AD51F";
                                elseif($z->log_affected >= 10):
                                    $color = "#DCDD75";
                                endif;
                                
                                ?>
				<tr style="background-color: <?php echo $color;?>"> 
    				<td><?php echo $z->log_type;?></td> 
    				<td><?php echo $z->log_affected;?></td> 
    				<td><?php echo $z->log_date;?></td> 
				</tr> 
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
