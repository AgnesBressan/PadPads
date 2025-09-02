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
            <h1>Desativar Conta</h1>
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

                <div id='campos'>

                    <br><label class="hora2">
                        <p style="width: 520px;margin-top: -5px;"><b>ID</b>
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label
                        class="hora2"><b>STATUS</b></label></p>
                    <p style="width: 520px;">
                        <font size="3">
                            <font style="arial"><input type="number" name="idcliente"
                                    value="<?php echo $linha['idcliente']; ?>" readonly>&nbsp;<input type="text"
                                    name="status" value="<?php echo getStatus($linha['idcliente']); ?>" readonly></font>
                        </font>
                    </p>
                    <br><label class="hora2">
                        <p style="width: 520px;margin-top: -5px;"><b>NOME</b>
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label
                        class="hora2"><b>SOBRENOME</b></label></p>
                    <p style="width: 520px;">
                        <font size="3">
                            <font style="arial"><input type="text" name="nome" value="<?php echo $linha['nome']; ?>"
                                    readonly>&nbsp;<input type="text" name="sobrenome"
                                    value="<?php echo $linha['sobrenome']; ?>" readonly>
                            </font>
                        </font>
                    </p>
                    <br><label class="hora2">
                        <p style="width: 520px;margin-top: -5px;"><b>RUA</b>
                    </label></p>
                    <p style="width: 520px;">
                        <font size="3">
                            <font style="arial"><input type="text" name="endereco" size="46"
                                    value="<?php echo $linha['rua']; ?>" readonly></font>
                        </font>
                    </p>
                    <font size="4"><b><br><label class="hora2">
                                <p style="width: 520px;margin-tp: -5px;">BAIRRO:
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>COMPLEMENTO</label>
                            </p></b></font>
                    <p style="width: 520px;">
                        <font size="3">
                            <font style="arial">
                                <input type="text" name="bairro" value="<?php echo $linha['bairro']; ?>" readonly>
                                &nbsp;
                                <input type="text" name="complemento" value="<?php echo $linha['complemento']; ?>"
                                    readonly>
                            </font>
                        </font>
                    </p>
                    <br><label class="hora2">
                        <p style="width: 520px;margin-top: -5px;"><b>CIDADE</b>
                    </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label
                        class="hora2"><b>ESTADO</b></label></p>
                    <p style="width: 520px;">
                        <font size="3">
                            <font style="arial"><input type="text" name="cidade" value="<?php echo $linha['cidade']; ?>"
                                    readonly>&nbsp;<input type="text" name="estado"
                                    value="<?php echo $linha['estado']; ?>" readonly></font>
                        </font>
                    </p>
                    <br><label class="hora2">
                        <p style="width: 520px;margin-top: -5px;"><b>EMAIL</b>
                    </label></p>
                    <p style="width: 520px;">
                        <font size="3">
                            <font style="arial"><input type="text" name="email" size="46"
                                    value="<?php echo $linha['email']; ?>" readonly></font>
                        </font>
                    </p>

                </div><br><br>


                <input type="submit" class="btn-user1" value="Confirmar Exclusão"><br><br>

            </form>
        </div>
        <br><br>
    </font>
</center>

<!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

</div>
</body>

</html>