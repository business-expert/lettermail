<style>
    body {
        background-color: #FF9B03;
    }
    #okvir {
        background-color: #eee;
        border: 1px solid #ccc;
        padding: 9px;
    }
    .col_full {
        width:100%;
        margin-bottom: 5px;
    }
    .center {
        text-align: center;
    }
    small {
        font-size: 8px;
    }
    .col_left {
        width: 40%;
        float:left;
        margin-right: 4%;
    }
    .col_right {
        width: 60%;
        float:left;
    }
h1 {
    font-family: "Myriad Pro", Myriad, "Liberation Sans", "Nimbus Sans L", "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size:22.6px;
    color:rgb(95, 115, 111);
    text-shadow: 0px 0px 3px #FFF;
    margin-top: 4px;
}
h2 {
    font-family: "Myriad Pro", Myriad, "Liberation Sans", "Nimbus Sans L", "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size:17px;
    color:#80AC24;
    text-shadow: 0px 0px 3px #FFF;
    margin-top: -22px;
}

.tabela {
	border-width: 1px;
	border-spacing: 0px;
	border-style: none;
	border-color: white;
	border-collapse: separate;
        width:100%;
}
.tabela th {
	border-width: 0px;
	padding: 1px;
	border-style: solid;
	border-color: white;
        font-size: 14px !important;
        color: #5F736F;
        width:100px;
}
.tabela td {
	border-width: 1px;
	padding: 1px;
	border-style: solid;
	border-color: white;
        font-size: 23px !important;
        color: #5F736F;
        font-weight: bold;
}
.tabela td.price-final {
    color:#E06020 !important;
    font-size: 42px !important;
    font-weight: bold !important;
    text-align: center;
}
a {
    color:#E06020 !important;
}
.product-notes-content {
    padding: 6px;
    font-size: 13px;
    text-shadow: 1px 2px 0px #FFF;
}
.product-notes-content ul {
    list-style: none;
    margin-left: -45px;
}
.product-notes-content li {
    list-style: none;
    margin-top: 8px;
    border-bottom: 1px dotted #666666;
}
</style>
<img src="<?php echo base_url();?>assets/images/logo.png" />
<div class="col_full center">
    <small>predogled ponudbe</small>
</div>
<div id="okvir">
    <div class="col_left">
                   <img src="
                            <?php if(!empty($ponudba->offer_image1)) : ?>
                            <?php echo base_url();?>thumb.php?h=250&w=250&src=<?php echo base_url();?>uploads-ponudbe/<?php echo $ponudba->offer_image1;
                            else:  ?>
                           <?php echo base_url();?>thumb.php?h=340&q=100&w=305&src=<?php echo base_url();?>uploads-ponudbe/no-image.jpg
                           <?php endif; ?>" class="imgpost">
                   
            <div style="background-color: white; padding: 5px; width: 90%">
                     <h3>Opombe</h3>
                     <div class="product-notes-content">
                        Veljavnost kupona: <?php echo $ponudba->offer_validuntil;?>
                     </div>
            </div>
                   
    </div>
    
    <div class="col_right">
            <h1> <?php echo $ponudba->offer_head;?></h1>
            <h2> <?php echo $ponudba->offer_subhead;?></h2>
 
            
            <table class="tabela" border=0>
            <tbody>
                <!-- Results table headers -->
                <tr align="center" cellspacing="10">
                <th>VREDNOST</th>
                <th>POPUST</th>
                <th>PRIHRANEK</th>
                <th></th>
                </tr>
                <tr>
                <td><?php echo $ponudba->offer_value;?> €</td>
                <td><?php echo $ponudba->offer_discount;?> %</td>
                <td><?php echo $ponudba->offer_save;?> €</td>
                <td class="price-final"><?php echo $ponudba->offer_price;?> €</td>
                </tr>
            </tbody>
            </table>
            <br />
            <div style="background-color: white; padding: 5px; width: 100%">
                    <?php echo $ponudba->offer_shortdesc;?>
                    <?php if(!empty($ponudba->offer_shortdesc)) :?><hr /> <?php endif;?>
                    <?php echo $ponudba->offer_longdesc;?>
                    <br />
                    <h2>Plačaj <?php echo $ponudba->offer_price;?> € za ponudbo v vrednosti <?php echo $ponudba->offer_value;?> €! <a href="<?php echo base_url();?>kupi/<?php echo $ponudba->offer_id;?>">NAKUP!</a></h2>
            </div>
            
      </div>
    
</div>