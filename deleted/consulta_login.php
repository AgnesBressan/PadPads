<?php
session_start();
$email = $_POST['email'];
$entrar = $_POST['entrar'];
$senha = $_POST['senha'];
$senha = md5($senha);
include "conexao.php";

  if (isset($entrar)) {
      
    $verifica = pg_query("SELECT * FROM cliente WHERE email =
    '$email' AND senha = '$senha' AND excluido IS FALSE") or die("erro ao selecionar");  
      if (pg_num_rows($verifica)<=0)
      {
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='login.php';</script>";
        die();
        session_destroy();
      }
      else
      {
        $linha=pg_fetch_array($verifica);
        $id=$linha['idcliente'];
        $_SESSION['email']=$email;
        $_SESSION['nome']=$linha['nome'];
        $_SESSION['id']=$linha['idcliente'];
        if($linha['administrador']=='f'){
          $_SESSION['status']='c';
          header("Location:index.php");
        }
        else{
          $_SESSION['status']='a';
          header("Location:index_adm.php");
        } 
      }
  }
?>