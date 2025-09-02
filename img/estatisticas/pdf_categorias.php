<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    session_start();
    $conecta = pg_connect("host=localhost port=5432 dbname=a31sofiarosa user=a31sofiarosa password=postgres");
    if(!$conecta) echo "eu amo dar erros aleatorios do nada";
    include 'fpdf/pdf.php';

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->Cabecalho('Categorias mais vendidas');
    $pdf->Ln(25);

    $i=0;
    $x=34;
    $x2=$x+60;
    $x3=$x2+40;

    foreach($_SESSION['estt_categorias'] as $cat => $vendas){
        $p=($vendas/$_SESSION['estatisticas']['ncompras'])*100;

        if($i==0){
            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(190,5,"A Mais Vendida",0,0,'C');
            $pdf->Ln(7);

            $pdf->SetX($x);
            $pdf->SetFont('Arial', '', '14');
            $pdf->TH(60,"Categoria");
            $pdf->TH(40,"Total de Vendas");
            $pdf->TH(40,"Porcentagem");
            $pdf->Ln(5.2);

            $pdf->SetFillColor(227,227,227);
            $pdf->SetX($x);

            $pdf->Cell(60,10,utf8_decode($cat),0,0,'C',true);
            $pdf->Cell(40,10,$vendas,0,0,'C',true);
            $pdf->Cell(40,10,number_format($p,0,',','.')."%",0,0,'C',true);
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', '14');
            $pdf->Cell(190,5,"Outras categorias (em ordem de vendas)",0,0,'C');
            $pdf->Ln(7);

            $pdf->SetX($x);
            $pdf->SetFont('Arial', '', '14');
            $pdf->TH(60,"Categoria");
            $pdf->TH(40,"Total de Vendas");
            $pdf->TH(40,"Porcentagem");
            $pdf->Ln(5);
        }
        else{
            $pdf->Ln(5);
            $pdf->TD($x,60,$cat);
            $pdf->TD($x2,40,$vendas);
            $pdf->TD($x3,40,number_format($p,0,',','.')."%");
            

            $pdf->Ln(10);
            $pdf->SetX($x);
            $pdf->SetFillColor(236, 153, 255);
            $pdf->Cell(140,1,"",0,0,'C',true);  
        }

        // if($i>=7&&$i%7==0){
        //     $pdf->SetX(10);
        //     $pdf->TH(60,"Produto");
        //     $pdf->TH(40,"Total de Vendas");
        //     $pdf->TH(50,"Faturamento");
        //     $pdf->TH(40,"Porcentagem");
        //     $pdf->Ln(5);
        // }
        
        
        $i++;
    }

    $pdf->Output();
?>