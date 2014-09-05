<h2>Pagina inicial do sistema administrativa</h2>
<div id="bemvindo">
<p>
	<?php $id = pegaIdAdministrador($_SESSION['administrador']);?>
	Bem vindo <?php echo $_SESSION['administrador'];?>, seu último login foi em: 
<span id="ultimoLogin">
<?php 
	$dataLogin = ultimoLogin($id);
	if(empty($dataLogin))
		echo "é seu primeira login";
	else
		echo date("d/m/Y h:i:s", strtotime(ultimoLogin($id)));
?>
</p>
</span><!--UltimoLogin-->
</div>