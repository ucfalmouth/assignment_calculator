<?php session_start(); 

require_once("includes/schedule_functions.php");
//require_once('includes/krumo/class.krumo.php');
require_once('includes/googledocs.php');

?>

<link href="styles/acalc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"> </script>

<script language="javascript"> 
function showMore(num_id) {
    var ele = document.getElementById("toggleText" + num_id);
    var text = document.getElementById("displayText" + num_id);
    if(ele.style.display == "block") {
        
        $(ele).slideUp('fast'); 
        text.innerHTML = 'View Work Breakdown +';
    }
    else {
        $(ele).slideDown('fast');
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
<h1>Assignment Calculator</h1>

<?php 
//krumo($_POST);
$enddate = ($_POST['enddate'])? $_POST['enddate'] : date("d-m-y", strtotime(date()." + 1 month"));;
require("includes/dateDiff.php");
$today = ($_POST['startdate'])? $_POST['startdate'] : date("d-m-y");;


$assignment_end =  dateDiff("-", $enddate, $today);

error_reporting(E_ALL);
ini_set('display_errors','On');
// do this in a function?

$googledoc = "https://docs.google.com/spreadsheet/pub?key=0AkXIzcr-VBVDdEMzUDA2Wm5OQ0k4LVRLVFhCTnJ1Vmc&single=true&gid=0&output=csv";

$schedule = google_input($googledoc);
$schedule = parse_google_schedule($schedule);

$num_id = 1;
$last_deadline = 0;
foreach($schedule as $key => $phase) {

    $sections = $phase['sections'];
    $deadline = $assignment_end * $phase['duration'] * 0.01;
    $deadline = floor($deadline);
    $deadline = $deadline + $last_deadline;
    $last_deadline = $deadline;

    $date = strtotime(date("d-m-y", strtotime($today)) . " +$deadline days");
    $date = date('d-m-y', $date);
    $schedule[$key]['date'] = $date;
    $class = 'colour-'.$num_id;

    echo phase_list($phase['phase'], $sections, $date, $num_id, $class);
    $num_id++;
}
//krumo($schedule);
$_SESSION['schedule']=$schedule;
?>


<form action="pdf.php" method="post"  target="_blank">
  <p>
    <input type="submit" value="Download schedule as a PDF" class="text_button notbut">
  </p>
</form>

        <form action="addEmail.php" method="post"  target="_blank">
  <p>
    <!--
  <div>If you would like to recieve email reminders of your schedule, please submit your email address:</div>
    <label for="message"></label>
    <input type="text" value="" name="email" placeholder="name@mail.com" class="acinput">
    <input type="submit" value="Please send me email reminders" class="text_button notbut notbutb">
  </p>
  <div class="newbut"><a href="test.php">Create another schedule</a></div>
    -->
    <p>
    <input type="submit" value="email reminders coming soon.." class="text_button">
  </p>
</form>
</div>