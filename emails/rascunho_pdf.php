<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
include ('fpdf.php');

class PDF extends FPDF{
    function Logo(){
        $this->Image('logo.png',10,6,30);
    }
    function areaTexto($texto,$align){
        $texto=utf8_decode($texto);
        $this->Cell(0,0,$texto, 0, 1, $align);
    }
}
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
    $pdf->Logo();
    $pdf->Ln(3);
    $pdf->areaTexto('Olá estou testando todos os acentos tipo na palavra coração','L');
    $pdf->Output('/tmp/resumo_compra.pdf','I');
?>

