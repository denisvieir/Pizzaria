<?php

require_once '../bibliotecas/Pager/Pager.php';
require_once '../bibliotecas/Pager/Common.php';                                    
require_once '../bibliotecas/Pager/Jumping.php';

$dadosAdministrador = listar("administrador");

?>

<table width="600">
    <tr>
        <td>Nome</td>
        <td>Usuário</td>
        <td>Senha</td>
    </tr>
    
    <?php
    $params = array(
        'mode' => 'Jumping',
        'perPage' => 3,
        'delta' => 2,
        'itemData' => $dadosAdministrador
    );
    $pager = @Pager::factory($params);
    //$pager = & Pager::factory($params);
    $data  = $pager->getPageData();
    foreach ($data as $d):
    ?>
    <form action="">
        <tr>
            <td><?php echo $d['administrador_nome'];?></td>
            <td></td>
            <td></td>
        </tr>
    </form>
    <?php endforeach;?>
    
</table>
