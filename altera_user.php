<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 

<?php session_start();
    $idcliente = $_SESSION['id'];
    include "conexao.php";
    function returnOld($var,$s){
        GLOBAL $idcliente;
        GLOBAL $linha;
        //echo $linha[$s];
        //echo $var;
        if(empty($var) ||is_null($var)) {
            if(empty($linha[$s]))return null;
            return $linha[$s];
        }
        else return $var;
    }


    
    if(isset($_GET['acao'])){
        $acao=$_GET['acao'];
        if($acao='alt')
        {
            
            $nome=$_POST['nome'];
            $rua=$_POST['rua'];
            $cidade=$_POST['cidade'];
            $estado=$_POST['estado'];
            $sobrenome=$_POST['sobrenome'];
            $email=$_POST['email'];
            $bairro=$_POST['bairro'];
            $complemento=$_POST['complemento'];

            $nome=returnOld($nome,'nome');
            $rua=returnOld($rua,'rua');
            $cidade=returnOld($cidade,'cidade');
            $estado=returnOld($estado,'estado');
            $sobrenome=returnOld($sobrenome,'sobrenome');
            $email=returnOld($email,'email');
            $bairro=returnOld($bairro,'bairro');
            $complemento=returnOld($complemento,'complemento');

            $sql="UPDATE cliente SET nome='$nome', rua='$rua', 
            cidade='$cidade',estado='$estado', sobrenome='$sobrenome', email='$email',
            bairro='$bairro',complemento='$complemento' WHERE idcliente = $idcliente"; 
            //essa aqui chamamos de string sql, é o comando

            $resultado = pg_query($conecta,$sql);//ele tá pedindo pra executar o sql
            $n = pg_affected_rows($resultado);//ele seleciona o numero de linhas afetadas pelo sql
            if($n>0) {
                $_SESSION['nome']=$nome;
                $_SESSION['email']=$email; 
                header("Location:area_user.php?alert=editok");
            }
            else header("Location:area_user.php?alert=nedit");
        

            
        }//else if($acao='ex')
        // {
            
            
        //     // $idcliente=$_POST["idcliente"];
        //     // $nome=$_POST["nome"];
        //     // $sobrenome=$_POST["sobrenome"];
        //     // $rua=$_POST["rua"];
        //     // $bairro=$_POST["bairro"];
        //     // $numero=$_POST["numero"];
        //     // $cidade=$_POST["cidade"];
        //     // $estado=$_POST["estado"];
        //     // $status=$_POST["status"];

        //     $sql="update cliente 
        //     set
        //     excluido=TRUE WHERE idcliente=$idcliente";

        //     $resultado=pg_query($conecta,$sql);
        //     $qtde=pg_affected_rows($resultado);

        //     if ($qtde > 0)
        //     {
        //         echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
        //         echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=exclui_prod.php'>";
        //         //header("Location:logout.php");
        //     }

        //     else	
        //     {
        //         echo "<script type='text/javascript'>alert('Falha na Desativação!')</script>";
        //         //echo "<a href='exclui_prod.php'>Voltar</a>";
        //         echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=area_user.php'>";
        //     }
        //}
        
    }

    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <a name="topo"></a>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="js.js"></script>

    <title>Altera Usuário</title>

    <style>

    </style>
</head>

<body>
    <div class="liso">


        <font face='arial'>

            <div class="cabecalho"></div><br>


            <!--<div id="mae">-->

            <!-- $sql="UPDATE cliente SET nome=$nome, rua=$rua, cidade=$cidade, sobrenome=$sobrenome, email=$email WHERE idcliente = $idcliente"; -->

            <?php

        function getStatus($id)
        {
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

        $sql="SELECT * FROM cliente WHERE idcliente='$idcliente'";
        $resultado= pg_query($conecta, $sql);
        $qtde=pg_num_rows($resultado);

        if ( $qtde == 0 )
         {
            
                echo "Cliente não encontrado !!!<br><br>";
                exit;
         }

                
          $linha=pg_fetch_array($resultado);
          
          /*echo "Idcliente...:".$linha['idcliente']."<br>";
          $nome= $linha['nome'];
          echo "Sobrenome...........: ".$linha['sobrenome']."<br>";
          echo "Email..........: ".$linha['email']."<br>";
        //echo "Senha...............: ".$linha['senha']."<br>";
          echo "Status......".getStatus($linha['idcliente'])."<br>";
          echo "<a href='altera_prod_lista.php?idcliente=".$linha['idcliente']."'>*/
          
          
        ?>
            <center>
                <br><br>
                <div id="mae">
                    <a href="index.php"><br><img src="img/logo.png" align="center" width="190" height="62"><br></a>
                    <form action="altera_user.php?acao=alt" method="post">

                        <center>
                            <br><br>
                            <img src="img/img_titulos/titulo_alteradados_usuario.png" height="45px" width="420px">
                            <br><br>
                        </center>

                        <br>

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
                            <input type="text" name="nome" size="13" value="<?php echo $linha['nome']; ?>">


                            &nbsp;&nbsp;&nbsp;

                            <label class="hora0">
                                <font size="4" color="#999696"><b>SOBRENOME:</b></font>
                            </label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" size="12" name="sobrenome" value="<?php echo $linha['sobrenome']; ?>">

                            <br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label class="hora1">
                                <font size="4"><b>RUA:</b></font>
                            </label>
                            &nbsp;&nbsp;
                            <input type="text" name="rua" size="55" value="<?php echo $linha['rua']; ?>">

                            <br><br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label class="hora1">
                                <font size="4"><b>BAIRRO:</b></font>
                            </label>
                            &nbsp;&nbsp;
                            <input type="text" name="bairro" size="13" value="<?php echo $linha['bairro']; ?>">

                            &nbsp;&nbsp;&nbsp;

                            <label class="hora0">
                                <font size="4" color="#999696"><b>COMPLEMENTO:</b></font>
                            </label>
                            <input type="text" name="complemento" size="12" value="<?php echo $linha['complemento']; ?>">

                            <br><br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label class="hora1">
                                <font size="4"><b>CIDADE:</b></font>
                            </label>
                            &nbsp;&nbsp;
                            <input type="text" name="cidade" size="13" value="<?php echo $linha['cidade']; ?>">

                            &nbsp;&nbsp;&nbsp;

                            <label class="hora0">
                                <font size="4" color="#999696"><b>UNID. FEDERAL:</b></font>
                            </label>


                            <input type="text" name="estado" size="12" value="<?php echo $linha['estado']; ?>">

                            <br><br><br>

                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <label class="hora1">
                                <font size="4"><b>EMAIL:</b></font>
                            </label>
                            &nbsp;
                            <input type="text" name="email" size="55" value="<?php echo $linha['email']; ?>" readonly>

                        </div>


                        <br><br>
                        <button type="submit" value="Alterar Dados" class="btn_geral btn_login">Alterar Dados</button>
                    </form>

                    <footer>

                        <br><br>
                        <font size="2" style="arial">
                            <center>Trabalho Mousepad - Grupo 04 <br> CTI Unesp Bauru SP</center><br><br>
                        </font>

                        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

                    </footer>
                </div>
                <br><br><a href="area_user.php" class="btn_baixo btn_login1">Voltar</a><br><br><br>
            </center>
        </font>

        <!-- <img class="setinha" src="img/seta2.png" onclick="window.location.href='#topo';"> -->

    </div>
</body>

</html>
