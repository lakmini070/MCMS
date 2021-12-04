<style>
    .dash_bg{
        background-position: center center;
        background-size: cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        background-image: url('<?php echo base_url('assets/img/doctor.jpg'); ?>');
        height: 200px;
		display: block;
		}
	
	.alert-heading {
    font-weight: 600;
	color: dark blue;
	}
</style>

<?php
$userid=$this->session->userdata('oba_userbackendsession');
$usertype = $this->session->userdata('oba_iUserTypeBackendsession');


$hour = date('H', time());
$gritting = "";
if ($hour >= 0 && $hour <= 11) {
    $gritting = "Good Morning";
} else if ($hour > 11 && $hour <= 16) {
    $gritting = "Good Afternoon";
} else if ($hour > 16 && $hour <= 23) {
    $gritting = "Good Evening";
} else {
    
}


?>

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">
    </div>

    <div id="content">
			<br>
        <div class="alert alert-info alert-block">
               
                <h1 style="text-align: center;" class="alert-heading"> Hello, <?php echo $gritting . " , " . $this->session->userdata('oba_vFirstNamebackendsession'); ?></h1>
		
        </div>
		
		<div class="bgimg">
		
		<div style="background-image: url(<?php echo base_url('assets/img/doctor.jpg'); ?>);height: 270px; width: 1100px;"></div>

		</div>
		<br>
		<div class="alert alert-info alert-block">
               
                <h1 style="text-align: center;" class="alert-heading">We hope each new day brings you closer to a full and speedy recovery!</h1>
        </div>

</div>

</div>