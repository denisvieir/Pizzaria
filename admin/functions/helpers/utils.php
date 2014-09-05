<?php 
function verificaCadastro($tabela,$nomeCampo, $cadastro )
{
	$pdo = conectar();
	try{
	//echo "select * from $tabela where $nomeCampo = '$cadastro'";
	$verificaCadastro = $pdo->prepare("select * from $tabela where $nomeCampo = :cadastro");
	$verificaCadastro->bindValue(":cadastro",$cadastro);
	$verificaCadastro->execute();

	if ($verificaCadastro->rowCount() > 0)
		return false;
	else
		return true;
	}catch (Exception $e)
	{
		echo 'Erro ao verificar registro cadastrado'.$e->getMessage();
	}
}

function obrigatorio($nomeCampo, $campo = null)
{
	global $obrigatorio;

	
	
	if ($campo !== null){
		if(empty($campo)){
			$obrigatorio = "O campo $nomeCampo é obrigatorio !";
			return false;
		}
		else
			return $campo;
	}
	
		
}

function validarCep($cep)
{
	global $validou;

	if (preg_match("/\d{5}-\d{3}$/", $cep))
		return true;
	else
		$validou = "O formato do cep, não foi aceito!";

}

function validarTelefone($telefone)
{
	global $validou;
	 
	if (preg_match("/^[(]\d{2}[)]\d{4}-\d{4}$/i", $telefone))
		return true;
	else
		$validou = "O formato do telefone, não foi aceito!";

}

function criaSessao($sessao, $valorSessao)
{
	if(empty($valorSessao))
		return $_SESSION[$sessao] = "";
	else
		return $_SESSION[$sessao] = $valorSessao;
	
}

function listar($tabela)
{
	$pdo = conectar();

	try{

		$listar = $pdo->prepare("Select * from " .$tabela);
		$listar->execute();


		if($listar->rowCount() > 0){
			$dados = $listar->fetchAll(PDO::FETCH_ASSOC);			
			return $dados;
		}
		else
			return false;
		
	}catch(PDOException $e)
	{
		echo "Erro:".$e->getMessage();
	}

}