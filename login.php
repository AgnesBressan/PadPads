<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 


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
            border-radius: 20px;
            margin-top: -150px;
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
    </style>


    <meta charset="utf-8" />
    <title>Login</title>
    <script src="js.js"></script>
</head>

<body>

    <div class="fundo">
    </div>

    <center>
        <div id="div">
            <font face="arial">


                <br>

                <a href="index.php"><img src="img/logo.png" align="center" width="190" height="62"></a>

                <center>
                <br><br>
                <img src="img/img_titulos/titulo_login.png" height="30px" width="80px">
                <br><br>
                </center>

                <form method="post" action="consulta_login.php">

                    <div align="left">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>EMAIL:</b></font>
                        </label>
                        <input type="email" size="13" name="email" id="email" required>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora2">
                            <font size="4"><b>SENHA:</b></font>
                        </label>
                        <input type="password" name="senha" size="14" id="senha" required>

                        <br><br>
                        <div align="center">
                            <button type="submit" value="Entrar" name="entrar" id="entrar"
                                class="btn_geral btn_login">Entrar</button>
                        </div><br>
                    </div>
                </form>

                <font face="arial" size="3">
                    <div style="padding-top:30px; padding-left:20px; " align="left">


                        <form method="post" action="cad_user.php">
                            &nbsp;&nbsp;Não possui um cadastro?
                            <input type="submit" value="Cadastrar">
                        </form> <br>
                        <form method="post" action="esquecisenha.php">
                            &nbsp;&nbsp;Esqueceu a senha?
                            <input type="submit" value="Recuperar">
                        </form> <br>
                    </div>
                </font>

                <footer>
                    <br>
                    <font size="2">Trabalho Mousepads - Grupo 04 <br> CTI Unesp Bauru SP</font><br><br>
                </footer>


            </font>

        </div>
    </center>
    <div align="center">
        <br>
        <a href='index.php'><button type="submit" value="limpar" name="enviar" class="btn_baixo btn_login1">Voltar para
                Home</button></a>
        <br><br>

        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

    </div>


</body>

</html>