<?php
    $conecta = pg_connect("host=localhost port=5432 dbname=a31sofiarosa user=a31sofiarosa password=postgres");
    if(!$conecta) echo "conexão falhou";
?>