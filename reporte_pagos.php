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

            $queryPago = "SELECT * FROM pagos WHERE cod = '$ci' and factura != 0 order by nro" ;
            $resPagos = mysqli_query($conect, $queryPago);

            $totalPagado = "SELECT SUM(monto) as monto from pagos where cod = '$ci' and factura != 0 order by monto";
            $resTotal =  mysqli_query($conect, $totalPagado);
            $rowTotal = mysqli_fetch_array($resTotal);
            // $queryNotas = "SELECT * FROM notas WHERE ci = '$ci'";
            // $resNotas = mysqli_query($conect, $queryNotas);
            // $rowNotas = mysqli_fetch_array($resNotas);


            $pdf = new PDF();
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 8);
            $txt = iconv('utf-8', 'cp1252', strtoupper(utf8_encode($programa)));

            $pdf -> Cell(30);
            $pdf->Cell(50, 5, $txt, 0, 1, 'L');
            $pdf -> Cell(30);
            $pdf->Cell(50, 5, 'Maestrante...', 0, 1, 'L');
            $pdf -> Ln(5);
            $pdf->Cell(25, 6, 'Gestion', 1, 0, 'L');
            $pdf->Cell(10, 6, 'Nro.', 1, 0, 'L');
            $pdf->Cell(40, 6, 'Concepto', 1, 0, 'L');
            $pdf->Cell(20, 6, 'Monto', 1, 0, 'L');

            $pdf->Cell(33, 6, 'Fecha de pago', 1, 0, 'L');
            $pdf->Cell(33, 6, 'Fecha Pagada', 1, 0, 'L');
            $pdf->Cell(25, 6, 'Nro. Factura', 1, 1, 'L');

            while ($rowPagos = mysqli_fetch_array($resPagos)) {

                $pdf->Cell(25, 6,$rowPagos['gestion'] , 1, 0, 'L');
                $pdf->Cell(10, 6,$rowPagos['nro'], 1, 0, 'L');
                $pdf->Cell(40, 6,$rowPagos['concepto'], 1, 0, 'L');
                $pdf->Cell(20, 6,$rowPagos['monto'], 1, 0, 'L');

                $pdf->Cell(33, 6, $rowPagos['fec'], 1, 0, 'L');
                $pdf->Cell(33, 6, $rowPagos['fecpag'], 1, 0, 'L');
                $pdf->Cell(25, 6, $rowPagos['factura'], 1, 1, 'L');
            }
            $pdf-> Ln(10);
            $pdf->Cell(80);
            $pdf->Cell(30, 5, 'Total Programa'.' '.$rowP['costo'], 0, 1, 'L');
            
            
            $pdf->Cell(80);
            $pdf->Cell(30, 5, 'Cuotas pagados'.' '.mysqli_num_rows($resPagos), 0, 1, 'L');
            

            
            $pdf->Cell(80);
            $pdf->Cell(30, 5, 'Total pagado '.$rowTotal['monto'], 0, 1, 'L');

            $diferencia = $rowP['costo'] - $rowTotal['monto'];
            $pdf->Cell(80);
            $pdf->Cell(30, 5, 'Saldo a pagar '. $diferencia, 0, 1, 'L');
            


            $con = new ConvertirNum();
            $hoy = getdate();
            $pdf->Ln(20);
            $pdf->Cell(150, 10, $hoy['mday'] . '         ' . $con->mes($hoy['mon']) . '       ' . $hoy['year'], 0, 1, 'R');

            $pdf->Output();
        }
    }
}
