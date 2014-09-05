$(document).ready(function(){
	$("input[type=radio][name=meta]").click(function(){
		var escolhido = $(this).val();		
		$.ajax({
			type:"post",
			data:"escolhido="+escolhido,
			url: "cadastrar/cadastrar_jquery/metas.php",
			success:function(resposta){
				$("#resposta").html(resposta);
			}
		});

	});
});