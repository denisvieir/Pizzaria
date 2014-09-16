<?php

function alterarCliente(Array $dadosCliente, $id){
    $pdo = conectar();
    
    try
    {
        $alterarCliente = $pdo->prepare("UPDATE clientes SET "
                ."cliente_nome = :nome, "
                ."cliente_cidade = :cidade,"
                ."cliente_estado = :estado," 
		."cliente_bairro = :bairro,"
	        ."cliente_cep = :cep,"
                ."cliente_telefone = :telefone,"
		."cliente_celular = :celular,"
	        ."cliente_endereco = :endereco,"
                ."cliente_login = :login, "
                ."cliente_senha = :senha "
                ."WHERE cliente_id = :id"); 
        
        foreach ($dadosCliente as $key => $value): 	
			$alterarCliente->bindValue(":$key",$value);
		endforeach;
        $alterarCliente->bindValue(":id",$id);       
        $alterarCliente->execute();
        
        
        if($alterarCliente->rowCount() == 1)
            return true;
        else
            return false;
            
        
    }catch(PDOException $e)
    {
        echo "Erro.: " .$e->getMessage();
    }
}