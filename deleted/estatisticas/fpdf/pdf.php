<?php
include ('fpdf.php');

class PDF extends FPDF{
    function Cabecalho($texto){
        $this->SetFont('Arial', 'B', '20');
        $this->SetFillColor(227, 227, 227);
        $this->Rect(10,10,190,20,'F');
        $this->Image('https://i.imgur.com/mAvPkRK.png',20,12,50,'PNG');
        $this->Cell(65,20);
        $texto=utf8_decode($texto);
        $this->Cell(100,20,$texto,0,0);
    }
    function TH($w,$texto){
        $this->SetFillColor(236, 153, 255);
        $this->Cell($w,5,$texto,0,0,'C',true);
    }
    public function TD($x,$w,$texto)
    {
        $this->SetX($x);
        $this->SetLineWidth($w);
        $texto=utf8_decode($texto);
        $this->Cell($w,10,$texto,0,0,'C');
    }
}//class pdf extends fpdf
?>

