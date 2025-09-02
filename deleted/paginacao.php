<?php

    include "conexao.php";

    $busca = "SELECT nome FROM cliente ORDER BY idcliente ";

    $total_reg = 1; //total por página
    if(isset($_GET['pagina'])){
        $pagina=$_GET['pagina'];
    }
    

    if (!isset($pagina)) 
    {
        $pc = "1";
    } 
    else 
    {
        $pc = $pagina;
    }

    $inicio = $pc - 1; //valor inicial

    $inicio = $inicio * $total_reg;

    $limite = pg_query($conecta,$busca."LIMIT $total_reg OFFSET $inicio");

    $todos = pg_query($busca);

    $tr = pg_num_rows($todos); // verifica o número total de registros

    $tp = $tr / $total_reg; // verifica o número total de páginas

    // vamos criar a visualização
    while ($dados = pg_fetch_array($limite)) 
    {
        $nome = $dados["nome"];
        echo "Nome: ".$nome."<br>";
    }

    // agora vamos criar os botões "Anterior e próximo"
    $anterior = $pc -1;

    $proximo = $pc +1;

    if ($pc>1) 
    {
        echo " <a href='?pagina=$anterior'><- Anterior</a> ";
        
    }
    echo "|";

    if ($pc<$tp) 
    {
        echo " <a href='?pagina=$proximo'>Próxima -></a>";
    }

?>