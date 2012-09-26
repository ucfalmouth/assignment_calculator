<link href="acalc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"> </script>

<script language="javascript"> 
function showMore(num_id) {
    var ele = document.getElementById("toggleText" + num_id);
    var text = document.getElementById("displayText" + num_id);
    if(ele.style.display == "block") {
            ele.style.display = "none";
        text.innerHTML = 'View Work Breakdown +';
    }
    else {
        ele.style.display = "block";
        text.innerHTML = 'Hide -';
    }
}
</script>

<script>
$(document).ready(function() {
    $('div.accordionButton').click(function() {
        $('div.accordionContent').slideUp('normal');    
        $(this).next().slideDown('normal');
    });
    $("div.accordionContent").hide();
});
</script>

<div id="ach">
<?php 
$enddate = $_POST['enddate'];
require("dateDiff.php");
$today = $_POST['startdate'];
$assignment_end =  dateDiff("-", $enddate, $today);

error_reporting(E_ALL);
ini_set('display_errors','On');
// do this in a function?
require_once("includes/schedule_functions.php");
require_once('includes/krumo/class.krumo.php');
require_once('includes/googledocs.php');
$googledoc = "https://docs.google.com/spreadsheet/pub?key=0AkXIzcr-VBVDdEMzUDA2Wm5OQ0k4LVRLVFhCTnJ1Vmc&single=true&gid=0&output=csv";

$schedule = google_input($googledoc);
$schedule = parse_google_schedule($schedule);

$num_id = 1;
foreach($schedule as $phase) {

    $sections = $phase['sections'];
    $end = $assignment_end * $phase['duration'] * 0.01;
    $end = floor($end);

    $date = strtotime(date("d-m-y", strtotime($today)) . " +$end day");
    $introduction = $sections[0]['description'];
    $class = 'colour-'.$num_id;

    echo phase_list($phase['phase'], $sections, $date, $num_id, $class);
    $num_id++;
}
 
?>
<form action="pdf.php" method="post"  target="_blank">
  <p>
    <label for="message"></label>
    <input type="hidden" value="<?php echo date('d-m-y', $date); ?>" name="date1"/>
    <input type="hidden" value="<?php echo date('d-m-y', $date2);?>" name="date2"/>
    <input type="hidden" value="<?php echo date('d-m-y', $date3); ?>" name="date3"/>
    <input type="hidden" value="<?php echo date('d-m-y', $date4); ?>" name="date4"/>
  </p>
  <p>
    <input type="submit" value="Download schedule as a PDF" class="text_button notbut">
  </p>
</form>

        <form action="addEmail.php" method="post"  target="_blank">
  <p>
  <div>If you would like to recieve email reminders of your schedule, please submit your email address:</div>
    <label for="message"></label>
    <input type="text" value="" name="email" placeholder="name@mail.com" class="acinput">
    <input type="hidden" value="<?php echo date('d-m-y', $date); ?>" name="date1"/>
    <input type="hidden" value="<?php echo date('d-m-y', $date2);?>" name="date2"/>
    <input type="hidden" value="<?php echo date('d-m-y', $date3); ?>" name="date3"/>
    <input type="hidden" value="<?php echo date('d-m-y', $date4); ?>" name="date4"/>
<input type="hidden" value="<?php echo date('d-m-y', $date5); ?>" name="date5"/>
  
    <input type="submit" value="Please send me email reminders" class="text_button notbut notbutb">
  </p>
  <div class="newbut"><a href="test.php">Create another schedule</a></div>
</form>
</div>