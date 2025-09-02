<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha</title>

    <style>
        .fundo {
            z-index: 0;
            background-color: purple;
            color: purple;
            border: 2px solid purple;
            margin: 0px;
            height: 200px;
        }

        body {
            background-color: #f6bfff;
        }

        #div {
            z-index: 1;
            width: 600px;
            height: auto;
            background-color: white;
            border-radius: 20px;
            margin-top: -150px;
        }

        #erro{
            color:red;
        }

        .btn_baixo {
            border: none;
            color: white;
            background-color: #db87cf;
            padding: 15px;
            margin: 5px;
            font-size: 24px;
            line-height: 12px;
            border-radius: 5px;
            position: relative;
            box-sizing: border-box;
            cursor: pointer;
            transition: all 400ms ease;
        }

        .btn_baixo:hover {
            background: rgba(0, 0, 0, 0);
            color: #db87cf;
            box-shadow: inset 0 0 0 3px #800080;
            border-color: #db87cf;
        }
    </style>
</head>
<body>
<div class="fundo"></div>
<center>
<font face="arial">
    <div id="div">
        <a href="index.php"><img src="img/logo.png" align="center" width="190" height="62"></a>
        <center>
            <br><br>
            <img src="img/img_titulos/titulo_esquecisenha.png" height="40px">
            <br><br>
            </center>
        <form method="post" action="esquecisenha.php">
            Insira seu email para recuperação de senha<br><br>
            <input type="email" name="email">&nbsp;&nbsp;&nbsp;<input type="submit" value="Enviar">
        </form>
    <br>
    <div id="erro"></div>
    <br><br>   
    </div><!--DIV MAE-->
    <br><br><a href='index.php'><button type="submit" value="limpar" name="enviar" class="btn_baixo btn_login1">Voltar para
                Home</button></a>
</font>
</center>
</body>
</html>
<?php
    if(!isset($_POST['email']))return;
    
    include 'conexao.php';
    $email=$_POST['email'];
    $sql="SELECT * FROM cliente WHERE email='$email' AND excluido=false";
    $resultado=pg_query($conecta,$sql);
    $ar=pg_affected_rows($resultado);

    if($ar<=0)
    echo "<script>
    document.getElementById('erro').innerHTML='Email não encontrado no banco de dados';
    </script>";

    else{
        echo "<script>
        document.getElementById('erro').innerHTML='Foi enviado um email com um link para redefinição de senha.';
        </script>";

        $linha=pg_fetch_array($resultado);

        $_SESSION['nome']=$linha['nome'];
        $_SESSION['email']=$email;
        $_SESSION['id_esqueceu']=$linha['idcliente'];
        $_SESSION['enviar']='recupera';

        require "emails/enviagmail.php";
        unset($_SESSION['nome']);
        unset($_SESSION['email']);
    }

    
?>