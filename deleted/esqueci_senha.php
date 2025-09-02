<?php session_start(); ?>
<?php

    include "conexao.php";

if(isset($_POST['rec_email']))
{//Augusto, tá aqui? To mexendo pra resolver os erros, tá?
    try
    {

        $email = $_POST['rec_email'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            throw new Exception("Email inválido.");
        }

        $sql_code = "SELECT senha FROM cliente WHERE email = '$email'";
        $sql_query = pg_query($sql_code);
        $dado = pg_fetch_array($sql_query);
        $total = pg_num_rows($sql_query);

        if($total == 0)
        {
            //$erro[] = "O email informado não existe no banco de dados.";
            throw new Exception ("O email não existe");
        }

        $novasenha = substr(md5(time()), 0, 6);
        $nscrip = md5(md5($novasenha));
    
        if(mail($email,"Nova senha", "Sua senha antiga foi atualizada para: ".$novasenha))
        {
            $sql_code = "UPDATE cliente SET senha = '$nscrip' WHERE email = '$email'";
            $sql_query = $mysqli->query($sql_code) or die ($mysqli->$error);
        }

    }

    catch(Exception $e)
    {
        $erro = $e->getMessage()."\n";
        echo $erro;
    }

}
?>