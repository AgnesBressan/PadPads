<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 


<?php 
    session_start();
    if(isset($_SESSION['nome']))
    {
        $nome_session = $_SESSION['nome'];
        $idcliente=$_SESSION['id'];
        if($_SESSION['status']=='c'){
            $adm=false;
        } 
        else $adm=true;
    }
    else{
        $nome_session="Convidado";
        $adm=false;
    }

    if(!isset($_SESSION['carrinho'])){
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=carrinho.php'>";
        return;
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

            <div style="padding-top: 17px; padding-left:15px;">

                <a><a href="carrinho.php"><img src="img/carrinho.png" width="50px" height="50px"></a>


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
            <span style="padding-top:30px; padding-left:20px">
                <center><?php
                        if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                        else echo "Bem vindo, cliente <br><b>$nome_session</b>"
                    ?></center>
            </span>

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
        </header><br>
        <center>
        <br><br>
        <img src="img/img_titulos/titulo_carrinho_finaliz.png" height="40px" width="300px">
        <br><br><br>
        </center>

<?php

            //session_start();
            include "conexao.php";
            $totalC=0;

            //criar a venda
            $sql="INSERT INTO compra (idcompra,idcliente) VALUES (DEFAULT, $idcliente)";
            $res=pg_query($conecta,$sql);
            if(pg_affected_rows($res)<=0){
                echo"erro na inclusao da compra";
                return;
            }
            
            echo "<table cellspacing='0'";
            echo "<tr align='center' style='padding:10px;'>
            <th width='105px' style='background-color:lightgray;'></th>
            <th align='justify'style='background-color:lightgray;'>&nbsp;&nbsp;Item</th>
            <th style='background-color:lightgray;'>Preço</th>
            <th style='background-color:lightgray;'>Quantidade</th>
            <th style='background-color:lightgray;'>Subtotal</th></tr>";

            foreach($_SESSION['carrinho'] as $idproduto => $qtd)
            { // Início do FOREACH
                
                $sql = "SELECT * FROM produto WHERE idproduto=$idproduto AND excluido IS FALSE AND qtde>=$qtd";
                $res = pg_query($conecta, $sql);
                /*if(pg_affected_rows($res)==0) echo "nao achou!";*/
                $linha = pg_fetch_array($res);
                $q=$linha['qtde'];
                $preco = $linha['preco'];
                $p = number_format($preco, 2, ',', '.');
                $nome=$linha['nome'];
                echo "<tr style='padding:10px'>";
                echo "<td><img style='margin-left:5px;' width='100px'src='img/".$linha['imagem']."'></td>";
                echo "<td align='justify'>&nbsp;&nbsp;$nome</td>";
                echo "<td align='center'>R$ $p</td>";
                echo "<td align='center'>$qtd</td>";
                echo "<td align='center'>".number_format($preco*$qtd, 2, ',', '.')."</td>";
                echo "</tr>";
                $sub=$preco*$qtd;
                $totalC += $preco*$qtd;
                $sql = "INSERT INTO itensdacompra VALUES (CURRVAL('compra_idcompra_seq'),".$idproduto.",".$qtd.",".$sub.");";
                $res = pg_query($conecta, $sql);
                /* if(pg_affected_rows($res)<=0){
                        echo"erro na inclusao dos itens";
                        return;
                }*/
                $sql= "UPDATE produto SET qtde=".($q-$qtd)."WHERE idproduto=$idproduto";
                $res=pg_query($conecta,$sql);
            
            }// Término do FOREACH
            echo "<tr style='padding:10px; background-color:lightgray;'><td><b>Total:</b></td><td align='right' colspan='4'>".number_format($totalC, 2, ',', '.')."</td></tr>"; 
            echo "</table><br><br>"; 
                
            //update tabela compra com valor final da compra
            $sql="UPDATE compra SET valor_final=$totalC, datacompra=NOW() WHERE idcompra=CURRVAL('compra_idcompra_seq')";
            $res=pg_query($conecta,$sql);
            if(pg_affected_rows($res)<=0){
                echo"erro na atualizacao do preco";
                return;
            }
            else{
                echo "<center><a href='produtos.php' class='btn_geral btn_login'>Comprar novamente</a></center><br><br>";
            }

?>

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
    </div>

    <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">

    </div>
</body>

</html>
<?php
    $_SESSION['enviar']='finaliza';
    require "emails/enviagmail.php";
?>