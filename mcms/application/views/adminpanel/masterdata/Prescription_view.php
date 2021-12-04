<?php
$tid = $this->uri->segment(5);
$showbutton = $this->uri->segment(4);
//echo $showbutton; exit();


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
    $id = $edit_prescription[0]->id;
    $iP_id = $edit_prescription[0]->iP_id;
    $d_id = $edit_prescription[0]->d_id;
    $iAppointmentNumber = $edit_prescription[0]->iAppointmentNumber;
    $dDate = $edit_prescription[0]->dDate;
    $cEnable = $edit_prescription[0]->cEnable;
    $iAge = $edit_prescription[0]->iAge;
    $tDescription = $edit_prescription[0]->tDescription;
	$fReport = $edit_prescription[0]->fReport;
    
       
}
//echo $saveStatus;
?>

<style>
    
    #sparks li {
    display: inline-block;
    max-height: 47px;
    overflow: hidden;
    text-align: left;
    /*box-sizing: content-box;*/
    /*-moz-box-sizing: content-box;*/
    /*-webkit-box-sizing: content-box;*/
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
                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 22px 15px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/prescription/add_prescription"); ?>"><h5>Add New</h5></a>
                    </li>

                    <li class="sparks-info" style="border: 1px solid #c5c5c5; padding-right: 0px; padding: 10px; min-width: auto;">
                        <a href="<?php echo base_url("adminpanel/master/prescription/view_prescription"); ?>"><h5>View All<span class="txt-color-blue" style="text-align: center"><i class=""></i><?php echo count($list_data); ?></span></h5></a>
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
								<div class="jarviswidget-editbox"></div>
                                <div class="widget-body no-padding">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th style = "display: none;">No</th>
                                                <th>Date</th>                              
												<th>Doctor Name</th>
                                                <th>Patient Name</th>
												<th width='10%'>Age</th>
												<th>Appointment<br>Number</th>
												<?php /* <th>Description</th>*/ ?>
												<th width='10%' style=" text-align: center">View / Modify </th> 
                                                <th width='10%' style=" text-align: center">Delete</th>
                                                <th width='10%'>Activation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $count=0;

                                            foreach ($list_data as $rowlist) {
                                               $count++;
                                                $recordid = $rowlist->id;
                                                $cEnable = $rowlist->cEnable;
                                                
                                                ?>
                                                <tr>
             <!--to get decending order--><td style= "display: none;"><?php echo $count; ?></td>
                                                    <td><?php echo $rowlist->dDate; ?></td>
                                                   <!-- <td><?php echo $rowlist->Shedule_Time; ?></td>-->
                                                    <td><?php echo $rowlist->doc_name; ?></td>
                                                    <td><?php echo $rowlist->patient_name; ?></td>
                                                    <td><?php echo $rowlist->iAge; ?></td>
													<td><?php echo $rowlist->iAppointmentNumber; ?></td>
													<?php /*<td><textarea rows="6" name="tDescription"><?php echo $rowlist->tDescription; ?></textarea></td>*/ ?>

                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                            <a href="<?php echo base_url("adminpanel/master/prescription/edit_prescription/$recordid"); ?>" title="Modify"><i class="fa fa-edit" style=" text-align: center"></i></a>
                                                        </div>
                                                    </td>
                                                    <td align='center'> 
                                                        <div class="control-buttons" style="font-size: 15px;">  
                                                         <a href="<?php echo base_url("adminpanel/master/prescription/delete_record/$recordid"); ?>" onclick="return confirm('Are you sure?')" title="Delete"><i class=" fa fa-trash" style=" text-align: center"></i></a>
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
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/prescription/active_record/$recordid"); ?>';
                                                                } else {
                                                                    window.location.href = '<?php echo base_url("adminpanel/master/prescription/deactive_record/$recordid"); ?>';
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
                    <div class="jarviswidget-editbox">
                     </div>
                    <div class="widget-body no-padding">
                        <form action="<?php echo base_url("adminpanel/master/prescription/save_prescription"); ?>" method="post" id="prescription_register-form" class="smart-form" enctype="multipart/form-data">
                            <header>
                                <?php echo $title; ?>
                            </header>
                            <fieldset>


								<div class="row">                                    
                                    <section class="col col-12">
                                        <label class="label">Date <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append fa fa-calendar "></i>
                                            <input type="dDate" name="dDate" placeholder="" value="<?php echo $dDate ?>" required class="datepicker" data-dateformat='yy-mm-dd' >
										</label>
                                    </section>

                                   

								</div>
                                <div class="row">
                                    <section class="col col-6"> 
                                        <label class="label">Doctor <span style=" color: red">*</span></label>
                                        <label class="select">
                                            <select name="d_id" id="d_id" required >
                                                <option value="" selected=""  >Select Doctor </option>
                                                <?php
                                                foreach ($iUserTypeArr as $row) {
                                                    $u_type_id = trim($row->id);
                                                    $vAccTypeName = trim($row->vFirstName).' '.trim($row->vLastName);
                                                    $selTextse = "";
                                                    if ($u_type_id == $d_id) { //array search
                                                        $selTextse = "selected=\"selected\"";
														$for_d_print=$vAccTypeName;
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
                                        <label class="label">Patient <span style=" color: red">*</span></label>
                                        <label class="select">
                                            <select name="iP_id" id="iP_id" required readonly style="display:none;" >
                                                <option value="" selected=""  >Select Patient </option>
                                                <?php
                                                foreach ($iUserTypeArr_p as $row) {

                                                    $u_type_id = trim($row->id);
                                                    $vAccTypeName = trim($row->vFirstName).' '.trim($row->vLastName);
                                                    $selTextse = "";
                                                    if ($u_type_id == $iP_id) { //array search
                                                        $selTextse = "selected=\"selected\"";
														$for_p_print=$vAccTypeName;
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
                                        <label class="label">Appointment No <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="iAppointmentNumber" name="iAppointmentNumber"  value="<?php echo $iAppointmentNumber ?>">
                                        </label>
                                    </section>
                                   
                                      <section class="col col-6">
                                        <label class="label">Age<span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append "></i>
                                            <input type="iAge" name="iAge"  value="<?php echo $iAge ?>">
                                        </label>
                                    </section>
                                </div>


                                <div class="row">                           
                                    <section class="col col-6">
                                        <label class="label">Medical Reports </label>
                                        <div class="input input-file">
                                        <span class="button">
                                            <input id="fReport" type="file" name="fReport" onchange="this.parentNode.nextSibling.value = this.value">Browse
                                        </span>
                <!--readonly=""-->          <input type="text" placeholder="Please Attached">
                                        </div>
                                        <?php  if($fReport){ 
                                        ?>
                                        <br>
                                        <a href='<?php echo base_url().'/medical_reports/'.$fReport;?>' target="new" >Click here to see the attachment </a>
                                        <?php } ?>
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
                                <div class="row"> </div>

                            <header>
                                <h5>Prescribed Drug Details</h5>
                            </header>
                            <fieldset>              
                                <div role="content">
                                <div>       
              <table class="table table-bordered" id="happy" style="box-shadow: none;">
                                        <thead>
                                            <tr style="border: none;">
                                                <th style="width: 100px;">Drug Name</th>
                                                <th style="width: 100px;">Dosage</th>
                                                <th style="width: 150px;">Methods of Administration</th>
                                                <th style="width: 50px;">Add New Row</th>
                                            </tr>
                                        </thead>

                                        <tbody>
    <!--check data availability-->   <?php if(count($pres_data)>0) {


                                    for($m=0; count($pres_data)>$m; $m++){ ?>

                            <tr class="tr_clone">
                                <td>
                                    <label class="select">
                                    <select name="iDrugID[]" id="DrugID_0" required>
                                    <option>Select Drug </option>
                                        <?php
                                            foreach ($drug_data as $row) {
                                                $D_save_id=$pres_data[$m]->iDrugId;  //data id from for loop
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
                                    </select>
                                    <i></i>
                                    </label>
                                </td>

                                <td>                   
                                    <label class="input">
                                    <input type="number" name="iQty[]" id="Qty_0" value="<?php echo $pres_data[$m]->iQuantity; ?>" >
                                    </label>
                                </td>
                                
                                <td>                  
                                    <label class="input">
                                    <input type="text" name="Dusage[]" id="Dusage_0" value="<?php echo $pres_data[$m]->Dusage; ?>" >
                                    </label>
                                </td>                
                                                        
                                <td style="text-align: center;"><span class="glyphicon glyphicon-plus" onclick="add_new_row()" >&nbsp;</span>
                                </td>

                            </tr>


<?php }//end for loop
 } else { ?>
                            <tr class="tr_clone">
                                <td>
                                    <label class="select">
                                    <select name="iDrugID[]" id="DrugID_0" required>
                                    <option>Select Drug </option>
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
                                    </select>
                                    <i></i>
                                    </label>
                                </td>

                                <td>                   
                                    <label class="input">
                                    <input type="number" name="iQty[]" id="Qty_0" value="" >
                                    </label>
                                </td>
                                
                                <td>                  
                                    <label class="input">
                                    <input type="text" name="Dusage[]" id="Dusage_0" value="" >
                                    </label>
                                </td>                
                                                        
                                <td style="text-align: center;"><span class="glyphicon glyphicon-plus" onclick="add_new_row()" >&nbsp;</span>
                                </td>

                            </tr>  
            <?php } ?>     
                                            </tbody>
                                            </table>
                                            
                                </div>
                            </div>
<!--Assigning all option value to one variable= op_data -->
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
mytr += '<tr class="tr_clone">';
mytr += '<td>';
mytr += '<label class="select">';
mytr += '<select name="iDrugID[]" id="DrugID_'+ row_count +'" required>';
mytr += '<option>Select Drug </option>';
mytr +=  '<?php echo $op_data; ?>';
mytr += '</select>';
mytr += '<i></i>';
mytr += '</label>';
mytr += '</td>';
mytr += '<td>';
mytr += '<label class="input">';
mytr += '<input type="number" name="iQty[]" id="Qty_'+ row_count +'" value="" >';
mytr += '</label>';
mytr += '</td>';
mytr += '<td>';
mytr += '<label class="input">';
mytr += '<input type="text" name="Dusage[]" id="Dusage_'+row_count+'" value="">';
mytr += '</label>';
mytr += '</td>';
mytr += '<td style="text-align: center;">';
mytr += '<span class="glyphicon glyphicon-plus" onclick="add_new_row()" >&nbsp;</span>';
mytr += '</td>';
mytr += '</tr>';


var $tableBody = $('#happy').find("tbody"),
$trLast = $tableBody.find("tr:last"),
//$trNew = $trLast.clone();
$trNew = mytr;
$trLast.after($trNew);    
                }
</script>
                                <br>
                                <div class="row">
                                <section class="col col-6">
                                    <label class="label">Description</label>
                                    <label class="textarea">
                                    <textarea rows="6" name="tDescription"><?php echo $tDescription ?></textarea> 
                                    </label>
                                </section>
                                </div>
                            </fieldset>
                        </fieldset>


                                
                            <footer>
                                <input type="hidden" name="cSaveStatus" value="<?php echo $saveStatus ?>">
                                <input type="hidden" name="id" value="<?php echo $this->uri->segment(5); ?>">
								<input type="hidden" name="uploadpath" value="medial_reports/">
                                <button id="button1id" name="button1id" type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                                <button type="button" class="btn btn-default" onclick="viewlist()">
                                    Back
                                </button>
								<?php if ($this->uri->segment(5)!='') { ?>
								<button type="button" class="btn btn-default" onclick='printDiv();'>
                                    Print
                                </button>
								<?php } ?>
                            </footer>
                        </form>
                    </div>
                </div>
			</div>
		<?php } ?>
    </div>
</div>  


<!--print prescription -->
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
		 <h3 class="heading">Prescription</h3>
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
                        <td>Date</td>
						<td><?php echo $list_data[0]->dDate; ?></td>
                        <td></td>
                    </tr>
					<tr>
                        <td>Doctor</td>						
						<td><?php echo $for_d_print; ?></td>
                        <td></td>
                    </tr> 					
					<tr>
                        <td>Patient</td>
						<td><?php echo $for_p_print; ?></td>
                        <td></td>
                    </tr>
					<tr>
                        <td>Appointment No</td>
						<td><?php echo $list_data[0]->iAppointmentNumber; ?></td>
                        <td></td>
                    </tr>
					<tr>
                        <td>Age</td>
						<td><?php echo $list_data[0]->iAge; ?></td>
                        <td></td>
                    </tr>
                   
                    <tr>
                            <td colspan="3">
                                
                                    <table class="table table-bordered" id="happy">
                                        <thead>
                                            <tr>
                                                <th style="width: 50%;">Drug Name</th>
                                                
                                                <th style="width: 45%;">Methods of Administration</th>
                                                <th style="width: 5%;text-align: center;">Dosage</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
<?php if(count($pres_data)>0) {
for($m=0; count($pres_data)>$m; $m++){ ?>

<tr class="tr_clone">
                                <td>
                                    <label class="select">
                                    
                                        <?php
                                            foreach ($drug_data as $row) {
                                                $D_save_id=$pres_data[$m]->iDrugId;
                                                $D_id = trim($row->id);
                                                $D_Name = trim($row->vDrugName);
                                                $D_price = trim($row->fUnitPrice);
                                                
                                                    if ($D_save_id == $D_id) { //array search
                                                        
                                                        echo $D_Name.'(Rs.'.$D_price.' /=)';
                                                    } 
                                            }
                                            ?>
                                    
                                    
                                    </label>
                                </td>

                               
                                
                                <td>                  
                                    <label class="input" >
                                    <?php echo $pres_data[$m]->Dusage; ?>
                                    </label>
                                </td>

                                <td>                   
                                    <label class="input" style="text-align: center;">
                                    <?php echo $pres_data[$m]->iQuantity; ?>
                                    </label>
                                </td>                     
                                

                            </tr>


<?php } }  ?>
</tbody>
</table>
                            </td>
                    </tr>
  					<tr>
                        <td>Description</td>
						<td><?php echo $list_data[0]->tDescription; ?></td>
                        <td><br><br><br></td>
                    </tr>

                </tbody>
            </table>
            <br>
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
    
</script>

<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<script type="text/javascript">
//  GLOBAL FUNCTIONS!

    $(document).ready(function () {

        var errorClass = 'invalid';
        var errorElement = 'em';

        var $checkoutForm = $('#prescription_register-form').validate({
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
                iP_id: {
                    required: true
                },
                     
                d_id: {
                    required: true
                },
                iAppointmentNumber: {
                    required: true
                },
                
                dDate: {
                    required: true
                },
                
            },

            // Messages for form validation
            messages: {
                iP_id: {
                    required: 'Select Patient'
                },
                
                
                d_id: {
                    required: 'Select Doctor'
                },
                iAppointmentNumber: {
                    required: 'Please enter No'
                },
                
                dDate: {
                    required: 'Please enter date'
                },
                
            },

            // Do not change code below
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
    });
	
		
$(document).ready(function(){
 
  // Initialize select2
  $("#iP_id").select2();

});

</script>
