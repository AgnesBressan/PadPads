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
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Resultado da pesquisa</title>
    <script type="text/javascript" src="script/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    

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
    
    <!-- linha alterada tentativa de filtro -->
    
    <script type="text/javascript">

    function mudaEstado()
    {
        if(document.getElementById('caixa_filtro').style.display == 'block')
        {
            document.getElementById('caixa_filtro').style.display = 'none';
        }else
        document.getElementById('caixa_filtro').style.display = 'block';
    }

    </script>

    <!-- linha alterada tentativa de filtro -->

    <div id="div">
        <div id="barrafixa" align="center">
            <nav>
                <ul>
                    <font face="arial" size="5">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="sobre.php">Sobre</a></li>
                        <li><a href="cad_user.php">Cadastro</a></li>
                    </font>
                </ul>
            </nav>
        </div>
        <div id="branca">
            <img style="padding-left: 45px;" src="img/logo.png" width="300px;">
            <div style="padding-top:30px; padding-left:20px;">

            </div>


            <!--Linha alterada-->
            <div style="padding-top: 17px; padding-left:350px;">
                <!--Linha alterada-->

                <a><a href="carrinho.php"><img src="img/carrinho.png" width="50px" height="50px"></a></a>


                <?php
                    if($adm==true){
                        echo "<a href = 'index_adm.php'><img src='img/usuario2.png' width='50px' height='50px'></a>";
                    } 
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

            <!--Linhas alteradas-->
            <span style="padding-top:30px; padding-left:20px">
                <center><?php
                        if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                        else echo "Bem vindo, cliente <br><b>$nome_session</b>"
                    ?></center>
            </span>
            <!--Linhas alteradas-->


        </div>
        <header>
            <nav>
                <ul>
                    <font face="arial">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="produtos.php">Produtos</a></li>
                        <li><a href="sobre.php">Sobre</a></li>
                        <li><a href="cad_user.php">Cadastro</a></li>
                    </font>
                </ul>
            </nav>
        </header>



        <!--Linhas alteradas-->

        <center>
            <h1>Produtos pesquisados</h1>

            <form method="post" action="pesquisa_prod_lista.php">
            
            <!-- linha alterada tentativa de filtro -->
            <!-- <font face="arial">
                filtros:
                <select id="caixa_filtro" name="tipo_filtro">
                    <option value="nome">Nome</option>
                    <option value="modelo">Modelo</option>
                    <option value="cor">Cor</option>
                    <option value="categoria">Categoria</option>
                </select> &nbsp; -->

            <!-- linha alterada tentativa de filtro -->

                <!-- pesquisa: -->
                <select name="tipo_pesquisa">
                    <option value="nome">Nome</option>
                    <option value="modelo">Modelo</option>
                    <option value="cor">Cor</option>
                    <option value="categoria">Categoria</option>
                </select>
                </font>
                <input type="text" class="caixinha" name="pesquisa" placeholder="Digite a pesquisa" required>
                &nbsp;&nbsp;
                <input type="submit" value="Buscar">
            </form>
        </center>

        <!--Linhas alteradas-->

        <br><br>
        <div class='container'>
            <?php
                function getCategoria($id)
                {
                    GLOBAL $conecta;
                    $sql="SELECT * FROM categoria WHERE idcategoria=$id";
                    $l=pg_fetch_array(pg_query($conecta,$sql));
                    return $l['nome_categoria'];
                }
                include "conexao.php";
                if($_POST['tipo_pesquisa']=='categoria')
                {
                    $sql="SELECT * FROM categoria WHERE nome_categoria ILIKE '%$_POST[pesquisa]%'";
                    $resultado=pg_query($conecta,$sql);
                    $encontrados=pg_affected_rows($resultado);
                    if($encontrados>0)
                    {
                        $linha=pg_fetch_array($resultado);
                        $sql="SELECT * FROM produto WHERE idcategoria=".$linha['idcategoria'];
                    }
                } // linhas alteradas tentaiva de filtro
                else if($_POST['tipo_filtro']=='categoria')
                {
                    $sql="SELECT * FROM categoria WHERE nome_categoria = '%$_POST[tipo_filtro]%'";
                    $resultado=pg_query($conecta,$sql);
                    $encontrados=pg_affected_rows($resultado);
                    if($encontrados>0)
                    {
                        $linha=pg_fetch_array($resultado);
                        $sql="SELECT * FROM produto WHERE idcategoria=".$linha['idcategoria'];
                    }
                }    
                //linhas alteradas tentativa de filtro     
                else $sql="SELECT * FROM produto WHERE $_POST[tipo_pesquisa] ILIKE '%$_POST[pesquisa]%' ORDER BY idproduto;";

                $resultado=pg_query($conecta,$sql);

                $encontrados=pg_affected_rows($resultado);

                if($encontrados>0)
                {
                    for($i=0; $i<$encontrados; $i++)
                    {
                        $linha= pg_fetch_array($resultado);
                        echo "<div class='sub'>
                        <center><div class='fundo-imagem'><img height='130px' src='img/".$linha['imagem']."' height='130px'></div></center>
                        <div style='border: 3px solid #999696;border-top:none; padding:5px; width:100%'><br><b>Nome:</b> ".$linha['nome']."<br>
                        <b>Modelo</b> ".$linha['modelo']."<br>
                        <b>Cor</b> ".$linha['cor']."<br>
                        <b>Categoria</b> ".getCategoria($linha['idcategoria'])."<br>";
                        if($linha['qtde']>0) echo "<b>Preço: </b> R$ ".number_format($linha['preco'],2,',','.').
                        "<br><br><center><a class='btn-user' href='carrinho.php?acao=add&idproduto=".$linha['idproduto']."'>Adicionar ao Carrinho</a></center><br>";
                        else echo "<span style='color:red;'>Produto indisponível</span>";
                    echo "</div></div>";
                    } 
                }
                else
                {
                    echo "<div align='center'>Não foi encontrado nenhum produto<br><br> </div>";
                }
            ?>
        </div>
        <div class="rodape">
            <header>
                <div>
                    <nav>
                        <ul>
                            <font face="arial">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="produtos.php">Produtos</a></li>
                                <li><a href="sobre.php">Sobre</a></li>
                                <li><a href="cad_user.php">Cadastro</a></li>
                            </font>
                            <br>
                        </ul>
                    </nav>
                </div>
            </header>
        </div>
        <br>
        <font face="arial" size="3">
            <div align="center">
                <b>
                    01</b> - Agnes Almeida &nbsp;
                <b>05</b> - Augusto Amaral &nbsp;
                <b>17</b> - Isabela Navarro &nbsp;
                <b>31</b> - Sofia Rosa &nbsp;
                <b>32</b> - Stephanie Antonelli &nbsp;
                <b>35</b> - Yasmin Sousa &nbsp;
            </div>
        </font>
        <br>

        <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">

    </div><!-- fecha div mae-->

</html>