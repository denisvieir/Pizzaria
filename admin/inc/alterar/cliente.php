<?php

if (isset($_POST['alterarAdmin'])):
    $nomeCliente = obrigatorio("nome", $_POST['clienteNome']);
    $cidadeCliente = obrigatorio("nome", $_POST['clienteCidade']);
    $estadoCliente = obrigatorio("nome", $_POST['clienteEstado']);
    $bairroCliente = obrigatorio("nome", $_POST['clienteBairro']);
    $cepCliente = obrigatorio("nome", $_POST['clienteCep']);
    $telefoneCliente = obrigatorio("nome", $_POST['clienteTelefone']);
    $enderecoCliente = obrigatorio("nome", $_POST['clienteEndereco']);
    $loginCliente = obrigatorio("login", $_POST['clienteLogin']);
    $senhaCliente = obrigatorio("senha", $_POST['clienteSenha']);
    
    global $obrigatorio;
        
    if(empty($obrigatorio)):

        if(verificaCadastro("clientes", "cliente_nome", $nomeCliente)):
            if (verificaCadastro("clientes", "cliente_login", $loginCliente)):

                if(alterarCliente($dadosCliente = array(
                    "nome" => $_POST['clienteNome'],
                    "cidade" => $_POST['clienteCidade'],
                    "estado" => $_POST['clienteEstado'],
                    "bairro" => $_POST['clienteBairro'],
                    "cep" => $_POST['clienteCep'],
                    "telefone" => $_POST['clienteTelefone'],
                    "endereco" => $_POST['clienteEndereco'],
                    "login" => $_POST ['clienteLogin'],
                    "senha" => $_POST ['clienteSenha']
                ), $_POST['id'])):
                    $mensagem = "Cliente alterado com sucesso !";
                else:
                    $erro = "Erro ao alterar Cliente";
                    
                endif;
            else: 
                $erro = "Já existe um cliente com esse Login !";

            endif;

        else: 
            $erro = "Já existe um cliente com esse nome !";

        endif;
    else:
        $erro = $obrigatorio;            
    endif;
    
endif;

require_once '../bibliotecas/Pager/Pager.php';
require_once '../bibliotecas/Pager/Common.php';                                    
require_once '../bibliotecas/Pager/Jumping.php';

$dadosAdministrador = listar("clientes");

?>
<div class="formularioAlterar">
    <h2>.:ALTERAR CLIENTE:.</h2>
<table>
    <tr class="cabecalho">
        <td>Nome</td>
        <td>Cidade</td>
        <td>Estado</td>
        <td>Bairro</td>
        <td>Cep</td>
        <td>Telefone</td>
        <td>Celular</td>        
        <td>Endereço</td>        
        <td>Login</td>
        <td>Senha</td>
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

				<input type="hidden" value="<?php echo $d['cliente_id'];?>" name="id"/>
            <td><input type="text" value="<?php echo $d['cliente_nome'];?>" name="clienteNome" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_cidade'];?>" name="clienteCidade" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_estado'];?>" name="clienteEstado" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_bairro'];?>" name="clienteBairro" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_cep'];?>" name="clienteCep" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_telefone'];?>" name="clienteTelefone" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_celular'];?>" name="clienteCelular" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_endereco'];?>" name="clienteEndereco" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_login'];?>" name="clienteLogin" class="input_text"/></td>
            <td><input type="text" value="<?php echo $d['cliente_senha'];?>" name="clienteSenha" class="input_text"/></td>
            <td><input type="submit" name="alterarAdmin" value="Alterar" class="input_button"></td>
        </tr>
    </form>
    <?php endforeach;?>
    
    <tr>
        <td colspan="10" align="center">
            <?php
            $links = $pager->getLinks();
            echo $links['all'];
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="10" align="center">
            <?php echo isset($mensagem) ? '<div class="mensagem">'.$mensagem.'</div>' : "";?>
            <?php echo isset($erro) ? '<div class="erro">'.$erro.'</div>' : "";?>
        </td>
    </tr>
</table>
</div>