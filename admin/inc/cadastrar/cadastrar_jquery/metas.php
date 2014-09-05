<?php 
include "../../../functions/conexao/conexao.php";

$pdo = conectar();
$tipo = $_POST['escolhido'];

switch($tipo)
{
    case "description"
        : $meta = 1; break; 
    case "keywords" 
        : $meta = 2;
}

try{
	$verificarCadastro = $pdo->prepare("SELECT * FROM metas INNER JOIN metas_tipo 
		ON metas.meta_tipo = metas_tipo.metas_tipo_id WHERE  metas_tipo =:tipo");
	$verificarCadastro->bindValue(":tipo", $tipo);
	$verificarCadastro->execute();

	if ($verificarCadastro->rowCount() == 1)
		echo "Já existe uma meta para este campo";
	else {
		?>
                <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
                <script>
                    tinymce.init({selector:'textarea'});
                </script>
		<form action="" method="POST">
			<textarea name="metas"></textarea>
                        <input type="hidden" name="tipo" value="<?php echo $meta;?>"/>
                        <input type="submit" name="cadastrarMeta" value="cadastrar" class="bt_submit">
                </form>
		<?php	
	}


}catch(PDOException $e)
{
	echo "Erro ao verificar as metas";

}

