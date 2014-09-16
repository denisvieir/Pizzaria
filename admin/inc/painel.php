<?php

session_start();

//include_once '..functions/conexao/conexao.php';
//include_once '..functions/login/login.php';

include_once '../functions/config/config.php';

try
{
    carregaIncludes(array("conexao","login","url","categoria", "utils","administrador","cliente","pizza","metas"),"admin");
}catch(Exception $e)
{
	echo $e->getMessage();
}

verificaLogado('logado_admin');

?>
<html>
<head>

	<title>Administrador - Pizzaria</title>
	<link href="../css/style_painel.css" rel="stylesheet" type="text/css"/>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script type="text/javascript" src="../js/meta.js"></script>
        <meta charset="utf-8">
	<script>
        tinymce.init({selector:'textarea'});
	</script>


</head>
	<body>
		<div id="container">
			<div id="header">
				<div id="logo">
					Pizzaria de Net<br/>
						<span id="sublogo">A melhor pizzaria da cidade</span><!--SUBLOGO-->
				</div><!--LOGO-->
				
				
				<div id="busca">
					<form action="" method="POST">
						<input type="text" name="busca" id="txt_busca"/>
						<input type="submit" name="buscar" value="ok" id="bt_busca"/>
					</form>	
					<div id="lupa"><img src="../images/lupa.png"></div><!--LUPA-->
				</div><!--BUSCA-->
			</div><!--HEADER-->
			
			<div id="conteudo">
				<div id="menuLateral">
					<ul>
						<li><a href="?p=cadastrar_pizza">Cadastrar Pizza</a></li>
						<li><a href="?p=cadastrar_cliente">Cadastrar Cliente</a></li>
						<li><a href="?p=cadastrar_categoria">Cadastrar categoria</a></li>
						<li><a href="?p=cadastrar_administrador">Cadastrar administrador</a></li>
						<li><a href="?p=cadastrar_metas">Cadastrar metas</a></li>
					</ul>
					<br>
					<ul>
						<li><a href="?p=alterar_pizza">Alterar Pizza</a></li>
						<li><a href="?p=alterar_foto">Alterar Foto</a></li>
						<li><a href="?p=alterar_cliente">Alterar Cliente</a></li>
						<li><a href="?p=alterar_categoria">Alterar Categoria</a></li>
						<li><a href="?p=alterar_administrador">Alterar Administrador</a></li>
                                                <li><a href="?p=alterar_metas">Alterar Metas</a></li>
					</ul>
					<br>
					<ul>
						<li><a href="?p=deletar_pizza">Deletar Pizza</a></li>
						<li><a href="">Deletar Foto</a></li>
						<li><a href="">Deletar Cliente</a></li>
						<li><a href="">Deletar categoria</a></li>
					</ul>
					<br>
					<ul>
						<li><a href="">Relatorio  dos Pedidos</a></li>
						<li><a href="">Relatorio dos clientes</a></li>
						<li><a href="">E-mails recebidos</a></li>
						<li><a href="">Aniversariantes</a></li>
					</ul>

				</div>
				<div id="conteudoAdmin">
				<?php 
				if(isset($_GET['p']))
				{
					try{
						$valor = $_GET['p'];
						carregaUrls($valor);						
					}catch(Exception $e)
					{
						echo $e->getMessage();
					}
				}
				else
					include_once "home.php";
				?>
				</div>		
			</div>
			
			<div id="fix"></div>
			
			<div id="rodape">
			Pizzaria da net <?php echo date("Y"); ?>
			</div><!--RODAPE-->
		</div><!--Container-->
	</body>
</html>