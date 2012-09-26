
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <link href="styles/acalc.css" rel="stylesheet" type="text/css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  <script src="/jquery/jquery.ui.core.js"></script> 
  <script src="/jquery/jquery.ui.widget.js"></script> 
  <script src="/jquery/jquery.ui.datepicker.js"></script> 
  <script src="/jquery/jquery.form-validation-and-hints.js" type="text/javascript"></script>
  
  <!--JavaScript function for the jQuery Calender developed by jQuery @  http://jqueryui.com/demos/datepicker/-->
<script>
	$(function() {
	$("#datepicker").datepicker({dateFormat: 'd-m-y'});
});
</script>

<!--JavaScript function for the jQuery Calender developed by jQuery @ http://jqueryui.com/demos/datepicker/-->
<script>
	$(function() {
	$("#datepicker2").datepicker({dateFormat: 'd-m-y'});
});
</script>
 
<div id="ach">
<form method='post' action='schedule.php'>
   <div class="title">Assignment <span class="start">Start Date</span></div> <input type="text" name="startdate" id="datepicker" class="acinput" placeholder="01-01-12"/>
    <div class="title">Assignment <span class="end">Deadline</span></div> <input type="text" name="enddate" id="datepicker2" class="acinput" placeholder="01-02-12"/>
    <div><input type="submit" class="subbut" value="Get my assignment schedule"></div>
</form>

</div>

