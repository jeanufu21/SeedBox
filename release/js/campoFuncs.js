		/*
				Title: Funções para o cadastro de campo
				Author:washington soares
				Date: 07/04/2014
				*/

				$(document).ready(function(){

			$('.coordinate').mask('+099.00000', {translation:  {'+': {pattern: /[-+]/, optional: true}}});

			$("#vai").on("click",function(){

				
				if($("#nome_campo ").val() == "")
				{
					novaMensagem("erro","Field 'Name' is required!");
					return 0;
				}
					
				if($("#city").val() == "")
				{
					novaMensagem("erro","Field 'City' is required!");
					return 0;
				}
				if($("#uf").val() == "")
				{
					novaMensagem("erro","Field 'UF' is required!");
					return 0;
				}
					
					// validateFields("#new_countryside");


			// 	dados = $("#new_countryside").serializeArray();

			// 	$.ajax({

			// 		type:"POST",
			// 		url:"../control/campo_control.php?acao=cadastrar",
			// 		data: dados,
			// 	}).done(function(html){
			// 		if(parseInt(html,10)== -1)
			// 		{
			// 			novaMensagem("erro","This countryside already exists!");
			// 			return 0;
			// 		}
			// 		if(parseInt(html,10) == 1)
			// 		{
			// 			novaMensagem("sucesso","Countryside Registred!");
			// 			$("input[type=text],input[type=password]").each(function(){

			// 				$(this).val('');
			// 			});


			// 		}
			// 		else if(parseInt(html,10) == 2)
			// 			novaMensagem("erro","Error:Unable to register the Countryside!");
			// 	});


			});


	});
