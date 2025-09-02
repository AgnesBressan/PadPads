<?php
/*
Extraído de:
http://www.davidchc.com.br/video-aula/php/carrinho-de-compras-com-php/
vídeo aula de:https://www.youtube.com/watch?v=CBzfcl-Qk1c

Adaptado por Profa. Ariane Scarelli para banco de dados PostgreSQL (ago/2016)
Adaptado para o projeto pelo grupo (ago/2020)
*/
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
    if(!isset($_SESSION['id']))header("Location:login.php");
    
    $idcliente=$_SESSION['id'];
    include "conexao.php"; 

    function exibe(){
        GLOBAL $conecta;
        GLOBAL $idcliente;
        $total=0.00;
        echo "<table cellspacing='0' width='950px'>".
        "<tr style='background-color:lightgray; padding:10px' align='center'>
            <th width='105px'></th> 
            <th>Produto</th> 
            <th>Preço</th> 
            <th>Quantidade</th> 
            <th>Subtotal</th> 
            <th width='100px'>Remover</th></tr>";
        //abre a tabela e cria a linha de titulos  
        
        foreach($_SESSION['carrinho'] as $idproduto => $qtd)
        {
            $sql = "SELECT * FROM produto WHERE idproduto=$idproduto AND excluido IS FALSE";
            $res = pg_query($conecta, $sql);
            $afetadas = pg_affected_rows($res);
            if($afetadas>0)
            {
                $linha = pg_fetch_array($res);
                $nome = $linha['nome'];
                $preco = $linha['preco'];
                $sub = $preco * $qtd;
                $total += $sub;
                $preco = number_format($preco, 2, ',', '.');
                $sub = number_format($sub, 2, ',', '.');
                
                echo "<tr style='height: 40px;'>".
                "<td><img style='margin-left:5px;' width='100px'src='img/".$linha['imagem']."'></td>". 
                "<td width='200px'>&nbsp;&nbsp;$nome</td>".//celula - nome
                "<td width='100px' align='center'>R$ $preco</td>". //celula - preco
                
                "<td align='center' width='100px'>
                    <a href='?acao=add&idproduto=$idproduto'>
                    <img src='img/mais.png' width='10px'></a> <span id='qtd'>&nbsp&nbsp $qtd &nbsp&nbsp</span> 
                    <a href='?acao=dwn&idproduto=$idproduto'>
                    <img src='img/menos.png' width='10px'></a>
                </td>".//celula - quantidade 

                "<td width='100px' align='center'>R$ $sub</td>".//celula - subtotal
                
                "<td><center><a href='carrinho.php?acao=del&idproduto=$idproduto' style='background-color: lightgray; padding: 2px; color: #000; text-decoration:none;'>Remover</a>
                </center></td></tr>";//botão de remover
            }
            
        }// Término do FOREACH
        $total = number_format($total, 2, ',', '.');

        echo "<tr style='background-color:lightgray; padding:10px;'><td><b>&nbsp;&nbsp;Total:</b></td>
            <td colspan='5' align='right'><b>&nbsp;&nbsp;R$ ".$total."&nbsp;&nbsp;</b></td></tr><br><br>";
        echo "</table>";
        if(count($_SESSION['carrinho'])>0)

        echo "<br><br>; <div align='center'><a href='finaliza.php'><button type='submit' value='limpar' name='enviar' class='btn_geral btn_login'>Finalizar Compra</button></a>
         <br><br><a href='produtos.php'><button type='submit' value='limpar' name='enviar' class='btn_geral btn_login'>Continuar Comprando</button></a></div>";

    }
    function getQuantidade($idproduto){
        GLOBAL $conecta;
        $sql = "SELECT * FROM produto WHERE idproduto=$idproduto";
        $linha=pg_fetch_array(pg_query($conecta,$sql));
        //echo "<span style='color:green;'>".$linha['qtde']."</span>";
        return $linha['qtde'];
    }

    function acao($acao,$idproduto){
        GLOBAL $conecta;
        switch($acao){
            case 'add':
                if(!isset($_SESSION['carrinho'][$idproduto])){ //ele verifica se há um espaço do array com esse produto
                    $_SESSION['carrinho'][$idproduto] = 1;//se não houver, ele o define com a quantidade do produto
                }else{
                    $q=$_SESSION['carrinho'][$idproduto];
                    $qp=getQuantidade($idproduto);
                    // echo $qp;
                    if($q == $qp){
                        echo"<div class='alert'>Não se pode comprar mais do que há disponível em estoque!
                             <br>Estão disponíveis deste produto:".$qp."<br><br><a href='carrinho.php'>Ok</a><br><br></div>";
                    }
                    else
                    $_SESSION['carrinho'][$idproduto] += 1;//se houver ele soma um na quantidade ja definida
                }
                break;
            case 'del':
                unset($_SESSION['carrinho'][$idproduto]);
                header("location:./carrinho.php");
                break;
            case 'dwn':
                $_SESSION['carrinho'][$idproduto]-=1;//diminui um na quantidade
                if($_SESSION['carrinho'][$idproduto]==0)
                    unset($_SESSION['carrinho'][$idproduto]);
                header("location:./carrinho.php");
                break;
        }
    }

    //main
    
    if(!isset($_SESSION['carrinho']))
        $_SESSION['carrinho']=array();
    
    if(isset($_GET['acao']))
    {
        $idproduto = intval($_GET['idproduto']);
        $acao=$_GET['acao'];
        acao($acao,$idproduto);
    }


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <a name="topo"></a>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Carrinho de compras</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div id=div>
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
                    <input type="text" name="pesquisa" placeholder="Pesquise o produto" required>
                    &nbsp;&nbsp;
                    <input type="submit" value="Buscar">
                </form>
            </div>

            <div style="padding-top: 17px; padding-left:10px;">

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
        </header>
        <center>
            <h1>Carrinho de compras</h1>
        </center>
        <?php
        
        if(count($_SESSION['carrinho'])==0){
            echo "<center><h4><u>Não há produtos no seu carrinho. </u></h4></center>"."<center><a class='btn-user' href='produtos.php'>Comprar</a></center><br>";
            //return;
        }
        else exibe();
        
        
    ?>
        <!-- <p>ALO?</p> -->
        <br><br>
        <br><br>

        <!-- <br><br>   -->
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

    </div>
</body>

</html>