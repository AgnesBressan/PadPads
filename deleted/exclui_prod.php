<?php

    session_start();
    // unset ($_SESSION['nome']);
    if(isset($_SESSION['nome']))
    {
        $nome_session = $_SESSION['nome'];
        //echo"<p style='padding-top:30px>Bem-Vindo, <b>$nome_session</b><br></p>";
        //echo "<a href='logout.php'><button style='background: #lightyellow; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 18px; font-family: times new roman;'> Logout </button></a></span>";
    }
    else
    {
        $nome_session = "Convidado";
        //echo"<p style='padding-top:20px'>Bem-Vindo, <br><b>convidado</b> <br></p>";
        //echo"<br><a href='login.php'>Faça Login</a> Para ler o conteúdo<br></span>";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="script/jquery-3.5.1.js"></script>
    <title>Loja Virtual</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
   <script type="text/javascript">
        $(window).scroll(function() {
            if ($(window).scrollTop() >= 100)
                $("#barrafixa").fadeIn("slow");
            else
                $("#barrafixa").fadeOut("slow");
        });

    </script>
    <div id="div">
        <div id="barrafixa">
            <center>
                <nav>
                    <ul>
                        <font face="arial">
                            <li><a href="index_adm.php">Home</a></li>
                            <li><a href="cad_user_adm.php">Cadastro</a></li>
                            <li><a href="altera.php">Produtos</a></li>
                            <li><a href="cad_produto.html">Pesquisas</a></li>
                           
                        </font>
                    </ul>
                </nav>
            </center>
        </div>
        <div id="branca">
            <img style="padding-left: 45px;" src="img/logo.png" width="300px;">
            <div style="padding-top:30px; padding-left:20px;">
                <!--div da pesquisa-->
                <form method="post" action="pesquisa_prod_lista.php">
                    <select name="tipo_pesquisa">
                        <!-- <option value="idproduto">Id produto</option> -->
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="categoria">Categoria</option>
                        <option value="cor">Cor</option>
                    </select>
                    <input type="text" name="pesquisa" placeholder="Digite a pesquisa" required>
                    &nbsp;&nbsp;
                    <input type="submit" value="Buscar">
                </form>
            </div>

            <div style="padding-top: 17px; padding-left:23px;">

                <a><a href="carrinho.php"><img src="img/carrinho.png" width="50px" height="50px"></a></a>


<?php 
                     
 
                            if(isset($_SESSION['nome']))
                            {
                                echo "<a href = 'area_user.php'><img src='img/usuario.png' width='50px' height='50px'></a>";
                                    
                            }

                            else
                            {
                                echo "<a href = 'login.php'><img src='img/usuario.png' width='50px' height='50px'></a>";
                            }

?>
            </div>
            <span style="padding-top:30px; padding-left:20px">
                <center><?php
                        echo "Bem-Vindo, ADM<br><b> $nome_session </b>";
                    ?></center>
            </span>

        </div>
        <header>
            <nav>
                <ul>
                    <font face="arial">
                        <li><a href="index_adm.php">Home</a></li>
                        <li><a href="cad_user_adm.php">Cadastro</a></li>
                        <li><a href="altera.php">Produtos</a></li>
                        <li><a href="cad_produto.html">Pesquisas</a></li>
                    </font>
                </ul>
            </nav>
        </header>
        <br>
      
        
        <br><br>
        <div class='container'>
           
<?php
            include "conexao.php";
            $sql="SELECT * FROM produto WHERE excluido=FALSE ORDER BY idproduto;";

            $resultado=pg_query($conecta,$sql);

            $encontrados=pg_affected_rows($resultado);

            if($encontrados>0)
            {
                for($i=0; $i<$encontrados; $i++)
                {
                    $linha= pg_fetch_array($resultado);
                    echo "<div class='sub'>
                        ID: ".$linha['idproduto']."<br>
                        Nome: ".$linha['nome']."<br>
                        Modelo: ".$linha['modelo']."<br>
                        Cor: ".$linha['cor']."<br>
                        Categoria: ".$linha['idcategoria']."<br>";
                        if($linha['qtde']>0) echo "Preço: ".$linha['preco'].
                        "<br>";
                    echo "<br><div align='center'><a href='exclui_prod_confirma.php?idproduto=".$linha['idproduto']."'><button style='background: #E0FFFF; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 18px; font-family: times new roman;'> Excluir </button></div></a>"; 
                    echo "</div>";
                }
                
            }
            else
            echo "Não foi encontrado nenhum produto !!!<br><br>";
        pg_close($conecta);
?>
        </div>
        
        <br><br>
        <br><br>

        <!-- <br><br>   -->
        <div class="rodape">
            <header>
                <div>
                    <nav>
                        <ul>
                            <font face="arial">
                                <li><a href="index_adm.php">Home</a></li>
                                <li><a href="cad_user_adm.php">Cadastro</a></li>
                                <li><a href="altera.php">Produtos</a></li>
                                <li><a href="cad_produto.html">Pesquisas</a></li>
                                
                            </font>
                            <font face="arial" size="3">
                                <br><br>
                                01 - Agnes
                                05 - Augusto
                                17 - Isabela
                                31 - Sofia
                                32 - Stephanie
                                35 - Yasmin
                            </font>
                        </ul>
                    </nav>
                </div>
            </header>
        </div>
    </div>
</body>

</html>
