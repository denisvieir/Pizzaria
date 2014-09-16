<?php

if (isset($_POST['alterarCategoria'])):
    $nomeCategoria = obrigatorio("nome", $_POST['categoriaNome']);
    
    
    global $obrigatorio;
        
    if(empty($obrigatorio)):

        if(verificaCadastro("categorias", "categoria_nome", $nomeCategoria)):
                if(alterarCategoria($_POST['categoriaNome'], $_POST['id'])):
                    $mensagem = "Categoria alterada com sucesso !";
                else:
                    $erro = "Erro ao alterar categoria";
                    
                endif;
        else: 
            $erro = "Já existe uma categoria com esse nome !";
        endif;
    else:
        $erro = $obrigatorio;            
    endif;
    
endif;

require_once '../bibliotecas/Pager/Pager.php';
require_once '../bibliotecas/Pager/Common.php';                                    
require_once '../bibliotecas/Pager/Jumping.php';

$dadosAdministrador = listar("categorias");

?>
<div class="formularioAlterar">
    <h2>.:ALTERAR CATEGORIA:.</h2>
<table>
    <tr class="cabecalho">
        <td>Nome</td>
        <td>Alterar</td>
        
    </tr>
    
    <?php
    $params = array(
        'mode' => 'Jumping',
        'perPage' => 10,
        'delta' => 5,
        'itemData' => $dadosAdministrador
    );

    $pager = @Pager::factory($params);
    //$pager = & Pager::factory($params);
    $data  = $pager->getPageData();
    
        foreach ($data as $d):
    ?>
    <form action="" method="POST">
        <tr>

				<input type="hidden" value="<?php echo $d['categoria_id'];?>" name="id"/>
            <td><input type="text" value="<?php echo $d['categoria_nome'];?>" name="categoriaNome" class="input_text2"/></td>            
            <td><input type="submit" name="alterarCategoria" value="Alterar" class="input_button"></td>
        </tr>
    </form>
    <?php endforeach;?>
    
    <tr>
        <td colspan="4" align="center">
            <?php
            $links = $pager->getLinks();
            echo $links['all'];
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" align="center">
            <?php echo isset($mensagem) ? '<div class="mensagem">'.$mensagem.'</div>' : "";?>
            <?php echo isset($erro) ? '<div class="erro">'.$erro.'</div>' : "";?>
        </td>
    </tr>
</table>
</div>