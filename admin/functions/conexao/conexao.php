<?php
  //Conexao com o BD de dados
		define ("USER", "root");
		define ("PASS", "");
		define ("HOST", "localhost");
		define ("DBNAME", "pizzaria");
	

	function conectar()
	{ 
		$dsn = "mysql:host=". HOST .";dbname=". DBNAME ."";

		try{
			$conectar = new PDO($dsn, USER , PASS);
			$conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		}catch(PDOException  $ex)
		{
			echo "Erro ao conectar: ".$ex->getMessage();
		}

		return $conectar;
	}


?> 
