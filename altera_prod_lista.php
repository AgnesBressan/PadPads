<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 

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

    include "conexao.php";
  
    $idproduto = $_GET["idproduto"];
    $sql = "SELECT * FROM produto WHERE idproduto = $idproduto;";
    $resultado = pg_query($conecta,$sql);
    $qtde = pg_num_rows($resultado);
    if ( $qtde == 0 )
    {
        echo "Produto não encontrado!<br><br>";
        exit;
    }
    $linha = pg_fetch_array($resultado);

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


        .btn_geral:hover {
            background: rgba(0, 0, 0, 0);
            color: #800080;
            box-shadow: inset 0 0 0 3px #800080;
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
        }

    </style>
    <script src="js.js"></script>

    <meta charset="utf-8" />
    <title>Alterando produtos</title>
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
                <a href="login.php">Fazer Login</a><br><a href="index.php">Continuar como <?php echo $nome_session ?></a>
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

                <form action="grava_prod_alterado.php" method="post">
                    
                    <center>
                        <br><br>
                        <img src="img/img_titulos/titulo_alterandoprod.png" height="35px">
                        <br><br><br>
                    </center>

                    <label class="hora">
                        <font size="4"><b>ID PRODUTO:</b></font>
                    </label>
                    <input class="text_box" type="text" size="5" name="idproduto" value="<?php  echo $idproduto;?> " readonly />

                    <br>

                    <br><br>

                    <div align="left">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>NOME:</b></font>
                        </label>
                        <input class="text_box" type="text" size="17" name="nome" value="<?php echo $linha['nome']; ?>" />

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora2">
                            <font size="4"><b>MODELO:</b></font>
                        </label>
                        <input class="text_box" type="text" name="modelo" size="15" value="<?php echo $linha['modelo']; ?>" />


                        <br>

                        <br><br>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>COR:</b></font>
                        </label>
                        <input class="text_box" type="text" size="17" name="cor" value="<?php echo $linha['cor']; ?>" />


                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora2">
                            <font size="4"><b>PREÇO:</b></font>
                        </label>
                        <input class="text_box" type="number" name="preco" style="width:130px" max="10000" min="0" step=".01" value="<?php echo $linha['preco']; ?>" />

                        <br /><br />
                        <br />
                    </div>

                    <div align="left">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="hora">
                            <font size="4"><b>CATEGORIA:</b></font>
                        </label>
                        <select id="catg" onchange="changeSelect('outro')" style="width: 100px" name="categoria">
                            <?php
                    //Agnesss, é essa parte aqui a da categoria, 
                    //tá em php pq ele vai percorrendo a tabela pra procurar as categorias disponiveis
                            include "conexao.php";
                            $r=pg_query($conecta,"SELECT * FROM categoria");
                            $num=pg_affected_rows($r);
                            for($i=1;$i<=$num;$i++){
                                $l=pg_fetch_array($r);
                                if($linha['idcategoria']==$l['idcategoria']) echo "<option value=".$l['idcategoria']." selected>".$l['nome_categoria']."</option>";
                                else echo "<option value=".$l['idcategoria'].">".$l['nome_categoria']."</option>";
                            }
                        ?>
                            <option value='outro'>Outro</option>
                        </select>

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="hora2">
                            <font size="4"><b>ESTOQUE:</b></font>
                        </label>
                        <input class="text_box" type="number" name="qtde" style="width:130px" min="0" value="<?php echo $linha['qtde'] ?>" />
                        <br>
                        <input id="outro" name="outro" placeholder="Digite a Nova Categoria!"><br>
                        <br><br>

                    </div>

                    <font color="#999696" size="4"><b>IMAGEM:</b></font>
                    <br>
                    <!-- <?php echo $i; ?> -->
                    <?php echo"<img class='preview-img' width='400px' src='img/".getImagem($idproduto)."'>"?>
                    <br>
                    <label> Caso queira alterar, selecione: </label><br>
                    <input class="file-chooser" name="imagem" type="file" accept="image/*"><br>
                    <script>
                        /*
                    o script abaixo foi desenvolvido por Flávio Almeida e
                    retirado de http://cangaceirojavascript.com.br/preview-imagens-upload/
                    É utilizado para mostrar a imagem selecionada antes do upload por um input file. 
                    fora adaptado para o projeto pelo grupo.
                  */
                        const $ = document.querySelector.bind(document);
                        const previewImg = $('.preview-img');
                        const fileChooser = $('.file-chooser');

                        fileChooser.onchange = e => {
                            const fileToUpload = e.target.files.item(0);
                            const reader = new FileReader();

                            // evento disparado quando o reader terminar de ler 
                            reader.onload = e => previewImg.src = e.target.result;

                            // solicita ao reader que leia o arquivo 
                            // transformando-o para DataURL. 
                            // Isso disparará o evento reader.onload.
                            reader.readAsDataURL(fileToUpload);
                        };

                    </script>
                    <br><br>
                    <div align="center">
                        <button type="submit" value="limpar" name="enviar" class="btn_geral btn_login">Enviar</button>
                        &nbsp;

                        <button type="reset" value="limpar" name="limpar" class="btn_geral btn_login">Limpar</button>
                    </div>
                    <br /><br />
                </form>

                <footer>
                    <br>
                    <font size="2">Trabalho Mousepads - Grupo 04 <br> CTI Unesp Bauru SP</font><br><br>

                </footer>

            </font>
        </div>
    </center>
    <div align="center">
        <br>

        <a href='altera_exclui_prod.php'><button type="submit" value="limpar" name="enviar" class="btn_baixo btn_login1">Voltar</button></a>
        <br><br>

        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

    </div>
</body>

</html>
