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

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="<?php echo base_url();?>assets/login/css/style.css">

	</head>
	<body style="background-image:url(<?php echo base_url();?>assets/images/account-bgc.jpg)" style="background-size: cover;">
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
				
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
							<div class="text w-100">
							<a href="<?php echo base_url();?>"><img src="<?php echo base_url() ?>uploads/logo.png" height="150"/></a>
								<h2 id="lblGreetings"></h2>
								<p>Welcome to <br> <?php echo get_settings('system_name');?><br> Please login with your email and password</p>
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
							.alert-green{
								background-color:green;
								color:white
							}
						</style>
							<?php if($this->session->flashdata('error_message') != "") : ?>
								<div class="alert alert-red hide_msg"><?=$this->session->flashdata('error_message');?></div>
							<?php endif;?>
							<?php if($this->session->flashdata('flash_message') != "") : ?>
								<div class="alert alert-green hide_msg"><?=$this->session->flashdata('flash_message');?></div>
							<?php endif;?>
			      			<h3 class="mb-4"><?php echo get_phrase('login_here');?></h3>
			      		</div>		
			      	</div>
							<form method="post" class="signin-form" action="<?php echo base_url();?>login/validate_login">
			      		<div class="form-group mb-3">
			      			<input type="email" name="email" id="email" class="form-control" placeholder="<?php echo get_phrase('email');?>" required>
			      		</div>
		            <div class="form-group mb-3">
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
           $('.hide_msg').delay(3000).slideUp();
        });
    </script>
	
		<script>
			var myDate = new Date();
			var hrs = myDate.getHours();
		
			var greet;
		
			if (hrs < 12)
				greet = 'Good Morning';
			else if (hrs >= 12 && hrs <= 16)
				greet = 'Good Afternoon';
			else if (hrs >= 16 && hrs <= 24)
				greet = 'Good Evening';
		
			document.getElementById('lblGreetings').innerHTML =
				'<b>' + greet + '</b>';
		</script>
		
		


	</body>
</html>

