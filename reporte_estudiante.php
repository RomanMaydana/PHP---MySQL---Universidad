<?php
include('bd.php');
include('plantilla.php');
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Cell(20, 6,'C.I.',1,0,'C');
$pdf->Cell(70, 6,'Apellidos',1,0,'C');
$pdf->Cell(70, 6,'Nombres',1,1,'C');

$pdf->Setfont('Times','',10);
$query="SELECT * FROM estudiante ORDER BY Ap ASC";
    $resultado = mysqli_query($conect, $query);
    
while($row=$resultado->fetch_assoc())
{
	$pdf->Cell(20,6,$row['ci'],1,0,'C');
	$pdf->Cell(70,6,$row['ap'],1,0,'C');
	$pdf->Cell(70,6,utf8_decode($row['nom']) ,1,1,'C');
}

//$pdf->Output();
//$pdf->Output('F','Reporte.pdf');

//for($i=1;$i<=40;$i++)
  //  $pdf->Cell(0,10,utf8_decode('Imprimiendo línea número ').$i,0,1);
$pdf->Output();
?>