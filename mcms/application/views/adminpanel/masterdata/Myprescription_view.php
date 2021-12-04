<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);

if ($saveStatus == "A") {
    $id = "";
    $iP_id = "";
    $d_id = "";
    $iAppointmentNumber = "";
    $dDate = "";
    $cEnable = "";
    $iAge = "";
    $tDescription = "";
	$fReport ="";
    

    
}
if ($saveStatus == 'E') {
    $id = $edit_myprescription[0]->id;
    $iP_id = $edit_myprescription[0]->iP_id;
    $d_id = $edit_myprescription[0]->d_id;
    $iAppointmentNumber = $edit_myprescription[0]->iAppointmentNumber;
    $dDate = $edit_myprescription[0]->dDate;
    $cEnable = $edit_myprescription[0]->cEnable;
    $iAge = $edit_myprescription[0]->iAge;
    $tDescription = $edit_myprescription[0]->tDescription;
	$fReport = $edit_myprescription[0]->fReport;
    
    
    
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
                    Prescriptions
                </h1>
            </div> 


            <div class="col-lg-8">                
                <ul id="sparks" class="">
                    
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/myprescription/view_myprescription"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>
                        
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
												<th width='5%' style=" text-align: center">View</th>
                                                

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
													<?php /*<td><textarea rows="6" name="tDescription"><?php echo $rowlist->tDescription; ?></textarea></td>*/ ?>
                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/myprescription/view_detail_myprescription/$recordid"); ?>" title="Modify"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                          
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


                        <form action="" method="post" id="user_register-form" class="smart-form" enctype="multipart/form-data">
                            <header>
                                <?php echo $title; ?>
                            </header>


                            <fieldset>
								<div class="row">
                                    
                                    <section class="col col-12">
                                        <label class="label">Date </label>
                                        <label class="input"> <i class="icon-append fa fa-calendar "></i>
                                            <input type="dDate" name="dDate" placeholder="" value="<?php echo $dDate ?>" required class="datepicker11" data-dateformat='yy-mm-dd' readonly>
										</label>
                                    </section>
								</div>	
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
                                            </select><i></i>
                                        </label>
                                    </section>
									
									<section class="col col-6"> 
                                        <label class="label">Patient </label>
                                        <label class="select">
                                            <select name="iP_id" id="iP_id" required disabled>
                                                <option value="" selected=""  >Select Patient </option>
                                                <?php
                                                foreach ($iUserTypeArr_p as $row) {

                                                    $u_type_id = trim($row->id);
                                                    $vAccTypeName = trim($row->vFirstName).' '.trim($row->vLastName);
                                                    $selTextse = "";
                                                    if ($u_type_id == $iP_id) { //array search
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


                                  
                                </div>
                                <div class="row">
                                    
                                    <section class="col col-6">
                                        <label class="label">Appointment No </label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="iAppointmentNumber" name="iAppointmentNumber"  value="<?php echo $iAppointmentNumber ?>" readonly>
                                        </label>
                                    </section>
                                   
                                      <section class="col col-6">
                                        <label class="label">Age </label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="iAge" name="iAge"  value="<?php echo $iAge ?>" readonly>
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
									<section class="col col-6">

										<label class="label">Description</label>
										<label class="textarea">								
											<textarea rows="6" name="tDescription" disabled readonly><?php echo $tDescription ?></textarea> 
                                    </label>

									</section>
																	
									<section class="col col-6">
										<label class="label">Medical Reports </label>
                                    							
										<?php  if($fReport){ ?>
										<br><a href='<?php echo base_url().'/medical_reports/'.$fReport;?>' target="new" >Click here to see the attachment </a>
                                
									<?php } ?>
									</section>                                    
                                </div>	
                                <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 15px;box-sizing: border-box;">
                            <!--check data availability-->   <?php if(count($pres_data)>0) {  ?>

                                <div >       
                                    <table class="table table-bordered" id="happy">
                                        <thead>
                                            <tr>
                                                <th style="width: 100px;">Drug Name</th>
                                                <th style="width: 100px;">Dosage</th>
                                                <th style="width: 150px;">Methods of Administration</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
    

<?php
                                    for($m=0; count($pres_data)>$m; $m++){ ?>

                            <tr class="tr_clone">
                                <td>
                                    
                                        <?php
                                            foreach ($drug_data as $row) {
                                                $D_save_id=$pres_data[$m]->iDrugId;  //data id from for loop
                                                $D_id = trim($row->id);
                                                $D_Name = trim($row->vDrugName);
                                                $D_price = trim($row->fUnitPrice);
                                               
                                                
                                                    if ($D_save_id == $D_id) { //array search
                                                         echo "$D_Name (Rs.$D_price /=)";
                                                    } 
                   
                                            }
                                            ?>
                                    
                                </td>

                                <td>                   
                                    <?php echo $pres_data[$m]->iQuantity; ?>
                                </td>
                                
                                <td>                  
                                    <?php echo $pres_data[$m]->Dusage; ?>
                                </td>                
                                                        
                               

                            </tr>


<?php }//end for loop  ?>
</tbody>
                                            </table>
                                            
                                </div>
                            
                            <?php
 }  ?>     
                                            
                                       
                                    </section>
                                                                    
                                                                        
                                </div>				
								
                                <br>
                             
                            </fieldset>

                            <footer>
                                <input type="hidden" name="cSaveStatus" value="<?php echo $saveStatus ?>">
                                <input type="hidden" name="id" value="<?php echo $this->uri->segment(5); ?>">
								<input type="hidden" name="uploadpath" value="medial_reports/">
								
							 
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
        document.location = '<?php echo base_url("adminpanel/master/myprescription/view_myprescription"); ?>';
    }
    
    
    function show_div(cat)
    {//alert (cat);
        if (cat == 'Y') {
           //alert (cat);
           document.getElementById('div1').style.display = "block";
           document.getElementById('sec1').style.display = "block";

           
        }
        else if (cat == 'N')
        {
             document.getElementById('div1').style.display = "none";
             document.getElementById('sec1').style.display = "none";
        }
    }
    
    function showall (){
        
        document.getElementById('div1').style.display = "block";
           document.getElementById('sec1').style.display = "block";
    }

</script>

<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>



<script type="text/javascript">

// DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function () {


        var errorClass = 'invalid';
        var errorElement = 'em';

        var $checkoutForm = $('#myprescription-form').validate({
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
                vTitle: {
                    required: true
                },
                
                
            },

            // Messages for form validation
            messages: {
                vTitle: {
                    required: 'Select title'
                },
                
                
            },

            
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });

        

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



        /* END TABLETOOLS */

  
        $("#iUserType").change(function(){
            if ($(this).val()==""){ $(this).css({color: "#FF0000"});}
            else {  $(this).css({color: "#000"});}
        });
        
     



    })

</script>
