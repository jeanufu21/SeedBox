$(document).ready(function(){


				$.ajax({

					type:"POST",
					url:"../control/consulta_user_control.php?sem_botao",
					data:null,

				}).done(function(html){
					
					
					$("#usuario_body").append(html);
					
		        });



			$("#ver_usuarios").on("click",function(){

				$("#usuario_body").empty();


				var nome_buscado = $("#busca_nome").val();

					$.ajax({

								type:"POST",
								url:"../control/consulta_user_control.php?busca",
								data:{nome_buscado:nome_buscado},

							}).done(function(html){
								
								
								$("#usuario_body").append(html);
								
					        });




				});





			$("#atualizar").on("click",function(){

					var validacao = false;

					$("#caixa_modal input[type=text]").each(function(){

						if($(this).val() == "")
						{
							validacao = true;

						
						}


					});

					if(validacao)
					{
							novaMensagem("erro","Please, Fill out all fields!");
							return false;
					}


					var param = $("form").serializeArray();

					$.ajax({

								type:"POST",
								url:"../control/consulta_user_control.php?editar_user",
								data:param

							}).done(function(html){
								
								if(parseInt(html,10) == 1)
								{
									novaMensagem("sucesso","Completed update!");
									$("#corp").empty();
									$("#corp").load("../view/view_consulta_user.php");

								}
								if(parseInt(html,10) == 0)
								{
									novaMensagem("erro","Operation failed!");
								}
								
								
					        });



			});



			


});