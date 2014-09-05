<?php 
//teste
session_start();

include_once 'functions/conexao/conexao.php';
include_once 'functions/login/login.php';


//$_SESSION['favcolor'] = 'green';


if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if (isset($_POST['logar'])){
		$login = addslashes($_POST['login']);
		$senha = addslashes($_POST['senha']);
		if(logar($login,$senha))
//			echo $_SESSION['cliente'];
			header("Location: inc/painel.php");
			//echo $_SESSION['cliente'];
			//echo 'logado';
		else
			echo "Login ou senha invalidos!";
	}
}
		

?>

<htlm>
<header>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>
		Adminstrador - Pizzaria da net
	</title>
	<link href="css/style_login.css" rel="stylesheet" type="text/css"/>	
</header>
<body>
	<div id="container">
			<div id="login">
					
					<div id="titulo">
						Administrador - Pizzaria da Net
					</div><!--TItulo-->
							
							<div id="cadeado">
								<img src="images/cadeado.png" title="login" alt="login administrador"/>
							</div><!--Cadead-->
							
							
							<div id="form_login">
								<form action="" method="POST">
									<label for="login_nome">Login:</label>
									<input type="text" name="login" class="input_text_login"></input>
							
									<label for="senha">Senha:</label>
									<input type="text" name="senha" class="input_text_login"></input><br>
							
									<input type="submit" name="logar" value="ok" id="botao_logar"/>
								</form>
							</div><!--Form login-->
							<div id="fix"></div>

			</div><!--Login-->
			 
	</div><!--Container-->

</body>
</htlm>