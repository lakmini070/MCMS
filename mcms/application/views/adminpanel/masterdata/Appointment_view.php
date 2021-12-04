<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);

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
    <div id="ribbon">
        <span class="ribbon-button-alignment">           
        </span>
			<ol class="breadcrumb"> </ol>
    </div>
    <div id="content">
        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">
                    <i class="fa fa-table fa-fw "></i> 
                    Appointment Details
                </h1>
            </div> 
            <div class="col-lg-8">                
                <ul id="sparks" class="">                    
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                    <a href="<?php echo base_url("adminpanel/master/appointment/view_appointment"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>                        
                    </li>                    
                </ul>
            </div>
        </div>
        <?php
        
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

        <?php 
		
		$saveStatus='V';
		if ($saveStatus == 'V') { ?>
            <section id="widget-grid" class="">                
                <div class="row">                    
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">                        
                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">                            
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Appointment Details</h2>
                            </header>
                            <div>
                                <div class="jarviswidget-editbox"></div>
                                <div class="widget-body no-padding">
								<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>Doctor Name</th>
                                                <th>Shedule Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                            
												<th>Patient Name</th>
												<th>Appointment Number</th>
                                                <th width='10%'>Activation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            foreach ($list_data as $rowlist) {
                                                $recordid = $rowlist->id;
                                                $cEnable = $rowlist->cEnable;


                                                ?>							

                                                <tr>
                                                    <td><?php echo $rowlist->doc_name; ?></td>
                                                    <td><?php echo $rowlist->dSheduleDate; ?></td>
                                                    <td><?php echo $rowlist->vSheduleStartTime; ?></td>
                                                    <td><?php echo $rowlist->vSheduleEndTime; ?></td>
                                                    
													<td><?php echo $rowlist->patient_name; ?></td>
													<td style="text-align:center"> <?php echo $rowlist->iAppointmentNumber; ?></td>
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
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/appointment/active_record/$recordid"); ?>';
                                                                } else {
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/appointment/deactive_record/$recordid"); ?>';
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
        <?php }  ?>
    </div>
</div>  

<script type="text/javascript">
    function viewlist() {
        document.location = '<?php echo base_url("adminpanel/master/appointment/view_appointment"); ?>';
    }
    
</script>

<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">

// GLOBAL FUNCTIONS!
    $(document).ready(function () {
       
        /* BASIC ;*/
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
                // Initialize the responsive datatables helper
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
                // Initialize the responsive datatables helper
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
                // Initialize the responsive datatables helper
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
