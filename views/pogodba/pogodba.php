
<style>

    .half_left {
        float:left;
        width: 65%;
    }  
    .half_right {
        float:left;
        width: 25%;
    }
    .textLeft {
        text-align: left;
    }  
    .textRight {
        text-align: right;
    }
    .centerText {
        text-align: center;
    }
    .okvir {
        width: 100%;
        padding: 21px;
    }
    h1 {
        color: #2e2c2c;
        font-size: 20px;
        
    }
    .opis {
        width: 100%;
        padding: 21px;
    }
    h2 {
        font-size: 15px;
    } 
    h3 {
        font-size: 12px;
    }
    p {
        font-size: 12px;
    }
    #container {
        width: 100%;
        height:100%;
    }
    #noga {
        padding:21px;
        bottom: 0px;
        font-size: 11px;
    }
    .col_full {
        width: 100%;
        clear:both;
        margin-bottom: 15px;
        margin-top: 18px;
    }
    span.small {
        font-size: 9px;
    }
</style>
<div id="container">
<div class="okvir">
    <div class="half_left">
        <img src="http://dev.armopelus.com/oglasnik/assets/images/logo.png">
    </div>
    <div class="half_right textRight">
        <p>Fax: +386 1 256 15 31</p>
    </div>
    <div class="centerText col_full">
   Pogodba št. 000-000-<?php echo date("Y");?> <br /> o promocijski prodaji med</div>
    
<table border="1" bordercolor="#ccc" style="background-color:#fff; border: 1px solid #ccc;" width="100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Družba/podjetje:</td>
		<td><?php echo $part->ponudnik_title;?></td>
		<td align="center" width="10">in</td>
		<td align="center">PENTAGRAMA d.o.o.</td>
	</tr>
	<tr>
		<td>Zakoniti zastopnik:</td>
		<td><?php echo $part->ponudnik_person;?></td>
		<td></td>
		<td align="center">ID za DDV. SI403319036</td>
	</tr>
	<tr>
		<td>Poslovni naslov</td>
		<td><?php echo $part->ponudnik_address;?> <br /><?php echo $part->ponudnik_zip;?>, <?php echo $part->ponudnik_city;?></td>
		<td></td>
		<td align="center">Matična številka: <br />5356121000 <br /> Tip pogodbe: <br /> BLAGO</td>
	</tr>
	<tr>
		<td>Davčna številka ali <br />
ID za DDV :</td>
		<td><?php echo $part->ponudnik_tax;?></td>
		<td></td>
		<td align="center">Zastopnik  <br />
e-oglasnika:
</td>
	</tr>
	<tr>
		<td>Matična številka</td>
		<td><?php echo $part->ponudnik_mat;?></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Kontaktna oseba</td>
		<td><?php echo $part->ponudnik_legal;?></td>
		<td></td>
		<td align="center">Tel.: 01 256 15 34</td>
	</tr>
	<tr>
		<td>Tel.:</td>
		<td><?php echo $part->ponudnik_phone;?></td>
		<td></td>
		<td align="center">Faks.: 01 256 15 34</td>
	</tr>
	<tr>
		<td>E-mail</td>
		<td><?php echo $part->ponudnik_email;?></td>
		<td></td>
		<td align="center"></td>
	</tr>
	<tr>
		<td>Internetna stran</td>
		<td><?php echo $part->ponudnik_url;?></td>
		<td></td>
		<td align="center"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td align="center">Številka ponudbe: <br /></td>
	</tr>
</table>


    <div class="col_full">
        <div class="textLeft" style="width:50%; float:left;">
            
        <span class="small">(v nadaljevanju - Partner)</span>
        
        </div>
        <div class="textRight" style="width:50%; float:left;">
            
        <span class="small">(v nadaljevanju - PENTAGRAMA)</span>
        
        </div>
        <hr />
    </div>
<strong>Pogoji ponudbe</strong> – <span class="small">Informacije o kuponu</span> <br />
PENTAGRAMA d.o.o je izvajalec storitve e-oglasnik bo skozi to storitev predstavljala kupon v skladu z določbo 1.2 priloženih Splošnih pogojev poslovanja. Partner prodaja proizvode ali storitve opisane na kuponu. Kupon bo kupcem poslan v elektronski ali fizični obliki. Kupec bo lahko kupon zamenjal pri partnerju za proizvode ali storitve, ki so navedeni na kuponu (v času in pod pogoji, kot je to navedeno na kuponu):
<hr />
<strong>Partner s kuponom nudi (opis ponudbe; količina, popust): </strong><br/>
<?php echo $ponudba->offer_head;?>
<hr />
<strong>Posebna navodila ali omejitve: </strong><br/>
<?php echo $ponudba->offer_notes;?>
<hr />
<strong>Pogoji ponudbe: </strong><br/>
<table border="1" bordercolor="#ccc" style="background-color:#fff; border: 1px solid #ccc;" width="100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Osnovna MPC (z dostavo)</td>
		<td><?php echo $ponudba->offer_value;?> €</td>
		<td>Provizija e-oglasnika v EUR</td>
		<td><?php echo $ponudba->offer_provisionoglasnik;?> €</td>
	</tr>
	<tr>
		<td>Akcijska MPC preko e-oglasnika <br />(z dostavo)</td>
		<td><?php echo $ponudba->offer_price;?> €</td>
		<td>(Akcijska MPC preko e-oglasnika <br /> minus provizija e-oglasnika v EUR)</td>
		<td><?php $cena = $ponudba->offer_price - $ponudba->offer_provisionoglasnik;
                echo $cena;?> €</td>
	</tr>
	<tr>
		<td>Partnerju pripada</td>
		<td><?php echo $cena;?> €</td>
		<td></td>
		<td></td>
	</tr>
</table>
<hr />
1. Ponudba s strani partnerja je pogojena z minimalnim številom prodanih kuponov (v nadaljnjem besedilu – količinski prag), ki je dogovorjeno, kot to sledi iz nadaljevanja:<br />
2. Datum zaključka: partner se strinja, da bo ponudba na voljo skladno z zgoraj navedenimi pogoji v spodnjem navedenem obdobju:
<br />
<table border="1" bordercolor="#ccc" style="background-color:#fff; border: 1px solid #ccc;" width="100%" cellpadding="3" cellspacing="3">
	<tr>
		<td>Količinski prag</td>
		<td>Min <?php echo $ponudba->offer_minimal;?></td>
		<td>prodanih kuponov</td>
		<td>Rok veljavnosti kuponov</td>
		<td><?php echo $ponudba->offer_validuntil;?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td>po zaključku akcije</td>
		<td><span class="small"> 1 mesec = 30 dni </span></td>
	</tr>
</table>
<br />
Plačila partnerju se opravljalo na poslovni račun: <br />
<div style="padding: 8px; border: 1px solid #ccc"><?php echo $part->ponudnik_trr;?></div>
<br />
TRR partnerja<br />
X Partner je seznanjen in se strinjam s Splošnimi in posebnimi pogoji poslovanja.<br />
<br />
<div style="padding: 8px; border: 1px solid #ccc">
    
    <div style="width:50%; float:left;">
        Ljubljana <?php echo $datum;?>
    </div>
    
    <div style="width:50%; float:left;">
        <?php echo $part->ponudnik_legal;?>
    </div>
    
</div>
<div style="padding: 8px;">
    
    <div style="width:50%; float:left;">
        Kraj in datum
    </div>
    
    <div style="width:50%; float:left;">
        Zastopnik Partnerja
    </div>
    
</div>
<br />
<div style="padding: 8px; border: 1px solid #ccc">
    
    <div style="width:50%; float:left;">
        Ljubljana <?php echo $datum;?>
    </div>
    
    <div style="width:50%; float:left;">
        <?php echo $ponudba->k_name." ".$ponudba->k_surname;?>
    </div>
    
</div>
<div style="padding: 8px;">
    
    <div style="width:50%; float:left;">
        Kraj in datum
    </div>
    
    <div style="width:50%; float:left;">
        Zastopnik e-oglasnika
    </div>
    
</div>
<br />
<div style="padding: 8px; border: 1px solid #ccc">
    
    <div style="width:50%; float:left;">
        Pogodba je odobrena s strani <br />
        PENTAGRAMA d.o.o.
    </div>
    
    <div style="width:50%; float:left;">
        Ljubljana,  <?php echo $datum;?>
    </div>
    
</div>
<div style="padding: 8px;">
    
    <div style="width:50%; float:left;">
        &nbsp;
    </div>
    
    <div style="width:50%; float:left;">
        Kraj in datum
    </div>
    
</div>


<br /><br /><br /><br /><br /><br /><br />
Miro Peternelj <br />
direktor
<hr/>

</div>


</div>