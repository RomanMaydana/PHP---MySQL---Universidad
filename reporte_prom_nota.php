<?php
require("fpdf/fpdf.php");
include('bd.php');
include('convertir_num.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        // $this->Image('img/IEE-LOGOWEB.png', 10, 8, 33);
        // Arial bold 15
        $this->Ln(20);
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        // $this->Cell(80);
        // Título
        // $this->Cell(30, 10, 'FACULTAD CIENCIAS PURAS Y NATURALES', 0, 1, 'C');
        // Salto de línea
        // $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 1, 'C');
    }
}

$query = "SELECT m.codigo as cod ,m.nommat as mat, max(nota) as nota FROM materias m, notas n  WHERE m.codigo = n.codmat group by m.nommat";
$result = mysqli_query($conect, $query);
$queryP = "SELECT avg(nota) as notas from notas";
$resultP = mysqli_query($conect, $queryP);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->Cell(30);
$pdf->Cell(50, 5, 'MEJORES NOTAS POR MATERIA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$pdf->Ln(5);
$pdf->Cell(25, 6, 'CODIGO', 1, 0, 'L');
$pdf->Cell(100, 6, 'MATERIA', 1, 0, 'L');
$pdf->Cell(20, 6, 'NOTA', 1, 1, 'L');
while ($row = mysqli_fetch_array($result)) {

    $pdf->Cell(25, 6, $row['cod'], 1, 0, 'L');
    $pdf->Cell(100, 6, $row['mat'], 1, 0, 'L');
    $pdf->Cell(20, 6, $row['nota'], 1, 1, 'L');
    
}
$pdf->Ln(10);
$pdf->Cell(80);
if($row = mysqli_fetch_array($resultP)) {
$pdf->Cell(30, 5, 'Promedio General' . ' '.$row['notas'] , 0, 1, 'L');
}


$con = new ConvertirNum();
$hoy = getdate();
$pdf->Ln(20);
$pdf->Cell(150, 10, $hoy['mday'] . '         ' . $con->mes($hoy['mon']) . '       ' . $hoy['year'], 0, 1, 'R');

$pdf->Output();
