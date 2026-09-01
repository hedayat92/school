	<?php
		if ($set_direction = $this->session->userdata('set_direction')) {
		} else {
			$set_direction = get_settings('text_align');
		}
	?>

<!DOCTYPE html>
<html lang="en" dir="<?php if ($set_direction == 'right-to-left') echo 'rtl';?>">
	<?php
		if ($skin_colour = $this->session->userdata('skin_colour')) {
		} else {
			$skin_colour = get_settings('skin_colour');
		}
	?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="A complete and most powerful school system management system for all. Purchase and enjoy">
    <meta name="author" content="OPTIMUM LINKUP COMPUTERS">

    

    <link rel="icon"  sizes="16x16" href="<?php echo base_url() ?>uploads/logo.png">
    <title><?=ucfirst($page_name);?>&nbsp;|&nbsp;<?=get_settings('system_title');?></title>
    <!-- Bootstrap Core CSS -->
    
    <link href="<?php echo base_url(); ?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet" type="text/css"/>
    <!-- Menu CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet" type="text/css"/>
    <!-- morris CSS -->
	
	    <!--alerts CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/morrisjs/morris.css" rel="stylesheet" type="text/css"/>
    <!-- animation CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Custom CSS -->
    
    <!-- Custom CSS -->
	<?php if ($set_direction == 'right-to-left') { ?>
	  <link href="<?php echo base_url(); ?>optimum/css/style-rtl.css" rel="stylesheet" type="text/css"/>
	<?php } if($set_direction == 'left-to-right') { ?>
	  <link href="<?php echo base_url(); ?>optimum/css/style.css" rel="stylesheet" type="text/css"/>
	<?php } if($skin_colour == 'black') { ?>
	<link href="<?php echo base_url(); ?>optimum/css/default-dark.css" rel="stylesheet" type="text/css"/>
	<?php } ?>





    
    <!-- color CSS -->
	 <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropify/dist/css/dropify.min.css" type="text/css"/>
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" / >


	<?php if($skin_colour != 'black') : ?>
		<!-- color CSS -->
		<link href="<?php echo base_url(); ?>optimum/css/colors/<?=$skin_colour?>.css" id="theme"  rel="stylesheet" type="text/css"/>
	<?php endif;?>
    
	<?php if($skin_colour == 'black') : ?>      
	<!-- color CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/colors/default-dark.css" id="theme" rel="stylesheet" type="text/css"/>
	<?php endif;?>
	
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" type="text/css"/ >
	
	 <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" / >
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" / >
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" / >
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
	
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/skins/all.css" rel="stylesheet">
		
		
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/plugins/bower_components/gallery/css/animated-masonry-gallery.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/plugins/bower_components/fancybox/ekko-lightbox.min.css" />

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>optimum/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	
	
	 <!--Owl carousel CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/owl.carousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/owl.carousel/owl.theme.default.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url(); ?>js/font-awesome-icon-picker/fontawesome-four-iconpicker.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/sweetalert.css" type="text/css">
	
									

	
	
	<script src="<?php echo base_url(); ?>optimum/js/jquery-1.11.0.min.js"></script>


	<!--<link href="<?php echo base_url(); ?>optimum/fullcalendar/css/style.css" rel="stylesheet">-->

    <!--Amcharts-->
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/pie.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/serial.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/gauge.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/funnel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/radar.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/amexport.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/canvg.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>
        <!-- Resources -->
    <script src="<?php echo base_url(); ?>optimum/amcharts/core.js"></script>
    <script src="<?php echo base_url(); ?>optimum/amcharts/charts.js"></script>
    <script src="<?php echo base_url(); ?>optimum/amcharts/animated.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>

        
