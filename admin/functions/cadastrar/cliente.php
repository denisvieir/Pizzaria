<?php 

function cadastrarCliente(Array $valores)
{
	$pdo = conectar();

	try
	{
		
		$cadastraCliente = $pdo->prepare("insert into clientes(
						cliente_nome, 
                                        	cliente_cidade,
                                                cliente_estado, 
						cliente_bairro,
						cliente_cep,
						cliente_telefone,
						cliente_celular,
						cliente_endereco,
						cliente_login,
						cliente_senha
						) 										
						values(
						:nome,
						:cidade,
						:estado,
						:bairro,
						:cep,
						:telefone,
						:celular,
						:endereco,
						:login,
						:senha)");
		
		foreach ($valores as $key => $value): 	
			$cadastraCliente->bindValue(":$key",$value);
		endforeach;	
		$cadastraCliente->execute();
		if($cadastraCliente->rowCount()==1)
			return true;
		else 
			return false; 

	}catch(Exception $e)
	{
		echo "erro ao cadastrar o cliente! ".$e->getMessage();
	}
}