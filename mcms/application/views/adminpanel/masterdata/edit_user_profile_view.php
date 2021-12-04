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
        if (validation_errors() != "") {
            $showinput = 0;
            ?>
            <div class="alert alert-block alert-info">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><i class="fa fa-check-square-o"></i><?php echo validation_errors(); ?></h4>
            </div>
            <?php
        }
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
		
		<div class="jarviswidget">
                            <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Change Password</h2>
                            </header>
                            <div>
                                <!-- widget content -->
                                <div class="widget-body no-padding">
									<form action="<?php echo base_url('adminpanel/master/user_profile/change_password'); ?>" method="post" id="changepassword-form" class="smart-form" novalidate="novalidate">
                                        <header>
                                            Password
                                        </header>
                                    <div class="row">
                                        <div class="col col-sm-12">
                                            <fieldset style="border-bottom:1px solid rgba(0,0,0,.1); padding-bottom: 20px;">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <label class="label">Current Password</label>
                                                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                            <input type="password" name="pPasswordold" id="pPasswordold" value="<?php ?>">
														</section>

													</div>
													<div class="row">
														<section class="col col-6">
														<label class="label">New Password <span style=" color: red">*</span> ( Minimum 6 characters to Maximum 14 characters )</label>
														<label class="input"> <i class="icon-append fa fa-lock"></i>
														<input type="password" name="pPassword" id="pPassword" value="<?php ?>">
														<b class="tooltip tooltip-bottom-right">Don't forget your password</b>
														</label>
														</section>
														
														
														<section class="col col-6">
                                                        <label class="label">Retype Password</label>
                                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                        <input type="password" name="cPassword" id="cPassword" value="<?php ?>">
                                                        </label>
                                                        </section>
													</div>
                                                </div>                                            
                                            </fieldset>
                                        </div>
                                    </div>

										<footer>
											<button id="button1id" name="button1id" type="submit" class="btn btn-primary">Ok</button>
										</footer>
									</form>
                                </div>
                            </div>
	   </div>
    </div>
</div>  



<script type="text/javascript">

    $(document).ready(function () {


        var errorClass = 'invalid';
        var errorElement = 'em';

        var $checkoutForm = $('#changepassword-form').validate({
            errorClass: errorClass,
            errorElement: errorElement,
            highlight: function (element) {
                $(element).parent().removeClass('state-success').addClass("state-error");
                $(element).removeClass('valid');
            },
            unhighlight: function (element) {
                $(element).parent().removeClass("state-error").addClass('state-success');
                $(element).addClass('valid');
            },

            // Rules for form validation
            rules: {
                
                pPasswordold: {
                    required: true
                },
                pPassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 40
                },
                cPassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 40,
                    equalTo: '#pPassword'
                }
            },

            // Messages for form validation
            messages: {

                pPasswordold: {
                    required: 'Please enter your current password'
                },
                pPassword: {
                    required: 'Please enter your new password'
                },
                cPassword: {
                    required: 'Please enter your mew password one more time',
                    equalTo: 'Please enter the same password as above'
                }
            },

            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
     
    });

</script>
