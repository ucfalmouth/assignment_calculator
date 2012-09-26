<?php
function dateDiff($dformat, $endDate, $beginDate)
{
$date_parts1=explode($dformat, $beginDate);
$date_parts2=explode($dformat, $endDate);
$start_date=gregoriantojd($date_parts1[1], $date_parts1[0], $date_parts1[2]);
$end_date=gregoriantojd($date_parts2[1], $date_parts2[0], $date_parts2[2]);
return $end_date - $start_date;
}
?>