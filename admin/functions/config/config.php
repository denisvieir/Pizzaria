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
	
        $pastas = explode(PATH_SEPARATOR, get_include_path());
        $caminhos = count($pastas);

	if (!is_null($includes)):
		if(is_array($includes)):
			foreach ($includes as $inc):
                            for($i=0; $i < $caminhos; $i++):
                                if (file_exists($pastas[$i]. $inc .".php")):
                                    include_once $pastas[$i]. $inc .".php";  
                                endif;
                            endfor;
				//include $inc .".php";
			endforeach;			
		else:
			throw new Exception("O parametro passado não é um array");
		endif;
	else:
		throw new Exception("Nenhum parametro foi passado para a função");
	endif;

}

