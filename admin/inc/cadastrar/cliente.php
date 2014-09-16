<?php 
unset($_SESSION);
if (isset($_POST['cadastrarCliente'])):
	global $obrigatorio;
	
	$nome = obrigatorio("nome",addslashes($_POST['nome']));
	$cidade = obrigatorio("cidade",addslashes($_POST['cidade']));
	$estado = obrigatorio("estado",addslashes($_POST['estado']));
	$bairro = obrigatorio("bairro",addslashes($_POST['bairro']));
	$cep = obrigatorio("cep",addslashes($_POST['cep']));
	$validouCep = validarCep($cep);
	$telefone = obrigatorio("telefone",addslashes($_POST['telefone']));
	validarTelefone($telefone);
	$celular = obrigatorio("celular",addslashes($_POST['celular']));
	validarTelefone($celular);
	$endereco = obrigatorio("endereco",addslashes($_POST['endereco']));
	$login = obrigatorio("login",addslashes($_POST['login']));
	$senha = obrigatorio("senha",addslashes($_POST['senha']));	

	//$cep = validarCep($_POST['cep']);

	criaSessao("nome",$nome);
	criaSessao("cidade",$cidade);
	criaSessao("estado",$estado);
	criaSessao("bairro",$bairro);
	criaSessao("cep",$cep);
	criaSessao("telefone",$telefone);
	criaSessao("celular",$celular);
	criaSessao("endereco",$endereco);


	global $validou;
	
	
	if (empty($obrigatorio)):
		if(empty($validou)):
			if (verificaCadastro("clientes","cliente_nome",$nome)):
				if 	(verificaCadastro("clientes","cliente_login",$login)):
					if(cadastrarCliente(array("nome"=>$nome,"cidade"=>$cidade,"estado"=>$estado,"bairro"=>$bairro,
					"cep"=>$cep,"telefone"=>$telefone,"celular"=>$celular,"endereco"=>$endereco,"login"=>$login, "senha"=>md5($senha)))):
						$mensagem = "cliente cadastrato com sucesso!";
					else:
						$erro = "Erro ao cadastrar cliente !";
					endif;
				else:	
						$erro = "Esse cliente já Existe!";
				endif;
			else:
						$erro = "Esse cliente já Existe!";
			endif;
		else:
			$erro = $validouCep;	
		endif;
	else:
		$erro = $obrigatorio;
		endif;	
	
endif;
?>


<div class="formularioCadastro">
<h2>.:Cadastrar Cliente</h2>
	
	<div class="formCadastro">
		<form action="" method="POST">
			<label for="categoria">Nome:</label>
			<input type="text" name="nome" value="<?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : ""; ?>" class="txt_field"/>*
			<label for="categoria">Cidade:</label>
			<input type="text" name="cidade" value="<?php echo isset($_SESSION['cidade']) ? $_SESSION['cidade'] : ""; ?>"  class="txt_field"/>*
			<label for="categoria">Estado:</label>
			<input type="text" name="estado" value="<?php echo isset($_SESSION['estado']) ? $_SESSION['estado'] : ""; ?>"  class="txt_field_menor"/>*
			<label for="categoria">Bairro:</label>
			<input type="text" name="bairro" value="<?php echo isset($_SESSION['bairro']) ? $_SESSION['bairro'] : ""; ?>"  class="txt_field"/>*
			<label for="categoria">Cep:</label>
			<input type="text" name="cep" value="<?php echo isset($_SESSION['cep']) ? $_SESSION['cep'] : ""; ?>"  class="txt_field_menor"/>*
			<label for="categoria">Telefone:</label>
			<input type="text" name="telefone" value="<?php echo isset($_SESSION['telefone']) ? $_SESSION['telefone'] : ""; ?>"  class="txt_field_menor"/>*
			<label for="categoria">Celular:</label>
			<input type="text" name="celular" value="<?php echo isset($_SESSION['celular']) ? $_SESSION['celular'] : ""; ?>" class="txt_field_menor"/>*
			<label for="categoria">Endereco:</label>
			<input type="text" name="endereco" value="<?php echo isset($_SESSION['endereco']) ? $_SESSION['endereco'] : ""; ?>" class="txt_field_maior"/>*
			<label for="categoria">Login:</label>
			<input type="text" name="login" class="txt_field"/>*
			<label for="categoria">Senha</label>
			<input type="text" name="senha" class="txt_field"/>*
			<label for="submit"></label>
			<input type="submit" name="cadastrarCliente" value="cadastrar" class="bt_submit"/>
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

