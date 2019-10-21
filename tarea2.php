<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    //CABECERA
    function Header(){
        //logo
       // $this->Image('logo.png',10,8,33);
        //arial bold 15
        $this->SetFont('Arial','B',15);
        //mov derecha
        $this->Cell(30);
        //titulo
        $this->Cell(130,10,'FACULTAD DE CIENCIAS PURAS Y NATURALES',0,0,'C');
        //salto de linea
        $this->Ln(20);
       
        $this->Cell(100,10,'LISTA DE ESTUDIANTES QUE PAGARON',0,0,'C');
        //salto de linea
        $this->Ln(20);

        $this->SetFont('Arial','B',10);
        $this->Cell(40, 10, 'NOMBRE', 1, 0, 'C', 0);
        $this->Cell(60, 10, 'APELLIDO', 1, 0, 'C', 0);
        $this->Cell(80, 10, 'MATERIA', 1, 0, 'C', 0);
        $this->Cell(15, 10, 'NOTA', 1, 1, 'C', 0);
       
    }
    //PIE
    function Footer(){        
        //Posicion a 1,5cm del final
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',5);
        //Numero de Pagina
        $this->Cell(0,10,utf8_decode('Pagína ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

include('bd.php');
$consulta = "SELECT estudiantes.Nom,estudiantes.Ap, materias.nommat,notas.notas FROM notas, estudiantes,pagos,materias WHERE pagos.Cod=estudiantes.CI AND estudiantes.CI=notas.codest AND materias.codigo=notas.codmat GROUP BY notas.codmat";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(40, 10, $row['Nom'], 1, 0, 'C', 0);
    $pdf->Cell(60, 10, $row['Ap'], 1, 0, 'C', 0);
    $pdf->Cell(80, 10, $row['nommat'], 1, 0, 'C', 0);
    $pdf->Cell(15, 10, $row['notas'], 1, 1, 'C', 0);

    

   


}



 
$pdf->Output();
?>