<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 


<?php 
    session_start();
    if(isset($_GET['unset'])){
        session_unset();
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=cad_user.php'>"; 
    }
    if(isset($_SESSION['nome']))
    
    {
        $nome_session = $_SESSION['nome'];
        $popup=true;
    }
    else{
        $nome_session="Convidado";
        $popup=false;
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

    /*---------------------------------------------- POPUP AVISO*/
    #popup {
        z-index: 3;
        background-color: white;
        width: 500px;
        display: none;
        border-radius: 20px;
        border: solid 1px;
        position: fixed;
        top: 15%;
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

    /* --------------------------------- FORMATAÇÃO AUTOMATICA PARA ERRO */
    .juntando {
        display: flex;
        flex-direction: rows;
    }

    /*--------------------------------- MENSAGENS DE ERRO NOVAS */
    .mostrar-erro {
        padding-left:127px;
        width:140px;

        display:flex;
        flex-direction:column;
        
        padding-top:2px;
    }
    .mostrar-erro section{
        display:flex;
        flex-direction:row;
    }
    .mostrar-erro table {
        width: 80%;
        padding: 5px;
        height:7px;
        /* background-color: lightgray; */
        
    }
    .mostrar-erro tr,td{
        height:7px;
        background-color: lightgray;
    }

    #fraca, #media, #forte, #otima{
        width: 25%;
        /* background-color:lightgray; */
    }

    #aviso, #aviso2{
        display:relative;
        width: 140px;
        
        text-align:left;
        color:red;
    }

    #aviso2{
        width:180px;
    }

    .mostrar-erro table, #aviso, #mostrarForca, #aviso2{
        font-size:12px;
    }

    #mostrarForca{
        padding-left:-5px;
        padding-top: 2px;
    }
    </style>

    <meta charset="UTF-8">
    <title>Cadastro - Padpad's</title>
    <script src="js.js">
    </script>
</head>

<body>

    <!-- <fieldset style="background-color: purple; border-style:none"> -->


    <!-- </fieldset> -->

    <div class="fundo">
    </div>
    <div id='popup'>
        <font face="arial" size="5">
            <a href="index.php"><span class="fechar">X</span></a><br>
            <center>
                <img width='100px' src='img/atencao.png'>
                <p>Ei, cuidado! Você está logado como <span style='color: red;'><?php echo $nome_session ?></span>. <br>
                    Se cadastrar outra conta, automaticamente será deslogado.<br>Tem certeza que quer cadastrar outra
                    conta?</p><br>
                <a href="cad_user.php?unset=true">Cadastrar outro</a><br><a href="index.php">Continuar como
                    <?php echo $nome_session ?></a>
                <br><br>
            </center>
        </font>
    </div>
    <center>
        <div id="div">
            <?php
            if($popup==true)
            echo "<script>document.getElementById('popup').style.display='block';
                            document.getElementById('div').style.filter='blur(10px)';</script>";
            else echo "<script>document.getElementById('popup').style.display='none';
                        document.getElementById('div').style.filter='none';</script>";
        ?>
            <font face="arial">

                <br>
                <a href="index.php"><img src="img/logo.png" align="center" width="190" height="62"></a>
                <center>
                <br><br>
                <img src="img/img_titulos/titulo_cadastro_cliente.png" height="35px" width="270px">
                <br><br>
                </center>

                <form method="post" align="center" action="?acao=cad" id="formulario" onsubmit="return env();">

                    <div align="left">
                        <div>
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
                        </div>

                        <div class="juntando">
                            <section>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label class="hora1">
                                    <font size="4"><b>EMAIL:</b></font>
                                </label>
                                <input class="text_box" id="email" type="email" size="13" name="email" 
                                onkeyup="document.getElementById('email').style.border='0';
                                         document.getElementById('email').style.borderBottom ='2px solid lightgrey'"
                                required>

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </section>
                            
                                &nbsp;
                                <section style="margin-left: -15px">
                                <img src="img/info.ico" width="20px"
                                            title="Entre 8 e 16 caracteres, podendo ter números, letras maiúsculas e minúsculas e caracteres especiais">
                                        &nbsp;
                                    <label class="hora2">
                                        <font size="4"><b>SENHA:</b></font>
                                    </label>
                                    <input class="text_box" type="password" name="senha" id="senhaForca"
                                        onkeyup="validarForca()" size="14" required>

                                    <span class="mostrar-erro">
                                    <section>
                                        <table cellspacing="0">
                                            <tr>
                                                <td id="fraca"></td>
                                                <td id="media"></td>
                                                <td id="forte"></td>
                                                <td id="otima"></td>
                                            </tr>
                                        </table>
                                        <div id="mostrarForca">Força</div>
                                    </section>
                                        <div id="aviso"></div>
                                    </span>
                                    
                                </section>
                                <br><br>

                            
                        </div>
                        <br>
                            <section align="left">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="password" id="confirmasenha" placeholder="Confirma a Senha *" size="14"
                                    onkeyup="confirmarSenha()" required>
                                <span class="mostrar-erro">
                                    <span id="aviso2" style="color:red; align:right; padding-left: 290px"></span>
                                </span>
                            </section>
                            <div id="avisofinal"></div>

                            <br>
                            <div align="center">
                                <button type="submit" value="limpar" name="enviar"
                                    class="btn_geral btn_login">Enviar</button>
                                &nbsp;

                                <button type="reset" value="limpar" name="limpar"
                                    class="btn_geral btn_login">Limpar</button>
                            </div>
                        

                        <br><br>

                    </div>
                </form>
                <p id="erro">Erro: email já cadastrado <a href="login.php" style="color: purple">Fazer login</a> </p>

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
    $senha=$_POST['senha'];

    $senha=md5($senha);

    function consistenciaEmail($e){
        GLOBAL $conecta;
        $sql="SELECT * FROM cliente WHERE email='$e'";
        $resultado=pg_query($conecta,$sql);
        $afetadas=pg_affected_rows($resultado);
        if($afetadas>0)
        {
            ?>
                <script>
                    document.getElementById('erro').style.display = "block";
                    document.getElementById('email').style.border="1px solid red";
                </script>
            <?php
            throw new Exception("Email já cadastrado");
        }
            
    }

    function cadastro($n, $s,$e, $se){
        GLOBAL $conecta;
        $sql="INSERT INTO cliente VALUES(DEFAULT, '$n', '$s', '$e', '$se','f','f',null,null,null,null,null)";
        $resultado=pg_query($conecta, $sql);
        $afetadas=pg_affected_rows($resultado);
        if($afetadas<=0)
            throw new Exception("Houve um erro no cadastro.");
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
            cadastro($nome,$sobrenome,$email,$senha);
            //echo "Cadastro bem sucedido.";
            $_SESSION['nome']=$nome;
            $_SESSION['id']=getId($email);
            $_SESSION['email']=$email;
            $_SESSION['status']='c';
            $_SESSION['enviar']='cad_user';
            require "emails/enviagmail.php";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
        }
    }
    catch(Exception $e){
    $erro = $e->getMessage()."\n";
    }

?>