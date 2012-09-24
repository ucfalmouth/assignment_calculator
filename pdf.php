<?php
require('fpdf.php');

	
$date1 = ($_POST['date1']);
$date2 = ($_POST['date2']);
$date3 = ($_POST['date3']);
$date4 = ($_POST['date4']);


$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,Schedule,0,1,'l'); 
$pdf->Ln();
$pdf->Cell(30,8,'Complete Research By:','l');
$pdf->Ln();
$pdf->Cell(30,8,$date1,0,'l');
$pdf->Ln();
$pdf->Cell(30,8,'Complete Literacy Review By:','l');
$pdf->Ln();
$pdf->Cell(30,8,$date2,0,'l');
$pdf->Ln();
$pdf->Cell(30,8,'Complete Draft By:','l');
$pdf->Ln();
$pdf->Cell(30,8,$date3,0,'l');
$pdf->Ln();
$pdf->Cell(30,8,'Complete Final Review By:','l');
$pdf->Ln();
$pdf->Cell(30,8,$date4,0,'l');
$pdf->Ln(15);
$pdf->Output();
$pdf->Cell(0,40,'(end of excerpt)');
?>

