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
$googledoc = "https://docs.google.com/spreadsheet/pub?key=0AkXIzcr-VBVDdEMzUDA2Wm5OQ0k4LVRLVFhCTnJ1Vmc&single=true&gid=0&output=csv";
require_once('includes/krumo/class.krumo.php');

function google_input($googledoc) {
  if (($handle = fopen($googledoc, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
          $schedule_array[] = $data;
      }
      fclose($handle);
  }
  // remove table headers
  unset($schedule_array[0]);
  return $schedule_array;
}
//krumo($schedule_array);

function parse_google_schedule($schedule_array) {
  $i=0;
  foreach($schedule_array as $row_num => $row) {
    // is this a main essay phase?
    if ($row[0]) {
      $i = 0;
      $schedule[$row[0]][$i] = array(
        'title'=>$row[2],
        'description' => $row[7],
        'links' => array(array('title' => $row[3], 'url' =>$row[4])),
      );
      $lastparent = $row[0];
      $lastsection = $i;
      $i++;
    } elseif ($row[2]) { // is this a section within a phase?
      $schedule[$lastparent][$i] = array(
        'title'=>$row[2],
        'description' => $row[7],
      );
      $schedule[$lastparent][$i]['links'][] = array('title' => $row[3], 'url' =>$row[4]);
      $lastsection = $i;
      $i++;
    } elseif ($row[5]) { // is this a link to add to section?
      $schedule[$lastparent][$lastsection]['links'][] = array('title' => $row[3], 'url' =>$row[4]);
      $lastsection = $i;
    } 
  }
  return $schedule;
}
$schedule = google_input($googledoc);
$schedule = parse_google_schedule($schedule);

krumo($schedule);
?>