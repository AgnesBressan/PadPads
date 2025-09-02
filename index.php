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
<!DOCTYPE hm>
<html lang="pt-br">

<head>
    <a name="topo"></a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="script/jquery-3.5.1.js"></script>
    <title>Loja Virtual</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="slide.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="js.js"></script>
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
    <div id='popup'>
        <font face="arial" size="5">
            <a href="index.php"><span class="fechar">X</span></a><br>
            <center>
                <img width='100px' src='img/usuario2.png'>
                <p>Olá, é bom te ver!<br>Você está logado como administrador nas páginas de usuário e,
                    assim, pode fazer diversas compras em seu nome. Caso queira voltar para a área de administrador,
                    basta clicar no bonequinho ao lado do carrinho. Aproveite suas compras!</p><br>
                <a class="btn_geral btn_login" href="index.php">Ok</a><br>
                <br><br>
            </center>
        </font>
    </div>
    <div id="div">
        <?php
                    if(isset($_GET['popup'])){
                        echo "<script>document.getElementById('popup').style.display='block';
                           document.getElementById('div').style.filter='blur(10px)';</script>";
                    }
                    else echo "<script>document.getElementById('popup').style.display='none';
                    document.getElementById('div').style.filter='none';</script>";
                ?>
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
            <span style="padding-top:30px; padding-left:15px">
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
        <br><br>
        <div class="imagem_princ">
            <!-- SLIDE!! -->
            <div class="slider">

                <div class="slides">

                    <input type="radio" name="radio-btn" id="radio1">

                    <input type="radio" name="radio-btn" id="radio2">

                    <input type="radio" name="radio-btn" id="radio3">

                    <input type="radio" name="radio-btn" id="radio4">

                    <div class="slide primeiro">

                        <img src="img/series_slides.png" alt="">


                    </div>

                    <div class="slide">

                        <img src="img/filmes_slides.png" alt="">

                    </div>

                    <div class="slide">

                        <img src="img/trad_slides.png" alt="">

                    </div>

                    <div class="slide">

                        <img src="img/gamer_slides.png" alt="">

                    </div>

                    <div class="navigation-auto">

                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>


                    </div>


                </div>

                <div class="navigation-manual">

                    <label for="radio1" class="manual-btn"></label>

                    <label for="radio2" class="manual-btn"></label>

                    <label for="radio3" class="manual-btn"></label>

                    <label for="radio4" class="manual-btn"></label>


                </div>


            </div>
            <script type="text/javascript">
            var counter = 1;

            setInterval(function() {

                document.getElementById('radio' + counter).checked = true;

                counter++;

                if (counter > 4) {
                    counter = 1;

                }


            }, 3000);
            </script>
            <!-- SLIDE!! -->
        </div>

        <div class="texto_princ">
            <div align="center">
                <div class="font1-princ">
                    <font face="sans-serif"><b>Mousepads para todos os gostos!</b></font>
                </div>
                <br>
            </div>
            <div align="justify" style="padding:5px">
                <div class="font2-princ">
                    <font face="sans-serif">PadPads produz desde mousepads tradicionais até</font>
                    <font face="sans-serif">mousepads gamers totalmente estilosos e úteis, que</font>
                    <font face="sans-serif">combinam com qualquer decoração.</font>
                    <font face="sans-serif">Mousepads facilitam muito todas as atividades realizadas no</font>
                    <font face="sans-serif">computador, gerando conforto e praticidade!</font>
                </div>
            </div>
        </div>
        <br><br><br><br>





        <div id="img-peq">
            <div class="imagem_peq">
                <br>
                <div align="center"><img src="img/trad_modelo2.png" width="226px"></div>
            </div>
            <div class="imagem_peq">
                <br>
                <div align="center"><img src="img/trad_modelo1.png" width="226px"></div>
            </div>
            <div class="imagem_peq">
                <br>
                <div align="center"><img src="img/trad_modelo3.png" width="226px"></div>
            </div>
        </div>



        <br>


        <div id="tex-peq">

            <div class="texto_peq">

                <div align="center" style="padding:5px">
                    <div class="font1-peq">
                        <font face="sans-serif"><b>Temáticos de Séries</b></font>
                    </div>
                </div>

                <div align="justify" style="padding:5px">
                    <div class="font2-peq">
                        <font face="sans-serif">As tão amadas séries de TV estampadas em seu mousepad!</font>
                    </div>
                </div>

            </div>


            <div class="texto_peq">

                <div align="center" style="padding:5px">
                    <div class="font1-peq">
                        <font face="sans-serif"><b>Temáticos de Filmes</b></font>
                    </div>
                </div>

                <div align="justify" style="padding:5px">
                    <div class="font2-peq">
                        <font face="sans-serif">Os seus personagens favoritos dos cinemas direto pro seu escritório!
                        </font>
                    </div>
                </div>

            </div>


            <div class="texto_peq">

                <div align="center" style="padding:5px">
                    <div class="font1-peq">
                        <font face="sans-serif"><b>Estampados</b></font>
                    </div>
                </div>
                <div align="justify" style="padding:5px">
                    <div class="font2-peq">
                        <font face="sans-serif">PadPads se ligou nas maiores tendências de estampa para embelezar seu
                            ambiente!</font>
                    </div>
                </div>

            </div>
            <br><br>

        </div>
        <br><br>
        <div class="tex_video" style="padding:10px">

            <div class="font2-princ">
                <font face="sans-serif">O vídeo ao lado</font><br>
                <font face="sans-serif">demonstra qual o melhor</font><br>
                <font face="sans-serif">tipo de mousepad para</font><br>
                <font face="sans-serif">você, levando em</font><br>
                <font face="sans-serif">consideração sua maior</font><br>
                <font face="sans-serif">adaptação.</font><br>
            </div>
            <div>
                <iframe style="padding-left:10px" width="460" height="215"
                    src="https://www.youtube.com/embed/_f64qn3xs1g" frameborder="0"
                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
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

    </div><!-- AQUI FECHA A DIV MÃE!!!-->
</body>

</html>