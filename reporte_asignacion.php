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

$query = "SELECT m.nommat,m.codigo,tmp.codasig from (select codmata,codasig from asignacion where codasig like 'MGPP3-MA301-1') tmp, materias m where tmp.codmata = m.codigo";
$result = mysqli_query($conect, $query);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();



if ($row = mysqli_fetch_array($result)) {
    $pdf->Cell(80);
    $pdf->Cell(50, 5, 'REPORTE DE ESTUDIANTES - MATERIA - ASIGNACION '.$row['codasig'], 0, 1, 'C');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(30);
    $pdf->Cell(50, 5, $row['nommat'], 0, 1, 'C');
}
$pdf->SetFont('Arial', '', 8);
$pdf->Ln(5);
$pdf->Cell(100, 6, 'Estudiante', 1, 0, 'L');
$pdf->Cell(20, 6, 'Nota', 1, 1, 'L');
$codmat = $row['nommat'];
$queryN = "SELECT dest,nota from notas where codmat = '$codmat'";
$resultN = mysqli_query($conect, $queryN);
while ($row = mysqli_fetch_array($resultN)) {
    $ci = $row['dest'];
    $queryE = "SELECT nom,ap from estudiante where ci = $ci";
    $resultE = mysqli_query($conect, $queryE);
    if ($rowE = mysqli_fetch_array($resultE)) {
    $pdf->Cell(100, 6, $rowE['nom'].' '.$rowE['ap'], 1, 0, 'L');
    }
    $pdf->Cell(20, 6, $row['nota'], 1, 1, 'L');
    
}
$pdf->Ln(10);
$pdf->Cell(80);


$con = new ConvertirNum();
$hoy = getdate();
$pdf->Ln(20);
$pdf->Cell(150, 10, $hoy['mday'] . '         ' . $con->mes($hoy['mon']) . '       ' . $hoy['year'], 0, 1, 'R');

$pdf->Output();
