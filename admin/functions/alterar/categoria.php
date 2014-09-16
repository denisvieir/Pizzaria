<?php

function alterarCategoria($nome, $id){
    $pdo = conectar();
    
    try
    {
        $alterarCategoria = $pdo->prepare("UPDATE categorias SET categoria_nome = :nome WHERE categoria_id = :id"); 
        
        
	$alterarCategoria->bindValue(":nome",$nome);
	$alterarCategoria->bindValue(":id",$id);       
        $alterarCategoria->execute();
        
        
        if($alterarCategoria->rowCount() == 1)
            return true;
        else
            return false;
            
        
    }catch(PDOException $e)
    {
        echo "Erro.: " .$e->getMessage();
    }
}