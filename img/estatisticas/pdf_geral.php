<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    session_start();
    include 'fpdf/pdf.php';

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', '20');
    $pdf->Cabecalho('Estatísticas Gerais');

    $pdf->Ln(25);

    $pdf->SetFont('Arial', 'B', '14');
    $texto="Total de compras (em reais): R$".number_format($_SESSION['estatisticas']['compras'],2,',','.');
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);

    $texto="Produto mais vendido atualmente: ".$_SESSION['estatisticas']['maisVendido'];
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);

    $texto="Clientes Ativos : ".$_SESSION['estatisticas']['nclientesa']."  (".number_format($_SESSION['estatisticas']['pativa'],0,',','.')."%)";
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);
    
    $texto=utf8_decode("Média de compras por clientes (compras/clientes) : ");
    $texto=$texto.number_format($_SESSION['estatisticas']['mediacc'],2,',','.');
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);

    $pdf->Output();
?>