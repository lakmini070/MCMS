<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);

if ($saveStatus == "A") {
    $id= "";
    $d_id = "";
    $dSheduleDate = "";
    $vSheduleStartTime = "";
    $vSheduleEndTime = "";
    $cEnable = "";
    $iPatient_count = "";
 
    
	
	   
}
if ($saveStatus == 'E') {
    $id = $edit_availability[0]->id;
    $d_id = $edit_availability[0]->d_id;
    $dSheduleDate = $edit_availability[0]->dSheduleDate;
    $vSheduleStartTime = $edit_availability[0]->vSheduleStartTime;
    $vSheduleEndTime = $edit_availability[0]->vSheduleEndTime;
    $iPatient_count = $edit_availability[0]->iPatient_count;
    $cEnable = $edit_availability[0]->cEnable;
   
    
    
}
//echo $saveStatus;
?>

<style>
    
    #sparks li {
    display: inline-block;
    max-height: 47px;
    width: 95px;
}
    
    #sparks li h5 {
    color: #555;
    font-size: 11px;
    font-weight: 400;
    margin: -3px 0 0 0;
    padding: 0;
    border: none;
    font-weight: 900;
    text-transform: uppercase;
    text-align: center;
}
    
    #sparks li span {
    color: #324b7d;
    display: block;
    font-weight: 900;
    margin-top: 5px;
}

#sparks li h5:hover{
    color: #999999;
}

#sparks li span:hover{
    color: #ffffff;
}

    
</style>


<div id="main" role="main">
    <!-- RIBBON -->
    <div id="ribbon">
    <span class="ribbon-button-alignment">            
    </span>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i> 
                    Shedule
                </h1>
            </div> 

            <div class="col-lg-8">                
                <ul id="sparks" class="">
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 22px 15px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/availability/add_availability"); ?>"><h5>Add New</h5></a>    
                    </li>
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/availability/view_availability"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>                     
                    </li>                   
                </ul>
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

         if ($this->session->flashdata('message') != "") {
            $showinput = 0;
            ?>
            <div class="alert alert-block alert-success">
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading"><i class="fa fa-check-square-o"></i><?php echo $this->session->flashdata('message'); ?></h4>
            </div>
            <?php
        }
        ?>

        <?php if ($saveStatus == 'V') { ?>
            <section id="widget-grid" class="">
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Current Shedule</h2>
                            </header>

                            <div>
                                <div class="jarviswidget-editbox">
                                </div>
                                <div class="widget-body no-padding">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>Doctor Name</th>
                                                <th>Shedule Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
												<th>Num. of Patient</th>
                                                <th width='12%' style=" text-align: center">Modify </th>
                                                <th width='12%' style=" text-align: center">Delete</th>
                                                <th width='10%'>Activation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($list_data as $rowlist) {
                                                
                                                $recordid = $rowlist->id;
                                                $cEnable = $rowlist->cEnable;
                                               
												$Shedule_status=get_shedule_data($recordid);
                                                ?>
												

                                                <tr>
                                                    <td><?php echo $rowlist->vFirstName; ?> <?php echo $rowlist->vLastName; ?></td>
                                                    <td><?php echo $rowlist->dSheduleDate; ?></td>
                                                    <td><?php echo $rowlist->vSheduleStartTime; ?></td>
                                                    <td><?php echo $rowlist->vSheduleEndTime; ?></td>
													<td><?php echo $rowlist->iPatient_count; ?></td>
                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/availability/edit_availability/$recordid"); ?>" title="Modify"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                        </div>
                                                    </td>

                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">    <?php if($Shedule_status==0){ ?>                                            
                                                            <a href="<?php echo base_url("adminpanel/master/availability/delete_record/$recordid"); ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class=" fa fa-trash" style=" text-align: center"></i></a>
														   <?php } else { echo "N/A"; } ?>

                                                        </div>
                                                    </td>
                                                    
                                                    <td style="text-align:center; vertical-align: middle;">
                                                        <div class="onoffswitch-container" style="margin-top: 0px;">
                                                        <span class="onoffswitch">                
                                                            
                                                            <input type="checkbox" class="onoffswitch-checkbox" id="inline_<?php echo $recordid; ?>"  <?php if ($cEnable == 'Y') {echo 'checked="checked"';} ?>>
                                                            
                                                            <label class="onoffswitch-label" for="inline_<?php echo $recordid; ?>"> 
                                                                <span class="onoffswitch-inner" data-swchon-text="ON" data-swchoff-text="OFF"></span> 
                                                                <span class="onoffswitch-switch"></span>
                                                            </label> 
                                                        </span>
                                                        </div>

                                                        <script type="text/javascript">
                                                         //                                                                                     
                                                            $('#inline_<?php echo $recordid; ?>').on('change', function (e) {
                                                                if ($(this).prop('checked')) {
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/availability/active_record/$recordid"); ?>';
                                                                } else {
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/availability/deactive_record/$recordid"); ?>';
                                                                }
                                                            });

                                                        </script>
                                                    </td>                                                     
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
							</div>
						</div>
					</article>
				</div>
			</section>
		<?php } else { ?>


 
            <div class="jarviswidget" id="availability_register" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
                
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2></h2>
                </header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body no-padding">
                        <form action="<?php echo base_url("adminpanel/master/availability/save_availability"); ?>" method="post" id="availability_register-form" class="smart-form">
                            <header>
                                <?php echo $title; ?>
                            </header>
							<fieldset>
                                <div class="row">
                                    <section class="col col-6"> 
                                        <label class="label">Doctor <span style=" color: red">*</span></label>
                                        <label class="select">
                                            <select name="d_id" id="d_id" required>
                                                <option value="" selected=""  >Select Doctor </option>
                                                <?php
                                                foreach ($iUserTypeArr as $row) {
                                                    $u_type_id = trim($row->id);
                                                    $vAccTypeName = trim($row->vFirstName).' '.trim($row->vLastName);
                                                    $selTextse = "";
                                                    if ($u_type_id == $d_id) { //array search
                                                        $selTextse = "selected=\"selected\"";
                                                    } else {
                                                        $selTextse = "";
                                                    }
                            echo "<option value=\"$u_type_id\" $selTextse>$vAccTypeName</option>";
                                                }
                                                ?>
                                            </select><i></i>
                                        </label>
                                    </section>

                                   <?php?>
									<section class="col col-6">
									<label class="label">Shedule Date <span style=" color: red">*</span></label>
										<label class="input"> <i class="icon-append fa fa-calendar"></i>
											<input type="text" name="dSheduleDate" placeholder="" value="<?php echo $dSheduleDate; ?>" required class="datepicker" data-dateformat='yy-mm-dd'>
										</label>
									</section>
                                </div>
                                <div class="row">
                                    
                                    <section class="col col-6">
                                        <label class="label">Shedule Start time<span style=" color: red">*</span></label>
                                        <div class="input-group">
                                                <input class="form-control" name="vSheduleStartTime" id="vSheduleStartTime" type="text" value="<?php echo $vSheduleStartTime; ?>">
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        </div>

                                    </section>
                                   
                                      <section class="col col-6">
                                        <label class="label">Shedule End time<span style=" color: red">*</span></label>
                                        <div class="input-group">
                                                <input class="form-control" name="vSheduleEndTime" id="vSheduleEndTime" type="text" value="<?php echo $vSheduleEndTime; ?>" required >
                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                        </div>

                                    </section>
                                </div>
								
								<div class="row">
                                    
                                    <section class="col col-6">
                                        <label class="label">Num. of Patient <span style=" color: red">*</span></label>
                                        <label class="input"> 
                                            <input type="number" name="iPatient_count" value="<?php echo $iPatient_count; ?>" required>
                                        </label>
                                    </section>
                                   
                                      <section class="col col-6"> 
                                        <label class="label">Activation</label>
                                        <label class="select">
                                            <select id="cEnable" name="cEnable" required>
                                                <option value="Y" <?php if ($cEnable == 'Y') { ?>selected="selected"<?php } ?>>Active</option>
                                                <option value="N" <?php if ($cEnable == 'N') { ?>selected="selected"<?php } ?>>Deactive</option>
                                            </select> <i></i>
                                        </label>
                                    </section>
                                </div>
                                
                                <hr>
                                <br>
 
                            </fieldset>

                            <footer>
                                <input type="hidden" name="cSaveStatus" value="<?php echo $saveStatus ?>">
                                <input type="hidden" name="id" value="<?php echo $this->uri->segment(5); ?>">                              

                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" class="btn btn-default" onclick="viewlist()">
                                    Back
                                </button>
                            </footer>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
	</div>
</div>  

<script type="text/javascript">
    function viewlist() {
        // window.location="http://www.location.com/ie.htm";
        document.location = '<?php echo base_url("adminpanel/master/availability/view_availability"); ?>';
    }   
</script>



<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">

//GLOBAL FUNCTIONS!

    $(document).ready(function () {

        var errorClass = 'invalid';
        var errorElement = 'em';

        var $checkoutForm = $('#availability_register-form').validate({
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
                d_id: {
                    required: true
                },
                dSheduleDate: {
                    required: true
                },
                vSheduleStartTime: {
                    required: true
                },
                vSheduleEndTime: {
                    required: true
                },
                iPatient_count: {
                    required: true
                },
               
            },

            // Messages for form validation
            messages: {
                d_id: {
                    required: 'Please select doctor'
                },
                dSheduleDate: {
                    required: 'Please enter date'
                },
                vSheduleStartTime: {
                    required: 'Please enter time'
                },
                vSheduleEndTime: {
                    required: 'Please enter time'
                },
                iPatient_count: {
                    required: 'Please enter patient count'
                },
            },

            
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });

        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet: 1024,
            phone: 480
        };

        $('#dt_basic').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });


        /* COLUMN FILTER  */
        var otable = $('#datatable_fixed_column').DataTable({
            
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_fixed_column) {
                    responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_fixed_column.respond();
            }

        });

        // custom toolbar
        $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');

        // Apply the filter
        $("#datatable_fixed_column thead th input[type=text]").on('keyup change', function () {

            otable
                    .column($(this).parent().index() + ':visible')
                    .search(this.value)
                    .draw();

        });

        /* COLUMN SHOW - HIDE */
        $('#datatable_col_reorder').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'C>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_col_reorder) {
                    responsiveHelper_datatable_col_reorder = new ResponsiveDatatablesHelper($('#datatable_col_reorder'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_col_reorder.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_col_reorder.respond();
            }
        });


        /* TABLETOOLS */
        $('#datatable_tabletools').dataTable({

            // Tabletools options:
            //   https://datatables.net/extensions/tabletools/button_options
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'B>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "buttons": [
                {extend: 'copy', className: 'btn btn-default'},
                {extend: 'csv', className: 'btn btn-default'},
                {extend: 'excel', className: 'btn btn-default'},
                {extend: 'pdf', className: 'btn btn-default'},
                {extend: 'print', className: 'btn btn-default'},
            ],
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });

    })

</script>
