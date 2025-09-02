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
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Estatísticas de Venda</title>
    <script type="text/javascript" src="script/chartjs/dist/Chart.js"></script>
    <script type="text/javascript" src="script/chartjs/dist/Chart.min.js"></script>
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
                                <li><a href="exclui_cliente.php">Exclusão</a></li>
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
        <br><br>
        <img src="img/img_titulos/titulo_estatisticas.png" height="45px" width="330px">
        <br><br>
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
                    echo "<br><b>Clientes ativos: </b>$nclientesa[0] (".number_format($pativa,0,',','.')."%)";
                    $_SESSION['estatisticas']['nclientesa']=$nclientesa[0];
                    $_SESSION['estatisticas']['pativa']=$pativa;

                    $sql="SELECT count(*) FROM compra";//quantas compras foram feitas
                    $ncompras=pg_fetch_array(pg_query($conecta,$sql));
                    $_SESSION['estatisticas']['ncompras']=$ncompras[0];
                    $mediacc=$ncompras[0]/$nclientes[0];
                    echo "<br><b>Média de compras por cliente:</b>".number_format($mediacc,2,',','.');
                    $_SESSION['estatisticas']['mediacc']=number_format($mediacc,0,',','.');

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
                    echo "<br><br><a href='estatisticas/pdf_produtos.php' target='_blank'>Gerar PDF</a>";
                    echo "</div>";

                    echo "<div>";
                    echo "<b>Categorias mais vendidas</b><br>";
                    echo "Listagem das categorias das mais procuradas às menos procuradas";   
                    echo "<br><br><a href='#estatisticas-categorias' onclick='mostraCategorias()'>Visualizar</a>"; 
                    echo "<br><br><a href='estatisticas/pdf_categorias.php' target='_blank'>Gerar PDF</a>";
                    echo "</div>";

                    echo "<div style='margin-left:-20px; margin-top:20px;'>";
                    echo "<b>Total de vendas por cliente</b><br>";
                    echo "Listagem dos clientes e de sua participação nas vendas da empresa";   
                    echo "<br><br><a href='#estatisticas-clientes' onclick='mostraClientes()'>Visualizar</a>"; 
                    echo "<br><br><a href='estatisticas/pdf_clientes.php' target='_blank'>Gerar PDF</a>";
                    echo "</div>";

                    echo "<div style='margin-top:20px;'>";
                    echo "<b>Faturamento do período</b><br>";
                    echo "Visualização de dados sobre as vendas em determinado período";   
                    echo "<br><br><a href='#estatisticas-periodo' onclick='mostraPeriodo()'>Visualizar</a>"; 
                    // echo "<br><br><a href='estatisticas/pdf_periodo.php' target='_blank'>Gerar PDF</a>";
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

        function mostraClientes() {
            document.getElementById('estatisticas-clientes').style.display = 'block';
        }

        function escondeClientes() {
            document.getElementById('estatisticas-clientes').style.display = 'none';
        }
        function mostraPeriodo() {
            document.getElementById('estatisticas-periodo').style.display = 'block';
        }

        function escondePeriodo() {
            document.getElementById('estatisticas-periodo').style.display = 'none';
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
                echo "<tr align='center' style='background-color:lightgray'><th width='300px'>Imagem</th><th width='300px'>Produto</th>
                <th width='150px'>Total de vendas</th><th width='150px'>Faturado</th>
                <th width='150px'>%</th></tr>";

                $sql="SELECT SUM(qtd), idproduto FROM itensdacompra GROUP BY idproduto
                ORDER BY SUM(qtd) DESC;";
                /*selecionar a soma das quantidades e o id produto dos itens que aparecem na intensdacompra, 
                agrupar pelo id e ordenar do mais vendido pro menos vendido
                */
                $vendidos=pg_query($conecta,$sql);
                $n=pg_num_rows($vendidos);
                $_SESSION['estt_produtos']=array();
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
                    echo "<td>".number_format($produto[0] * $linha['preco'],2,',','.')."</td>";
                    echo "<td>".number_format(($produto[0] / $ncompras[0])*100,0,',','.') ."</td>";
                    $_SESSION['estt_produtos'][$linha['idproduto']]=$produto[0];

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
                $sql="SELECT idproduto, COUNT(idproduto) AS qtd FROM itensdacompra GROUP BY idproduto order by qtd;";
                $resultado=pg_query($conecta,$sql);
                $n=pg_num_rows($resultado);

                $categorias=array();
                for ($i=1; $i<=$n ; $i++) {
                    $produto=pg_fetch_array($resultado);//id do produto da compra

                    $sql="SELECT idcategoria FROM produto WHERE idproduto=$produto[idproduto]";
                    $linha=pg_fetch_array(pg_query($conecta,$sql));//id da categoria do produto
                    //echo $linha['idcategoria'];

                    $sql="SELECT nome_categoria FROM categoria WHERE idcategoria=$linha[idcategoria]";
                    $categoria=pg_fetch_array(pg_query($conecta,$sql));
                    $catatual=$categoria['nome_categoria'];//nome da categoria do produto
                    //echo $catatual;

                    if(isset($categorias[$catatual]))$categorias[$catatual]+=$produto['qtd'];
                    else $categorias[$catatual]=$produto['qtd'];
                }//rechear a $categorias
                arsort($categorias);
                $_SESSION['estt_categorias']=$categorias;

                echo "<table>";
                echo "<tr align='center' style='background-color:lightgray'><th width='300px'>Nome da Categoria</th>
                <th width='150px'>Id da categoria</th><th width='150px'>Quantidade</th></tr>";

                $i=0;
                $labels=[];
                $data=[];
                foreach ($categorias as $cat => $qtd) {
                    array_push($labels,$cat);
                    array_push($data,$qtd);

                    $sql="SELECT * FROM categoria WHERE nome_categoria='$cat'";
                    $linha=pg_fetch_array(pg_query($conecta,$sql));
                    if($i==0){
                        echo "<tr align='center' style='background-color:rgb(254, 186, 255)'>";
                    }
                    else echo "<tr align='center'>";

                    $percent=($qtd/$ncompras[0])*100;
                    $p=number_format($percent,0,',','.');

                    echo "<td>$linha[nome_categoria]</td>";
                    echo "<td>$linha[idcategoria]</td>";
                    echo "<td>".$p."%</td>"; 
                    echo "</tr>";
                    $i++;
                }
                

                echo "</table>";
            ?>
            <br><br><center><h4>Gráfico:</h4></center>
            <canvas id="myChart" width="300px" height="300px"></canvas>
  
            <script>
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo json_encode($labels)?>,
                        datasets: [{
                            label: 'Número de Compras',
                            data: <?php echo json_encode($data)?>,
                            backgroundColor: [
                                'rgba(191, 0, 255, 0.8)',
                                'rgba(54, 162, 235, 0.8)',
                                'rgba(255, 206, 86, 0.8)',
                                'rgba(75, 192, 114, 0.8)',
                                'rgba(153, 102, 255, 0.8)',
                                'rgba(255, 159, 64, 0.8)',
                                'rgba(255, 0, 0, 0.8)',
                                'rgba(0, 255, 8,0.8)',
                                'rgba(21, 0, 255, 0.8)',
                                'rgba(255, 99, 132, 0.8)',
                                'rgba(0, 255, 183, 0.8)',
                            ],
                            borderColor: 'rgba(0, 0, 0, 1)',
                            borderWidth: 0.5
                        }]
                    },
                    options: {
                        responsive:true,
                        maintainAspectRatio: false
                    }
                });
            </script>
        </div>

        <div id="estatisticas-clientes" style="display:none">
        <font size="4">
                <center>
                    <br><br><b>&nbsp;&nbsp;Vendas e Clientes</b><br>
                    <a onclick="escondeClientes()">Esconder</a>
                </center>
        </font>

        <?php
            $sql="SELECT * FROM cliente ORDER BY idcliente";
            $resultado=pg_query($conecta,$sql);
            $n=pg_num_rows($resultado);

            echo "<table>";
            echo "<tr align='center' style='background-color:lightgray'>
            <th width='50px'>Id Cliente</th>
            <th width='300px'>Nome Cliente</th>
            <th width='100px'>Número de Vendas</th>
            <th width='150px'>Participação (em reais)</th></tr>";
            
            $_SESSION['estt_clientes']=array();

            for ($i=1; $i <= $n; $i++) { 
                $cliente=pg_fetch_array($resultado);
                $id_cli=$cliente['idcliente'];

                $sql="SELECT * FROM compra WHERE idcliente=$id_cli";
                $num=pg_num_rows(pg_query($conecta,$sql));
                $participacao=0;
                for ($j=0; $j < $num; $j++) { 
                    $compra=pg_fetch_array(pg_query($conecta,$sql));
                    $participacao+=$compra['valor_final'];
                }

                $participacao=number_format($participacao,2,',','.');

                echo "<tr align='center'>";
                echo "<td>$id_cli</td>";
                echo "<td>$cliente[nome] $cliente[sobrenome]</td>";
                echo "<td>$num</td>";
                echo "<td>R$ $participacao</td>"; 
                echo "</tr>";

                $_SESSION['estt_clientes'][$id_cli]=$num;
            }

            echo "</table>";
        ?>
        </div>
        
        <div id="estatisticas-periodo" style="display:<?php if(isset($_GET[mes]))echo 'block;'; else echo 'none'?>">
        <font size="4">
            <center>
                <br><br><b>&nbsp;&nbsp;Faturamento por período</b><br>
                <a onclick="escondePeriodo()">Esconder</a>
            </center>
        </font>
        <?php
            $meses=array(
                1 => "Janeiro",
                2 => "Fevereiro",
                3 => "Março",
                4 => "Abril",
                5 => "Maio",
                6 => "Junho",
                7 => "Julho",
                8 => "Agosto",
                9 => "Setembro",
                10 => "Outubro",
                11 => "Novembro",
                12 => "Dezembro"
            );


            $sql="SELECT DISTINCT DATE_PART('month',datacompra) as mes FROM compra ORDER BY mes";
            $resultado=pg_query($conecta,$sql);//pegar todos os meses na tabela
            $n=pg_num_rows($resultado);

            echo "<form action='estatisticas.php#estatisticas-periodo' method='get'>
            <br><center>Mês:&nbsp;
            <select name='mes'>";

            for ($i=0; $i < $n; $i++) { 
                $l=pg_fetch_array($resultado);
                $mes=$l[0];

                if(isset($_GET['mes']) && $_GET['mes']==$mes){
                    echo "<option value='$mes' selected>$meses[$mes]</option>";
                }
                else echo "<option value='$mes'>$meses[$mes]</option>";
            }

            echo "</select>
            &nbsp;<input type='submit' value='Ver Mês'>";
            echo"</center>
            </form>";

            if(isset($_GET['mes'])){
                $mes = $_GET['mes'];
                $sql="SELECT DISTINCT DATE_PART('day',datacompra) as dia FROM compra 
                      WHERE DATE_PART('month',datacompra)=$mes ORDER BY dia";
                $resultado=pg_query($conecta,$sql);
                $n=pg_num_rows($resultado);

                echo "<br><table>";
                echo "<tr align='center' style='background-color:lightgray'>
                <th width='100px'>Dia do Mês</th>
                <th width='100px'>Faturamento</th>
                <th width='100px'>Porcentagem (sobre todo o total)</th>
                </tr>";
                $total_mes=0;
                $labels2=[];
                $data2=[];
                for ($i=0; $i <$n; $i++)
                {
                    $linha=pg_fetch_array($resultado);
                    array_push($labels2,$linha[0].'/'.$mes);
                    //echo "Dia do mes $mes: $linha[0] <br>";
                    $sql="SELECT * FROM compra WHERE DATE_PART('day',datacompra)=$linha[0] 
                          AND DATE_PART('month',datacompra)=$mes";
                    $r=pg_query($conecta,$sql);
                    $ncompras=pg_num_rows($r);
                    $total=0;
                    
                    for ($j=0; $j < $ncompras; $j++) { 
                        $compra=pg_fetch_array($r);
                        $total=$total+$compra['valor_final'];
                        //echo "Total após essa compra: $total<br><br>";
                    }
                    array_push($data2,round($total,2));
                    $total_mes+=$total;
                    $t=number_format($total,2,',','.');
                    $percent=($total/$compras[0])*100;
                    $p=number_format($percent,0,',','.');

                    echo "<tr align='center' height='30px'>
                    <td>$linha[0] / $meses[$mes]</td>
                    <td>R$ $t</td>
                    <td>$p%</td>
                    </tr>";
                }
                $tm=number_format($total_mes,2,',','.');
                $percent_mes=($total_mes/$compras[0])*100;
                $pm=number_format($percent_mes,0,',','.');

                echo "<tr><td colspan='3' style='color:white'>.</td></tr>";

                echo "<tr height='30px' style='background-color:rgb(236, 153, 255);'>
                <td><b>&nbsp;Resumo de $meses[$mes]</b></td>
                <td align='center'>R$ $tm</td>
                <td align='center'>$pm%</td>
                </tr>";
                echo "</table>";
                echo "<br><br>";
                echo "<br><br><center><h4>Faturamento do Mês $meses[$mes]</h4></center>";
                echo "<div style='height:400px'><canvas id='myLineChart' width='100px' height='100px'></canvas></div>";
            }
        ?>
        
        
        <script>
            var ctx2 = document.getElementById('myLineChart').getContext('2d');
            var myLineChart = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($labels2)?>,
                    datasets: [{
                        label: 'Faturamento',
                        fill:false,
                        borderColor: 'rgba(0,0,0,0.5)',
                        data: <?php echo json_encode($data2)?>,
                    }]
                },
                options: {
                    responsive:true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            type: 'linear',
                            ticks: {
                                beginAtZero: true,
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>
        
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


        <a href="exclui_cliente.php">Exclusão</a>

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