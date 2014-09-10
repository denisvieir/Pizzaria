<?php

if (isset($_POST['alterarAdmin'])):
    $nomeAdministrador = obrigatorio("nome", $_POST['adminNome']);
    $loginAdministrador = obrigatorio("login", $_POST['adminLogin']);
    $senhaAdministrador = obrigatorio("senha", $_POST['adminSenha']);
    
    global $obrigatorio;
        
    if(empty($obrigatorio)):

        if(verificaCadastro("administrador", "administrador_nome", $nomeAdministrador)):
            if (verificaCadastro("administrador", "administrador_login", $loginAdministrador)):

                if(alterarAdministrador($dadosAdministrador = array(
                    "nome" => $_POST['adminNome'],
                    "login" => $_POST ['adminLogin'],
                    "senha" => $_POST ['adminSenha']
                ), $_POST['id'])):
                    $mensagem = "Administrador alterado com sucesso !";
                else:
                    $erro = "Erro ao alterar administrador";
                    
                endif;
            else: 
                $erro = "Já existe administrador com esse Login !";

            endif;

        else: 
            $erro = "Já existe administrador com esse Nome !";

        endif;
    else:
        $erro = $obrigatorio;            
    endif;
    
endif;

require_once '../bibliotecas/Pager/Pager.php';
require_once '../bibliotecas/Pager/Common.php';                                    
require_once '../bibliotecas/Pager/Jumping.php';

$dadosAdministrador = listar("administrador");

?>
<div class="formularioAlterar">
    <h2>.:ALTERAR ADMINISTRADOR:.</h2>
<table width="600">
    <tr class="cabecalho">
        <td>Nome</td>
        <td>Usuário</td>
        <td>Senha</td>
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

				<input type="hidden" value="<?php echo $d['administrador_id'];?>" name="id"/>
            <td><input type="text" value="<?php echo $d['administrador_nome'];?>" name="adminNome" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['administrador_login'];?>" name="adminLogin" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['administrador_senha'];?>" name="adminSenha" class="input_text"/></td>
            <td><input type="submit" name="alterarAdmin" value="Alterar" class="input_button"></td>
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