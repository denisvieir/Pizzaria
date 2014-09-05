<?php 

function cadastrarAdministrador(Array $valores)
{
	$pdo = conectar();

	try
	{
		$cadastraAdministrador = $pdo->prepare("insert into administrador
			(administrador_nome, administrador_login, administrador_senha) 
			values(:nome,:login, :senha)");
		
		foreach ($valores as $key => $value): 	
			$cadastraAdministrador->bindValue(":$key",$value);
		endforeach;	
		$cadastraAdministrador->execute();
		if($cadastraAdministrador->rowCount()==1)
			return true;
		else 
			return false; 

	}catch(Exception $e)
	{
		echo "erro ao cadastrar o administrador".$e->getMessage();
	}
}