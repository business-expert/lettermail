                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
                    <h1 style="margin-left: 50px;">Pregled vsebine</h1>
			<table cellspacing="0"> 
			<thead align="center"> 
				<tr> 
    				<th width="50">Nadmenu</th> 
    				<th width="190">Naslov</th> 
    				<th width="190">Žeton</th> 
    				<th width="170">Ustvarjeno</th> 
    				<th width="170">Možnosti</th> 
				</tr> 
			</thead> 
			<tbody align="center"> 
                            <?php foreach($content as $cunt) : ?>
                            
                            
				<tr> 
    				<td width="50"><?php echo $cunt->content_id;?></td> 
    				<td width="190"><?php echo $cunt->content_title;?></td>     			
                                <td width="190"><?php echo $cunt->content_slug;?></td> 
    				<td width="170"><?php echo $cunt->content_created;?></td> 
    				<td width="170"><a href="<?php echo base_url();?>admin/viewContent/<?php echo $cunt->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteContent/<?php echo $cunt->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                                <?php
                                foreach($this->content_model->list_content_child($cunt->content_id) as $subpage): ?>
				<tr style="margin-left:10px; background-color: #ccc;"> 
    				<td width="50"><?php echo $subpage->content_parent;?></td> 
    				<td width="190"><?php echo $subpage->content_title;?></td>     			
                                <td width="190"><?php echo $subpage->content_slug;?></td> 
    				<td width="170"><?php echo $subpage->content_created;?></td> 
    				<td width="170"><a href="<?php echo base_url();?>admin/viewContent/<?php echo $subpage->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_edit.png" title="Uredi"></a> <a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteContent/<?php echo $subpage->content_id;?>"> <img src="<?php echo base_url();?>assets/admin/images/icn_trash.png" title="Izbriši"> </a></td> 
				</tr> 
                 
                               <?php endforeach; ?>
                                
                             <?php endforeach;?>
			</tbody> 
			</table>

		
		</article><!-- end of content manager article -->
		
