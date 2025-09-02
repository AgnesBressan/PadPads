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
    include "conexao.php";

    $idcliente=$_GET['id'];
    //echo $idcliente;

    
    $sql="UPDATE cliente 
    SET
    excluido=TRUE WHERE idcliente=$idcliente";

    $resultado=pg_query($conecta,$sql);
    $qtde=pg_affected_rows($resultado);
    //echo $qtde;

    if ($qtde > 0)
    {
    echo "<script type='text/javascript'>alert('Gravação OK !!!')</script>";
    if($adm==false)echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=logout.php'>";
    else echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=dados.php'>";
   // header("Location:logout.php");
    }

    else	
    {
    echo "Erro na exclusao !!!<br>";
    //echo "<a href='exclui_prod.php'>Voltar</a>";
    }
    ?>