<!-- Feito por: Agnes Bressan de Almeida, Augusto Amaral Domingues, Isabela de Castro Navarro, Sofia Azevedo Rosa, Stephanie Camargo Antonelli e Yasmin Oliveira de Sousa. --> 


<?php
    include "conexao.php"; 

    function cadCategoria($nome){
        GLOBAL $conecta;
        $sql="INSERT INTO categoria VALUES (DEFAULT, '$nome')";
        $r=pg_query($conecta,$sql);
        return $nome;
    }

    function getCategoria(){
        GLOBAL $conecta;
        $nome=$_POST['outro'];
        cadCategoria($nome);
        $sql = "SELECT * FROM categoria WHERE nome_categoria='$nome'";
        $linha=pg_fetch_array(pg_query($sql));
        return $linha['idcategoria'];
    }

    $idproduto= $_POST["idproduto"];
    $nome= $_POST["nome"];
    $preco= $_POST["preco"];
    $modelo= $_POST["modelo"];
    $cor= $_POST["cor"];
    $categoria = $_POST['categoria'];
    
    if($categoria=='outro'){
        $categoria=getCategoria();
    }
    $estoque= $_POST["qtde"];
    $imagem = $_POST["imagem"];

    if(empty($imagem)){
        $sql="SELECT * FROM produto WHERE idproduto=$idproduto";
        $linha=pg_fetch_array(pg_query($conecta,$sql));
        $imagem=$linha['imagem'];
    }

    $sql = "UPDATE produto 
    SET
    nome = '$nome',
    preco = $preco,
    modelo = '$modelo',
    cor = '$cor',
    idcategoria = $categoria,
    qtde = $estoque,
    imagem = '$imagem'
    WHERE idproduto = $idproduto;";
    //echo "idproduto: $idproduto, nome=$nome, $preco, modelo: $modelo, imagem: $imagem, categoria: $categoria";
    $resultado= pg_query($conecta,$sql);
    $qtde= pg_affected_rows($resultado);
    if ($qtde > 0)
    {
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=altera_exclui_prod.php?alert=ok'>";
    }
    else	
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=altera_exclui_prod.php?alert=notok'>";
    pg_close($conecta);
?>