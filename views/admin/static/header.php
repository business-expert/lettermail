<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo $title;?></title>
        <script type="text/javascript">
         var base_url = "<?php echo base_url();?>";
        </script>
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo base_url();?>assets/admin/js/jquery-1.5.2.min.js" type="text/javascript"></script>
         <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/admin/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/jquery.equalHeight.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admin/js/timepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/admin/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/admin/highcharts.js"></script>
	<script type="text/javascript">
            jQuery(function($){
            $.datepicker.regional['sl'] = {clearText: 'Očiten', clearStatus:
            '',
                    closeText: 'Zapri', closeStatus: '',
            prevText: '&laquo;Prej', prevStatus: '',
                    nextText: 'Naslednji&raquo;', nextStatus: '',
                    currentText: 'Danes', currentStatus: '',
            monthNames:
            ['Januar','Februar','Marec','April','Maj','Junij',
            'Julij','Avgust','September','Oktober','November','December'],
            monthNamesShort: ['Jan','Feb','Mar','Apr','Maj','Jun',
            'Jul','Avg','Sep','Okt','Nov','Dec'],
                    monthStatus: '', yearStatus: '',
                    weekHeader: 'Ve', weekStatus: '',
                    dayNamesShort: ['Ned','Pon','Tor','Sre','Čet','Pet','Sob'],
                    dayNames:
            ['Nedelja','Ponedeljek','Torek','Sreda','Četrtek','Petek','Sobota'],
                    dayNamesMin: ['Ne','Po','To','Sr','Če','Pe','So'],
                    dayStatus: 'DD', dateStatus: 'D, M d',
            dateFormat: 'dd.mm.yy', firstDay: 1,
                    initStatus: '', isRTL: false};
            $.datepicker.setDefaults($.datepicker.regional['sl']);
            }); 
	$(document).ready(function() 
        
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="<?php echo base_url();?>admin">e-oglasnik - Administracija</a></h1>
			<h2 class="section_title">Nadzorna plošča</h2><div class="btn_view_site"><a href="<?php echo base_url();?>" target="_blank">Poglej stran</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>Pozdrav, <?php echo $user_status->user_name." ".$user_status->user_surname;?>! <a href="<?php echo base_url();?>login/logout">Odjava</a></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
		</div>
	</section><!-- end of secondary bar -->