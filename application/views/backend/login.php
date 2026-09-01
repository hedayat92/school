<!DOCTYPE html>  
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="We ddevelop creative software, eye catching software. We also train to become a creative thinker">
<meta name="author" content="OPTIMUM LINKUP COMPUTERS">
<meta name="keywords" content="multi school system, multi branch school, ofine school, super school, html rtl, html dir rtl, 
		rtl website template, bootstrap 4 rtl template, rtl bootstrap template, admin panel template rtl, admin panel rtl, html5 rtl, academy training course css template, 
		classes online training website templates, courses training html5 template design, education training rwd simple template, educational learning management jquery html, 
		elearning bootstrap education template, professional training center bootstrap html, institute coaching mobile responsive template, 
		marketplace html template premium, learning management system jquery html, clean online course teaching directory template, 
		online learning course management system, online course website template css html, premium lms training web template, training course responsive website"/>
		
	<link rel="icon"  sizes="16x16" href="<?php echo base_url() ?>uploads/logo.png">
	<title><?php echo get_phrase('login');?> ~ <?php echo get_settings('system_title');?></title>


    <meta name="title" Content="<?= get_settings('system_title');?>">
    <meta name="description" content="PHP school management software">
    <meta name="keywords" content="multi school system, multi branch school,elearning bootstrap education template,learning management system">
    <link rel="shortcut icon" href="<?= base_url() ?>uploads/logo.png" type="image/x-icon">

   
    <link rel="apple-touch-icon" href="<?= base_url() ?>uploads/logo.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="<?= get_settings('system_title');?>">
    
    <meta itemprop="name" content="<?= get_settings('system_title');?>">
    <meta itemprop="description" content="PHP school management software">
    <meta itemprop="image" content="<?= base_url() ?>uploads/seo.png">
   
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= get_settings('system_title');?>">
    <meta property="og:description" content="PHP school management software">
    <meta property="og:image" content="<?= base_url() ?>uploads/seo.png"/>
    <meta property="og:image:type" content="<?= base_url() ?>uploads/seo.png" />
   
    <meta property="og:image:width" content="<?= '600 x 315';?>" />
    <meta property="og:image:height" content="<?= '600 x 315';?>" />
    <meta property="og:url" content="<?= base_url('');?>">
    
    <meta name="twitter:card" content="summary_large_image">


	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/style.css">
	
	<link href="<?php echo base_url();?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
	</head>
	<body style="background-image:url(<?php echo base_url();?>assets/images/account-bgc.jpg);background-size:cover; background-repeat:no-repeat;overflow:hidden">
	 <!-- Preloader css -->
 <!-- Preloader css -->
		<style>
			#load{
				width:100%;
				height:100%;
				position:fixed;
				z-index:9999;
				background:url("<?php echo base_url();?>assets/images/loader.svg") no-repeat center center rgba(0,0,0,0.25)
			}
		</style>
	 <div id="load"></div>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
							<a href="<?php echo base_url();?>"><img src="<?php echo base_url() ?>uploads/logo.png" class="img-circle" height="70"/></a>
								<h2 id="lblGreetings"></h2>
								<p>Welcome to <?php echo get_settings('system_name');?> Please login with your email and password</p>
								<!--
								<a href="<?php echo base_url();?>auth/newRegistration" class="btn btn-white btn-outline-white"><?php echo get_phrase('sign_up');?></a>-->
							</div>
			      </div>
						<div class="login-wrap p-4 p-lg-5">
			      	
					<div class="d-flex">
			      		<div class="w-100">
						<style>
							.alert-red{
								background-color:red;
								color:white
							}
						</style>
						<?php if($this->session->flashdata('error_message') != "") : ?>
							<div class="alert alert-red hide_msg"><?=$this->session->flashdata('error_message');?></div>
							<?php endif;?>
						<?php if($this->session->flashdata('flash_message') != "") : ?>
							<div class="alert alert-success hide_msg"><?=$this->session->flashdata('flash_message');?></div>
						<?php endif;?>
			      			<h3 class="mb-4"><?php echo get_phrase('sign_in');?></h3>
			      		</div>		
			      	</div>
							<form method="post" class="signin-form" action="<?php echo base_url();?>login/validate_login">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name"><?php echo get_phrase('email_address');?></label>
			      			<input type="email" name="email" id="email" class="form-control" placeholder="<?php echo get_phrase('email');?>" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" name="password" class="form-control" placeholder="<?php echo get_phrase('password');?>" required>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary submit px-2"><?php echo get_phrase('sign_in');?></button>
		            </div>
		            <div class="form-group d-md-flex">
		            	<div class="w-50 text-left">
			            	<label class="checkbox-wrap checkbox-primary mb-0">Remember Me<input type="checkbox" checked><span class="checkmark"></span></label>
						</div>
						<div class="w-50 text-md-right">
							<a href="<?php echo base_url();?>login/reset_password">Forgot Password</a>
						</div>
		            </div>
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="<?php echo base_url();?>assets/login/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>assets/login/js/popper.js"></script>
  <script src="<?php echo base_url();?>assets/login/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/login/js/main.js"></script>
  <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
  <link rel="stylesheet" href="<?= base_url();?>assets/ladda/ladda.css">
  <script src="<?= base_url();?>assets/spin/spin.js"></script>
  <script src="<?= base_url();?>assets/ladda/ladda.js"></script>
  
	<script type="text/javascript">
		$(document).ready(function(){
		Ladda.bind('button[type=submit]');
		
	});
	</script> 
  <?= get_settings('tawk_to');?>
  	<script>
 		document.onreadystatechange = function () {
		  var state = document.readyState
		  if (state == 'interactive') {
			   document.getElementById('contents').style.visibility="hidden";
		  } else if (state == 'complete') {
			  setTimeout(function(){
				 document.getElementById('interactive');
				 document.getElementById('load').style.visibility="hidden";
				 document.getElementById('contents').style.visibility="visible";
			  },1000);
		  }
		}
  	</script>
	
    <!-- auto hide message div-->
    <script type="text/javascript">
        $( document ).ready(function(){
           $('.hide_msg').delay(2000).slideUp();
        });
    </script>
	
		<script>
			var myDate = new Date();
			var hrs = myDate.getHours();
		
			var greet;
		
			if (hrs < 12)
				greet = 'Good Morning';
			else if (hrs >= 12 && hrs <= 17)
				greet = 'Good Afternoon';
			else if (hrs >= 17 && hrs <= 24)
				greet = 'Good Evening';
		
			document.getElementById('lblGreetings').innerHTML =
				'<b>' + greet + '</b>';
		</script>
		
		<?php if (($this->session->flashdata('flash_message')) !=''):?>
			<script type="text/javascript">
			$(document).ready(function(){
			  $.toast({
				heading: 'Success Message',
				text: '<?php echo $this->session->flashdata('flash_message');?>',
				position: 'top-right',
				loaderBg: '#ff6849',
				icon:'success',
				hideAfter: '3500',
				stack: 6
			
			  });
			
			});
			</script>
		<?php endif;?>


	</body>
</html>

