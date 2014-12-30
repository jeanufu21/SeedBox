		/*
				Title: Funções para o cadastro de parceiro
				Author:Tacio medeiros
				Date: 14/03/2014
		*/

		$(document).ready(function(){


		$("#enviaFuncionario").on("click",function(){

					dados = $("#formInsertUser").serializeArray();
					
					validacao = false;
					

					$("input[type=text]").each(function(){
						if($(this).val() == '')
							validacao = true;
					});

					validacaoRadio = true;

					$("input[type=radio]").each(function(){

						if($(this).is(":checked"))
							validacaoRadio = false;
					});

					var valor_senha1 = $("#senha_funcionario").val();
					var valor_senha2 = $("#confirma_senha_funcionario").val();

					if(valor_senha1 != valor_senha2){
						novaMensagem("erro","Passwords do not match!");
						return 0;
					}


					if(validacao || validacaoRadio)
					{
						novaMensagem("erro","Fill out all fields!");

						return 0;
					}


				$.ajax({

						type:"POST",
						url:"../control/funcionario_control.php?acao=cadastrar",
						data: dados,
						cache:false,
						
					}).done(function(html){
						if(parseInt(html,10) == 1)
						{
							novaMensagem("sucesso","User Joined!");
							$("input[type=text],input[type=password]").each(function(){

								$(this).val('');
							});
						}
						else if(parseInt(html,10) == 2)
						novaMensagem("erro","Error:Unable to register the User!");
						else if(parseInt(html,10) == 3)
						novaMensagem("erro","Error:This login already exist!");
					});

				

				return 0;

			});
			

		});

