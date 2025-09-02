<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 

<?php session_start(); 
    $idcliente = $_SESSION['id'];
    if(isset($_GET['alert'])){
        $a=$_GET['alert'];
        switch($a){
            case 'editok':
                echo "<script>alert('Alteração bem sucedida!');
                window.location='area_user.php'</script>";
                break;
            case 'nedit':
                echo "<script>alert('Falha inesperada na alteração!');
                window.location='area_user.php'</script>";
                break;
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <a name="topo"></a>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Area usuários</title>

    <style>
    .cabecalho {
        z-index: 0;
        background-color: purple;
        color: purple;
        /*border: 2px solid white;*/
        margin: 0px;
        height: 200px;
    }

    /*ate aqui*/
    </style>



</head>

<body>
    <div class="liso">
        <font face='arial'>

            <div class="cabecalho"></div><br>


            <center>


                <script>
                function hover(val1, val2) {
                    document.getElementById(val2).style.display = "block";
                    document.getElementById(val1).style.opacity = "10%";
                }

                function dhover(val1, val2) {
                    document.getElementById(val1).style.opacity = "100%";
                    document.getElementById(val2).style.display = "none";
                }
                </script>

                <?php

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
    
        include "conexao.php";
        
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

                <br><br>
                <div id="mae" align='center'>
                    <a href="<?php
                     if($linha['administrador']=='f') echo 'index.php';
                     else echo 'index_adm.php';
                     ?>"><br><img src="img/logo.png" align="center" width="190" height="62"><br></a>

                    <center>
                        <br><br>
                        <img src="img/img_titulos/titulo_areadocliente.png" height="45px" width="260px">
                        <br><br>
                    </center>

                    <br>
                    <div align="left">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <label class="hora1">
                            <font size="4"><b>STATUS:</b></font>
                        </label>
                        &nbsp;&nbsp;
                        <input type="text" name="status" size="13" value="<?php echo getStatus($linha['idcliente']); ?>"
                            readonly>

                        &nbsp;&nbsp;&nbsp;

                        <label class="hora0">
                            <font size="4" color="#999696"><b>ID DO USUÁRIO:</b></font>
                        </label>
                        &nbsp;
                        <input type="text" name="id_cliente" style="padding-left:-5px" size="11"
                            value="<?php echo $linha['idcliente']; ?>" readonly>
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
                        <input type="text" size="12" name="sobrenome" value="<?php echo $linha['sobrenome']; ?>"
                            readonly>

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
                        <input type="text" name="complemento" size="12" value="<?php echo $linha['complemento']; ?>"
                            readonly>

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
                    <!-- <a class="btn-user" href="altera_user.php">Logout</a><br> -->
                    <br><br><br>

                    <div align="center">
                        <br>

                        <a href='altera_user.php'><button type="submit" value="limpar" name="enviar"
                                class="btn_geral btn_login">Alterar Dados</button></a>
                        <a href='logout.php'><button type="submit" value="limpar" name="enviar"
                                class="btn_geral btn_login">Logout</button></a><br>
                        <a href='history_user.php'><button type="submit" value="limpar" name="enviar"
                                class="btn_geral btn_login">Histórico</button></a><br>
                    </div>

                    <footer>

                        <br><br>
                        <font size="2">
                            <font style="arial">
                                <center>Trabalho Mousepad - Grupo 04 <br> CTI Unesp Bauru SP</center>
                            </font>
                            <br>
                            <!--adicionei-->
                        </font>

                        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

                    </footer>

                </div>
            </center>

        </font>

        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->
        <br><br>
        <!--adicionei-->
    </div>

</body>

</html>