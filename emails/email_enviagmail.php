<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php

// session_start();

/*
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
date_default_timezone_set('Etc/UTC');

//Carrega as bibliotecas de classes
require './PHPMailer/PHPMailerAutoload.php';

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

//Set who the message is to be sent to
$email=$_SESSION['email'];
$nome=$_SESSION['nome'];
$mail->addAddress($email, $nome); //Preencher com o email e nome de quem receberá a mensagem

//Set the subject line
$mail->Subject = 'PadPads: Confirmação de cadastro'; //Preencher com o assunto do email

$mail->isHTML(true); //Configurar mensagem como HTML

$mail->CharSet='UTF-8'; //Configurar conjunto de caracteres da mensagem em HTML
switch ($_SESSION['enviar']){
    case 'cad_user':
        $file = fopen("email_confirmacaocadastro.html","r");
        $str=fread($file,filesize("email_confirmacaocadastro.html"));
        break;
}

$str = trim($str);
fclose($file);
$mail->Body    = $str;

////Replace the plain text body with one created manually
//$mail->Body = $mail->Body = "<object data='body.html'></object>";; //Mensagem em HTML

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    // echo "Message sent!";
}