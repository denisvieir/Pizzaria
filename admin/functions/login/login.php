<?php 

function gravarLogin($cliente)
{
    date_default_timezone_set("BRAZIL/EAST");
    $pdo = conectar();
    try{
        $gravarLogin = $pdo->prepare("INSERT INTO dados_login_administrador (dados_login_administrador, dados_login_administrador_data) VALUES (:cliente, :data)");
        
        $gravarLogin->bindValue(":cliente", $cliente);
        $gravarLogin->bindValue(":data", date("Y-m-d h:i:s"));
        $gravarLogin->execute();
        //Se cadastrou no banco de dados o login do admin
        if($gravarLogin->rowCount() == 1)
            return true;
        else 
            return false;
    }catch(PDOException $e)
    {
        echo "Erro ao gravar os dados do login ". $e->getMessage();
    }
}


function gravarDados($arquivo)
{
	if ($arquivo == "functions/login/sucesso_login.txt")
		$str = "O administrador logou com sucesso com o ip  ".$_SERVER['REMOTE_ADDR']." na data " .date("d/m/y h:i:s")."\n";
        
	else			
		$str = "Erro ao logar com o IP: ".$_SERVER['REMOTE_ADDR'].
			"na data " .date("d/m/y h:i:s");
              
	if(file_exists($arquivo))
        {
		$file = fopen($arquivo, "a");
		if($file)
		{
                    
                        fputs($file,$str);
		}
                fclose($arquivo);
	}
}

function logar($login, $senha)
{

	$pdo = conectar();
	try{

		$logar = $pdo->prepare("Select * from administrador where administrador_login = :login AND  administrador_senha =:senha");
		$logar->bindValue(":login", $login);
		$logar->bindValue(":senha", $senha);
		$logar->execute();
		$dadosLogin = $logar->fetch(PDO::FETCH_ASSOC);
                
	if($logar->rowCount()==1)
	{
		gravarDados("functions/login/sucesso_login.txt");
		$_SESSION['administrador']  = $dadosLogin['administrador_nome'];
		$_SESSION['logado_admin'] = true;
                gravarLogin($dadosLogin['administrador_id']);
	 	return true;		
	}
	else
	{
		gravarDados("functions/login/erro_login.txt");
		//$_SESSION['logado_admin'] = false;
		return false;
	}
	}catch(PDOException $e)
	{
		echo 'Erro ao logar no sistema: '.$e->getMessage();
	}
}

function verificaLogado($sessao){
    if(!isset($_SESSION[$sessao]))
        header ("Location: ../index.php");
}

function pegaIdAdministrador($nome = null)
{
    $pdo = conectar();
    try
    {
        $pegaId = $pdo->prepare("Select * from administrador where administrador_nome = :administrador");
        $pegaId->bindValue(":administrador", $nome);
        $pegaId->execute();
        $dados = $pegaId->fetch(PDO::FETCH_ASSOC);
        return $dados['administrador_id'];
    }catch(PDOException $e)
    {
     echo "Erro ao pegar id do administrador" .$e->getMessage();      
    }
    
}

function ultimoLogin($id)
{
    $pdo = conectar();
    try
    {
        $ultimaVisita = $pdo->prepare("Select * from dados_login_administrador where dados_login_administrador = :dados_login order by dados_login_administrador_data DESC Limit 1,1");
        $ultimaVisita->bindValue(":dados_login", $id);
        $ultimaVisita->execute();
        $dados = $ultimaVisita->fetch(PDO::FETCH_ASSOC);
        return $dados['dados_login_administrador_id'];
    }catch(PDOException $e)
    {
     echo "Erro ao verificar último login" .$e->getMessage();      
    }
    
}

?>

