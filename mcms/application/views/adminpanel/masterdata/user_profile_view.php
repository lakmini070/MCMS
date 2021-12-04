<style>
    #sparks li span {
        display: block;
        font-weight: 900;
        margin-top: 5px;
    }

    #iUserType{
        color: #FF0000;
    }

</style>

<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">

    </div>
	 
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i> 
                    My Profile
                </h1>
            </div> 
 
        </div>
        <?php
        $showinput = 1;
        
        ?>
        <?php
        if ($this->session->flashdata('message_error') != "") {
            $showinput = 0;
            ?>
            <div class="alert alert-block alert-danger">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><i class="fa fa-check-square-o"></i><?php echo $this->session->flashdata('message_error'); ?></h4>
            </div>
            <?php
        }
        ?>
        <?php
        if ($this->session->flashdata('message_saved') != "") {
            $showinput = 0;
            ?>
            <div class="alert alert-block alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><i class="fa fa-check-square-o"></i><?php echo $this->session->flashdata('message_saved'); ?></h4>
            </div>
            <?php
        }
        ?>

        <div class="row">
            <div class="col-sm-12">
                <div class="well well-sm">
                    <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-11" style="width:100%">
                    <div class="well well-light well-sm no-margin no-padding">
                            <div class="row">
                                    <div class="col-sm-12" style="width:100%">
                                           
                                    </div>

                                    <div class="col-sm-12">
                                            <div class="row">
                                                <a  href="<?php echo base_url("adminpanel/master/user_profile/change_profile_picture"); ?>">
                                                    
                                                    <div class="col-sm-3 profile-pic" style="top: 75px;">
                                                        <?php 
                                                            $fProfilePic=$profile_data[0]['fProfilePic'];
                                                            
                                                            if($fProfilePic==''){
                                                                $pic='user.png';
                                                            }else{
                                                                $pic=$fProfilePic;
                                                            }
                                                        ?>
                                                        <img src="<?php echo base_url("assets/img/profile_pic/$pic"); ?>" style="width: 100px; height: 100px;">
                                                            
                                                    </div>
                                                </a>
                                                    <div class="col-sm-6">
                                                        <h1><?php echo $profile_data[0]['vFirstName']; ?> <span class="semi-bold"><?php echo $profile_data[0]['vLastName']; ?></span>
                                                            <br>
                                                            <small><?php echo $profile_data[0]['vAccTypeName']; ?></small></h1>

                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <p class="text-muted">
                                                                        <i class="fa fa-phone"></i>&nbsp;&nbsp;<span class="txt-color-darken"><?php echo $profile_data[0]['vContactNo']; ?></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="text-muted">
                                                                        <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:<?php echo $profile_data[0]['vEmail']; ?>"><?php echo $profile_data[0]['vEmail']; ?></a>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="text-muted">
                                                                        <i class="fa fa-home"></i>&nbsp;&nbsp;<span class="txt-color-darken"><?php echo $profile_data[0]['tAddress']; ?></span>
                                                                    </p>
                                                                </li>
                                                                <li>
                                                                    <p class="text-muted">
                                                                        <i class="fa fa-user"></i>&nbsp;&nbsp;<span class="txt-color-darken"><?php echo $profile_data[0]['vUserName']; ?></span>
                                                                    </p>
                                                                </li>
                                                            </ul>
                                                            <br>
                                                            <br>
<a href="<?php echo base_url("adminpanel/master/user_profile/edit_user_profile"); ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i> Change Password</a>
															<br>
                                                            <br>
                                                    </div>
											</div>
                                    </div>
                            </div>
						</div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  


<script type="text/javascript">

</script>
