<?php

function alterarAdministrador(Array $dadosAdministrador, $id){
    $pdo = conectar();
    
    try
    {
        $alterarAdministrador = $pdo->prepare("UPDATE administrador SET administrador_nome = :nome, administrador_login = :login, administrador_senha = :senha WHERE administrador_id = :id"); 
        
        foreach ($dadosAdministrador as $key => $value): 	
			$alterarAdministrador->bindValue(":$key",$value);
		endforeach;
        $alterarAdministrador->bindValue(":id",$id);       
        $alterarAdministrador->execute();
        
        
        if($alterarAdministrador->rowCount() == 1)
            return true;
        else
            return false;
            
        
    }catch(PDOException $e)
    {
        echo "Erro.: " .$e->getMessage();
    }
}