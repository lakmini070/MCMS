<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);

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
                    Invoice list
                </h1>
            </div> 


            <div class="col-lg-8">                
                <ul id="sparks" class="">
                    
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/inv_list/view_inv_list"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>
                        
                    </li>
                    
                </ul>
            </div> 

        </div>
        

        <?php if ($saveStatus == 'V') { ?>
            <section id="widget-grid" class="">
               
                <div class="row">

                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Invoice Details</h2>
                            </header>

                            <div>

                                <div class="jarviswidget-editbox">
                                    
                                </div>
                                
                                <div class="widget-body no-padding">

                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
												<th style="display:none;">ID</th>
												<th style="width: 111px;">Invoice Number </th>
                                                <th>Date</th>                                                
                                                <th>Patient Name</th>
                                                <th>Doctor Name</th>
												<th>Amount</th>
												<th width='10%'>View</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          
                                            foreach ($list_data as $rowlist) {
                                                
												$recordid = $rowlist->id;
												$details_sum_array=invoice_detail_tot($recordid);
												$details_sum=$details_sum_array[0]->sumval;
												
                                                $DoctorCharge = $rowlist->fDoctorCharge;
												$totamt = (int)$DoctorCharge+(int)$details_sum;
												$wwcount=count($list_data)+5;
												$wwcount=$wwcount-1;
												
                                                ?>
                                                <tr>
													<td  style="display:none;"><?php echo $wwcount; ?></td>
													<td><?php echo $rowlist->id; ?></td>
                                                    <td><?php echo $rowlist->dSaveDate; ?></td>
                                                    
                                                    <td><?php echo $rowlist->patient_name; ?></td>
                                                    <td><?php echo $rowlist->doc_name; ?></td>													
													<td><?php echo $totamt; ?></td>   
                                                    <td style="text-align:center; vertical-align: middle;">
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/inv_list/edit_inv_list/$recordid"); ?>" title="Print"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                          
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
                    
                    <div class="widget-body no-padding" >
                        <form action="#" method="post" id="user_register-form" class="smart-form" enctype="multipart/form-data">
                            <fieldset>
								<div class="row">                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 20px;">
                                        <label class="label col-lg-2 col-md-2 col-sm-2 col-xs-2">Invoice Number </label>
                                        <label class="label col-lg-10 col-md-10 col-sm-10 col-xs-10">: 
                                            <?php echo $list_data[0]->id; ?>
										</label>
                                    </div>
								</div>
								<div class="row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 20px;">
                                        <label class="label col-lg-2 col-md-2 col-sm-2 col-xs-2">Invoice Date </label>
                                        <label class="label col-lg-10 col-md-10 col-sm-10 col-xs-10">: 
                                            <?php echo $list_data[0]->dSaveDate; ?>
										</label>
                                    </div>
								</div>
									<div class="row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 20px;">
                                        <label class="label col-lg-2 col-md-2 col-sm-2 col-xs-2">Prescription Date </label>
                                        <label class="label col-lg-10 col-md-10 col-sm-10 col-xs-10">: 
                                            <?php echo $list_data[0]->dPrescriptionDate; ?>
										</label>
                                    </div>
								</div>	
<div class="row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 20px;">
                                        <label class="label col-lg-2 col-md-2 col-sm-2 col-xs-2">Doctor Name</label>
                                        <label class="label col-lg-10 col-md-10 col-sm-10 col-xs-10">: 
                                            <?php echo $list_data[0]->doc_name; ?>
										</label>
                                    </div>
								</div>
<div class="row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 20px;">
                                        <label class="label col-lg-2 col-md-2 col-sm-2 col-xs-2">Patient Name</label>
                                        <label class="label col-lg-10 col-md-10 col-sm-10 col-xs-10">: 
                                            <?php echo $list_data[0]->patient_name; ?>
										</label>
                                    </div>
								</div>
<div class="row">
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-left: 20px;">
                                        <label class="label col-lg-2 col-md-2 col-sm-2 col-xs-2">Prescription</label>
                                        <label class="label col-lg-10 col-md-10 col-sm-10 col-xs-10">: 
                                            <?php echo $list_data[0]->tDescription; ?>
										</label>
                                    </div>
								</div>		
                                <div class="row">                                                                        
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
														<th style="width: 100px;">Drug</th>
														<th style="width: 80px;">Qty</th>
														<th style="width: 80px;">Unit Price</th>
														<th style="width: 80px;">Price</th>
														
													</tr>
												</thead>
												<tbody>
												<?php 
												$tot=0;
												for ($x = 0; $x <count($list_data_detail); $x++) {
													$tot=$tot+$list_data_detail[$x]->fPrice; ?>
													<tr class="tr_clone">
														<td><label class="select"><?php echo  $list_data_detail[$x]->vDrugName; ?></label></td>
														<td><label class="input"><?php echo  $list_data_detail[$x]->iQuantity; ?></label></td>
														<td><label class="input"><?php echo  $list_data_detail[$x]->fUnitPrice; ?></label></td>
														<td><label class="input"><?php echo  $list_data_detail[$x]->fPrice; ?></label></td>
													</tr>
												<?php } ?>	
													
													
													<tr >
														<td colspan=3>Sub Total</td>
														<td><label class="input"><?php echo $tot; ?></label></td>
														
													</tr>
													<tr >
														<td colspan=3>Doctor Charge</td>
														<td><label class="input"><?php echo $list_data[0]->fDoctorCharge; ?></label></td>
														
													</tr>
													<tr >
														<td colspan=3>Total Value</td>
														<td><label class="input"><?php echo $tot+$list_data[0]->fDoctorCharge; ?> </label></td>
														
													</tr>
													
												</tbody>
											</table>
											
										</div>
									</div>
                            <footer>
                               
                                <button type="button" class="btn btn-default" onclick="viewlist()">
                                    Back
                                </button>
								
								<button type="button" class="btn btn-default" onclick='printDiv();'>
                                    Print
                                </button>
                            </footer>
                        </form>

                    </div>
                    

                </div>
            

            </div>
           				                 
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('DivIdToPrint');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}
</script>
        <?php } ?>

    </div>
</div>  

<?php if ($saveStatus != 'V') { ?>
<div id="DivIdToPrint" style="display:none;">


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
        }
        .brand-section{
           background-color: #0d1033;
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 80%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
			text-align: left;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: end;
        }
		
        .w-20{
            width: 20%;
        }

        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <h1 class="text-white">HMC</h1>
                </div>
                <div class="w-20">
                    <div class="company-details">
                        <p class="text-white">HMC, Habarakada, Homagama</p>
                        <p class="text-white">0112173201</p>
                        <p class="text-white">hmcemail@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="body-section">
            <br>
            <table class="table-bordered">
                <tbody>
				<thead>
                    <tr>
                        <th></th>
                        <th class="col-6"></th>
                        
                    </tr>
                </thead>
                    <tr>
                        <td>Invoice Number</td>
                        <td><?php echo $list_data[0]->id; ?></td>
                    </tr>
					<tr>
                        <td>Invoice Date</td>
                        <td><?php echo $list_data[0]->dSaveDate; ?></td>
                    </tr> 					
					<tr>
                        <td>Prescription Date</td>
                        <td><?php echo $list_data[0]->dPrescriptionDate; ?></td>
                    </tr>
					<tr>
                        <td>Doctor Name</td>
                        <td><?php echo $list_data[0]->doc_name; ?></td>
                    </tr>
					<tr>
                        <td>Patient Name</td>
                        <td><?php echo $list_data[0]->patient_name; ?></td>
                    </tr>
  					<tr>
                        <td>Prescription</td>
                        <td> <?php echo $list_data[0]->tDescription; ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
        </div>

        <div class="body-section">
            <h3 class="heading">Invoice Details</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Drug</th>
                        <th class="w-20">Qty</th>
                        <th class="w-20">Unit Price</th>
                        <th class="w-20">Price</th>
                    </tr>
                </thead>
                <tbody>
												<?php 
												$tot=0;
												for ($x = 0; $x <count($list_data_detail); $x++) {
													$tot=$tot+$list_data_detail[$x]->fPrice; ?>
													<tr>
														<td><?php echo  $list_data_detail[$x]->vDrugName; ?></td>
														<td><?php echo  $list_data_detail[$x]->iQuantity; ?></td>
														<td><?php echo  $list_data_detail[$x]->fUnitPrice; ?></td>
														<td><?php echo  $list_data_detail[$x]->fPrice; ?></td>
													</tr>
												<?php } ?>
                    
					
                    <tr>
                        <td colspan="3" class="text-right">Sub Total</td>
                        <td><?php echo $tot; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Doctor Charge</td>
                        <td><?php echo $list_data[0]->fDoctorCharge; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Total Value</td>
                        <td><?php echo $tot+$list_data[0]->fDoctorCharge; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>    
    </div>      
</body>
</html>
</div>

<?php } ?>
<script type="text/javascript">
    
    
    function viewlist() {
        document.location = '<?php echo base_url("adminpanel/master/prescription/view_prescription"); ?>';
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

 

</script>

<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>




