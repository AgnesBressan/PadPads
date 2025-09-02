
<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 

<?php session_start(); ?>
<?php
    //TODO aaaaaa

    include "conexao.php";
    

    $file= $_FILES['imagem']['name'];
    //echo $file."<br>"; //debug
    $destino = "./img/".$file;
    $tmp= $_FILES['imagem']['tmp_name'];
    //echo $tmp; //debug 
    move_uploaded_file( $tmp, $destino  );

    /*Linhas comentadas pois está em fase de teste do upload de imagens.
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $modelo = $_POST['modelo'];
    $catg = $_POST['catg'];
    $cor = $_POST['cor'];
    $qdte = $_POST['qtde'];

    $sql = "insert into produto 
             values(DEFAULT,'$modelo','Vermelho', 1 ,$preco,30,'f');"; 
    $resultado=pg_query($conecta,$sql);
    $linhas=pg_affected_rows($resultado);
    if ($linhas > 0)
        echo "Produto gravado !!!<br><br>";
    else
        echo "Erro na gravação do produto!!!<br><br>";
    pg_close($conecta);*/
    
?>