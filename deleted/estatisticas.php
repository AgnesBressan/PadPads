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
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Estatísticas de Venda</title>
</head>

<body>
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
        <!--DIV MAE-->
        <?php
        if($adm==false)
        echo "<script>document.getElementById('popup').style.display='block';
                           document.getElementById('div').style.filter='blur(10px)';</script>";
        else echo "<script>document.getElementById('popup').style.display='none';
                    document.getElementById('div').style.filter='none';</script>";
    ?>
        <div id="branca">
            <img style="padding-left: 45px;" src="img/logo.png" width="300px;">
            <div style="padding-top:30px; padding-left:20px;">
                <!--div da pesquisa-->
                <form method="post" action="pesquisa_prod_lista_adm.php">
                    <select name="tipo_pesquisa">
                        <!-- <option value="idproduto">Id produto</option> -->
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="categoria">Categoria</option>
                        <option value="cor">Cor</option>
                    </select>
                    <input type="text" name="pesquisa" placeholder="Pesquise o produto" required>
                    &nbsp;&nbsp;
                    <input type="submit" value="Buscar">
                </form>
            </div>

            <div style="padding-top: 17px; padding-left:23px;">
                <?php
                            if($adm==true){
                                echo "<a href = 'index.php?popup=admCompra'><img src='img/usuario2.png' width='50px' height='50px'></a>";
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
            <span style="padding-top:30px; padding-left:15px">
                <center><?php
                        if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                        else echo "Bem vindo, cliente <br><b>$nome_session</b>"
                    ?></center>
            </span>

        </div><!-- AQUI FECHA A DIV BRANCA!!!-->
        <header>
            <nav>
                <ul class="menu">
                    <font face="arial">
                        <li><a href="index_adm.php">Home</a></li>
                        <li><a href="#">Cliente</a>
                            <ul>
                                <li><a href="cad_user_adm.php">Cadastro</a></li>
                                <li><a href="exclui_user.php">Exclusão</a></li>
                                <li><a href="dados.php">Pesquisa</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Produto</a>
                            <ul>
                                <li><a href="cad_prod.php">Cadastro</a></li>
                                <li><a href="altera_exclui_prod.php">Alteração</a></li>
                                <li><a href="produtos_adm.php">Pesquisa</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Vendas</a>
                            <ul>
                                <li><a href="history_compras.php">Pesquisa</a></li>
                                <li><a href="estatisticas.php">Estatísticas</a></li>
                            </ul>
                        </li>
                    </font>
                </ul>
            </nav>
        </header>

        <center>
            <h1>Estatísticas de Venda</h1>
        </center>

        <div style="text-align:justify;">
            <font size="5"><b>&nbsp;&nbsp;Estatísticas gerais</b><br></font>
            <?php
                    include 'conexao.php';
                    $_SESSION['estatisticas']=array();

                    $sql="SELECT SUM(valor_final) FROM compra";
                    $compras=pg_fetch_array(pg_query($conecta,$sql));
                    $_SESSION['estatisticas']['compras']=$compras[0];
                    echo "<p>
                    <b>Total de vendas (em reais)</b>: R$ ". number_format($compras[0],2,",",'.');

                    $sql="SELECT SUM(qtd), idproduto FROM itensdacompra GROUP BY idproduto
                    ORDER BY SUM(qtd) DESC;";
                    /*selecionar a soma das quantidades e o id produto dos itens que aparecem na intensdacompra, 
                    agrupar pelo id e ordenar do mais vendido pro menos vendido
                    */
                    $vendidos=pg_query($conecta,$sql);
                    $maisVendido=pg_fetch_array($vendidos);

                    $sql="SELECT nome FROM produto WHERE idproduto=$maisVendido[idproduto]";
                    $produto=pg_fetch_array(pg_query($conecta,$sql));
                    echo "<br><b>Produto mais vendido atualmente: </b> $produto[nome] ($maisVendido[0] vendas)";
                    $_SESSION['estatisticas']['maisVendido']=$produto['nome'];

                    $sql="SELECT count(*) FROM cliente";
                    $nclientes=pg_fetch_array(pg_query($conecta,$sql));

                    $sql="SELECT count(DISTINCT idcliente) FROM compra";
                    $nclientesa=pg_fetch_array(pg_query($conecta,$sql));

                    $pativa=($nclientesa[0]/$nclientes[0])*100;
                    echo "<br><b>Clientes ativos: </b>$nclientesa[0] (".$pativa."%)";
                    $_SESSION['estatisticas']['nclientesa']=$nclientesa[0];
                    $_SESSION['estatisticas']['pativa']=$pativa;

                    $sql="SELECT count(*) FROM compra";//quantas compras foram feitas
                    $ncompras=pg_fetch_array(pg_query($conecta,$sql));
                    $mediacc=$ncompras[0]/$nclientes[0];
                    echo "<br><b>Média de compras por cliente:</b> $mediacc";
                    $_SESSION['estatisticas']['mediacc']=$mediacc;

                    echo "<br><br><a href='estatisticas/pdf_geral.php' target='_blank'>Gerar PDF</a>";

                    echo "</p>";
                ?>
        </div>

        <br>
        <font size="5"><b>&nbsp;&nbsp;Estatísticas Específicas</b><br></font>
        <div class="grid-estatisticas">

            <?php
                    include 'conexao.php';

                    $sql="SELECT SUM(valor_final) FROM compra";
                    $compras=pg_fetch_array(pg_query($conecta,$sql));
                    echo "<div style='margin-left:-20px'>";
                    echo "<b>Produtos mais vendidos</b><br>"; 
                    echo "Listagem dos produtos ordenados dos mais vendidos aos menos vendidos";     
                    echo "<br><br><a href='#estatisticas-produtos' onclick='mostraProdutos()'>Visualizar</a>"; 
                    echo "<br><br><a href='estatisticas/pdf_geral.php'>Gerar PDF</a>";
                    echo "</div>";

                    echo "<div>";
                    echo "<b>Categorias mais vendidas</b><br>";
                    echo "Listagem das categorias das mais procuradas às menos procuradas";   
                    echo "<br><br><a href='#estatisticas-categorias' onclick='mostraCategorias()'>Visualizar</a>"; 
                    echo "<br><br><a href='estatisticas/pdf_categorias.php'>Gerar PDF</a>";
                    echo "</div>";

                ?>
        </div>
        <script>
        function mostraProdutos() {
            document.getElementById('estatisticas-produtos').style.display = 'block';
        }

        function escondeProdutos() {
            document.getElementById('estatisticas-produtos').style.display = 'none';
        }

        function mostraCategorias() {
            document.getElementById('estatisticas-categorias').style.display = 'block';
        }

        function escondeCategorias() {
            document.getElementById('estatisticas-categorias').style.display = 'none';
        }
        </script>

        <div id="estatisticas-produtos" style="display:none;">
            <font size="4">
                <center>
                    <br><br><b>&nbsp;&nbsp;Produtos mais vendidos</b><br>
                    <a onclick="escondeProdutos()">Esconder</a>
                </center>
            </font>
            <a></a>
            <?php
                echo "<table>";
                echo "<tr align='center'><th width='300px'>Imagem</th><th width='300px'>Produto</th>
                <th width='150px'>Total de vendas</th><th width='150px'>Faturado</th>
                <th width='150px'>%</th></tr>";

                $sql="SELECT SUM(qtd), idproduto FROM itensdacompra GROUP BY idproduto
                ORDER BY SUM(qtd) DESC;";
                /*selecionar a soma das quantidades e o id produto dos itens que aparecem na intensdacompra, 
                agrupar pelo id e ordenar do mais vendido pro menos vendido
                */
                $vendidos=pg_query($conecta,$sql);
                $n=pg_num_rows($vendidos);

                for($i=1;$i<=$n;$i++){
                    $produto=pg_fetch_array($vendidos);
                    $sql="SELECT * FROM produto WHERE idproduto=$produto[idproduto]";
                    $linha=pg_fetch_array(pg_query($conecta,$sql));
                    if($i==1){
                        echo "<tr align='center' style='background-color:rgb(254, 186, 255)'>";
                    }
                    else echo "<tr align='center'>";

                    echo "<td><img width='200px' src='img/$linha[imagem]'></td>";
                    echo "<td>$linha[nome]</td>";
                    echo "<td>$produto[0]</td>";
                    echo "<td>".($produto[0] * $linha['preco'])."</td>";
                    echo "<td>".number_format(($produto[0] / $ncompras[0])*100,0,',','.') ."</td>";


                    echo "</tr>";
                }

                echo "</table>";
            ?>

        </div>




        <div id="estatisticas-categorias" style="display:none;">
            <font size="4">
                <center>
                    <br><br><b>&nbsp;&nbsp;Categorias mais vendidas</b><br>
                    <a onclick="escondeCategorias()">Esconder</a>
                </center>
            </font>
            <a></a>

            <?php
                $sql="SELECT SUM(qtd), idproduto FROM itensdacompra GROUP BY qtd
                ORDER BY SUM(qtd) DESC;";

                $sql="SELECT idproduto, COUNT(idproduto) AS qtd FROM itensdacompra GROUP BY idproduto having COUNT(idproduto) > 1 order by desc ";
                
                $vendidos=pg_query($conecta,$sql);
                

            ?>


        </div>

        <br><br>
        <div class="rodape">
            <header>
                <div>
                    <nav>
                        <ul class="menusubs">
                            <font face="arial">
                                <li><a href="index_adm.php">Home</a></li>
                                <li><a href="#">Cliente</a>
                                    <!-- <ul>
                                        <li><a href="cad_user_adm.php">Cadastro</a></li>
                                        <li><a href="altera_exclui_prod_adm.php">Alteração</a></li>
                                        <li><a href="dados.php">Pesquisa</a></li>
                                    </ul>-->
                                </li>
                                <li><a href="#">Produto</a>
                                    <!-- <ul>
                                        <li><a href="cad_prod.php">Cadastro</a></li>
                                        <li><a href="exclui_user.php">Exclusão</a></li>
                                        <li><a href="produtos_adm.php">Pesquisa</a></li>
                                    </ul>-->
                                </li>
                                <li><a href="#">Vendas</a>
                                    <!--  <ul>
                                        <li><a href="history_compras.php">Pesquisa</a></li>
                                        <li><a href="estatisticas.php">Estatísticas</a></li>
                                    </ul>-->
                                </li>
                            </font>
                            <br><br><br><br><br><br><br><br><br>
                        </ul>
                    </nav>
                </div>
            </header>
        </div>
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <a href="cad_user_adm.php">Cadastro</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="cad_prod.php">Cadastro</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="history_compras.php">Pesquisa</a>

        <br><br>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="altera_exclui_prod_adm.php">Alteração</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


        <a href="exclui_user.php">Exclusão</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="estatisticas.php">Estatísticas</a>

        <br><br>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="dados.php">Pesquisa</a>

        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <a href="produtos_adm.php">Pesquisa</a>

        <br>
        <font face="arial" size="3">
            <div align="center">

                <hr class="hr">

                <img src="img/logo.png" height="49px" width="150px">

                <br> <br>

                <b> Agnes Almeida &nbsp;
                    | &nbsp; Augusto Amaral &nbsp;
                    | &nbsp; Isabela Navarro &nbsp;
                    | &nbsp; Sofia Rosa &nbsp;
                    | &nbsp; Stephanie Antonelli &nbsp;
                    | &nbsp; Yasmin Sousa </b>
            </div>
        </font>
        <br>

        <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">
    </div>
    <!--DIV MAE-->
</body>

</html>