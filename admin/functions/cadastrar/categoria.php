<?php
function cadastrarCategoria($categoria)
{
	$pdo = conectar();


	try
	{
		$cadastrarCategoria = $pdo->prepare("Insert into categorias(categoria_nome) values (:categoria)");
		$cadastrarCategoria->bindValue(":categoria",$categoria);
		$cadastrarCategoria->execute();

		if ($cadastrarCategoria->rowCount() == 1)
			return true;
		else 
			return false;


	}catch(Exception $e)
	{
		echo "Erro ao cadastrar categoria " .$e->getMessage();
	}
}

?>