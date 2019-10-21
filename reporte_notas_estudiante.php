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
        $this -> Ln(20);
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'FACULTAD CIENCIAS PURAS Y NATURALES', 0, 1, 'C');
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
if (isset($_GET['ci'])) {
    $ci = $_GET['ci'];
    $query = "SELECT * FROM estudiante WHERE ci = $ci";
    $result = mysqli_query($conect, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $pro = $row['pro'];
        $nombre = $row['nom'];
        $apellido = $row['ap'];
        $reguni = $row['reguni'];
        $codpro = $row['codpro'];
        $correo = $row['correo'];

        $queryCodPro = "SELECT * FROM programa WHERE digo = '$codpro'";

        $resultPro = mysqli_query($conect, $queryCodPro);
        if (mysqli_num_rows($resultPro) == 1) {
            $rowP = mysqli_fetch_array($resultPro);
            $programa = $rowP['programa'];

            $queryNotas = "SELECT * FROM notas WHERE dest = '$ci' ";
            $resNotas = mysqli_query($conect, $queryNotas);



            // $queryNotas = "SELECT * FROM notas WHERE ci = '$ci'";
            // $resNotas = mysqli_query($conect, $queryNotas);
            // $rowNotas = mysqli_fetch_array($resNotas);


            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);
            $txt = iconv('utf-8', 'cp1252', utf8_encode($programa));
            
            $pdf->Cell(80);
            $pdf->Cell(30, 10, $txt, 0, 1, 'C');
            $pdf->Cell(80);
            $pdf->Cell(30, 10, $apellido . ' ' . $nombre . '               ' . $ci, 0, 0, 'C');

            $pdf->Ln(20);
            $con = new ConvertirNum();

            while ($rowNotas = mysqli_fetch_array($resNotas)) {
                $cod = $rowNotas['CODMAT'];
                $queryMateria = "SELECT * FROM materias WHERE codigo = '$cod'";
                $resMate = mysqli_query($conect, $queryMateria);
                $rowMat = mysqli_fetch_array($resMate);
                $numlit = $con-> convertir(intval($rowNotas['NOTA']));
                $pdf->Cell(20, 10, '2019', 0, 0, 'C');
                $pdf->Cell(100, 10, $rowMat['nommat'], 0, 0, 'L');
                $pdf->Cell(10, 10, $rowNotas['NOTA'], 0, 0, 'L');
                $pdf->Cell(10, 10, $numlit, 0, 1, 'L');  
            }
            for ($i = 1; $i <= 95; $i++) {
                $pdf->Cell(2, 10, '-  ', 0, 0, 'C');
            }
            $pdf->Cell(2, 10, '-  ', 0, 1, 'C');
            $hoy = getdate();
            $pdf -> Ln(20);   
            $pdf->Cell(150, 10, $hoy['mday'].'         '.$con->mes($hoy['mon']) .'       '.$hoy['year'], 0, 1, 'R');

            $pdf->Output();
        }
    }
}
