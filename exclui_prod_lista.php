<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 


<?php
    include "conexao.php";
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
    function getCategoria($id)
    {
        GLOBAL $conecta;
        $sql="SELECT * FROM categoria WHERE idcategoria=$id";
        $linha=pg_fetch_array(pg_query($conecta,$sql));
        return $linha['nome_categoria'];
    }
    function getImagem($id){
        GLOBAL $conecta;
        $sql="SELECT * FROM produto WHERE idproduto=$id";
        $linha=pg_fetch_array(pg_query($conecta,$sql));
        return $linha['imagem'];  
    }

    $idproduto = $_GET["idproduto"];
    $sql="SELECT * FROM produto WHERE idproduto = $idproduto;";
    $resultado= pg_query($conecta,$sql);
    $qtde= pg_num_rows($resultado);

    if ( $qtde == 0 )
    {
        echo "Produto não encontrado!<br><br>";
        exit;
    }

    $linha = pg_fetch_row($resultado);
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
            width: 120px;
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
    <script src="js.js"></script>

    <meta charset="utf-8" />
    <title>Produto para Exclusão</title>
    <script src="js.js"></script>
</head>

<body>
    <div class="fundo">
    </div>
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
    <center>
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
                <form action="exclui_prod_logica.php" method="post">

                    <center>
                        <br><br>
                        <img src="img/img_titulos/titulo_excluindoprod.png" height="35px">
                        <br><br><br>
                    </center>


                    <label class="hora">
                        <font size="4"><b>ID PRODUTO:</b></font>
                    </label>
                    <input class="text_box" type="text" size="5" name="idproduto" value="<?php echo $linha[0]; ?> " />

                    <br>

                    <br><br>

                    <div align="left">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>NOME:</b></font>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="text_box" type="text" size="15" name="nome" value="<?php echo $linha[1]; ?>" readonly>

                        &nbsp;&nbsp;&nbsp;

                        <label class="hora2">
                            <font size="4"><b>MODELO:</b></font>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="text_box" type="text" name="modelo" size="10" value="<?php echo $linha[2]; ?>" readonly>


                        <br>

                        <br><br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>COR:</b></font>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="text_box" type="text" size="15" name="cor" value="<?php echo $linha[3]; ?>" readonly>


                        &nbsp;&nbsp;&nbsp;

                        <label class="hora2">
                            <font size="4"><b>PREÇO:</b></font>
                        </label>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="text_box" type="number" name="preco" max="10000" min="0" step=".01" value="<?php echo $linha[5]; ?>" readonly>

                        <br /><br />
                        <br />
                    </div>

                    <div align="left">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="hora2">
                            <font size="4"><b>ESTOQUE:</b></font>
                        </label>
                        <input class="text_box" type="number" name="estoque" style="width:135px" min="0" value="<?php echo $linha[6];?>" />

                        &nbsp;&nbsp;&nbsp;
                        <label class="hora">
                            <font size="4"><b>CATEGORIA:</b></font>
                        </label>
                        <input class="text_box" type="text" size="10" name="categoria" value="<?php echo getCategoria($linha[0]); ?>" readonly>
                        <br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <br><br>


                    </div>

                    <font color="#999696" size="4"><b>IMAGEM:</b></font>
                    <br><br>
                    <?php 
                    echo"<img class='preview-img' width='400px' src='img/".getImagem($linha[0])."'>"?>
                    <!-- <img class="preview-img" width="400px"> -->
                    <br><br>
                    <button type="submit" value="limpar" name="enviar" class="btn_geral btn_login">Confirma
                        exclusão</button>

                    <!-- <button style="background: #f6bfff; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 15px; font-family: arial;" type="reset" value="limpar"> Limpar </button>&nbsp; -->

                    <br /><br />
                </form>

                <footer>
                    <br>
                    <font size="2">Trabalho Mousepads - Grupo 04 <br> CTI Unesp Bauru SP</font><br><br>
                </footer>

            </font>
        </div>
    </center>
    <!------------------------------------- ALTERAÇÃO  ------------------------------------------------->
    <div align="center">
        <br>

        <a href='altera_exclui_prod.php'><button type="submit" value="limpar" name="enviar" class="btn_baixo btn_login1">Voltar</button></a>
        <br><br>

        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

    </div>
</body>

</html>
