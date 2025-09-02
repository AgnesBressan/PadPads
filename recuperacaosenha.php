
<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    session_start();
    $id=$_GET['id'];
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
    </style>
</head>

<body>
    <script>
        function tamanhoSenha(){
            document.getElementById('aviso1').innerHTML="";
            let senha=document.getElementById('senha').value;
            if(senha.length<8){
                document.getElementById('aviso1').innerHTML="Senha muito curta!";
            }
            else if(senha.length>16){
                document.getElementById('aviso1').innerHTML="Senha muito longa!";
            }
            else{
                document.getElementById('aviso1').innerHTML="";
            }
        }
        function confirmarSenha(){
            let senha1=document.getElementById('senha').value;
            let senha2=document.getElementById('confirmasenha').value;
            if(senha2.length>0 && senha2!=senha1){
                document.getElementById('aviso2').innerHTML="Senhas não correspondem!";
            }
            else{
                document.getElementById('aviso2').innerHTML="";
            }
        }
    </script>

    <div class="fundo"></div>
    <center>
        <font face="arial">
            <div id="div">
                <img src="img/logo.png" align="center" width="190" height="62">
                <br>
                <font size="5">Recuperação de Senha</font><br>
                <span>Insira a nova senha abaixo:</span><br><br>
                <form method="post">
                    <input type="password" name="senha" id="senha" onkeyup="tamanhoSenha()" placeholder="Insira a nova senha"><br>
                        <span id="aviso1" style="color:red; align:right;"></span><br>

                    <input type="password" id="confirmasenha" onkeyup="confirmarSenha()" placeholder="Confirme a nova senha"><br>
                        <span id="aviso2" style="color:red; align:right;"></span>

                    <br><input type="submit" value="Enviar">
                </form>
                <br>
                <span id="erro"></span>
                <br><br>
            </div>
            <!--DIV MAE-->
        </font>
    </center>
</body>

</html>
<?php
    if(!isset($_POST['senha']))return;
    
    $conecta = pg_connect("host=localhost port=5432 dbname=a31sofiarosa user=a31sofiarosa password=postgres");
    if(!$conecta) echo "conexão falhou";

    $senha=$_POST['senha'];
    $senha_cripto=md5($senha);
    $sql="UPDATE cliente SET senha='$senha_cripto' WHERE idcliente=$id";
    $resultado=pg_query($conecta,$sql);
    $ar=pg_affected_rows($resultado);

    if($ar<=0)
    echo "<script>
    document.getElementById('erro').innerHTML='Ocorreu um erro ao atualizar sua senha.';
    </script>";
    else{
        session_unset();
        echo "<script>alert('Senha registrada com sucesso, faça o login para continuar.')</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=login.php'>";
    }

    
?>