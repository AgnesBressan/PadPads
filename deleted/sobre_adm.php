<?php
session_start();
if (isset($_SESSION['nome'])) {
    $nome_session = $_SESSION['nome'];
    if ($_SESSION['status'] == 'c') {
        $adm = false;
    } else $adm = true;
} else {
    $nome_session = "Convidado";
    $adm = false;
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
                <a href="login.php">Fazer Login</a><br><a href="index.php">Continuar como <?php echo $nome_session ?></a>
                <br><br>
            </center>
        </font>
    </div>
    <div id="div">
        <?php
        if ($adm == false)
            echo "<script>document.getElementById('popup').style.display='block';
                           document.getElementById('div').style.filter='blur(10px)';</script>";
        else echo "<script>document.getElementById('popup').style.display='none';
                    document.getElementById('div').style.filter='none';</script>";
        ?>
        <script type="text/javascript">
            $(window).scroll(function() {
                if ($(window).scrollTop() >= 100)
                    $("#barrafixa").fadeIn("slow");
                else
                    $("#barrafixa").fadeOut("slow");
            });
        </script>

        <div id="barrafixa">
            <!--<center>
                <nav>
                    <ul>
                        <font face="arial">
                            <li><a href="index_adm.php">Home</a></li>
                            <li><a href="produtos_adm.php">Produtos</a></li>
                            <li><a href="sobre_adm.php">Sobre</a></li>
                            <li><a href="cad_user_adm.php">Cadastro</a></li>
                        </font>
                    </ul>
                </nav>
            </center>-->
        </div><!-- Div barra fixa-->

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
                    <input type="text" name="pesquisa" placeholder="Pesquise o produto" required>&nbsp;&nbsp;
                    <input type="submit" value="Buscar">
                </form>
            </div>

            <div style="padding-top: 17px; padding-left:23px;">

                <?php
                if ($adm == true) {
                    echo "<a href = 'index.php?popup=admCompra'><img src='img/usuario2.png' width='50px' height='50px'></a>";
                }
                if (isset($_SESSION['nome'])) {
                    echo "<a href = 'area_user.php'><img src='img/usuario.png' width='50px' height='50px'></a>";
                } else {
                    echo "<a href = 'login.php'><img src='img/usuario.png' width='50px' height='50px'></a>";
                }

                ?>
            </div>
            <span style="padding-top:30px; padding-left:20px">
                <center><?php
                        if ($adm == true) echo "Administrador <br><b>$nome_session</b>";
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


        <br><br>
        <br><br>
        <div class="texto_sobre">

            <span class="font1-princ">
                <center>
                    <font face="sans-serif"><b>Projeto</b></font>
                </center>
            </span><br>
            <div align="justify" style="padding:5px">
                <div class="font2-princ">
                    <font face="sans-serif"> Comercializamos os mais estilosos e acessíveis mousepads para você.</font>
                    <font face="sans-serif">Os produtos são desenvolvidos com muito carinho e qualidade, visando atender
                        os desejos de nossos clientes.</font>
                    <font face="sans-serif">Desejamos a você uma agradável estadia em nosso site e ótimas compras!
                    </font>
                </div>
            </div>

        </div><br><br><br>

        <div class="texto_sobre">
            <span class="font1-princ">
                <font face="sans-serif">
                    <center><b>Desenvolvedores</b></center>
                </font>
            </span><br>
            <div align="justify" style="padding:5px">
                <div class="font2-princ">
                    <font face="sans-serif">O projeto foi desenvolvido por alunos que cursam o segundo ano do ensino
                        médio integrado ao técnico em informática</font>
                    <font face="sans-serif">no Colégio Técnico Industrial (CTI). <br>Os alunos foram orientados pelos professores:
                        <b>Rodrigo Ferreira de Carvalho</b>, na disciplina de Aplicativos I;
                        <b>Vitor Del Gaudio Simeão</b>, na disciplina de PHP e Banco de dados;
                        <b>Jovita Hojas Baena</b>, na disciplina de Gestão de Negócios I.</font><br><br><br>

                </div>
            </div>
        </div><br><br><br><br>
        <center>
            <div id="img-peq">


                <div class="imagem_peq">


                    <img src="img/agnes_o.jpg" width="150" height="150">

                    <br><br>
                    <p>1 Agnes</p>

                </div>


                <div class="imagem_peq">


                    <img src="img/augusto_o.jpg" width="150" height="150">

                    <br><br>
                    <p>05 Augusto</p>

                </div>



                <div class="imagem_peq">


                    <img src="img/isa_o.jpg" width="150" height="150">

                    <br><br>
                    <p>17 Isabela</p>

                </div>



                <div class="imagem_peq">


                    <img src="img/soff_o.jpg" width="150" height="150">

                    <br><br>
                    <p>31 Sofia</p>

                </div>


                <div class="imagem_peq">


                    <img src="img/steph_o.jpg" width="150" height="150">

                    <br><br>
                    <p>32 Stephanie</p>

                </div>


                <div class="imagem_peq">


                    <img src="img/yasmin_o.jpg" width="150" height="150">

                    <br><br>
                    <p>35 Yasmin</p>

                </div>



            </div><br><br>
        </center>
        <div class="rodape">
            <header>
                <div>
                    <nav>
                        <ul class="menusubs">
                            <font face="arial">
                                <li><a href="index_adm.php">Home</a></li>
                                <li><a href="#">Cliente</a>
                                    <ul>
                                        <li><a href="cad_user_adm.php">Cadastro</a></li>
                                        <li><a href="altera_exclui_prod_adm.php">Alteração</a></li>
                                        <li><a href="dados.php">Pesquisa</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Produto</a>
                                    <ul>
                                        <li><a href="cad_prod.php">Cadastro</a></li>
                                        <li><a href="exclui_user.php">Exclusão</a></li>
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
                            <br><br><br><br><br><br><br><br><br>
                        </ul>
                    </nav>
                </div>
            </header>
        </div>
        <br><br><br><br><br><br><br><br><br><br>
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
        
<?php ?>
        <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';">
                        
    </div>
</body>

</html>