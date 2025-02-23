<?php
require('sfpdf.php');

$pdf = new sFPDF();
$pdf->AddPage();

// Add a Unicode font (uses UTF-8)
$pdf->AddFont('KaputaUnicode','','kaputaunicode.php',true);
$pdf->SetFont('KaputaUnicode','',14);

// Load a UTF-8 string from a file and print it
$txt = file_get_contents('HelloWorld.txt');
$pdf->Write(15,$txt);

// Select a standard font (uses windows-1252)
$pdf->SetFont('Arial','',14);
$pdf->Ln(10);
$pdf->Write(5,"The file size of this PDF is only 17 KB!");

$pdf->Output();
?>
