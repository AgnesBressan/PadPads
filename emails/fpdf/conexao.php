<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. -->

<?php
    $conecta = pg_connect("host=localhost port=5432 dbname=a31sofiarosa user=a31sofiarosa password=postgres");
    if($conecta) echo "conexão correta";
?>