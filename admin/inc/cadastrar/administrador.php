<?php 
unset($_SESSION);
if (isset($_POST['cadastrarAdministrador']) && $_POST['cadastrarAdministrador'] != ''):
	$nome = obrigatorio("nome",addslashes($_POST['nome']));
	$login = obrigatorio("login",addslashes($_POST['login']));
	$senha = obrigatorio("senha",addslashes($_POST['senha']));
	

	criarSessao("nomeAdmin", $nome);
	criarSessao("loginAdmin", $login);
	criarSessao("senhaAdmin", $senha);

	global $obrigatorio;

	if (empty($obrigatorio)):
		if (verificaCadastro("administrador","administrador_nome",$nome)):
			if 	(verificaCadastro("administrador","administrador_login",$login)):
				if(cadastrarAdministrador(array("nome"=>$nome, "login"=>$login, "senha"=>md5($senha)))):
					$mensagem = "administrador cadastrato com sucesso!";
				else:
					$erro = "Erro ao cadastrar administrador !";
				endif;
			else:	
					$erro = "Esse login já Existe!";
			endif;
		else:
					$erro = "Esse administrador já Existe!";
		endif;
	else:
		$erro = $obrigatorio;	
	endif;	
endif;
?>


<div class="formularioCadastro">
<h2>.:Cadastrar Administrador</h2>
	
	<div class="formCadastro">
		<form action="" method="POST">
			<label for="categoria">Nome:</label>
			<input type="text" name="nome" class="txt_field" value="<?php echo isset($_SESSION['nomeAdmin']) ? $_SESSION['nomeAdmin'] : ""; ?>" />*
			<label for="categoria">Login:</label>
			<input type="text" name="login" class="txt_field" value="<?php echo isset($_SESSION['loginAdmin']) ? $_SESSION['loginAdmin'] : ""; ?>" />*
			<label for="categoria">Senha</label>
			<input type="text" name="senha" class="txt_field" value="<?php echo isset($_SESSION['senhaAdmin']) ? $_SESSION['senhaAdmin'] : ""; ?>" />*
			<label for="submit"></label>
			<input type="submit" name="cadastrarAdministrador" value="cadastrar" class="bt_submit"/>
			<input type="submit" name="limparCampos" value="Limpar Formulário" class="bt_submit"/>
		</form>
	</div>
	
	<?php echo isset($mensagem) ? '<div class="mensagem">'.$mensagem.'</div>' : "";?>
	<?php echo isset($erro) ? '<div class="erro">'.$erro.'</div>' : "";?>

	<?php
	//Para limpar Formulario
	if(isset($_POST['limparCampos']))
		unset($_SESSION);
	?>
	
	<div class="obrigatorio">*Campos Obrigatorios</div>


</div>