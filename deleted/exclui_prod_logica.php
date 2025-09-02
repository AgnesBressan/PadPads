<?php
                include "conexao.php";

                $idproduto = $_POST['idproduto'];
               
                
                $sql="update produto 
                set excluido = 'true'
                WHERE idproduto = $idproduto";



                $resultado= pg_query($conecta,$sql);
                $qtde= pg_affected_rows($resultado);
                if ($qtde > 0 )
                {
                    echo "<script type='text/javascript'>alert('Exclusão OK!')</script>";
                    echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=exclui.php'>";
                }
                else
                {
                    echo "Erro na exclusão!<br>";
                    echo "<a href='altera_exclui_prod.php'>Voltar</a>";
                }
                 pg_close($conecta);
  ?>
