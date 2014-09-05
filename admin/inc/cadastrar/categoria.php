<?php 
unset($_SESSION);
if (isset($_POST['cadastrarCategoria']) && $_POST['categoria'] != ''):
	$categoria = addslashes($_POST['categoria']);
	
	criaSessao("categoria",$categoria);
	global $obrigatorio;
	

	if (verificaCadastro("categorias","categoria_nome",$categoria)):	
		if(cadastrarCategoria($categoria)):
			$mensagem = "Categoria cadastrata com sucesso!";
		else:
			$erro = "Erro ao cadastrar categoria !";
		endif;
	else:	
		$erro = "Essa categoria já Existe";
	endif;
endif;
?>

<div class="formularioCadastro">
<h2>.:Cadastrar Categoria</h2>
	
	<div class="form">
		<form action="" method="POST">
			<label for="categoria" >Categoria:</label>
			<input type="text" name="categoria" value="<?php echo isset($_SESSION['categoria']) ? $_SESSION['categoria'] : ""; ?>"  class="txt_field"/>
			<label for="submit"></label>
			<input type="submit" name="cadastrarCategoria" value="cadastrar" class="bt_submit"/>
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

</div>