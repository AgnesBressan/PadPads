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
                        <font face="arial" size="5">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="produtos.php">Produtos</a></li>
                                <li><a href="sobre.php">Sobre</a></li>
                                <li><a href="cad_user.php">Cadastro</a></li>
                            </font>
                        </ul>
                    </nav>
                    </center>
                </div>
                <div id="branca">
                    <img style="padding-left: 45px;"src="img/logo.png" width="300px;">
                    <div style="padding-top:30px; padding-left:20px;"><!--div da pesquisa-->
                        <form method="post" action="pesquisa_prod_lista.php"> 
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

                        <a><a href = "carrinho.php"><img src="img/carrinho.png" width="50px" height="50px"></a>                   

              
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
                    <span style="padding-top:30px; padding-left:15px"><center><?php
                        if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                        else echo "Bem vindo, cliente <br><b>$nome_session</b>"
                    ?></center></span>

                </div><!-- AQUI FECHA A DIV BRANCA!!!-->
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
                <center>
                <h1>Histórico de Compras de <?php echo $_SESSION['nome'];?></h1>
                <!-- <h3>Usuário: <?php echo $_SESSION['nome'];?></h3> -->
                <?php
                    include "conexao.php";
                    $id=$_SESSION['id'];
                    $sql="SELECT * FROM compra WHERE idcliente=$id ORDER BY idcompra DESC"; //procurar todas as compras feitas pelo user
                    $resultado=pg_query($conecta,$sql);
                    $num=pg_affected_rows($resultado);

                    if($num<=0){//se não for encontrada nenhuma...
                        echo "<br>Não há compras cadastradas. <br><br><a class='btn-user' href='produtos.php'>Comprar</a><br><br>";   
                        exit;
                    }

                    for($i=1;$i<=$num;$i++)
                    {
                        $linha=pg_fetch_array($resultado);
                        $idc=$linha['idcompra'];
                        $total=$linha['valor_final'];
                        echo "<table cellspacing='0'>";
                        echo"<br><br><tr class='tr0'><td colspan='4' align='center'><font class='titab'><b>ID da Compra:</b> ".$idc."</font></td>";
                        
                        echo "<tr class='tr1'><th align='justify' width='300px'>&nbsp;&nbsp;&nbsp;Item</th><th>Preço</th><th>Quantidade</th><th>Valor total</th></tr>";
                        $sql="SELECT produto.nome, produto.preco, itensdacompra.qtd 
                        FROM produto INNER JOIN itensdacompra 
                        ON itensdacompra.idproduto=produto.idproduto 
                        WHERE itensdacompra.idcompra=$idc"; //pesquisando os itens de cada compra
                        $r=pg_query($conecta,$sql);
                        $n=pg_affected_rows($r);
                        for($j=1;$j<=$n;$j++)
                        {
                            if($j%2==0)
                            {
                                echo"<tr class='tr2'>";
                            }
                            else
                            {
                                echo"<tr class='tr3'>";
                            }
                            $l=pg_fetch_array($r);
                            $np=$l['nome'];
                            $pp=$l['preco'];
                            $qp=$l['qtd'];
                            $vp= $pp*$qp;
                            //$pt=$l['compra.valor_final'];
                            echo "<td align='left'>&nbsp;&nbsp;&nbsp;$np</td>";
                            echo "<td align='center'>R$".number_format($vp,2,",",".")."</td>";
                            echo "<td align='center'>$qp</td>";
                            echo "<td align='center'>R$".number_format($vp,2,",",".")."</td>";
                            echo "</tr>";
                        }//fim do for (resultado itens das compras)
                        echo "<tr border='none' height='35px'><td colspan='4' align='right'><b>Soma final:</b> R$ ".$total."</td><br></tr>";
                        echo "</table>";
                    }//fim do for (resultado de todas as compras feitas)
                ?>
                </center>
                <br><br>
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
                
            </div><!-- AQUI FECHA A DIV MÃE!!!-->
    </body>

</html>


