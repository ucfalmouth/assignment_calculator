<?php

function google_input($googledoc) {
  if (($handle = fopen($googledoc, "r")) !== FALSE) {
      while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
          $schedule_array[] = $data;
      }
      fclose($handle);
  }
  // remove table headers
  // unset($schedule_array[0]);
  return $schedule_array;
}


// this function is specific to the individual spreadsheet
// could be made more generic with recursive function?
function parse_google_schedule($schedule_array) {
  $i=0;
  $headers = $schedule_array[0];
  /*
  // identify columns by header text (allows spreadsheet form to change)
  foreach($headers as $header) {
    $header = strtolower($header);
     //echo $header;
    if (!strstr($header, '#')){ // allows comment out irrelevant columns
      if (strstr($header, 'phase')){
        $column_phase = $i;
        //print "\$column_phase = $column_phase  ";
      } elseif (strstr($header, 'section')){
        $column_section = $i;
        //print "\$column_section = $column_section  ";
      } elseif (strstr($header, 'link')){
        if (strstr($header, 'text')){
          $column_link_text = $i;
          //print "\$column_link_text = $column_link_text  ";
          //echo 'url_text: '.$header;
        } elseif (strstr($header, 'link')){
          $column_link_url = $i;
          //print "\$column_link_url = $column_link_url  ";
          //echo 'url_url:  '.$i;
        }
      } elseif (strstr($header, 'description')){
        $column_description = $i;
        //print "\$column_description = $column_description  ";
      } elseif (strstr($header, 'duration')){
        $column_duration = $i;
        //print "\$column_duration = $column_duration  ";
      }
    }
    $i++;
  }
  */

  $column_phase = 0;
  $column_section = 3;
  $column_link_text = 4;
  $column_link_url = 5;
  $column_description = 7;
  $column_duration = 1;

  //krumo($headers);
  unset($schedule_array[0]);
  $s=0; 
  $p = 0;
  foreach($schedule_array as $row_num => $row) {
    // step through the cells of the spreadsheet row
    // is this a main essay phase? (ie the first column has content)
    if ($row[$column_phase]) {
      $s = 0;
      $schedule[$p]['phase'] = $row[$column_phase];
      $schedule[$p]['duration'] = $row[$column_duration];
      $schedule[$p]['sections'][$s] = array(
        'title'=>$row[$column_section],
        'description' => strip_format($row[$column_description]),
        'links' => array(array('title' => $row[$column_link_text], 'url' =>$row[$column_link_url])),
      );
      $lastphase = $p;
      $lastsection = $s; // reset section count
      $s++;
      $p++;
    } elseif ($row[$column_section]) { // is this a section within a phase?
      $schedule[$lastphase]['sections'][$s] = array(
        'title' => $row[$column_section],
        'description' => strip_format($row[$column_description]),
      );
      $schedule[$lastphase]['sections'][$s]['links'][] = array('title' => $row[$column_link_text], 'url' =>$row[$column_link_url]);
      $lastsection = $s;
      $s++;
    } elseif ($row[$column_link_url]) { // is this a link to add to section?
      $schedule[$lastphase]['sections'][$lastsection]['links'][] = array('title' => $row[$column_link_text], 'url' =>$row[$column_link_url]);
      $lastsection = ($lastsection)? $lastsection : $s;
    } 
  }
  //krumo($schedule);
  return $schedule;
}

// remove word formatting characters
function strip_format($string) {
  return preg_replace('/[^(\x20-\x7F)\x0A]*/','', $string);
}

?>