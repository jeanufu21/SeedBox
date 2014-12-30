/*
Title: Funções para a pagina de Cadastro de Produto
Author:Jean Fabrício
Date:22/02/2014

*/


$(document).ready(function()
{

$("#set").change(function(){

	
		$("#outros_param").empty();
		var tags = "<br><br>";
		$("#outros_param").append(tags);
		

		ajax_especie = $("#especie_busca option:selected").val();
		$.ajax({

			type:"POST",
			url:"../control/constroi_param_control.php", 
			data: {especie_busca:ajax_especie}
									
		}).done(function(html){

			$("#outros_param").append(html);
		});

});//fim da funcão constroi Parametros

$("#cd_produto").on("click",function(){

		validacao = false;
	
	if($("#outros_param div").length == 0)
	{
		novaMensagem("erro","Please configure the set of the parameters!");
		return 0;
	}
	$("input[type=text]:not(.fbrand,#resistence)").each(function(){

		if($(this).val() == "")
		{
			validacao = true;	
			return 0;
		}
	});

	$("select").each(function(){

		if($(this).val() == "")
		{
			novaMensagem("erro","Please! Select an brand");
			return 0;
		}
	});


	if($('#fbrand').val() == "")
		{
			novaMensagem("erro","Please! Select an brand");
			return 0;
		}

	if(validacao){
		novaMensagem("erro","Fill out all fields!");
		return;
		}

		valor_form = $("form").serializeArray();

		$.ajax({

		type:"POST",
		url:"../control/produto_control.php?cd_produto=true",
		data: valor_form
								
	}).done(function(html){
		// $("#saida").append(html);
		
	
		if(parseInt(html,10) == 1)
		{
			$("input:not(.fbrand,.radios),textarea").each(function(){

				$(this).val('');
			});
			// $("#outros_param").empty();
			novaMensagem("sucesso","Registered product");
			return 0;
		}
		else if(parseInt(html,10) == 0)
		{
			novaMensagem("erro","Failed to register the product");
			return 0;
		}
		else if(parseInt(html,10) == -1){
			novaMensagem("erro","There is already an Original Pedigree or  Brazilian Pedigree with that name.");
			return;
		}
	});

	
});// fim da funcao cadastro de produto

$("#obrand").change("click",function(){
		ajax_marca = $("#obrand option:selected").val();
		
		$.ajax({

			type:"POST",
			url:"../control/produto_control.php?marca=true", 
			data: {marca_busca:ajax_marca}
									
		}).done(function(html){

			 $("#fbrand").attr("value",html);
			 // $("#saida").append(html);
		});

});//fim da funcão constroi Parametros

});// fim do document