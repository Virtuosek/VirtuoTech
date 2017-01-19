<?php

require '../../admin/lib/php/dbConnect.php';
require '../../admin/lib/php/classes/Connexion.class.php';
require '../../admin/lib/php/classes/DAOClient.class.php';

$cnx = Connexion::getInstance($dsn,$user,$password);

$clients = new DAOClient($cnx);
$liste = $clients->readAll();
$nbr = count($liste);

require ('../../admin/lib/php/fpdf/fpdf.php');

$pdf = new FPDF('P','cm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->SetDrawColor(180,0,0);
$pdf->SetFillColor(180,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(3, 3);
$pdf->Cell(16,1,'Liste des clients',1,1,'L',1);

$pdf->SetDrawColor(0, 0 ,0);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',12);
$pdf->SetXY(2.5, 4);
$x = 2.5;$y =4;

for($i=0;$i<$nbr;$i++)
{
    $pdf->SetXY($x+0.5,$y);
    $pdf->Cell(16,1, ($liste[$i]['nom_client']),0,1,'L',1);
    $pdf->SetXY($x+5,$y);
    $pdf->Cell(16,1,  utf8_encode($liste[$i]['prenom']),0,1,'L',1);
    $pdf->SetXY($x+10,$y);
    $pdf->Cell(16,1,  utf8_encode($liste[$i]['email']),0,1,'L',1);
    $y+=0.8;
}
$pdf->Output();
?>