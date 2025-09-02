<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    session_start();
    $conecta = pg_connect("host=localhost port=5432 dbname=a31sofiarosa user=a31sofiarosa password=postgres");
    if(!$conecta) echo "eu amo dar erros aleatorios do nada";
    include 'fpdf/pdf.php';

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->Cabecalho('Produtos mais vendidos');
    $pdf->Ln(25);

    $i=0;
    foreach($_SESSION['estt_produtos'] as $id => $vendas){
        $sql="SELECT * FROM produto WHERE idproduto=$id";
        $resultado=pg_query($conecta,$sql);
        $linha=pg_fetch_array($resultado);
        $p=($vendas/$_SESSION['estatisticas']['ncompras'])*100;

        if($i==0){
            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(190,5,"O Mais Vendido",0,0,'C');
            $pdf->Ln(7);

            $pdf->SetFont('Arial', '', '14');
            $pdf->TH(60,"Produto");
            $pdf->TH(40,"Total de Vendas");
            $pdf->TH(50,"Faturamento");
            $pdf->TH(40,"Porcentagem");
            $pdf->Ln(5);

            $pdf->SetFillColor(227,227,227);
            $pdf->SetX(10);

            $pdf->Cell(60,10,$linha['nome'],0,0,'C',true);
            $pdf->Cell(40,10,$vendas,0,0,'C',true);
            $pdf->Cell(50,10,"R$ ".number_format($vendas*$linha['preco'],2,',','.'),0,0,'C',true);
            $pdf->Cell(40,10,number_format($p,0,',','.')."%",0,0,'C',true);
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(190,5,"Outros produtos (em ordem de vendas)",0,0,'C');
            $pdf->Ln(7);

            $pdf->SetFont('Arial', '', '14');
            $pdf->TH(60,"Produto");
            $pdf->TH(40,"Total de Vendas");
            $pdf->TH(50,"Faturamento");
            $pdf->TH(40,"Porcentagem");
            $pdf->Ln(5);
        }
        else{
            $pdf->Ln(10);

            $pdf->TD(70,40,$vendas);
            $pdf->TD(110,50,"R$ ".number_format($vendas*$linha['preco'],2,',','.'));
            $pdf->TD(160,40,number_format($p,0,',','.')."%");

            $y=$pdf->GetY();
            $pdf->SetXY(10,$y); 
            $pdf->MultiCell(60,5,utf8_decode($linha['nome']),0,"C");

            $pdf->Ln(10);
            $pdf->SetFillColor(236, 153, 255);
            $pdf->Cell(190,1,"",0,0,'C',true);  
        }

        if($i>=7&&$i%7==0){
            $pdf->SetX(10);
            $pdf->TH(60,"Produto");
            $pdf->TH(40,"Total de Vendas");
            $pdf->TH(50,"Faturamento");
            $pdf->TH(40,"Porcentagem");
            $pdf->Ln(5);
        }
        
        
        $i++;
    }

    $pdf->Output();
?>