<?php
function cadastrarMetas($tipo, $texto)
{
	$pdo = conectar();
	try
	{
		$cadastrarMetas = $pdo->prepare("Insert into metas (meta_tipo,meta_texto)"
                        . "values (:tipo, :texto)");
		$cadastrarMetas->bindValue(":tipo",$tipo);
                $cadastrarMetas->bindValue(":texto",$texto);
		$cadastrarMetas->execute();

		if ($cadastrarMetas->rowCount() ==1)
			return true;
		else 
			return false;


	}catch(PDOException $e)
	{
		echo "Erro ao cadastrar Metas " .$e->getMessage();
	}
}
