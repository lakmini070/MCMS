<!DOCTYPE html>
<html lang="en-us" id="extr-page">
	<head>
		<meta charset="utf-8">
		<title>Medicare Center Management System</title>

		
		<!-- #CSS Links -->
		<!-- Basic Styles Login form-->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>">

		<!-- SmartAdmin Styles Login form : -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-production.min.css"); ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-skins.min.css"); ?>">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-rtl.min.css"); ?>"> 

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="<?php echo base_url("assets/img/favicon/favicon.jpg"); ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url("assets/img/favicon/favicon.jpg"); ?>" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="<?php echo base_url("assets/css/extranalcss.css"); ?>">

	</head>
	
	<body class="">
            <header id="header" style="background-color: darkblue; !important; background-image: none; border-bottom: 1px solid transparent !important;">
			</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">
                           
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">
						<h1 class="txt-color-blue login-header-big">WELCOME</h1>
						<div class="hero">
							<div class="pull-left login-desc-box-l">
                        <img src="<?php echo base_url("assets/img/favicon/logo1.png"); ?>" width="500px" height="700px" style=" margin-left: 100px"  alt="" class="img-responsive">
							</div>                                                 
						</div>                                           
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="<?php echo base_url("adminpanel/login/login_validation"); ?>" method="post" id="login-form" class="smart-form client-form">
								<header>
									Sign In
								</header>

								<fieldset>
									
									<section>
										<label class="label">User Name</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="vUserName">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please Enter User Name</b></label>
									</section>

									<section>
										<label class="label">Password</label>
										<label class="input"> <i class="icon-append fa fa-lock"></i>
											<input type="password" name="pPassword">
											<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter Password</b> </label>
									</section>
                                    <?php
                                        echo validation_errors('<div style="height:25px; padding:0px;" class="alert alert-danger" role="alert">', '</div>');
                                     ?>
                                     <?php if ($error != '') { ?>
                                      <div style="height:25px; padding:0px;" class="alert alert-danger" role="alert">
                                              <?php echo $error; ?>
                                      </div>                                  
                                      <?php } ?>                              
								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary">
										Sign in
									</button>
								</footer>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

		
		<!-- BOOTSTRAP JS -->		
		<script src="<?php echo base_url("assets/js/bootstrap/bootstrap.min.js"); ?>"></script>
		
		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url("assets/js/app.min.js"); ?>"></script>
   

	</body>
</html>