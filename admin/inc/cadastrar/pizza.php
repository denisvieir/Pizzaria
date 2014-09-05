<?php
require_once "../bibliotecas/lib/WideImage.php"; 
//include_once "../../bibliotecas/lib/WideImage.php";
unset($_SESSION);
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrarPizza'])):


	$categoriaPizza = obrigatorio("categoria", $_POST['categoria']);	 
	$nomePizza = obrigatorio("nome da pizza", $_POST['nome']);	
	$precoPizza = obrigatorio("preco", $_POST['nome']);	
	$fotoPizza = obrigatorio("foto", $_FILES['foto_pizza']['name']);
	$descricaoPizza = obrigatorio("descricao", $_POST['descricao']);

	criaSessao("nomePizza",$nomePizza);
	criaSessao("precoPizza",$precoPizza);
	criaSessao("descricaoPizza",$descricaoPizza);

	global $obrigatorio;

	if(empty($obrigatorio)){

                $foto = $_FILES['foto_pizza']['name'];
                $temp = $_FILES['foto_pizza']['tmp_name'];
          try{
                $fotos = WideImage::load($temp);
                $redimensionar = $fotos->resize(104,80,"fill");
                $redimensionar->saveToFile("../../fotos/".$foto);

                if($redimensionar->isValid())
                {
                    $redimensionar = $fotos->resize(270,210,"fill");
                    $redimensionar->saveToFile("../../detalhes/".$foto);
                    if (verificaCadastro("pizzas", "pizza_nome", $_POST['nome'])){
                        
                            if(cadastrarPizza($dadosPizza = array("categoria" => $_POST['categoria'],
                                "nome" => $_POST['nome'],
                                "preco" => $_POST['preco'],
                                "descricao" => $_POST['descricao'],
                                "foto_inicio" => "fotos/".$foto,
                                "foto_detalhe" => "detalhes/".$foto)))
                                $mensagem = "Pizza cadastrada com sucesso!"; 
                            else
                                $erro = "Erro a cadastrar pizza!.";
                    }else
                        $erro = "Pizza já cadastrada!.";            
                }else
                    throw new Exception ("Não foi possível carregar a imagem");
          }catch(WideImage_Exception $e)
            {
                    echo "Erro:".$e->getMessage();
            }        
        }else
            $erro = $obrigatorio;
	
	

endif;
?>

<div class="formularioCadastro">
<h2>.:Cadastrar Pizza:.</h2>
	
	<div class="formCadastro">
		<form action="" method="POST" enctype="multipart/form-data">
			<label for="categoria">Categoria:</label>
				<select name="categoria">
					<option value="" selected="selected">Escolha uma categoria</option>
					<?php
					$dados = listar("categorias");
					if($dados):
						foreach ($dados as $d):
							?>
								<option value="<?php echo $d['categoria_id']; ?>"><?php echo $d['categoria_nome']; ?></option>
							<?php
						endforeach;
					else:?>
						<option value="" selected="selected">Nenhuma categoria cadastrada</option>
					<?php
					endif;
					?>
				</select>

			<label for="nome">Nome da pizza:</label>
			<input type="text" name="nome" value="<?php echo isset($_SESSION['nomePizza']) ? $_SESSION['nomePizza'] : ""; ?>"  class="txt_field"/>

			<label for="preco">Preco da pizza:</label>
			<input type="text" name="preco" class="txt_field" value="<?php echo isset($_SESSION['precoPizza']) ? $_SESSION['precoPizza'] : ""; ?>"/>

			<label for="nome">Foto da pizza:</label>
			<input type="file" name="foto_pizza" class="txt_field"/>

			<label for="nome"></label>
                        <textarea name="descricao">
                            <?php echo isset($_SESSION['descricaoPizza']) ? $_SESSION['descricaoPizza'] : ""; ?>
                        </textarea>

			
			<label for="submit"></label>
			<input type="submit" name="cadastrarPizza" value="cadastrar" class="bt_submit"/>
			<input type="submit" name="limparCampos" value="Limpar Formulário" class="bt_submit"/>
		</form>
	</div>
	
	<?php echo isset($mensagem) ? '<div class="mensagem">'.$mensagem.'</div>' : "";?>
	<?php echo isset($erro) ? '<div class="erro">'.$erro.'</div>' : "";?>
	
	<?php
	//Para limpar Formulario
	if(isset($_POST['limparCampos']))
		unset($_SESSION);
	?>

</div>