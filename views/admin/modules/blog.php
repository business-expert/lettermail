                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			                    
                    
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled blogov</h3>
		<ul class="tabs">
   		<li><a href="#tab1">Objave</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
    				<th width="190">Naslov</th> 
    				<th width="190">Žeton</th> 
    				<th width="170">Ustvarjeno</th> 
    				<th width="170">Možnosti</th> 
				</tr> 
			</thead> 
			<tbody> 
                            <?php foreach($content as $cunt) : ?>
                            
                            
				<tr> 
    				<td width="190"><?php echo $cunt->content_title;?></td>     			
                                <td width="190"><?php echo $cunt->content_slug;?></td> 
    				<td width="170"><?php echo $cunt->content_created;?></td> 
    				<td width="170"><a href="<?php echo base_url();?>admin/viewBlog/<?php echo $cunt->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteBlog/<?php echo $cunt->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                                
                             <?php endforeach;?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
			
		</div><!-- end of .tab_container -->
		
		</article><!-- end of content manager article -->
		
