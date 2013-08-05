<?php
session_start();
require('includes/fpdf.php');
// require_once('includes/krumo/class.krumo.php');

	
$date1 = ($_POST['date1']);
$date2 = ($_POST['date2']);
$date3 = ($_POST['date3']);
$date4 = ($_POST['date4']);

$schedule = $_SESSION['schedule'];


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->SetFontSize('24px');
$pdf->Cell(40,10,'Essay Schedule',0,1,'l'); 
$pdf->Ln();
$pdf->SetFontSize('12px');
$pdf->Cell(40,10,'Essay title:',0,1,'l'); 
$pdf->Ln();
$pdf->Cell(40,10,'.......................................................................................',0,1,'l'); 
$pdf->Ln();

foreach($schedule as $phase) {
  $pdf->SetFontSize('12px');
  $pdf->Cell(30,8,'Complete '.$phase['phase'].' By:','l');
  $pdf->Ln();
  $pdf->SetFontSize('18px');
  $pdf->Cell(30,8,$phase['date']."\n",0,'l');
  $pdf->Ln();
  $pdf->Ln();
}

$pdf->Output();
$pdf->Cell(0,40,'(end of excerpt)');

?>

