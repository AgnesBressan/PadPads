<?php
    include 'fpdf/pdf.php';
    session_start();
    
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', '20');
    $pdf->Cabecalho('Estatísticas Gerais');
    $pdf->Ln(25);

    $pdf->SetFont('Arial', 'B', '16');
    $valor=$_SESSION['estatisticas']['compras'];
    $texto="Total de compras (em reais): R$".number_format($valor,2,',','.');
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);
    
    $texto="Produto mais vendido atualmente: ".$_SESSION['estatisticas']['maisVendido'];
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);

    $texto="Clientes ativos: ".$_SESSION['estatisticas']['nclientesa']." (".
    number_format($_SESSION['estatisticas'][pativa],2,',','.')."% de todos os cadastrados)";
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);

    $texto=utf8_decode("Relação entre compra/cliente: ").number_format($_SESSION['estatisticas']['mediacc'],2,',','.');
    $pdf->Cell(300,20,$texto,0,0,'L');
    $pdf->Ln(10);

    $pdf->Output();
?>