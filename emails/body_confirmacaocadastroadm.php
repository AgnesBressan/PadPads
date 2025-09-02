<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <style>
        body{
            color:black;
        }
        .aviso{
            width:100%;
            /* height:30px; */
            background-color: rgb(224, 224, 224);
            color:black;
        }
        .imagem{
            width:100%;
            background-color:rgb(224, 224, 224);
        }
        footer{
            text-align:center;
            background-color: purple;
            color:lightgray;
        }

        a{
            text-decoration: none;
            color:purple;
        }
    </style>
</head>

<body> 
    <div class="imagem"><center><img src="https://i.imgur.com/UVhCOWE.png"></center></div>
    <?php
        if($_SESSION['adm']['status']==true){
            echo "<p>Obrigada por se tornar administrador da PadPads e fazer parte da nossa história! <br>
            Esperamos que goste e aproveite sua jornada conosco! <br>
            Para acessar o site da loja, 
            <a href='200.145.153.175/sofiarosa/ecommerce13/index.php'>Clique aqui</a>
            e logue como administrador para fazer parte da loja virtual!</p>";
        }
        else{
            echo "<p>Olá, você foi cadastrado em nossa loja online. <br>
            Esperamos que goste e aproveite sua jornada conosco! <br>
            Para acessar o site da loja, 
            <a href='200.145.153.175/sofiarosa/ecommerce13/index.php'>Clique aqui</a>
            para conhecer a loja virtual!</p>";
        }
    ?>
    <p>Seguem abaixo os dados de autenticação cadastrados.<br>
    <?php echo "Email:".$_SESSION['adm']['email'];
    echo "<br> Senha:".$_SESSION['adm']['senha'] ?></p>
    <div class="aviso" align="center"><br>Você foi cadastrado pelo nosso administrador <?php echo $_SESSION['adm']['logado']; ?>. Se acha que isso foi um engano, 
    apenas ignore esse email.><br><br></div>
    
    <footer>A empresa padpads é totalmente fictícia, criada para fins acadêmicos. Ninguém terá acesso aos seus dados pessoais
        como email, senha ou endereço. Obrigado novamente pela participação.
    </footer>
</body>

</html>
<?php 
unset ($_SESSION['adm']);
?>