<!DOCTYPE html>

<?php
    $userid=$this->session->userdata('oba_userbackendsession');
	$iUserType=$this->session->userdata('oba_iUserTypeBackendsession');
	$current_controller=$this->uri->segment(3);
	if($current_controller==''){
		$current_controller=$this->uri->segment(2);
	}
	
    $fProfilePic= load_user_profile_pic($userid);
    if($fProfilePic==''){
        $pic='user.png';
    }else{
        $pic=$fProfilePic;
    }
?>

<html lang="en-us" class="smart-style-0">
	<head>
		<meta charset="utf-8">

		<title>Medicare Center Management System</title>


		<!-- Basic Styles font and patern -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>">

		<!-- SmartAdmin Styles_skin : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-production-plugins.min.css"); ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-production.min.css"); ?>">
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-skins.min.css"); ?>">

		<!-- SmartAdmin RTL Support  -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/smartadmin-rtl.min.css"); ?>">

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url("assets/css/demo.min.css"); ?>">

		<!-- FAVICONS -->
		<link rel="shortcut icon" href="<?php echo base_url("assets/img/favicon/favicon.jpg"); ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url("assets/img/favicon/favicon.jpg"); ?>" type="image/x-icon">

		<!-- GOOGLE FONT -->
		<link rel="stylesheet" href="<?php echo base_url("assets/css/extranalcss.css"); ?>">

		<!-- jQuery --> <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 

		<!-- Select2 JS --> 
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    </head>

        <?php?>
        <body class="smart-style-0   fixed-header fixed-navigation ">
        <header id="header">

			<!-- pulled right: nav area -->
			<div class="pull-right">

				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>

				<!-- logout button -->
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a href="<?php echo base_url("adminpanel/login/logout"); ?>" title="Log Out" data-action="userLogout" data-logout-msg="You can successfully logged out!"><i class="fa fa-sign-out"></i></a> </span>
				</div>

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>

			</div>

		</header>

        <!-- Left panel : Navigation area -->

        <aside id="left-panel">

            <!-- User info -->
				<div class="login-info">
				<span>
					<a href="<?php echo base_url("adminpanel/master/user_profile/view_profile"); ?>" >
                    <img src="<?php echo base_url("assets/img/profile_pic/$pic"); ?>" alt="me" class="online" style="width: 26px; height: 26px;"/> 
					<span>
						<?php echo $this->session->userdata('oba_vFirstNamebackendsession'); ?> 
					</span>
					</a>
				</span>
				</div>


                <?php ?>
				<nav>
                    <ul>
                    	<li <?php if($current_controller=='managedashboard'){ echo "class='active'"; } ?>>
                    		<a href="http://localhost/mcms/adminpanel/managedashboard" data-id="1"><i class="fa fa-lg fa-fw fa-home"></i><span class="menu-item-parent">Dashboard</span></a>
                    	</li>


                    	<?php if($iUserType=='1' || $iUserType=='34' || $iUserType=='35') { ?>
                    	<li <?php if($current_controller=='check_availability'){ echo "class='open'"; } ?>>
                    		<a href="#" data-id="1000"><i class="fa fa-lg fa-fw fa-user-md"></i><span class="menu-item-parent">Doctor Channel</span><b class="collapse-sign"><em class="fa fa-plus-square-o"></em></b></a>
                    		<ul>
                    			<li <?php if($current_controller=='check_availability'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/check_availability/view_check_availability"><i class=""></i><span class="menu-item-parent">Make Appointment</span></a>
                    			</li>
                    		</ul>
                    	</li>
                    	<?php } ?>


                    	<?php if($iUserType=='1' || $iUserType=='34') { ?>
                    	<li <?php if($current_controller=='myprescription' || $current_controller=='user_profile'){ echo "class='open'"; } ?>>
                    		<a href="#" data-id="1003"><i class="fa fa-lg fa-fw fa-user"></i><span class="menu-item-parent">My Profile</span><b class="collapse-sign"><em class="fa fa-plus-square-o"></em></b></a>
                    		<ul>
                    			<li <?php if($current_controller=='myprescription'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/myprescription/view_myprescription"><i class=""></i><span class="menu-item-parent">View Prescription</span></a>
                    			</li>
                    			<li <?php if($current_controller=='user_profile'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/user_profile/view_profile"><i class=""></i><span class="menu-item-parent">Profile</span></a>
                    			</li>
                    		</ul>
                    	</li>
                    	<?php } ?>


                    	<?php if($iUserType=='1' || $iUserType=='35') { ?>
                    	<li <?php if($current_controller=='availability' || $current_controller=='appointment'){ echo "class='open'"; } ?>>
                    		<a href="#" data-id="1007"><i class="fa fa-lg fa-fw fa-comments"></i><span class="menu-item-parent">Appointment</span><b class="collapse-sign"><em class="fa fa-plus-square-o"></em></b></a>
                    		<ul>
                    			<li <?php if($current_controller=='availability'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/availability/view_availability"><i class=""></i><span class="menu-item-parent">Availability Management</span></a>
                    			</li>
                    			<li <?php if($current_controller=='appointment'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/appointment/view_appointment"><i class=""></i><span class="menu-item-parent">Appointment Details</span></a>
                    			</li>
                    		</ul>
                    	</li>
                    	<?php } ?>



                    	<?php if($iUserType=='1' || $iUserType=='35') { ?>
                    	<li <?php if($current_controller=='patient'){ echo "class='active'"; } ?>>
                    		<a href="http://localhost/mcms/adminpanel/master/patient/view_patient" data-id="200"><i class="fa fa-lg fa-fw fa-info-circle"></i><span class="menu-item-parent">Patient Details</span></a>
                    	</li>
                    	<?php } ?>



                    	<?php if($iUserType=='1' || $iUserType=='33') { ?>
                    	<li <?php if($current_controller=='prescription'){ echo "class='active'"; } ?>>
                    		<a href="http://localhost/mcms/adminpanel/master/prescription/add_prescription" data-id="1008"><i class="fa fa-lg fa-fw fa-paperclip"></i><span class="menu-item-parent">Prescription</span></a>
                    	</li>
                    	<?php } ?>


                    	<?php if($iUserType=='1' || $iUserType=='36') { ?>
                    	<li <?php if($current_controller=='invoice_prescription' || $current_controller=='drug' || $current_controller=='inv_list'){ echo "class='open'"; } ?>>
                    		<a href="#" data-id="1009"><i class="fa fa-lg fa-fw fa-medkit"></i><span class="menu-item-parent">Pharmacy Management</span><b class="collapse-sign"><em class="fa fa-plus-square-o"></em></b></a>
                    		<ul>
                    			<li <?php if($current_controller=='invoice_prescription'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/invoice_prescription/view_invoice_prescription"><i class=""></i><span class="menu-item-parent">Create Invoice</span></a>
                    			</li>
                    			<li <?php if($current_controller=='drug'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/drug/add_drug"><i class=""></i><span class="menu-item-parent">Medicine</span></a>
                    			</li>
                    			<li <?php if($current_controller=='inv_list'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/inv_list/view_inv_list"><i class=""></i><span class="menu-item-parent">Invoice List</span></a>
                    			</li>
                    		</ul>
                    	</li>
                    	<?php } ?>


                    	<?php if($iUserType=='1' || $iUserType=='36' || $iUserType=='35' || $iUserType=='33') { ?>
                    	<li <?php if($current_controller=='drug_report' || $current_controller=='today_appointment_report' || $current_controller=='min_drug_report' || $current_controller=='Patient_report'){ echo "class='open'"; } ?>>
                    		<a href="#" data-id="1012"><i class="fa fa-lg fa-fw fa-flag"></i><span class="menu-item-parent">Reports </span><b class="collapse-sign"><em class="fa fa-plus-square-o"></em></b></a>
                    		<ul>

                    			<?php if($iUserType=='1' || $iUserType=='36' || $iUserType=='33') { ?>
                    			<li <?php if($current_controller=='drug_report'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/drug_report/view_drug"><i class=""></i><span class="menu-item-parent">Drug Report</span></a>
                    			</li>
                    			<?php } ?>

                    			<?php if($iUserType=='1' || $iUserType=='35') { ?>
                    			<li <?php if($current_controller=='today_appointment_report'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/today_appointment_report/view_today_appointment"><i class=""></i><span class="menu-item-parent">Today's Appointment</span></a>
                    			</li>
                    			<?php } ?>

                    			<?php if($iUserType=='1' || $iUserType=='36') { ?>
                    			<li <?php if($current_controller=='min_drug_report'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/min_drug_report/view_min_drug"><i class=""></i><span class="menu-item-parent">Min Qty Drug Report</span></a>
                    			</li>
                    			<?php } ?>

								<?php if($iUserType=='1') { ?>
                    			<li <?php if($current_controller=='Patient_report'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/Patient_report/view_patient "><i class=""></i><span class="menu-item-parent">Patient Report</span></a>
                    			</li>
                    			<?php } ?>
                    		</ul>
                    	</li>
                    	<?php } ?>

						<?php if($iUserType=='1') { ?>
                    	<li <?php if($current_controller=='user'){ echo "class='open'"; } ?>><a href="#" data-id="100"><i class="fa fa-lg fa-fw fa-users"></i><span class="menu-item-parent">Staff Managment</span><b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b></a>
                    		<ul>
                    			<li <?php if($current_controller=='user'){ echo "class='active'"; } ?>>
                    				<a href="http://localhost/mcms/adminpanel/master/user/view_user"><i class=""></i><span class="menu-item-parent">Staff Users</span></a>
                    			</li>
                    		</ul>
                    	</li>
                    	<?php } ?>

                    </ul>
                </nav>

        </aside>


    <script src="<?php echo base_url("assets/ajax/libs/jquery/3.2.1/jquery.min.js");?>"></script>
	<script>
			if (!window.jQuery) {
				document.write('<script src="<?php echo base_url("assets/js/libs/jquery-3.2.1.min.js");?>"><\/script>');
			}
	</script>

	<script src="<?php echo base_url("assets/ajax/libs/jquery/3.2.1/jquery-ui.min.js");?>">"></script>
	<script>
			if (!window.jQuery.ui) {
				document.write('<script src="<?php echo base_url("assets/js/libs/jquery-ui.min.js");?>"><\/script>');
			}
	</script>



