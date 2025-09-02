<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de cliente</title>
        <script src="js.js"></script>
    </head>
    <body>
    <h1>Cadastro normal</h1>
        <form method="post" action="cadastroaction.php?acao=cad" id="formulario">
            <input type="text" name="nome" placeholder="Nome" ><br>
            <input type="text" name="sobrenome" placeholder="Sobrenome" ><br>
            <input type="email" name="email" placeholder="Email" ><br>
            <input type="password" name="senha" placeholder="Senha" id="senhaForca" onkeyup="validarForca()">
            <img src="/img/info.ico" width="20px" title="Entre 8 e 16 caracteres, podendo ter números, letras maiúsculas e minúsculas e caracteres especiais">
            <br>
            <div id="temporario"></div>
            <div id="mostrarForca"></div>
            <div id="aviso"></div>
            <input type="password" id="confirmasenha" placeholder="Confirma a Senha" onkeyup="confirmarSenha()"><br>
            <div id="aviso2"></div>
            <input type="button" value="Enviar" onclick="env()">
            <div id="avisofinal"></div>
        </form>
    <h1>CadastroAdmin</h1>
    <form method="post" action="cadastroaction.php?acao=adm" id="formularioADM">
            <input type="text" name="nome" placeholder="Nome" ><br>
            <input type="text" name="sobrenome" placeholder="Sobrenome" ><br>
            <input type="email" name="email" placeholder="Email" ><br>
            <input type="password" name="senha" placeholder="Senha" id="senhaadm">
            <img src="/img/info.ico" width="20px" title="Entre 8 e 16 caracteres, podendo ter números, letras maiúsculas e minúsculas e caracteres especiais">
            <br>
            <input type="radio" name="tipo" value="adm" id="adm">Administrador
            <input type="radio" name="tipo" value="user">Cliente
            <!-- <input type="password" id="confirmasenha" placeholder="Confirma a Senha" onkeyup="confirmarSenha()"><br> -->
            <!-- <div id="aviso2"></div> -->
            <input type="button" value="Enviar" onclick="envAdm()">
            <div id="avisofinal2"></div>
        </form>
    </body>
</html>

<?php 
include "conexao.php";
if(!isset($_GET['acao']))
    return;//ele não executa o php se a variável do action não existir
$acao=$_GET['acao'];

//variáveis de formulário
$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$email=$_POST['email'];
$senha=$_POST['senha'];

$senha=md5($senha);

function consistenciaEmail($e){
    GLOBAL $conecta;
    $sql="SELECT * FROM cliente WHERE email='$e'";
    $resultado=pg_query($conecta,$sql);
    $afetadas=pg_affected_rows($resultado);
    if($afetadas>0)
        throw new Exception("Email já cadastrado");
}

function cadastro($n, $s,$e, $se){
    GLOBAL $conecta;
    $sql="INSERT INTO cliente VALUES(DEFAULT, '$n', '$s', '$e', '$se','f')";
    $resultado=pg_query($conecta, $sql);
    $afetadas=pg_affected_rows($resultado);
    if($afetadas<=0)
        throw new Exception("Houve um erro no cadastro.");
}

function cadastroAdmin($n,$s, $e,$se){
    GLOBAL $conecta;
    // $adm=true;
    $sql="INSERT INTO cliente VALUES(DEFAULT, '$n', '$s', '$e', '$se',true)";
    $resultado=pg_query($conecta, $sql);
    $afetadas=pg_affected_rows($resultado);
    if($afetadas<=0)
        throw new Exception("Houve um erro no cadastro.");
}

//main
try{
    if($acao=='cad') {
        consistenciaEmail($email);
        cadastro($nome,$sobrenome,$email,$senha);
        //echo "Cadastro bem sucedido.";
        header("location:./redirec.html");
    }
    else if($acao=='adm'){
        $tipo=$_POST['tipo'];
        if($tipo=='adm')
            cadastroAdmin($nome,$sobrenome,$email,$senha);
        else 
            cadastro($nome,$sobrenome,$email,$senha);
        header("location:./redirec.html");
    }
}
catch(Exception $e){
    echo "Erro: ".$e->getMessage()."\n";
}

?>