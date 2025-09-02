<!DOCTYPE html>
<html lang="pt-br">

<head>

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

    #outro{
        border: 0;
        border-bottom: 2px solid lightgrey;
        padding: 5px;
        margin-left:70px;
        font-weight: bolder;
        display:none;
    }
    </style>


    <meta charset="utf-8" />
    <title>Alterando produtos</title>
    <script src="js.js"></script>
</head>

<body>

    <div class="fundo">
    </div>

    <center>
        <div id="div">
            <font face="arial">

            <br>

            <a href="index_adm.php"><img src="img/logo.png" align="center" width="190" height="62"></a>
            <h1>Cadastrar Novo Produto</h1><br>

            <form action="cad_produto_form.php?acao=cad" method="post">

                <!-- <label class="hora">
                    <font size="4"><b>ID PRODUTO:</b></font>
                </label>
                <input class="text_box" type="text" size="5" name="idproduto" value="<?php ?> " /> -->

                <br>

                <br><br>

                <div align="left">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>NOME:</b></font>
                    </label>
                    <input class="text_box" type="text" size="15" name="nome" />

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora2">
                        <font size="4"><b>MODELO:</b></font>
                    </label>
                    <input class="text_box" type="text" name="modelo" size="15" />


                    <br>

                    <br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>COR:</b></font>
                    </label>
                    <input class="text_box" type="text" size="15" max-size="100" name="cor" />


                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora2">
                        <font size="4"><b>PREÇO:</b></font>
                    </label>
                    <input class="text_box" type="number" name="preco" style="width:135px" min="0" step=".01" />

                    <br /><br />
                    <br />
                </div>
                <div align="left">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="hora">
                        <font size="4"><b>CATEGORIA:</b></font>
                    </label>
                    <select id="catg" onchange="changeSelect('outro')" name="categoria"
                        >
                        <?php
                    //Agnesss, é essa parte aqui a da categoria, 
                    //tá em php pq ele vai percorrendo a tabela pra procurar as categorias disponiveis
                            include "conexao.php";
                            $r=pg_query($conecta,"SELECT * FROM categoria");
                            $num=pg_affected_rows($r);
                            for($i=1;$i<=$num;$i++){
                                $linha=pg_fetch_array($r);
                                echo "<option value=".$linha['idcategoria'].">".$linha['nome_categoria']."</option>";
                            }
                        ?>
                        <option value='outro'>Outro</option>
                    </select>
                    
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="hora2">
                        <font size="4"><b>ESTOQUE:</b></font>
                    </label>
                    <input class="text_box" type="number" name="qtde" style="width:135px" min="0" />
                    <br> 
                    <input  id="outro" name="outro" 
                    placeholder="Digite a Nova Categoria!"><br>
                    <br><br>

                </div>
                <!--<label> Caso queira alterar, selecione: </label><br>
                
                <input type="radio" name="catg" value="liso" /><b> Liso </b>&nbsp;
                <input type="radio" name="catg" value="estampado" /><b> Estampado </b>&nbsp;
                <input type="radio" name="catg" value="series" /><b> Séries </b>&nbsp;
                <input type="radio" name="catg" value="filmes" /><b> Filmes </b>
                <br /><br /><br> -->

                <!-- <br /><br /><textarea
                        class="font_coment"
                        name="coment"
                        rows="6"
                        cols="60"
                        placeholder="Comentário"
                    ></textarea
                    ><br /> -->
                <font color="#999696" size="4"><b>IMAGEM:</b></font>
                <br><br>
                <!-- <label> Caso queira alterar, selecione: </label><br> -->
                <input class="file-chooser" name="imagem" type="file" accept="image/*"><br>
                <img class="preview-img" width="400px">
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
                <button
                    style="background: #f6bfff; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 15px; font-family: arial;"
                    type="submit" value="enviar"> Enviar </button>&nbsp;

                <button
                    style="background: #f6bfff; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 15px; font-family: arial;"
                    type="reset" value="limpar"> Limpar </button>&nbsp;

                <br /><br />
            </form>
            </font>
        </div>
    </center>
    <div align="center">
        <?php
                    echo "<br><a href='altera_prod.php'><button style='background: purple; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 18px; font-family: arial;'> Voltar para a alteração </button></a>"; 
        ?>
        <br><br>
    </div>
</body>

</html>
<?php
    //TODO aaaaaa

    include "conexao.php";
    
    function cadCategoria($nome){
        GLOBAL $conecta;
        $sql="INSERT INTO categoria VALUES (DEFAULT, '$nome')";
        $r=pg_query($conecta,$sql);
        return $nome;
    }

    function getCategoria($valor){
        GLOBAL $conecta;
        if($valor='Outro')$valor=cadCategoria($valor);

    }

    if(!isset($_GET['acao'])) exit;

    /* cadastro produtos ainda não funcional! 17/09/2020 */
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $modelo = $_POST['modelo'];
    //$catg = getCategoria($_POST['categoria']);
    $cor = $_POST['cor'];
    $qdte = $_POST['qtde'];
    $imagem=$_POST['imagem'];
    echo $imagem;
    $sql = "insert into produto 
            values(DEFAULT,'$nome','$modelo','$cor', 1 ,$preco,30,'$imagem','f');"; 
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if ($linhas > 0)
        echo "Produto gravado !!!<br><br>";
    else
        echo "Erro na gravação do produto!!!<br><br>";
    pg_close($conecta);
    
    
    
?>                        