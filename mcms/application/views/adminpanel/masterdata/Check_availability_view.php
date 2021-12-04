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
    $id = $edit_check_availability[0]->id;
    $d_id = $edit_check_availability[0]->d_id;
    $dSheduleDate = $edit_check_availability[0]->dSheduleDate;
    $vSheduleStartTime = $edit_check_availability[0]->vSheduleStartTime;
    $vSheduleEndTime = $edit_check_availability[0]->vSheduleEndTime;
    $iPatient_count = $edit_check_availability[0]->iPatient_count;
    $cEnable = $edit_check_availability[0]->cEnable;
   
    
    
}
//echo $saveStatus;
?>

<style>
    
    #sparks li {
    display: inline-block;
    max-height: 47px;
    overflow: hidden;
    text-align: left;
    box-sizing: content-box;
    -moz-box-sizing: content-box;
    -webkit-box-sizing: content-box;
    width: 95px;
}
    
    #sparks li h5 {
    color: #555;
    float: none;
    font-size: 11px;
    font-weight: 400;
    margin: -3px 0 0 0;
    padding: 0;
    border: none;
    font-weight: 900;
    text-transform: uppercase;
    webkit-transition: all 500ms ease;
    -moz-transition: all 500ms ease;
    -ms-transition: all 500ms ease;
    -o-transition: all 500ms ease;
    transition: all 500ms ease;
    text-align: center;
}
    
    #sparks li span {
    color: #324b7d;
    display: block;
    font-weight: 900;
    margin-top: 5px;
    webkit-transition: all 500ms ease;
    -moz-transition: all 500ms ease;
    -ms-transition: all 500ms ease;
    -o-transition: all 500ms ease;
    transition: all 500ms ease;
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
        <ol class="breadcrumb">
        </ol>
    </div>

    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i> 
                    Doctor Availability
                </h1>
            </div> 

            <div class="col-lg-8">                
                <ul id="sparks" class="">                    
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                     <a href="<?php echo base_url("adminpanel/master/check_availability/view_check_availability"); ?>"><h5>View All <span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>
                    </li>
                    
                </ul>
            </div> 

        </div>
        <?php
        $showinput = 1;
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

        <?php if ($saveStatus == 'V') { ?>
            <section id="widget-grid" class="">               
                <div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Current Doctor Availability</h2>
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
												<th>Avilable Channelings</th>
                                                <th width='12%' style=" text-align: center">Book Now </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //$oddeven_count = 0;
                                            foreach ($list_data as $rowlist) {
                                                /*$oddeven_count++;
                                                if ($oddeven_count == 1) {
                                                    $oddeven = 'even pointer';
                                                } else {
                                                    $oddeven = 'odd pointer';
                                                    $oddeven_count = 0;
                                                }*/

                                                $recordid = $rowlist->id;
                                                $cEnable = $rowlist->cEnable;
                                                
												$current_count= get_current_appointment_count($recordid);
												$tot_count=$rowlist->iPatient_count;
												$available_count=$tot_count-$current_count;
                                                ?>

												<?php if($rowlist->dSheduleDate==date('Y-m-d') && date("H:i", strtotime($rowlist->vSheduleStartTime))<date('H:i')){
													// nothing will printed 

												}else{ ?>
                                                <tr>
                                                    <td><?php echo $rowlist->vFirstName; ?> <?php echo $rowlist->vLastName; ?></td>
                                                    <td><?php echo $rowlist->dSheduleDate; ?></td>
                                                    <td><?php echo $rowlist->vSheduleStartTime; ?></td>
                                                    <td><?php echo $rowlist->vSheduleEndTime; ?></td>
													<td><?php echo $available_count; ?></td>
                                                    <td align='center'> 
													<?php if($available_count>0) { ?>
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/check_availability/edit_check_availability/$recordid"); ?>" title="Book now"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                        </div>
													<?php } else { echo "N/A"; } ?>
                                                    </td>                                     
                                                </tr>
												<?php } ?>

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

            <div class="jarviswidget" id="user_register" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2></h2>
				</header>
                <div>
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body no-padding">
						<form action="<?php echo base_url("adminpanel/master/check_availability/save_check_availability"); ?>" method="post" id="availability_register_check" class="smart-form"  onsubmit="return check_vali()">
                            <header>
                                <?php echo $title; ?>
                            </header>
                            <fieldset>							
                                <div class="row">
                                    <section class="col col-6"> 
                                        <label class="label">Doctor </label>
                                        <label class="select">
                                            <select name="d_id" id="d_id" required disabled>
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
                                            </select>
											<!-- Display ICON <i></i> -->
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">Shedule Date </label>
                                        <label class="input"> <!--<i class="icon-append fa fa-date"></i>-->
                                            <input type="text" name="dSheduleDate" value="<?php echo $dSheduleDate; ?>" required  readonly>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    
                                    <section class="col col-6">
                                        <label class="label">Shedule Start time </label>
                                        <label class="input"> <!--<i class="icon-append fa fa-date"></i> -->
                                            <input type="text" name="vSheduleStartTime" value="<?php echo $vSheduleStartTime; ?>" required  readonly>
                                        </label>
                                    </section>
                                   
                                      <section class="col col-6">
                                        <label class="label">Shedule End time </label>
                                        <label class="input"> <!-- <i class="icon-append fa fa-date"></i> -->
                                            <input type="text" name="vSheduleEndTime" value="<?php echo $vSheduleEndTime; ?>" required  readonly>
                                        </label>
                                    </section>
                                </div>
								
								<div class="row">
                                    
                                    <section class="col col-6"> 
                                        <label class="label">Patient <span style="color:red;">*</span></label>
                                        <label class="select">
                                            <select name="iP_id" id="iP_id" style="display:none;" >
                                                <?php if(count($PatientArr)!==1) { ?>
												<option value="" selected=""  >Select Patient </option>
                                                <?php }
                                                foreach ($PatientArr as $row) {

                                                    $iP_id = trim($row->id);
                                                    $vAccTypeName = trim($row->vFirstName).' '.trim($row->vLastName);
                                                    echo "<option value=\"$iP_id\" >$vAccTypeName</option>";
                                                }
                                                ?>
                                            </select>
                                            <span style="color:red;display:none;" id="p_id_vali">Please select the patient</span>											
                                        </label>
                                    </section>
									
									<section class="col col-6">
                                        <label class="label">Avilable Channelings</label>
                                        <label class="input"> <!--<i class="icon-append fa fa-date"></i> -->
										<?php 
												$current_count= get_current_appointment_count($id);												
												$available_count=$iPatient_count-$current_count;												
										?>
                                        <input type="text" name="iPatient_count" value="<?php echo $available_count; ?>" required  readonly>
                                        </label>
                                    </section>
                                </div>
                                 <br>							
							</fieldset>
							
                            <footer>
                                <input type="hidden" name="cSaveStatus" value="<?php echo $saveStatus ?>">
                                <input type="hidden" name="id" value="<?php echo $this->uri->segment(5); ?>">
								<input type="hidden" name="app_num" value="<?php echo $current_count+1; ?>">
							
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
        document.location = '<?php echo base_url("adminpanel/master/check_availability/view_check_availability"); ?>';
    }

</script>

<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">

function check_vali(){

    var p_value=$('#iP_id').val();
    if(p_value==''){
        $('#p_id_vali').css('display','block');
        return false;
    }else {
        $('#p_id_vali').css('display','none');
        return true;    
    }

}

//GLOBAL FUNCTIONS!

    $(document).ready(function () {

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

        /* END COLUMN SHOW - HIDE */

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


$(document).ready(function(){
 
  // Initialize select2
  $("#iP_id").select2();

});

</script>
