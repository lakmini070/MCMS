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
    <!-- END RIBBON -->  
	
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

		<div class="jarviswidget">                            
                            <header>
                                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                    <h2>Change Profile Picture</h2>
                            </header>

                            <!-- widget div-->
                            <div>
                                <div class="widget-body no-padding">
                                    <form action="<?php echo base_url('adminpanel/master/user_profile/save_profile_pic'); ?>" method="post" id="changepic-form" class="smart-form" novalidate="novalidate" enctype="multipart/form-data">
                                        <header>
                                            Profile Picture
                                        </header>                                                   
                                    <div class="row">
										<div class="col col-sm-12">                                                       
                                            <fieldset >
                                                <div class="form-group">
                                                    <div class="row">
                                                        <section class="col col-6">
                                                            <div class="input input-file">                                                                       
                                                                <input type="file" id="fProfilePic" name="fProfilePic" class="form-control valid" aria-invalid="false"  required>
																<label class="label"><span style=" color: red">*</span> ( Please select a picture )</label>
                                                            </div>
                                                        </section>
                                                    </div>             
                                                </div>
                                            </fieldset>                                                        
										</div>
									</div>

                                <footer>
                                    <input type="hidden" id="uploadpath" name="uploadpath" value="assets/img/profile_pic">
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

        var $checkoutForm = $('#changepic-form').validate({
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
                
                fProfilePic: {
                    required: true
                }
            },

            // Messages for form validation
            messages: {

                fProfilePic: {
                    required: 'Please select a picture'
                }
            },

            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
     
    });
</script>
