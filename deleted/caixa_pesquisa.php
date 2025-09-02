<form method="post" action="pesquisa_prod_lista.php">
                   <select name="tipo_pesquisa">
                        <option value="idproduto">Id produto</option>
                        <option value="nome">Nome</option>
                        <option value="modelo">Modelo</option>
                        <option value="categoria">Categoria</option>
                        <option value="cor">Cor</option>
                    </select>
                    <input type="text" name="pesquisa" placeholder="Digite a pesquisa" required>              
                    &nbsp;&nbsp;
                    <input type="submit" value="Buscar"> 
</form>