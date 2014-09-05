<?php 
   if (isset($_POST['cadastrarMeta']))
   {
       
       if(verificaCadastro("metas", "meta_tipo", $_POST['meta']))
        {
           echo 'toaqui';
            /*if (cadastrarMetas($_POST['meta'], $_POST['metas']))
                $mensagem = 'Meta cadastrada com sucesso';                
            else
                $erro = 'Erro ao cadastrar Meta! '; */
        }
        else
            $erro = "Já existe uma meta cadastrada";       
   }
?>

<div class="formularioCadastro">

<h2>Cadastrar Meta Tags</h2>
<p>Escolha qual metatag você quer cadastrar</p>
	<div id="metas">
		<form action="" method="POST">
			<label for="description">Description</label>
			<input type="radio" name="meta" value="description" checked="checked">

			<label for="description">Keywords</label>
			<input type="radio" name="meta" value="keywords" >
		</form>
	</div>
	<div id="resposta"></div>
        
        <?php echo isset($mensagem) ? '<div class="mensagem">'.$mensagem.'</div>' : "";?>
	<?php echo isset($erro) ? '<div class="erro">'.$erro.'</div>' : "";?>
	
</div>