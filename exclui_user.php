
<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 

<!-- exclui_cliente -->
<?php 
        session_start();
        // unset ($_SESSION['nome']);
        if(isset($_SESSION['nome']))
        {
            $nome_session = $_SESSION['nome'];
            //echo"<p style='padding-top:30px>Bem-Vindo, <b>$nome_session</b><br></p>";
            //echo "<a href='logout.php'><button style='background: #lightyellow; border-radius: 4px; padding: 8px; cursor: pointer; color: black; border: groove; font-size: 18px; font-family: times new roman;'> Logout </button></a></span>";
        }
        else
        {
            $nome_session = "Convidado";
            //echo"<p style='padding-top:20px'>Bem-Vindo, <br><b>convidado</b> <br></p>";
            //echo"<br><a href='login.php'>Faça Login</a> Para ler o conteúdo<br></span>";
        }
    // $idcliente=$_SESSION['id'];
    $idcliente=$_GET['id'];

    include "conexao.php";
    
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
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <a name="topo"></a>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Lista de clientes para exclusão - PadPads</title>
</head>

<body>
    <div class="liso">
        <div class="cabecalho"></div><br>
        <center>
            <font face="arial">
                <div id="mae">
                    <a href="<?php
                if($_SESSION['status']=='a') echo "index_adm.php";
                else echo "index.php";
            ?>"><img src="img/logo.png" align="center" width="190" height="62"><br></a>
                    <br><br>
                    <img src="img/img_titulos/titulo_desativar_conta.png" height="35px" width="250px">
                    <br><br><br>
                    <?php

    $sql="SELECT * FROM cliente WHERE idcliente = $idcliente;";

    $resultado=pg_query($conecta,$sql);
    $qtde=pg_num_rows($resultado);

    if ( $qtde == 0 )
    {
        echo "Cliente não encontrado !!!<br><br>";
        exit;
    }
    //echo "$idcliente";
    $linha = pg_fetch_array($resultado);
    ?>
                    <form action="exclui_user_logica.php?id=<?php echo $linha['idcliente']?>" method="post">

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

                        <br><br>


                        <input type="submit" class="btn_geral btn_login" value="Confirmar Exclusão"><br><br>

                    </form>
                </div>
                <br>
            </font>
        </center>
        <div align="center">
            <br>

            <a href='exclui_cliente.php'><button type="submit" value="limpar" name="enviar" class="btn_baixo btn_login1">Voltar</button></a>
            <br><br>

            <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

        </div>

        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

    </div>
</body>

</html>
