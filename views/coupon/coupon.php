
<style>

    .half_left {
        float:left;
        width: 65%;
    }  
    .half_right {
        float:left;
        width: 35%;
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
        border: 1.8px dashed orange;
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
</style>
<div id="container">
<div class="okvir">
    <div class="half_left">
        <img src="http://dev.armopelus.com/oglasnik/assets/images/logo.png">
    </div>
    <div class="half_right textRight">
        <p>Koda kupona: <?php echo $coupon->c_value;?></p>
    </div>
    
    <h1> <?php echo $ponudba->offer_head;?> </h1>
    <?php
    
    ?>
    <div class="half_left">
        <strong>Podatki o naslovu unovčenja kupona:</strong><br />
        <?php echo $ponudba->ponudnik_title;?> <br />
        <?php echo $ponudba->offer_address;?><br />
        <?php echo $ponudba->offer_zip;?> <?php echo $ponudba->offer_city;?><br />
        Tel.: <?php echo $ponudba->offer_phone;?><br />
        E-naslov: <?php echo $ponudba->offer_email;?><br />
        Delovni čas: <?php echo $ponudba->offer_worktime;?>
    </div>
    <div class="half_right">
        <strong>Vrednost kupona:</strong> <?php echo $ponudba->offer_value;?> €<br />
        <strong>Cena e-oglasnik kupona:</strong> <?php echo $ponudba->offer_price;?> €<br />
        <strong>Številka kupona:</strong> <?php echo $coupon->c_value;?><br />
        <strong>Porabnik kupona:</strong> <?php echo $coupon->rec_name." ".$coupon->rec_surname;?><br />
        <strong>Rok veljavnosti:</strong> do <?php echo $ponudba->offer_validuntil;?><br />
    </div>
</div>

<div class="opis">
    <h2>Podrobnosti o ponudbi:</h2> <br />
    <p>
        <?php echo $ponudba->offer_notes;?>
    </p>
    
    <hr />
    
    <h3>Kako uporabite kupon:</h3> <br />
<p>In hac habitasse platea dictumst. Phasellus eget dui vel lacus rhoncus suscipit a eu nisl. Maecenas quis neque eros.
    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris ante leo, vestibulum quis 
    imperdiet vitae, fermentum quis odio. Sed ipsum mauris, condimentum id ultrices vitae, porttitor eu augue. Quisque et sapien 
    ut lacus porta scelerisque! Maecenas aliquam nisl justo. Maecenas vel sagittis tortor.</p>



</div>
</div>