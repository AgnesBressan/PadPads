<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    session_start();
    $conecta = pg_connect("host=localhost port=5432 dbname=a31sofiarosa user=a31sofiarosa password=postgres");
    if(!$conecta) echo "eu amo dar erros aleatorios do nada";
    include 'fpdf/pdf.php';

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->Cabecalho('Compras por Cliente');
    $pdf->Ln(25);
    
    $pdf->SetX(34);
    $pdf->SetFont('Arial', '', '14');
    $pdf->TH(60,"Cliente");
    $pdf->TH(40,"Total de Compras");
    $pdf->TH(40,"Participacao");
    $pdf->Ln(5.2);
    
    $i=0;
    $x=34;
    $x2=$x+60;
    $x3=$x2+40;
    foreach($_SESSION['estt_clientes'] as $id => $vendas){
            $sql="SELECT * FROM cliente WHERE idcliente=$id";
            $r=pg_query($conecta, $sql);
            $cliente=pg_fetch_array($r);
            $nome=$cliente['nome'];
            $sobrenome=$cliente['sobrenome'];

            $nome=$nome." ".$sobrenome;

            $sql="SELECT * FROM compra WHERE idcliente=$id";
            $r=pg_query($conecta,$sql);
            $n=pg_num_rows($r);
            $p=0;
            for ($i=0; $i < $n; $i++) { 
                $l=pg_fetch_array($r);
                $p+=$l['valor_final'];
            }

            $pdf->Ln(5);
            $pdf->TD($x,60,utf8_decode($nome));
            $pdf->TD($x2,40,$vendas);
            $pdf->TD($x3,40,"R$ ".number_format($p,2,',','.'));
            

            $pdf->Ln(10);
            $pdf->SetX($x);
            $pdf->SetFillColor(236, 153, 255);
            $pdf->Cell(140,1,"",0,0,'C',true);
            
            

        $i++;
    }

    $pdf->Output();
?>