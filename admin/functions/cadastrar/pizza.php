<?php
function cadastrarPizza(Array $dadosPizza)
{
	$pdo = conectar();


	try
	{
		$cadastrarPizza = $pdo->prepare("Insert into pizzas (pizza_categoria,pizza_nome, pizza_preco, pizza_descricao, pizza_foto_inicio, pizza_foto_detalhe) values (:categoria, :nome, :preco, :descricao, :foto_inicio, :foto_detalhe)");
		foreach ($dadosPizza as $key => $value) {
                    $cadastrarPizza->bindValue(":$key",$value);
                } 
		
                $cadastrarPizza->execute();

		if ($cadastrarPizza->rowCount() ==1)
			return true;
		else 
			return false;


	}catch(PDOException $e)
	{
		echo "Erro ao cadastrar Pizza " .$e->getMessage();
	}
}