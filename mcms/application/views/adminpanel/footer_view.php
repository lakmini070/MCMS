<!-- PAGE FOOTER -->
<div class="page-footer">
    <div class="row">
        <div class="col-xs-12 col-sm-6" >
                    
        </div>
            <?php 
            $last_act= get_last_activity();
            $d=strtotime($last_act);
            $x=date("Y-m-d h:i:s",$d); 
            $y=date("Y-m-d H:i:s");
            $z= strtotime($y);
            $diff= round(abs($z-$d) / 60); 
            ?>
            <div class="col-xs-12 col-sm-12 text-right hidden-xs">
                <div class="txt-color-white inline-block">
                    <i class="txt-color-blueLight">Last account activity <i class="fa fa-clock-o"></i> <strong><?php if($diff > 60){
                    	$h=round($diff/60);
                    	$m=round($diff%60);
                    	echo $h.' hrs and '.$m.' mins ago';
                    }else{
                    	echo $diff.' mins ago';} ?>  &nbsp;</strong> </i>
                                
                </div>
            </div>
    </div>
</div>

<!--APP CONFIG -->
		<script src="<?php echo base_url("assets/js/app.config.js"); ?>"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo base_url("assets/js/bootstrap/bootstrap.min.js"); ?>"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="<?php echo base_url("assets/js/notification/SmartNotification.min.js"); ?>"></script>

		<!-- JARVIS WIDGETS -->
		<script src="<?php echo base_url("assets/js/smartwidgets/jarvis.widget.min.js"); ?>"></script>

		<!-- SPARKLINES -->
		<script src="<?php echo base_url("assets/js/plugin/sparkline/jquery.sparkline.min.js"); ?>"></script>

		<!-- JQUERY VALIDATE -->
		<script src="<?php echo base_url("assets/js/plugin/jquery-validate/jquery.validate.min.js"); ?>"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="<?php echo base_url("assets/js/plugin/masked-input/jquery.maskedinput.min.js"); ?>"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="<?php echo base_url("assets/js/plugin/select2/select2.min.js"); ?>"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="<?php echo base_url("assets/js/plugin/bootstrap-slider/bootstrap-slider.min.js"); ?>"></script>


		<!-- MAIN APP JS FILE -->
		<script src="<?php echo base_url("assets/js/app.min.js"); ?>"></script>
		
		<!-- PAGE RELATED PLUGIN(S) -->
			
		<!-- Full Calendar -->
		<script src="<?php echo base_url("assets/js/plugin/moment/moment.min.js"); ?>"></script>
		<script src="<?php echo base_url("assets/js/plugin/fullcalendar/fullcalendar.min.js"); ?>"></script>
               
        <script src="<?php echo base_url("assets/js/plugin/morris/raphael.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/plugin/morris/morris.min.js"); ?>"></script>
        <script src="<?php echo base_url("assets/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"); ?>"></script>
		
        <script type="text/javascript">
			pageSetUp();
			$('#vSheduleStartTime').timepicker();
			$('#vSheduleEndTime').timepicker();
			
		</script>
                
    </body>
</html>