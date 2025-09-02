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
    <div id='popup'><font face="arial" size="5">
    <a href="index.php"><span class="fechar">X</span></a><br>
    <center> 
        <img width='300px' src='img/pessoal_autorizado.jpg'>
        <p>Desculpe, você não tem autorização para acessar essa página. <br>
        Você está logado como <span style='color: red;'><?php echo $nome_session ?></span>. <br> 
        Se quiser acessar essa página, terá que logar com uma conta de administrador.<br></p><br>
        <a href="login.php">Fazer Login</a><br><a href="index.php">Continuar como <?php echo $nome_session ?></a>
        <br><br>
    </center>
    </font></div>
    <div id="div">
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
            <span style="padding-top:30px; padding-left:15px"><center><?php
                        if($adm==true) echo "Administrador <br><b>$nome_session</b>";
                        else echo "Bem vindo, cliente <br><b>$nome_session</b>"
                    ?></center></span>

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
        <h1>Área do administrador</h1>
            <h3>Consulta de Tabelas</h3>
            <div class="container">
                <span><b>
                    <a href="dados.php"><img src="img/usuario.png" width="100px">
                        <p>Tabela de Clientes</p>
                    </a>
                </b></span>
                <span><b>
                    <a href="produtos_adm.php"><img src="img/sacola.png" width="100px">
                        <p>Tabela de Produtos</p>
                    </a>
                </b></span>
                <span><b>
                    <a href="history_compras.php"><img src="img/prancheta.png" width="100px">
                        <p>Tabela de Compras</p>
                    </a>
                </b></span>
            </div>
            <h3>Alterar, Atualizar ou Excluir Dados</h3>
            <div class="container">
                <span><b>
                    <a href="cad_user_adm.php"><img src="img/usuario.png" width="100px">
                        <p>Cadastrar Cliente</p>
                    </a>
                </b></span>
                <span><b>
                    <a href="cad_prod.php"><img src="img/sacola.png" width="100px">
                        <p>Cadastrar produto</p>
                    </a>
                </b></span>
                <span><b>
                    <a href="altera_exclui_prod.php"><img src="img/sacola.png" width="100px">
                        <p>Alterar Produto</p>
                    </a>
                </b></span>
            </div>
        </center>
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
                               
                                  <b>  Agnes Almeida &nbsp; 
                                    | &nbsp; Augusto Amaral &nbsp; 
                                    | &nbsp; Isabela Navarro &nbsp; 
                                    | &nbsp; Sofia Rosa &nbsp; 
                                    | &nbsp; Stephanie Antonelli &nbsp; 
                                    | &nbsp; Yasmin Sousa </b>
                                </div>
                            </font>
                <br> 

                <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">

    </div><!-- AQUI FECHA A DIV MÃE!!!-->
</body>

</html>