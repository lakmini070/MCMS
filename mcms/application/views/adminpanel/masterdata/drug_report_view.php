<?php
$tid = $this->uri->segment(5);
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
        <?php if ($saveStatus == 'V') { ?>
            <section id="widget-grid" class="">             
                <div class="row">
			      <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Drug Report</h2>
                            </header>                          
                            <div>                               
                                <div class="jarviswidget-editbox">                                 
                                </div>
                                <div class="widget-body no-padding">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>Drug Name</th>
												<th>Quantity </th>
												<th>Unit Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($list_data as $rowlist) {
                                                $recordid = $rowlist->id;
                                                $cEnable = $rowlist->cEnable;
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowlist->vDrugName; ?></td>
                                                    <td><?php echo $rowlist->iQuantity; ?></td>
                                                    <td><?php echo $rowlist->fUnitPrice; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>


				<div class="row">
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="jarviswidget jarviswidget-color-darken" id="user_types" data-widget-editbutton="false">
                            <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>Fast Moving Drug Report for the Last Month</h2>
                            </header>
                            <div>
                                <div class="jarviswidget-editbox">
                                </div>
                                <div class="widget-body no-padding">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                            <tr>
                                                <th>Drug Name</th>
												<th>Quantity </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($list_data_for_fast as $rowlist) { 
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowlist->vDrugName; ?></td>
                                                    <td><?php echo $rowlist->iQuantity; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </article>                  
                </div>


              <div class="row">
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget" id="wid-id-2" data-widget-editbutton="false">	
								<header>
									<span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
									<h2>Bar Graph </h2>
								</header>
								<div>
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
									</div>
									<div class="widget-body no-padding">
										<div id="bar-graph" class="chart no-padding"></div>
									</div>
								</div>
							</div>
					</article>
				</div>
            </section>
        <?php }  ?>
    </div>
</div>  


<script src="<?php echo base_url("assets/js/plugin/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.colVis.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.tableTools.min.js"); ?>"></script> 
<script src="<?php echo base_url("assets/js/plugin/datatables/dataTables.bootstrap.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/plugin/datatable-responsive/datatables.responsive.min.js"); ?>"></script>

<!-- Morris Chart Dependencies -->
<script src="js/plugin/morris/raphael.min.js"></script>
<script src="js/plugin/morris/morris.min.js"></script>
<script>
			/*
			 * Run all morris chart on this page
			 */
	$(document).ready(function() {
	pageSetUp();
				// bar graph color
				if ($('#bar-graph').length) {
					Morris.Bar({
						element : 'bar-graph',
						data : [<?php foreach ($list_data_for_fast as $rowlist) {	 ?>
						{
							x : <?php echo "'".$rowlist->vDrugName."'"; ?>,
							y : <?php echo $rowlist->iQuantity; ?>
						},<?php } ?>
						],
                 
						xkey : ['x'],
						ykeys : ['y'],
						labels : ['Qty'],
						barColors : function(row, series, type) {
							if (type === 'bar') {
								var red = Math.ceil(150 * row.y / this.ymax);
								return 'rgb(' + red + ',0,0)';
							} else {
								return '#000';
							}
						}
					});
				}
			});

</script>