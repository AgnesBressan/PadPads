<?php
    include "conexao.php";

    $idproduto = $_GET["idproduto"];
    $sql="SELECT * FROM produto WHERE idproduto = $idproduto;";
    $resultado= pg_query($conecta,$sql);
    $qtde= pg_num_rows($resultado);
    if ( $qtde == 0 )
    {
        echo "Registro nao encontrado!<br><br>";
        exit;
    }
    $linha = pg_fetch_row($resultado);
?>
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
            margin-top: -150px;
        }

        #erro {
            border: 2px solid purple;
            display: none;
            width: 60%;
        }

    </style>


    <meta charset="utf-8" />
    <title>Produto para Exclusão</title>
    <script src="js.js"></script>
</head>

<body>
    <div class="fundo">
    </div>

    <center>
        <div id="div">
            <font face="arial">
                <form action="exclui_prod_logica.php" method="post">
                    <br>
                    <a href="index.php"><img src="img/logo.png" align="center" width="190" height="62"></a>
                    <h1>Excluir Produto</h1>


                    <br>
                    
                        <font> Id do produto:</font> <input type="text" name="idproduto" value="<?php echo $linha[0]; ?>" readonly> <br> <br>
                        
                        <font>Nome:</font> <input type="text" name="nome" value="<?php echo $linha[1]; ?>" readonly>
                        <br><br>

                        <font> Modelo:</font> <input type="text" name="modelo" value="<?php echo $linha[2]; ?>" readonly>
                        <br><br>

                        <font>Cor:</font> <input type="text" name="cor" value="<?php echo $linha[3]; ?>" readonly><br><br>



                        <font>Id da categoria:</font> <input type="text" name="idcategoria" value="<?php echo $linha[4]; ?>" readonly><br><br>


                        <font>Preço: </font> <input type="number" name="preco" value="<?php echo $linha[5]; ?>" readonly><br><br>

                        <font>Quantidade: </font> <input type="number" name="qtde" value="<?php echo $linha[6]; ?>" readonly> <br><br>

                        <!--   Imagem: <input type="number" name="img" value="<?php echo $linha[7]; ?>" readonly> -->

                   





                    <br>


                    <div align=center><input type="submit" value="Confirma exclusão"></div><br>
                </form>
            </font>
        </div>
    </center>



    <div align="center">
        <?php
                echo "<br><br><a href='exclui_prod.php'><button style='background: white; border-radius: 0px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 13px; font-family: arial;'> Voltar para a exclusão </button></a>"; 
                ?>
    </div>
</body>

</html>
