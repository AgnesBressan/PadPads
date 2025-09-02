<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->


<?php
    session_start();
    $id_esqueceu=$_SESSION['id_esqueceu'];
?>
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
    <p><center>Olá!</center><br>
    Foi solicitada uma recuperação de senha em seu nome. Para definir uma nova senha, entre no link: 
    <a href="<?php echo '200.145.153.175/sofiarosa/padpads/recuperacaosenha.php?id='.$id_esqueceu ?>">Recuperação de Senha</a></p>
    <div class="aviso" align="center"><br>Se você não efetuou essa solicitação, ignore esse email.<br><br></div>
    
    <footer>A empresa padpads é totalmente fictícia, criada para fins acadêmicos. Ninguém terá acesso aos seus dados pessoais
        como email, senha ou endereço. Obrigado novamente pela participação.
    </footer>
</body>

</html>