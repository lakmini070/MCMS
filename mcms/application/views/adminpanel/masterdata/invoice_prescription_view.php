<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);
if ($saveStatus == "A") {
    /*$id = "";
    $iP_id = "";
    $d_id = "";
    $iAppointmentNumber = "";
    $dDate = "";
    $cEnable = "";
    $iAge = "";
    $tDescription = "";
	$fReport ="";*/    
    
}
if ($saveStatus == 'E') {
    /*$id = $edit_prescription[0]->id;
    $iP_id = $edit_prescription[0]->iP_id;
    
    $iAppointmentNumber = $edit_prescription[0]->iAppointmentNumber;
    $dDate = $edit_prescription[0]->dDate;
    $cEnable = $edit_prescription[0]->cEnable;
    $iAge = $edit_prescription[0]->iAge;
    $tDescription = $edit_prescription[0]->tDescription;
	$fReport = $edit_prescription[0]->fReport;
    */
        
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
                    Prescriptions
                </h1>
            </div> 


            <div class="col-lg-8">                
                <ul id="sparks" class="">
                    
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/invoice_prescription/view_invoice_prescription"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>
                        
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
                                <h2>Current Prescriptions</h2>
                            </header>
                            
                            <div>                               
                                <div class="jarviswidget-editbox">          
                                </div>                                
                                <div class="widget-body no-padding">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>Date</th>
												<th>Doctor Name</th>
                                                <th>Patient Name</th>
												<th>Age</th>
												<th>Appointment<br>Number</th>
												<?php /* <th>Description</th> */ ?>
												<th width='5%' style=" text-align: center">Create Invoice </th>                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                           
                                            foreach ($list_data as $rowlist) {                                     
                                                $recordid = $rowlist->id;
                                                
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowlist->dDate; ?></td>
                                                    <td><?php echo $rowlist->doc_name; ?></td>
                                                    <td><?php echo $rowlist->patient_name; ?></td>
                                                    <td><?php echo $rowlist->iAge; ?></td>
													<td><?php echo $rowlist->iAppointmentNumber; ?></td>
                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/invoice_prescription/create_invoice/$recordid"); ?>" title="Modify"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                          
                                                        </div>
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
                    <div class="jarviswidget-editbox">
                    </div>
                    <div class="widget-body no-padding">
                        <form action="<?php echo base_url("adminpanel/master/invoice_prescription/save_invoice"); ?>" method="post" id="invoice_pres_form" class="smart-form" enctype="multipart/form-data">
                            
							<header>
                                <?php echo $title; ?>
                            </header>
                            <fieldset>
								<div class="row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Date</label>
										<label class="label col col-9">:&nbsp;<?php echo $edit_prescription[0]->dDate ?></label>
										<input type="hidden" name="dPrescriptionDate" value="<?php echo $edit_prescription[0]->dDate; ?>">
                                    </div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Doctor</label>
										<label class="label col col-9">:&nbsp;<?php echo $edit_prescription[0]->doc_name; ?></label>
										<input type="hidden" name="iDoctorId" value="<?php echo $edit_prescription[0]->iDoctorId; ?>">
                                    </div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Patient Name</label>
										<label class="label col col-9">:&nbsp;<?php echo $edit_prescription[0]->patient_name; ?></label>
										<input type="hidden" name="iPatientId" value="<?php echo $edit_prescription[0]->iPatientId; ?>">
                                    </div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Appointment No</label>
										<label class="label col col-9">:&nbsp;<?php echo $edit_prescription[0]->iAppointmentNumber; ?></label>
                                    </div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Age</label>
										<label class="label col col-9">:&nbsp;<?php echo $edit_prescription[0]->iAge; ?></label>
                                    </div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Description</label>
										<label class="label col col-9">:&nbsp;<?php echo $edit_prescription[0]->tDescription; ?></label>
										<input type="hidden" name="tDescription" value="<?php echo $edit_prescription[0]->tDescription; ?>">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Prescription details</label>
                                        <label class="label col col-9">
                                    <?php
                                                foreach ($edit_prescription_data as $row) {
                                                    echo ":&nbsp;Drug Name :".$row->vDrugName.' |  Qty :'.$row->iQuantity." |  Usage :".$row->Dusage."<br>";
                                                }
                                                ?>

                                            </label>
                                        <input type="hidden" name="tDescription" value="<?php echo $edit_prescription[0]->tDescription; ?>">
                                    </div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label class="label col col-3">Medical Reports</label>
										<label class="label col col-9">:&nbsp;<?php  if($edit_prescription[0]->fReport){ ?>
									<br><a href='<?php echo base_url().'/medical_reports/'.$edit_prescription[0]->fReport;?>' target="new" >Click here to see the attachment </a>
                                
                                <?php } ?></label>
                                    </div>
								</div>	
                                
                              
                                <br>                                
                            
                            </fieldset>
							
							<header>
                                Invoice details
                            </header>
                            <fieldset>				
                                    <div role="content">
                                   <div class="table-responsive">										
											<table class="table table-bordered" id="happy">
												<thead>
													<tr>
														<th style="width: 150px;">Drug</th>
														<th style="width: 100px;">Qty</th>
														<th style="width: 100px;">Price</th>
														<th style="width: 30px;">&nbsp;</th>
													</tr>
												</thead>
								<tbody>
									<tr class="tr_clone">
										<td>
											<label class="select">
											<select name="iDrugID[]" id="DrugID_0" required>
                                                <option   >Select Drug </option>
                                                <?php
                                                foreach ($drug_data as $row) {
													$D_save_id='';
                                                    $D_id = trim($row->id);
                                                    $D_Name = trim($row->vDrugName);
													 $D_price = trim($row->fUnitPrice);
                                                    $selTextse = "";
													$kk=$D_id."_".$D_price;
                                                    if ($D_save_id == $D_id) { //array search
                                                        $selTextse = "selected=\"selected\"";
                                                    } else {
                                                        $selTextse = "";
                                                    }

                                                    echo "<option value=\"$kk\" $selTextse>$D_Name (Rs.$D_price /=)</option>";
                                                }
                                                ?>
                                            </select><i></i>
                                            </label>
                                        </td>

										<td>
											<label class="input">
											<input type="number" name="iQty[]" id="Qty_0" value="" onkeyup="cal_val()">
											</label>
										</td>
														
										<td><label class="input"> 
											<input type="number" name="dPrice[]" id="Price_0" value="">
											</label>
                                        </td>
														
										<td style="text-align: center;">
                                            <span class="glyphicon glyphicon-plus" onclick="add_new_row()" >&nbsp;</span>
                                        </td>
														
                                    </tr>
													
													
									<tr >
										<td colspan=2>Doctor charge</td>

										<td><label class="input"><input type="number" name="dcharge" id="dcharge" value="" onkeyup="cal_val()"></label></td>
														<td >&nbsp;</td>
													</tr>
													<tr >
														<td colspan=2>Total Value</td>
														<td><label class="input"><input type="number" name="totPrice" id="totPrice" value="" ></label></td>
														<td >&nbsp;</td>
													</tr>
													
												</tbody>
											</table>
											
										</div>
									</div>
								<?php 
								$op_data='';
								foreach ($drug_data as $row) {
													$D_save_id='';
                                                    $D_id = trim($row->id);
                                                    $D_Name = trim($row->vDrugName);
													 $D_price = trim($row->fUnitPrice);
                                                    $selTextse = "";
													$kk=$D_id."_".$D_price;
                                                    if ($D_save_id == $D_id) { //array search
                                                        $selTextse = "selected=\"selected\"";
                                                    } else {
                                                        $selTextse = "";
                                                    }

                                                    $op_data.="<option value=\"$kk\" $selTextse>$D_Name  (Rs.$D_price /=)</option>";
                                                }
								?>
<script>

function add_new_row(){
    var rowCount = $('#happy tr').length;
	var row_count=rowCount-3;
	var mytr='';
mytr = '<tr class="tr_clone"><td><label class="select"><select name="iDrugID[]" id="DrugID_'+ row_count +'" required><option   >Select Drug </option>';
mytr +=  '<?php echo $op_data; ?>';

mytr += '</select><i></i></label></td><td><label class="input"><input type="number" name="iQty[]" id="Qty_'+ row_count +'" value="" onkeyup="cal_val()"> ';
mytr += '</label></td><td><label class="input"><input type="number" name="dPrice[]" id="Price_'+row_count+'" value=""></label></td>';
mytr += '<td style="text-align: center;"><span class="glyphicon glyphicon-plus" onclick="add_new_row()" >&nbsp;</span></td></tr>';


var $tableBody = $('#happy').find("tbody"),
$trLast = $tableBody.find("tr:first"),
//$trNew = $trLast.clone();
$trNew = mytr;
$trLast.after($trNew);
									
								}
								
								
								
function cal_val(){
									
	//alert('dd');
	var rowCount = $('#happy tr').length;
	var row_count=rowCount-3;
									
									
	//alert(row_count);
	var tot=0;
	for (var i = 0; i < row_count; i++) {
										
	   var qty = $('#Qty_'+i).val();
	   var value = $('#DrugID_'+i).val();

	   //alert(value);
	   if(qty!='' && qty!='undefined' && value!='' && qty!='undefined' && qty!='Select Drug'){
										
	       const myArr = value.split("_");
	       var price= myArr[1];
	       $('#Price_'+i).val(qty*price);
	       tot=tot+(qty*price);
											
		}
    }
									
		var dcharge = $('#dcharge').val();
		$('#totPrice').val(Number(dcharge)+Number(tot));
									
	}
</script>
                                
                    <div class="row">                                     
                                </div>
                                <hr>
                                <br>
                            </fieldset>

                            <footer>
                                <input type="hidden" name="cSaveStatus" value="V">
                                <input type="hidden" name="iPres_id" value="<?php echo $this->uri->segment(5); ?>">
                                <input type="hidden" name="d_id" value="<?php echo $edit_prescription[0]->id; ?>">
								<input type="hidden" name="iP_id" value="<?php echo $this->uri->segment(5); ?>">
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
        document.location = '<?php echo base_url("adminpanel/master/prescription/view_prescription"); ?>';
    }
    
</script>

<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>


<script type="text/javascript">

//  GLOBAL FUNCTIONS!

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
