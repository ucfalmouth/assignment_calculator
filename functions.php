<?php
/*
require_once("includes/schedule_functions.php");
$introduction = 'hello there';
$class = 'plan';
$steps = array(
  'step 1',
  'step 2',
  );
$phase = phase_list($introduction, $class, $steps);
*/
error_reporting(E_ALL);
ini_set('display_errors','On');

$googledoc = "https://docs.google.com/spreadsheet/pub?key=0AkXIzcr-VBVDdEMzUDA2Wm5OQ0k4LVRLVFhCTnJ1Vmc&single=true&gid=0&output=csv";
require_once('includes/krumo/class.krumo.php');
require_once('includes/googledocs.php');

$schedule = google_input($googledoc);
$schedule = parse_google_schedule($schedule);

krumo($schedule);
?>