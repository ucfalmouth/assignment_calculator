
<link href="acalc.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"> </script>

<script language="javascript"> 
function showMore(num_id) {
    var ele = document.getElementById("toggleText" + num_id);
    var text = document.getElementById("displayText");
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
<?php $enddate = $_POST['enddate'];
require("dateDiff.php");
$today = $_POST['startdate'];
$result =  dateDiff("-", $enddate, $today);

$s1 = $result * 0.05;
$s1 = floor($s1);
$s2 = $result * 0.60;
$s2 = floor($s2);
$s3 = $result * 0.07;
$s3 = floor($s3);
$s4 = $result * 0.21;
$s4 = floor($s4);
$s5 = $result * 0.10;
$s5 = floor($s5);

echo "<ul>";
echo "<li>";
echo "<div class='acinfo plan'>";
$date = strtotime(date("d-m-y", strtotime($today)) . " +$s1 day");
echo "<span>Planning</span>to be completed on: <b>".date('d-m-y', $date). "<br></b>";
?>

<a id="displayText1" href="javascript:showMore(1);">View Work Breakdown +</a>
<div id="toggleText1" style="display: none">
        <ul>
        <div class="accordionButton"><li>Understand The Assignment+</li></div>
        <div class="accordionContent">
            It is always worth spending some time considering carefully 
            what you have been asked to do and making sure you understand 
            what is expected. 
            <a href="http://www.google.com">Understanding the essay brief</a> 
            explains some key terms.</div>
            See also Assignment Types for other forms of academic writing.
        <li>Generate Ideas</li>
        <li>Make Research Plan</li>
    </ul> 
    </div>
<?php
echo "</li>";

/*
// do this in a function?
require_once("includes/schedule_functions.php");
require_once('includes/krumo/class.krumo.php');

$date = strtotime(date("d-m-y", strtotime($today)) . " +$s1 day");
$introduction = 'hello there';
$class = 'plan';
$steps = array(
  'step 1',
  'step 2',
  );
echo phase_list('Planning', $steps, $date, $class);
*/

$step2 = date('d-m-y', $date);
echo "<li>";
echo "<div class='acinfo res'>";
$date2 = strtotime(date("d-m-y", strtotime($step2)) . " +$s2 day");
echo "<span>Researching</span>will need to be completed on:<b> ".date('d-m-y', $date2)."<br></b>";
?>

<a id="displayText2" href="javascript:showMore(2);">View Work Breakdown +</a>
<div id="toggleText2" style="display: none">
        <ul>
        <li>Locate Sources</li>
        <li>Review Sources</li>
        <li>Active Reading and Making Notes</li>
        <li>Revise and Update Original Plan</li>

    </ul> 
    </div>
<?php
echo "</li>";

$step3 = date('d-m-y', $date2);
echo "<li>";
echo "<div class='acinfo org'>";
$date3 = strtotime(date("d-m-y", strtotime($step3)) . " +$s3 day");
echo "<span>Organising</span>will need to be completed on: <b>".date('d-m-y', $date3)."<br></b>";
?>
<a id="displayText3" href="javascript:showMore(3);">View Work Breakdown +</a>
<div id="toggleText3" style="display: none">
        <ul>
        <li>Collect Your Notes</li>
        <li>Arrange Notes to Reflect a Possible Argument</li>
        <li>Make a Writing Plan</li>
    </ul>
    </div>
<?php
echo "</li>";

$step4 = date('d-m-y', $date3);
echo "<li>";
echo "<div class='acinfo wri'>";
$date4 = strtotime(date("d-m-y", strtotime($step4)) . " +$s4  day");
echo "<span>Writing</span>will need to be completed on: <b>".date('d-m-y', $date4)."<br></b>";
?>
<a id="displayText4" href="javascript:showMore(4);">View Work Breakdown +</a>
<div id="toggleText4" style="display: none">
    <ul>
        <li>Start Your First Draft</li>
        <li>Follow Up Your Additional Research</li>
        <li>Revise and Rewrite</li>
        <li>Complete Referencing</li>
    </ul>
    </div>
<?php
echo "</li>";

$step5 = date('d-m-y', $enddate);
echo "<li>";
echo "<div class='acinfo fin'>";
$date5 = strtotime(date("d-m-y", strtotime($enddate)) . " -1  day");
echo "<span>Reviewing</span>will need to be completed on:<b> ".date('d-m-y', $date5)."<br></b>";
?>
<a id="displayText5" href="javascript:showMore(5);">View Work Breakdown +</a>
<div id="toggleText5" style="display: none">
    <ul>
        <li>Speak to a Writing Advisor</li>
        <li>Check Argument</li>
        <li>Check Formatting</li>
        <li>Check References</li>
        <li>Submit</li>
    </ul>
    </div>
<?php
echo "</li>";
echo "</ul>";
 
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