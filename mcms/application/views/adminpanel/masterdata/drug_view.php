<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);

if ($saveStatus == "A") {
	
	$id = "";
	$vDrugName = "";
	$iQuantity = "";
	$fUnitPrice = "";
	$cEnable = "";
	$iMinQty = "";   
}
if ($saveStatus == 'E') {
    $id = $edit_drug[0]->id;
    $vDrugName = $edit_drug[0]->vDrugName;
	$iQuantity = $edit_drug[0]->iQuantity;
	$fUnitPrice = $edit_drug[0]->fUnitPrice;
	$cEnable = $edit_drug[0]->cEnable;
	$iMinQty = $edit_drug[0]->iMinQty;    
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
                    Drug
                </h1>
            </div>
			<div class="col-lg-8">                
                <ul id="sparks" class="">
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 22px 15px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/drug/add_drug"); ?>"><h5>Add New</h5></a>                        
                    </li>
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/drug/view_drug"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>                        
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
        ?>

        <?php if ($saveStatus == 'V') { ?>
            <section id="widget-grid" class="">
                <div class="row">                    
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Current Drug</h2>
                            </header>                            
                            <div>
                                <div class="jarviswidget-editbox"> </div>
                                <div class="widget-body no-padding">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
												<th>ID</th>
											    <th>Drug Name</th>
												<th>Quantity </th>
												<th>Min Quantity </th>
												<th>Unit Price</th>
												<th width='5%' style=" text-align: center">View / Modify </th>
                                                <th width='5%' style=" text-align: center">Delete</th>
                                                <th width='5%'>Activation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            
                                            foreach ($list_data as $rowlist) {
                                                
                                                $recordid = $rowlist->id;
                                                $cEnable = $rowlist->cEnable;
                                               
                                                ?>
                                                <tr>
													<td><?php echo $rowlist->id; ?></td>
                                                    <td><?php echo $rowlist->vDrugName; ?></td>
                                                    <td><?php echo $rowlist->iQuantity; ?></td>
													<td><?php echo $rowlist->iMinQty; ?></td>
                                                    <td><?php echo $rowlist->fUnitPrice; ?></td>
                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/drug/edit_drug/$recordid"); ?>" title="Modify"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                        </div>
                                                    </td>
                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">                                                  
                                                        <a href="<?php echo base_url("adminpanel/master/drug/delete_record/$recordid"); ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class=" fa fa-trash" style=" text-align: center"></i></a>
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
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/drug/active_record/$recordid"); ?>';
                                                                } else {
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/drug/deactive_record/$recordid"); ?>';
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
		
            <div class="jarviswidget" id="user_register" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false" role="widget">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2></h2>
                </header>
                <div>
				<div class="jarviswidget-editbox"></div>
                    <div class="widget-body no-padding">
						<form action="<?php echo base_url("adminpanel/master/drug/save_drug"); ?>" method="post" id="user_register-form" class="smart-form" enctype="multipart/form-data">
                            <header>
                                <?php echo $title; ?>
                            </header>
                            <fieldset>							        
                                <div class="row">                                    
                                    <section class="col col-6">
                                        <label class="label">Drug Name <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="vDrugName" name="vDrugName"  value="<?php echo $vDrugName ?>" required>
                                            
                                        </label>
                                    </section>
                                   
                                      <section class="col col-6">
                                        <label class="label">Quantity <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="iQuantity" name="iQuantity"  value="<?php echo $iQuantity ?>" required>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
								<section class="col col-6">
                                        <label class="label">Unit Price <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="fUnitPrice" name="fUnitPrice"  value="<?php echo $fUnitPrice ?>" required>
                                        </label>
                                    </section>
								<section class="col col-6"> 
                                        <label class="label">Activation</label>
                                        <label class="select">
                                            <select id="cEnable" name="cEnable">
                                                <option value="Y" <?php if ($cEnable == 'Y') { ?>selected="selected"<?php } ?>>Active</option>
                                                <option value="N" <?php if ($cEnable == 'N') { ?>selected="selected"<?php } ?>>Deactive</option>
                                            </select> <i></i>
                                        </label>
                                    </section>		
								</div>
								
								<div class="row">
                                    <section class="col col-6">
                                        <label class="label">Min Quantity <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="iMinQty" name="iMinQty"  value="<?php echo $iMinQty; ?>"required>
                                        </label>
                                    </section>
                                </div>                               
                                <div class="row">    
                                </div>
                               
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
        document.location = '<?php echo base_url("adminpanel/master/drug/view_drug"); ?>';
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
                // Initialize the responsive datatables helper 
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
