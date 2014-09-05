<?php
//include_once "../conexao/conexao.php";

function exibeMetas($tipo){

	$pdo = conectar();
	
	try 
	{
		$listarMetas = $pdo->prepare("select * from metas where meta_tipo=:tipo");
		$listarMetas->bindValue(":tipo",$tipo);
		$listarMetas->execute();
		$dados = $listarMetas->fetch(PDO::FETCH_ASSOC);
		return strip_tags($dados['meta_texto']); 
	}catch(PDOException $ex)
	{
		echo "Erro ao conectar: ".$ex->getMessage();
	}
	return $conectar;
}

?> 
