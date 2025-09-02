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
    function mudaEstado() {
        if (document.getElementById('caixa_filtro').style.display == 'block') {
            document.getElementById('caixa_filtro').style.display = 'none';
        } else
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
                <!-- <form method="post" action="pesquisa_prod_lista.php">
                    <select name="tipo_pesquisa">
                        <option value="idproduto">Id produto</option>
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="categoria">Categoria</option>
                        <option value="cor">Cor</option>
                    </select>
                    <input type="text" name="pesquisa" placeholder="Digite a pesquisa" required>
                    &nbsp;&nbsp;
                    <input type="submit" value="Buscar">
                </form> -->
            </div>
            <!-- <div style="padding-top: 17px; padding-left:400px;">
                <img src="img/carrinho.png" width="50px" height="50px">
                <img src="img/usuario.png" width="50px" height="50px">
            </div> -->
            <div style="padding-top: 17px; padding-left:350px;">

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
        <center>
            <br>
            <font size="6"><b>
                <?php
                    if(isset($_GET['acao'])&&$_GET['acao']=='filtro') {
                        echo "Produtos Filtrados";
                    }
                    else {
                        echo "Todos os produtos";
                    }
                ?>
            </b></font>
            <a class="linkFiltro" onclick="mudaEstado('caixa_filtro')"><br>
                <?php
                    if(isset($_GET['acao'])&&$_GET['acao']=='filtro') {
                        echo "Filtrar Novamente";
                    }
                    else {
                        echo "Filtrar";
                    }
                ?>
            </a>
            <!--------linha alterada: filtro ------------->
            <font face="arial">
                <form method="post" action="?acao=filtro">
                    <div id="caixa_filtro" style="display:none">
                        <div style="display: flex; flex-direction: row; width:45%;">
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <div style="text-align:left; width:50%; padding-left:20px;">
                                <center>Modelo:<br></center>
                                <input type="checkbox" name="model1">Tradicional<br>
                                <input type="checkbox" name="model2">Gamer<br>
                                <input type="checkbox" name="model3">Especial<br>
                            </div>
                            <div style="text-align:left; width:50%; padding-left:20px;">
                                <center>Preço<br></center>
                                <label>R$</label>
                                <input id="min" type="number" name="minimo" step="0.01" placeholder="Mín"
                                    style="width:50px; height:30px;" onchange="requireOther()">
                                <label> - R$</label>
                                <input id="max" type="number" name="maximo" step="0.01" placeholder="Max"
                                    style="width:50px; height:30px;" onchange="requireOther()">
                            </div>
                            &nbsp;&nbsp;
                        </div>
                        <input type="submit" value="Filtrar">
                    </div>

                </form>
            </font>


            <!--------linha alterada: filtro ------------->

            <!--PESQUISA-->
            <br><br>
            <form method="post" action="pesquisa_prod_lista.php">
                <font face="arial">
                    <select name="tipo_pesquisa">
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="cor">Cor</option>
                        <option value="categoria">Categoria</option>
                    </select>
                </font>
                <input type="text" class="caixinha" name="pesquisa" placeholder="Pesquise o produto" required>
                &nbsp;&nbsp;
                <input type="submit" value="Buscar">
            </form>
        </center>

        <br><br>
        <?php
            include "conexao.php";
            function getCategoria($id){
                GLOBAL $conecta;
                $sql="SELECT * FROM categoria WHERE idcategoria=$id";
                $linha=pg_fetch_array(pg_query($conecta,$sql));
                return $linha['nome_categoria'];
            }
            function filtrarResultados($where){
                GLOBAL $conecta;

                $sql="SELECT * FROM produto WHERE $where ORDER BY idproduto";
                $resultado=pg_query($conecta, $sql);
                $n=pg_num_rows($resultado);
                echo "<div class='container'>";
                for ($i=1; $i <=$n ; $i++) { 
                    $dados=pg_fetch_array($resultado);
                    echo "<div class='sub'>
                            <center><div class='fundo-imagem'><img height='130px' src='img/".$dados['imagem']."' height='130px'></div></center>
                            <div style='border: 3px solid #999696;border-top:none; padding:5px; width:100%'><br><b>Nome:</b> ".$dados['nome']."<br>
                            <b>Modelo</b> ".$dados['modelo']."<br>
                            <b>Cor</b> ".$dados['cor']."<br>
                            <b>Categoria</b> ".getCategoria($dados['idcategoria'])."<br>";
                            if($dados['qtde']>0) echo "<b>Preço: </b> R$ ".number_format($dados['preco'],2,',','.').
                            "<br><br><center><a class='btn-user' href='carrinho.php?acao=add&idproduto=".$dados['idproduto']."'>Adicionar ao Carrinho</a></center><br>";
                            else echo "<br><br><center><span style='color:red;'>Produto indisponível</span></center><br>";
                    echo "</div></div>";
                }
                echo "</div>";
            }

            if(!isset($_GET['acao'])){
                $busca = "SELECT * FROM produto ORDER BY idcategoria ASC, modelo DESC ";
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
                echo "<div class='container'>";
                while ($dados = pg_fetch_array($limite)) 
                {
                    echo "<div class='sub'>
                            <center><div class='fundo-imagem'><img height='130px' src='img/".$dados['imagem']."' height='130px'></div></center>
                            <div style='border: 3px solid #999696;border-top:none; padding:5px; width:100%'><br><b>Nome:</b> ".$dados['nome']."<br>
                            <b>Modelo</b> ".$dados['modelo']."<br>
                            <b>Cor</b> ".$dados['cor']."<br>
                            <b>Categoria</b> ".getCategoria($dados['idcategoria'])."<br>";
                            if($dados['qtde']>0) echo "<b>Preço: </b> R$ ".number_format($dados['preco'],2,',','.').
                            "<br><br><center><a class='btn-user' href='carrinho.php?acao=add&idproduto=".$dados['idproduto']."'>Adicionar ao Carrinho</a></center><br>";
                            else echo "<br><br><center><span style='color:red;'>Produto indisponível</span></center><br>";
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
            }
            else if($_GET['acao']=='filtro'){
                $preco=false;
                if($_POST['minimo'] < $_POST['maximo'])
                {
                    if(isset($_POST['minimo']) || isset($_POST['maximo'])){
                        $preco=true;
                        $min=$_POST['minimo'];
                        $max=$_POST['maximo'];
                        if($min=="")$min=0;
                        if($max=="")$max=0;
                    }//verifica se tem um preço para filtrar
                }
                if(isset($_POST['model1']) && $_POST['model1']=='on'){
                    if($preco==true)
                    $model1="modelo = 'Tradicional' AND preco>=$min AND preco <=$max";
                    else 
                    $model1 = "modelo = 'Tradicional'";
                    echo "<center><font size='5'><b>Mousepads Tradicionais</b></font></center>";
                    filtrarResultados($model1);
                }//mostra todos os com modelo Tradicional
                if(isset($_POST['model2']) && $_POST['model2']=='on'){
                    if($preco==true)
                    $model2="modelo = 'Gamer' AND preco>=$min AND preco <=$max";
                    else 
                    $model2 = "modelo = 'Gamer'";
                    echo "<center><font size='5'><b>Mousepads Gamers</b></font></center>";
                    filtrarResultados($model2);
                }//mostra todos os com modelo Gamer
                if(isset($_POST['model3']) && $_POST['model3']=='on'){
                    if($preco==true)
                    $model3="modelo = 'Especial' AND preco>=$min AND preco <=$max";
                    else 
                    $model3 = "modelo = 'Especial'";
                    echo "<center><font size='5'><b>Mousepads Especiais</b></font></center>";
                    filtrarResultados($model3);
                }//mostra todos os com modelo Especiais
                if(!isset($_POST['model1']) && !isset($_POST['model2']) && !isset($_POST['model3']))
                {
                    if($preco==true)
                    {
                        if($min==0)
                        {
                            $where="preco<=$max";
                            echo "<center><font size='5'><b>Mousepads abaixo de R$".number_format($max,2,',','.')."</b></font></center>";
                            filtrarResultados($where); 
                        }
                        else if($max==0)
                        {
                            $where="preco >=$min";
                            echo "<center><font size='5'><b>Mousepads acima de R$".number_format($min,2,',','.')."</b></font></center>";
                            filtrarResultados($where); 
                        }
                        else
                        {
                            $where="preco >=$min AND preco<=$max";
                            echo "<center><font size='5'><b>Mousepads entre R$".number_format($min,2,',','.')." e R$".number_format($max,2,',','.')."</b></font></center>";
                            filtrarResultados($where); 
                        }
                        
                    }
                }//mostra todos os modelos apenas com filtro de preço
                echo "<center><a class='btn-user' href='produtos.php'>Ver todos os Produtos</a></center><br><br>";
            }//verifica se tem filtro aplicado
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

        <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">

    </div>
</body>

</html>