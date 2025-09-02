<?php 
    session_start();
    if(isset($_SESSION['nome']))
    {
        $nome_session = $_SESSION['nome'];
        if($_SESSION['status']=='c'){
            $adm=false;
        } 
        else $adm=true;
    }
    else{
        $nome_session="Convidado";
        $adm=false;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <a name="topo"></a>

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
        margin-top: -150px;
        border-radius: 20px;
    }

    #erro {
        border: 2px solid purple;
        display: none;
        width: 60%;
    }

    #perg {
        width: 400px;
        margin-left: auto;
        margin-right: auto;
        text-align: justify;
    }

    input {
        border: 0;
        border-bottom: 2px solid lightgrey;
        padding: 5px;
        font-weight: bolder;
    }

    label {
        color: #999696;
        font-size: 4;
    }

    label.hora {
        display: inline-block;
        width: 130px;
        color: #999696;
    }

    label.hora1 {
        display: inline-block;
        width: 70px;
        color: #999696;
    }

    label.hora2 {
        display: inline-block;
        width: 90px;
        color: #999696;
    }

    #outro {
        border: 0;
        border-bottom: 2px solid lightgrey;
        padding: 5px;
        margin-left: 70px;
        font-weight: bolder;
        display: none;
    }

    .btn_geral {

        border: none;
        color: #ffffff;
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

    .btn_login {

        background: #800080;

    }

    .btn_geral:hover {
        background: rgba(0, 0, 0, 0);
        color: #800080;
        box-shadow: inset 0 0 0 3px #800080;
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

    .btn_login1 {

        background: #db87cf;

    }

    #popup {
        z-index: 3;
        background-color: white;
        width: 500px;
        display: none;
        border-radius: 20px;
        border: solid 1px;
        position: fixed;
        top: 8%;
        left: 32%;
    }

    .fechar {
        font-size: small;
        background-color: #881167FF;
        border-radius: 50px;
        padding: 5px;
        color: white;
        float: right;
        margin-right: 10px;
        margin-top: 5px;
    }

    a {
        text-decoration: none;
        color: purple;
    }

    a:hover {
        color: gray;
    }
    </style>

    <meta charset="UTF-8">
    <title>Cadastro - Padpad's</title>
    <script src="js.js"></script>
</head>

<body>

    <!-- <fieldset style="background-color: purple; border-style:none"> -->


    <!-- </fieldset> -->

    <div class="fundo">
    </div>

    <center>
        <div id='popup'>
            <font face="arial" size="5">
                <a href="index.php"><span class="fechar">X</span></a><br>
                <center>
                    <img width='300px' src='img/pessoal_autorizado.jpg'>
                    <p>Desculpe, você não tem autorização para acessar essa página. <br>
                        Você está logado como <span style='color: red;'><?php echo $nome_session ?></span>. <br>
                        Se quiser acessar essa página, terá que logar com uma conta de administrador.<br></p><br>
                    <a href="login.php">Fazer Login</a><br><a href="index.php">Continuar como
                        <?php echo $nome_session ?></a>
                    <br><br>
                </center>
            </font>
        </div>
        <div id="div">
            <?php
            if($adm==false)
            echo "<script>document.getElementById('popup').style.display='block';
                            document.getElementById('div').style.filter='blur(10px)';</script>";
            else echo "<script>document.getElementById('popup').style.display='none';
                        document.getElementById('div').style.filter='none';</script>";
            ?>
            <font face="arial">

                <br>
                <a href="index_adm.php"><img src="img/logo.png" align="center" width="190" height="62"></a>
                <h1>Cadastro pelo Administrador</h1><br>


                <form method="post" align="center" action="?acao=cad" id="formulario" onsubmit="return env();">
                    <div align="center">
                        <label>
                            <font size="4"><b>TIPO DE CADASTRO:</b></font>
                        </label><br>
                        <input type="radio" name="tipo" value="adm" id="adm" required>Administrador<br>
                        <input type="radio" name="tipo" value="user" style="margin-left:-43px" required>Cliente<br><br>
                    </div>
                    <div align="left">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>NOME:</b></font>
                        </label>
                        <input class="text_box" type="text" name="nome" size="13" required>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora">
                            <font size="4"><b>SOBRENOME:</b></font>
                        </label>
                        <input class="text_box" type="text" name="sobrenome" size="14" required>

                        <br><br><br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>EMAIL:</b></font>
                        </label>
                        <input class="text_box" type="email" size="13" name="email" required>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                        <span style="margin-left:-25px;">
                            &nbsp;
                            <img src="img/info.ico" width="20px"
                                title="Entre 8 e 16 caracteres, podendo ter números, letras maiúsculas e minúsculas e caracteres especiais">
                            &nbsp;
                            <label class="hora2">
                                <font size="4"><b>SENHA:</b></font>
                            </label>
                            <input class="text_box" type="password" name="senha" id="senhaForca"
                                onkeyup="validarForca()" size="14" required>
                            <br><br>

                        </span>
                        <div id="mostrarForca" style="padding-left: 470px;">
                        </div>
                        <div id="aviso"></div>
                        <br>
                        <center>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <input type="password" id="confirmasenha" placeholder="Confirma a Senha *" size="14"
                                onkeyup="confirmarSenha()" required><br>

                            <div id="aviso2">

                            </div>

                            <div id="avisofinal">


                            </div>

                            <br>
                            <div align="center">
                                <button type="submit" value="limpar" name="enviar"
                                    class="btn_geral btn_login">Enviar</button>
                                &nbsp;

                                <button type="reset" value="limpar" name="limpar"
                                    class="btn_geral btn_login">Limpar</button>
                            </div>
                        </center>

                        <br><br>

                    </div>
                </form>
                <p id="erro">Erro: email já cadastrado <a style="color: purple">Fazer login</a> </p>

                <!-- <a class="topo" href="#ident">Voltar ao topo</a><br><br> -->


                <footer>
                    <font size="2">Trabalho Mousepads - Grupo 04 <br> CTI Unesp Bauru SP</font><br><br>
                </footer>


            </font>

            <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

        </div>
    </center>


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
$senha0=$_POST['senha'];
$status=$_POST['tipo'];
$senha=md5($senha0);

function consistenciaEmail($e){
    GLOBAL $conecta;
    $sql="SELECT * FROM cliente WHERE email='$e'";
    $resultado=pg_query($conecta,$sql);
    $afetadas=pg_affected_rows($resultado);
    if($afetadas>0)
    {
        ?><script>
document.getElementById('erro').style.display = "block";
</script><?php
        throw new Exception("Email já cadastrado");
    }
        
}

function cadastro($n, $s,$e, $se,$st){
    GLOBAL $conecta;
    GLOBAL $senha0;
    if($st=="adm"){
        $sql="INSERT INTO cliente VALUES(DEFAULT, '$n', '$s', '$e', '$se','t','f',null,null,null,null,null)";
        
        $_SESSION['adm']=array();
        $_SESSION['adm']['status']=true;
    }
    else {
        $sql="INSERT INTO cliente VALUES(DEFAULT, '$n', '$s', '$e', '$se','f','f',null,null,null,null,null)";
        $_SESSION['adm']=array();
        $_SESSION['adm']['status']=false;
    }
    $resultado=pg_query($conecta, $sql);
    $afetadas=pg_affected_rows($resultado);
    if($afetadas<=0)
        throw new Exception("Houve um erro no cadastro.");
    
    $_SESSION['adm']['logado']=$_SESSION['nome'];
    $_SESSION['adm']['nome']=$n;
    $_SESSION['adm']['email']=$e;
    $_SESSION['adm']['senha']=$senha0;

    $_SESSION['enviar']='cad_adm';
    require "emails/enviagmail.php";
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index_adm.php'>";
}


function getId($e){
    GLOBAL $conecta;
    $sql="SELECT * FROM cliente WHERE email='$e'";
    $resultado=pg_query($conecta,$sql);
    $linha=pg_fetch_array($resultado);
    return $linha['idcliente'];
}
//main
try{
    if($acao=='cad') {
        consistenciaEmail($email);
        cadastro($nome,$sobrenome,$email,$senha,$status);
        //echo "Cadastro bem sucedido.";
        // $_SESSION['nome']=$nome;
        // $_SESSION['id']=getId($email);
        // echo $_SESSION['id'];
        // header("location:./index.php");
        echo "<script>alert('Cadastrado com sucesso! $status');</script>";
        echo"<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index_adm.php'>";
    }
}
catch(Exception $e){
   $erro = $e->getMessage()."\n";
}

?>