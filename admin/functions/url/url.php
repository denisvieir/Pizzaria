<?php

function carregaUrls($pagina)
{
	$caminho = str_replace("_", "/", $pagina);
		
	if (is_file($caminho.".php"))
		include_once $caminho.".php";
	else
		throw new Exception("Essa página não existe");


}

