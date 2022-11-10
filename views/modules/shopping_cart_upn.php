<?php
$counter = 0;
foreach ($this->cart->contents() as $items):
    if($counter == 1) : break; endif;
    
    $ponudba_id = $items['id'];
    $ponudba    = $this->offers_model->detail($ponudba_id);
endforeach;
?>
<div id="main" role="main" class="roundedCorners5">
      <div id="main-content">
          <h1> Podatki za nakup z UPN nalogom </h1>
            <?php if($this->session->flashdata('message') != '') : ?>
            <div class="notification <?php echo $this->session->flashdata('type'); ?>">
            <p><?php echo $this->session->flashdata('message'); ?>
            </p>
            </div>
            <?php endif; ?>
          <center>
              <h3>Deli nakup z prijatelji</h3><br />
              <div style="margin-top:-25px;">
                <?php
                $title=urlencode($ponudba->offer_head);
                $url=urlencode(base_url()."ponudba/".$ponudba->offer_slug);
                $summary=urlencode($ponudba->offer_subhead);
                $image=urlencode(base_url()."thumb.php?src=".base_url()."uploads-ponudbe/".$ponudba->offer_image1."&h=100&w=100");
                ?>
                  <a onClick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $summary;?>&amp;p[url]=<?php echo $url; ?>&amp;&amp;p[images][0]=<?php echo $image;?>','sharer','toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)"><img src="http://aux.iconpedia.net/uploads/1751756290795472443.png" width="48" height="48"></a></a>
                  <a href="http://twitter.com/home?status=Pravkar naročil <?php echo $title ?>" title="Click to send this page to Twitter!" target="_blank"><img src="http://aux2.iconpedia.net/uploads/4479766462042748275.png" width="48" height="48"></a>
              </div>
          </center>
Prosimo, da položnico poravnate v roku 7 delovnih dni, sicer se kuponi brišejo. Do plačila naročilo in kupon nista veljavna.
Položnico lahko poravnate na pošti, banki ali preko elektronskega bančništva.
Po plačilu lahko traja do dva delovna dneva, da aktiviramo vaše naročilo. V roku 7 delovnih dni po plačilu bomo na vaš naslov poslali tudi račun za vplačani znesek. 
      
            <h2>Podatki za plačilo</h2>
            IBAN: SI56 0600 0011 8837 230 <br/>
            Referenca: SI 000 <?php echo $reference;?> <br/>
            Ime in priimek /naziv: Pentagrama d.o.o.<br/>
            Ulica in hišna številka: Cesta Dolomitskega odreda 10<br/>
            Pošta in kraj: 1000 Ljubljana<br/>
            Znesek: <?php echo $vsota;?> €
            
<?php $this->cart->destroy();?>
     </div>
</div>
