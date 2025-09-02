
<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 

<?php 
/*
    O sistema de paginação foi retirado de https://www.devmedia.com.br/paginacao-em-php/21972
    e adaptado para PostgreSQL pelo grupo;
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
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <a name="topo"></a>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Produtos</title>
    <script type="text/javascript" src="script/jquery-3.5.1.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
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
        <?php
        if($adm==false)
        echo "<script>document.getElementById('popup').style.display='block';
                           document.getElementById('div').style.filter='blur(10px)';</script>";
        else echo "<script>document.getElementById('popup').style.display='none';
                    document.getElementById('div').style.filter='none';</script>";
    ?>
        <div id="barrafixa" align="center">
            <!--<nav>
                <ul>
                    <font face="arial">
                        <li><a href="index_adm.php">Home</a></li>
                        <li><a href="produtos_adm.php">Produtos</a></li>
                        <li><a href="sobre_adm.php">Sobre</a></li>
                        <li><a href="cad_user_adm.php">Cadastro</a></li>
                    </font>
                </ul>
            </nav>-->
        </div>
        <div id="branca">
            <img style="padding-left: 45px;" src="img/logo.png" width="300px;">
            <div style="padding-top:30px; padding-left:20px;">
                <!-- <form method="post" action="pesquisa_prod_lista.php">
                    <select name="tipo_pesquisa">
                        <option value="idproduto">Id produto</option>
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="categoria">Categoria</option>
                        <option value="cor">Cor</option>
                    </select>
                    <input type="text" name="pesquisa" placeholder="Pesquise o produto" required>
                    &nbsp;&nbsp;
                    <input type="submit" value="Buscar">
                </form> -->
            </div>
            <!-- <div style="padding-top: 17px; padding-left:400px;">
                <img src="img/carrinho.png" width="50px" height="50px">
                <img src="img/usuario.png" width="50px" height="50px">
            </div> -->
            <div style="padding-top: 17px; padding-left:400px;">
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
            <span style="padding-top:30px; padding-left:20px">
                <center><?php
                if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                else echo "Bem vindo, cliente <br><b>$nome_session</b>"
            ?></center>
            </span>
        </div>
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

        <br><br>
        <center>

            <img src="img/img_titulos/titulo_prod.png" height="30px" width="150px">

            <br><br>

            <form method="post" action="pesquisa_prod_lista_adm.php">
                <select name="tipo_pesquisa">
                    <option value="nome">Nome</option>
                    <option value="modelo">Modelo</option>
                    <option value="cor">Cor</option>
                    <option value="categoria">Categoria</option>
                </select>
                <input type="text" class="caixinha" name="pesquisa" placeholder="Digite a pesquisa" required>
                &nbsp;&nbsp;
                <input type="submit" value="Buscar">
            </form>
        </center>

        <br><br>
        <div class='container'>
            <?php
            include "conexao.php";
            function getCategoria($id){
                GLOBAL $conecta;
                $sql="SELECT * FROM categoria WHERE idcategoria=$id";
                $linha=pg_fetch_array(pg_query($conecta,$sql));
                return $linha['nome_categoria'];
            }

            $busca = "SELECT * FROM produto WHERE excluido=false ORDER BY idcategoria ASC, modelo DESC ";

            $total_reg = 12; //total por página
            if(isset($_GET['pagina'])){
                $pagina=$_GET['pagina'];
            }
            
            //pc é a página atual
            if (!isset($pagina)) 
            {
                $pc = "1";
            } 
            else 
            {
                $pc = $pagina;
            }

            $inicio = $pc - 1; //valor inicial
            $inicio = $inicio * $total_reg;
            $limite = pg_query($conecta,$busca."LIMIT $total_reg OFFSET $inicio");
            $todos = pg_query($busca);
            $tr = pg_num_rows($todos); // verifica o número total de registros
            $tp = $tr / $total_reg; // verifica o número total de páginas

            while ($dados = pg_fetch_array($limite)) 
            {
                echo "<div class='sub'>
                        <center><div class='fundo-imagem'><img height='130px' src='img/".$dados['imagem']."' height='130px'></div></center>
                        <div style='border: 3px solid #999696;border-top:none; padding:5px; width:100%'><br><b>Nome:</b> ".$dados['nome']."<br>
                        <b>Modelo</b> ".$dados['modelo']."<br>
                        <b>Cor</b> ".$dados['cor']."<br>
                        <b>Categoria:</b> ".getCategoria($dados['idcategoria'])."<br>";
                        echo"<b>Preço: </b> R$".number_format($dados['preco'],2,',','.');
                    echo "</div></div>";            
	        }
            echo "</div>";
            // agora vamos criar os botÃµes "Anterior e próximo"

            $anterior = $pc -1;
            $proximo = $pc +1;
            
            echo "<center><br>";
            if ($pc>1) 
            {
                echo " <a class='paginacao' href='?pagina=$anterior'>Anterior</a> &nbsp;&nbsp;&nbsp;&nbsp;";
                
            }
            for($i=1;$i<=$tp+1;$i++){
                if($i==$pc) echo "<a class='paginacao2' href='?pagina=$i'>$i</a>&nbsp;&nbsp;&nbsp;&nbsp;";
                else echo "<a class='paginacao' href='?pagina=$i'>$i</a>&nbsp;&nbsp;&nbsp;&nbsp;";
            }
            if ($pc<$tp) 
            {
                echo " <a class='paginacao' href='?pagina=$proximo'>Próximo</a>";
            }
            echo "<br><br></center>";
        ?>


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

            <a href="exclui_cliente.php">Exclusão</a>


            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


            <a href="altera_exclui_prod.php">Alteração</a>

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
                </div>
            </font>
            <br>

            <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">

        </div>
</body>

</html>
