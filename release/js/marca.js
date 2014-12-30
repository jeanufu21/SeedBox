/*
		Title:Jquery para o cadastro de Marcas
		Author:Jean Fabrício
		Date: 03/03/2014
*/


$(document).ready(function(){

	$("#enviar").on("click",function(){

			validacao = false;

			$("input").each(function(){

				if($(this).val() == "")
				validacao = true;
			});

			if(validacao)
			{
				novaMensagem("erro","Fill out all fields!");
				return 0;
			}

			param = $("form").serializeArray();

				$.ajax({

						type:"POST",
						url:"../control/marca_control.php?acao=cadastrar",
						data:param,
						//success: function(){alert("Cadatro Realizado!");}
						
					}).done(function(html){
						if(parseInt(html,10) == 1)
						{
							novaMensagem("sucesso","Brand Registred!");
							$("input").each(function(){
								$(this).val('');
							});
							
							
						}
						else if(parseInt(html,10) == 2)
						novaMensagem("erro","Error:Unable to register the brand!");
					});

				
	});



});