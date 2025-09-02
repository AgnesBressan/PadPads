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
    <div id="div">
        <!-- <div id="barrafixa" align="center">
            <nav>
                <ul>
                    <font face="arial">
                        <li><a href="index_adm.php">Home</a></li>
                        <li><a href="produtos_adm.php">Produtos</a></li>
                        <li><a href="sobre_adm.php">Sobre</a></li>
                        <li><a href="cad_user.php">Cadastro</a></li>
                    </font>
                </ul>
            </nav>
        </div> -->
        <div id="branca">
            <img style="padding-left: 45px;" src="img/logo.png" width="300px;">
            <div style="padding-top:30px; padding-left:20px;">

            </div>
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
            <span style="padding-top:30px; padding-left:15px">
                <center>
                    <?php
                        if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                        else echo "Bem vindo, cliente <br><b>$nome_session</b>"
                    ?>
                </center>
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

        <center>
            <br><br><br>
            <img src="img/img_titulos/titulo_clientes_pesquisados.png" height="35px" width="345px">
            <br><br>

            <form method="post" action="pesquisa_prod_lista_cliente.php">
                <select name="tipo_pesquisa">
                    <!-- <option value="idproduto">Id produto</option> -->
                    <option value="idcliente">ID cliente</option>
                    <option value="nome">Nome</option>
                    <option value="sobrenome">Sobrenome</option>
                    <option value="email">Email</option>
                </select>
                <input type="text" name="pesquisa" placeholder="Digite a pesquisa" required>
                &nbsp;&nbsp;
                <input type="submit" value="Buscar">
            </form>
            <br>
        </center>

        <div class='container'>
            <?php
                include "conexao.php";
                    
                if($_POST['tipo_pesquisa'] == 'idcliente')
                {
                   $sql="SELECT * FROM cliente WHERE idcliente=".$_POST['pesquisa'];
                    $resultado=pg_query($conecta,$sql);
                    $encontrados=pg_affected_rows($resultado);
                    if($encontrados>0)
                    {
                        $linha=pg_fetch_array($resultado);
                        echo "<div class='sub'>
                        <center><div class='fundo-imagem'><img height='130px' src='img/perfil_clientes.png' height='130px'></div></center>
                        <div style='border: 3px solid #999696;border-top:none; padding:5px; width:100%'><br><b>ID cliente:</b> ".$linha['idcliente']."<br>
                        <b>Nome:</b> ".$linha['nome']."<br>
                        <b>Sobrenome:</b> ".$linha['sobrenome']."<br>
                        <b>Email:</b> ".$linha['email']."<br><br><center><a class='btn-user' href='todos_dados.php?id=".$linha['idcliente']."'>Ver mais...</a></center><br>";
                
                        echo "</div></div>"; 
                    }
                    else
                    {
                        echo "<div align='center'>Não foi encontrado nenhum cliente<br><br> </div>";
                    }
                }
                
                else
                {
                   $sql="SELECT * FROM cliente WHERE $_POST[tipo_pesquisa] ILIKE '%$_POST[pesquisa]%' ORDER BY idcliente;";

                    $resultado=pg_query($conecta,$sql);

                    $encontrados=pg_affected_rows($resultado);

                    if($encontrados>0)
                    {
                        for($i=0; $i<$encontrados; $i++)
                        {
                            $linha= pg_fetch_array($resultado);

                            echo "<div class='sub'>
                            <center><div class='fundo-imagem'><img height='130px' src='img/perfil_clientes.png' height='130px'></div></center>
                            <div style='border: 3px solid #999696;border-top:none; padding:5px; width:100%'><br><b>ID cliente:</b> ".$linha['idcliente']."<br>
                            <b>Nome:</b> ".$linha['nome']."<br>
                            <b>Sobrenome:</b> ".$linha['sobrenome']."<br>
                            <b>Email:</b> ".$linha['email']."<br><br><center><a class='btn-user' href='todos_dados.php?id=".$linha['idcliente']."'>Ver mais...</a></center><br>";

                            echo "</div></div>"; 
                        } 
                    }
                    else
                    {
                        echo "<div align='center'>Não foi encontrado nenhum cliente<br><br> </div>";
                    } 
                    
                }
                    
                
            ?>
        </div>
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

    </div><!-- fecha div mae-->
</body>

</html>
