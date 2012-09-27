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
  // identify columns by header text (allows spreadsheet form to change)
  foreach($headers as $header) {
    $header = strtolower($header);
     //echo $header;
    if (!strstr($header, '#')){
      if (strstr($header, 'phase')){
        $column_phase = $i;
      } elseif (strstr($header, 'section')){
        $column_section = $i;
      } elseif (strstr($header, 'link')){
        if (strstr($header, 'text')){
          $column_link_text = $i;
          //echo 'url_text: '.$header;
        } elseif (strstr($header, 'link')){
          $column_link_url = $i;
          //echo 'url_url:  '.$i;
        }
      } elseif (strstr($header, 'description')){
        $column_description = $i;
      } elseif (strstr($header, 'duration')){
        $column_duration = $i;
      }
    }

    $i++;
  }
  unset($schedule_array[0]);
  $i=0;
  $p = 0;
  foreach($schedule_array as $row_num => $row) {
    // is this a main essay phase?  
    if ($row[$column_phase]) {
      $i = 0;
      $schedule[$p]['phase'] = $row[$column_phase];
      $schedule[$p]['duration'] = $row[$column_duration];
      $schedule[$p]['sections'][$i] = array(
        'title'=>$row[$column_section],
        'description' => strip_format($row[$column_description]),
        'links' => array(array('title' => $row[$column_link_text], 'url' =>$row[$column_link_url])),
      );
      $lastparent = $p;
      $lastsection = $i;
      $i++;
      $p++;
    } elseif ($row[$column_section]) { // is this a section within a phase?
      $schedule[$lastparent]['sections'][$i] = array(
        'title'=>$row[$column_section],
        'description' => strip_format($row[$column_description]),
      );
      $schedule[$lastparent]['sections'][$i]['links'][] = array('title' => $row[$column_link_text], 'url' =>$row[$column_link_url]);
      $lastsection = ($lastsection)? $lastsection : $i;
      $i++;
    } elseif ($row[$column_link_url]) { // is this a link to add to section?
      $schedule[$lastparent]['sections'][$lastsection]['links'][] = array('title' => $row[$column_link_text], 'url' =>$row[$column_link_url]);
      $lastsection = ($lastsection)? $lastsection : $i;
    } 
  }
  return $schedule;
}

// remove word formatting characters
function strip_format($string) {
  return preg_replace('/[^(\x20-\x7F)\x0A]*/','', $string);
}

?>