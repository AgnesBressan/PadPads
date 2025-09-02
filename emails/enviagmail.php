
<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
session_start();
include ('fpdf/pdf.php');
/*
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
date_default_timezone_set('Etc/UTC');

//Carrega as bibliotecas de classes
require 'PHPMailer/PHPMailerAutoload.php';
//Cria uma nova instância da classe PHPMailer
$mail = new PHPMailer;

//Diz ao PHPMailer para usar SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = 'padpadscti'; //Preencher com o usuário da sua conta Gmail

//Password to use for SMTP authentication
$mail->Password = '123padpads'; //Preencher com a senha do usuário da sua conta Gmail

//Set who the message is to be sent from
$mail->From='padpadscti@gmail.com'; //Preencher com a sua conta Gmail

$mail->FromName='Empresa PadPads'; //Preencher com o nome do remetente



$mail->isHTML(true); //Configurar mensagem como HTML

$mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML

switch ($_SESSION['enviar']) {
    case 'cad_user':
        $mail->addAddress($_SESSION['email'], $_SESSION['nome']); //Preencher com o email e nome de quem receberá a mensagem
        $mail->Subject = 'PadPads: Confirmação de Cadastro'; //Preencher com o assunto do email

        ob_start();
        require "body_confirmacaocadastro.php";
        $mensagem = ob_get_contents();
        ob_end_clean();

        break;
    case 'cad_adm':
        $mail->addAddress($_SESSION['adm']['email'], $_SESSION['adm']['nome']); //Preencher com o email e nome de quem receberá a mensagem
        $mail->Subject = 'PadPads: Cadastro e Credenciais'; //Preencher com o assunto do email

        ob_start();
        require "body_confirmacaocadastroadm.php";
        $mensagem = ob_get_contents();
        ob_end_clean();

        break;
    case 'finaliza':
        // echo "entrou no case finaliza";
        $anexo='isSet';
        $mail->addAddress($_SESSION['email'], $_SESSION['nome']); //Preencher com o email e nome de quem receberá a mensagem
        $mail->Subject = 'PadPads: Confirmação de Compra'; //Preencher com o assunto do email

        ob_start();
        require "body_confirmacaocompra.php";
        $mensagem = ob_get_contents();
        ob_end_clean();

        break;

    case 'recupera':
        // echo "entrou no case recupera";
        $mail->addAddress($_SESSION['email'], $_SESSION['nome']); //Preencher com o email e nome de quem receberá a mensagem
        $mail->Subject = 'PadPads: Recuperação de senha'; //Preencher com o assunto do email

        ob_start();
        require "body_recuperacao.php";
        $mensagem = ob_get_contents();
        ob_end_clean();

        break;
}

if(isset($anexo)) {
    include 'fpdf/conexao.php';
    
    $pdf = new PDF();
    // echo "instanciou obj";
    $pdf->AddPage();
    // echo "depois do addpage";
    $pdf->Cabecalho('Resumo de Compra - Mousepads');
    // echo "depois de cabecalho";
    $pdf->Ln(35);
    // echo "depois de ln";
    
    $x=34;
    $x2=$x+50;
    $x3=$x2+30;
    $x4=$x3+30;

    $pdf->SetFont('Arial','B',12);
    $pdf->SetX($x);
    $pdf->TH(50,'Nome Produto');
    $pdf->TH(30,utf8_decode('Preço'));
    $pdf->TH(30,'Qtde');
    $pdf->TH(30,'Subtotal');
    $pdf->Ln(10);

    $y=$pdf->GetY();
    $final=0;
    foreach($_SESSION['carrinho'] as $idproduto => $qtd)
    { // Início do FOREACH
        
        $sql = "SELECT * FROM produto WHERE idproduto=$idproduto AND excluido IS FALSE AND qtde>=$qtd"; 
        $linha=pg_fetch_array(pg_query($conecta,$sql));

        $pdf->TD($x2,30,number_format($linha['preco'],2,',','.'));
        $pdf->TD($x3,30,$qtd);
        $pdf->TD($x4,30,number_format($linha['preco']*$qtd,2,',','.'));
        $pdf->SetXY($x,$y);
        $pdf->MultiCell(50,10,utf8_decode($linha['nome']),0,"C");

        $pdf->Ln(5);
        $pdf->SetX($x);
        $pdf->Cell(140,1,"",0,0,'C',true);
        $pdf->Ln(5);
        $y=$pdf->GetY();

        $final+=$linha['preco']*$qtd;
    }
    $pdf->SetFillColor(227,227,227);
    $pdf->SetX($x);
    $pdf->Cell(140,10,"Total da Compra: R$".number_format($final,2,',','.'),0,0,'R',true);

    $pdf->Close();
    $pdf->Output('/tmp/resumo_compra.pdf','F');

    // echo "fez o pdf";
    $mail->addAttachment('/tmp/resumo_compra.pdf');
    // echo "colocou como anexo";
}
$mail->Body    = $mensagem;
// echo $mensagem;
////Replace the plain text body with one created manually
unset($_SESSION['enviar']);
unset($_SESSION['carrinho']);
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    // echo "Message sent!";
}
?>