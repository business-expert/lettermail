                       <center> <?php if($this->session->flashdata('message') != '') : ?>
          		<div class="notification <?php echo $this->session->flashdata('type'); ?>">
			<p><?php echo $this->session->flashdata('message'); ?>
                        </p>
                        </div>
                        <?php endif; ?>
                       </center>
	<section id="main" class="column">
			
		<article class="module width_full">
		<header><h3 class="tabs_involved">Pregled čakajočih komentarjev</h3>
                </header>
                     <ol class="slats">
                    <?php
                    foreach($komentarji_cak as $k):
                        
                        $ponudba = $this->offers_model->detail($k->comment_offer);
                    ?>
                        <div style="background-color: #eee; padding: 12px; border: 1px solid #ccc; width: 90%; margin-top: 5px; margin-left: 15px;">
                           
         
                                    <li class="group">		
                                            <p><?php echo $k->comment_body;?>
                                                <span class="meta">Uporabnik <?php echo $k->user_name;?> <?php echo $k->user_surname;?> je dne, <?php echo date("d.m.Y", strtotime($k->comment_created)); ?>  komentiral ponudbo <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"><?php echo $ponudba->offer_head;?></a></span>
                                                <span style="color: red; font-weight: bold;"><a href="<?php echo base_url();?>admin/acceptKomentar/<?php echo $k->comment_id;?>">POTRDI</a></span> |
                                                <span style="color: red; font-weight: bold;"><a onclick="javascript:return confirm('Ste prepričani da želite zavrniti komentar?')" href="<?php echo base_url();?>admin/cancelKomentar/<?php echo $k->comment_id;?>">ZAVRNI</a></span> |
                                                 <span style="color: red; font-weight: bold;"><a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteKomentar/<?php echo $k->comment_id;?>">IZBRIS</a></span>
                                            </p>
                                    </li>			

          
                            	            
                        </div>       
                    <?php
                    endforeach;
                    ?>
			</ol>
		
		</article><!-- end of content manager article -->	
                
                <article class="module width_full">
		<header><h3 class="tabs_involved">Pregled zavrjenih komentarjev</h3>
                </header>
                     <ol class="slats">
                    <?php
                    foreach($komentarji_zav as $k):
                        $ponudba = $this->offers_model->detail($k->comment_offer);
                    ?>
                        <div style="background-color: #eee; padding: 12px; border: 1px solid #ccc; width: 90%; margin-top: 5px; margin-left: 15px;">
                           
         
                                    <li class="group">		
                                            <p><?php echo $k->comment_body;?>
                                                <span class="meta">Uporabnik <?php echo $k->user_name;?> <?php echo $k->user_surname;?> je dne, <?php echo date("d.m.Y", strtotime($k->comment_created)); ?>  komentiral ponudbo <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"><?php echo $ponudba->offer_head;?></a></span>
                                                <span style="color: red; font-weight: bold;"><a href="<?php echo base_url();?>admin/acceptKomentar/<?php echo $k->comment_id;?>">POTRDI</a></span> |
                                                <span style="color: red; font-weight: bold;"><a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteKomentar/<?php echo $k->comment_id;?>">IZBRIS</a></span>
                                            </p>
                                    </li>			

          
                            	            
                        </div>       
                    <?php
                    endforeach;
                    ?>
			</ol>
		
		</article><!-- end of content manager article -->           
                
                <article class="module width_full">
		<header><h3 class="tabs_involved">Pregled potrjenih komentarjev</h3>
                </header>
                     <ol class="slats">
                    <?php
                    foreach($komentarji_akt as $k):
                        $ponudba = $this->offers_model->detail($k->comment_offer);
                    ?>
                        <div style="background-color: #eee; padding: 12px; border: 1px solid #ccc; width: 90%; margin-top: 5px; margin-left: 15px;">
                           
         
                                    <li class="group">		
                                            <p><?php echo $k->comment_body;?>
                                                <span class="meta">Uporabnik <?php echo $k->user_name;?> <?php echo $k->user_surname;?> je dne, <?php echo date("d.m.Y", strtotime($k->comment_created)); ?>  komentiral ponudbo <a href="<?php echo base_url();?>ponudba/<?php echo $ponudba->offer_slug;?>"><?php echo $ponudba->offer_head;?></a></span>
                                                <span style="color: red; font-weight: bold;"><a onclick="javascript:return confirm('Ste prepričani da želite zavrniti komentar?')" href="<?php echo base_url();?>admin/cancelKomentar/<?php echo $k->comment_id;?>">ZAVRNI</a></span> |
                                                <span style="color: red; font-weight: bold;"><a onclick="javascript:return confirm('Ste prepričani da želite izbrisati?')" href="<?php echo base_url();?>admin/deleteKomentar/<?php echo $k->comment_id;?>">IZBRIS</a></span>
                                            </p>
                                    </li>			

          
                            	            
                        </div>       
                    <?php
                    endforeach;
                    ?>
			</ol>
		
		</article><!-- end of content manager article -->
		
