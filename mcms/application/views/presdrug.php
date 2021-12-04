<?php
if(preg_match("/^([a-zA-Z' ]+)$/",$givenName)){
    echo 'Valid name given.';
}else{
    echo 'Invalid name given.';
}


<?php
			if ($fReport !='1')
								echo "a is bigger than b";
									?>

                                <?php } ?>
								
// Save today's date.
var today = DateTime.Today;

// Calculate the age.
var age = today.Year - birthdate.Year;

// Go back to the year in which the person was born in case of a leap year
if (birthdate.Date > today.AddYears(-age)) age--;
<?php
$dateOfBirth = "17-10-1985";
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));
echo 'Age is '.$diff->format('%y');?>



                                <div  id="divnew" <?php if ($vTitle != 'Baby.') { ?> style=" display: none" <?php } ?>>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">Gardian First Name<span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="vGFName" id="vGFName" value="<?php echo $vGFName; ?>">
                                        </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">Gardian Last Name <span style=" color: red">*</span></label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="vGLName" value="<?php echo $vGLName; ?>">
                                        </label>
                                    </section>
                                </div>
                                 </div>
//Date vali
<input id="datepicker" onchange="checkDate()" required class="datepicker-input" type="text" data-date-format="yyyy-mm-dd" >

<script type="text/javascript">
 function checkDate() {
   var selectedDate = document.getElementById('datepicker').value;
   var now = new Date();
   if (selectedDate < now) {
    alert("Date must be in the future");
   }
 }
</script>

//Date vali
<input id="datepicker" onchange="checkDate()" required class="datepicker-input" type="text" data-date-format="yyyy-mm-dd" >

<script type="text/javascript">
   function checkDate() {
       var selectedDate = document.getElementById('datepicker').value;
       var now = new Date();
       var dt1 = Date.parse(now),
       dt2 = Date.parse(selectedDate);
       if (dt2 < dt1) {
            alert("Date must be in the future");
       }
 }
</script>

//

var selectedDate = $('#datepicker').datepicker('getDate');
var now = new Date();
if (selectedDate < now) {
  // selected date is in the past
}


sheduletime

    