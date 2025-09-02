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
        <!-- <div id="barrafixa">
            <center>
                <nav>
                    <ul>
                        <font face="arial">
                            <li><a href="index_adm.php">Home</a></li>
                            <li><a href="cad_user_adm.php">Cadastro</a></li>
                            <li><a href="altera_prod.php">Alteração</a></li>
                            <li><a href="exclui.php">Exclusão</a></li>
                            <li><a href="pesq.html">Pesquisas</a></li>
                        </font>
                    </ul>
                </nav>
            </center>
        </div> -->
        <div id="branca">
            <img style="padding-left: 45px;" src="img/logo.png" width="300px;">
            <div style="padding-top:30px; padding-left:20px;">
                <!--div da pesquisa-->
                <form method="post" action="pesquisa_prod_lista.php">
                    <select name="tipo_pesquisa">
                        <!-- <option value="idproduto">Id produto</option> -->
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="idcategoria">Categoria</option>
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

        <center>

            <?php
        include "conexao.php"; 
        $idcliente=$_GET['id'];
            function getStatus($id){
                GLOBAL $conecta;
                $sql="SELECT * FROM cliente WHERE idcliente = $id";  
                $resultado=pg_query($conecta,$sql);
                if(pg_num_rows($resultado)>0){
                    $linha=pg_fetch_array($resultado);
                    $status=$linha['administrador'];
                    if($status=='f') return "Cliente";
                    else return "Administrador";
                }
                else{
                    return "aaaaaaaaaaaa";
                }
                
            }
            $sql="SELECT * FROM cliente WHERE idcliente = $idcliente;";  
            $resultado=pg_query($conecta,$sql);
            $qtde=pg_num_rows($resultado);
            //area_user.php?idcliente=1            
             if ( $qtde == 0 )
             {
                
                    echo "Cliente não encontrado !!!<br><br>";
                    exit;
             }
                        
             $linha = pg_fetch_array($resultado);

        ?>

            <img src="img/img_titulos/titulo_conta_cliente.png" height="35px" width="270px">
            <br>
            <h2>'<?php echo $linha['nome'] ?>'</h2>
            <div style="padding-left:200px">
                <div align="left">

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>STATUS:</b></font>
                    </label>
                    &nbsp;&nbsp;
                    <input type="text" name="status" size="13" value="<?php echo getStatus($linha['idcliente']); ?>" readonly>

                    &nbsp;&nbsp;&nbsp;

                    <label class="hora0">
                        <font size="4" color="#999696"><b>ID DO USUÁRIO:</b></font>
                    </label>
                    &nbsp;
                    <input type="text" name="id_cliente" style="padding-left:-5px" size="11" value="<?php echo $linha['idcliente']; ?>" readonly>
                    <br><br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>NOME:</b></font>
                    </label>
                    &nbsp;&nbsp;
                    <input type="text" name="nome" size="13" value="<?php echo $linha['nome']; ?>" readonly>


                    &nbsp;&nbsp;&nbsp;

                    <label class="hora0">
                        <font size="4" color="#999696"><b>SOBRENOME:</b></font>
                    </label>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="text" size="12" name="sobrenome" value="<?php echo $linha['sobrenome']; ?>" readonly>

                    <br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>RUA:</b></font>
                    </label>
                    &nbsp;&nbsp;
                    <input type="text" name="endereco" size="55" value="<?php echo $linha['rua']; ?>" readonly>

                    <br><br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>BAIRRO:</b></font>
                    </label>
                    &nbsp;&nbsp;
                    <input type="text" name="bairro" size="13" value="<?php echo $linha['bairro']; ?>" readonly>

                    &nbsp;&nbsp;&nbsp;

                    <label class="hora0">
                        <font size="4" color="#999696"><b>COMPLEMENTO:</b></font>
                    </label>
                    <input type="text" name="complemento" size="12" value="<?php echo $linha['complemento']; ?>" readonly>

                    <br><br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>CIDADE:</b></font>
                    </label>
                    &nbsp;&nbsp;
                    <input type="text" name="cidade" size="13" value="<?php echo $linha['cidade']; ?>" readonly>

                    &nbsp;&nbsp;&nbsp;

                    <label class="hora0">
                        <font size="4" color="#999696"><b>UNID. FEDERAL:</b></font>
                    </label>


                    <input type="text" name="estado" size="12" value="<?php echo $linha['estado']; ?>" readonly>

                    <br><br><br>

                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    <label class="hora1">
                        <font size="4"><b>EMAIL:</b></font>
                    </label>
                    &nbsp;
                    <input type="text" name="email" size="55" value="<?php echo $linha['email']; ?>" readonly>

                </div>
            </div>
            <?php echo"<br><br>" ?>
            <a href="dados.php" class="btn-user">Voltar para lista</a><br><br><br>
        </center>


        <!-- <br><br>   -->
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

    </div><!-- AQUI FECHA A DIV MÃE!!!-->
</body>

</html>
