<?php
//define ("PATH_INCLUDE",null);

function carregaIncludes($includes=null,$modo)
{

	if($modo != null){
		if($modo == "login")
			define ("PATH_INCLUDE","functions/");
		elseif($modo =='admin')
			define ("PATH_INCLUDE","../functions/");
	}		
	else	
		throw new Exception ("O parametro não pode ser nulo");
	
	
	 set_include_path(PATH_INCLUDE."conexao/".PATH_SEPARATOR.PATH_INCLUDE."login/".
		PATH_SEPARATOR.PATH_INCLUDE."url/".PATH_SEPARATOR.PATH_INCLUDE."cadastrar/"
		.PATH_SEPARATOR.PATH_INCLUDE."helpers/".PATH_SEPARATOR.PATH_INCLUDE."alterar/");
	 

	if (!is_null($includes)):
		if(is_array($includes)):
			foreach ($includes as $inc):
				include $inc .".php";
			endforeach;			
		else:
			throw new Exception("O parametro passado não é um array");
		endif;
	else:
		throw new Exception("Nenhum parametro foi passado para a função");
	endif;

}

