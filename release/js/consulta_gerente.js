/*

		Title: Js para gerenciar a busca de gerente 
		data: 04/06/2014
		author: Jean Fabricio
		email:jeanufu21@gmail.com
*/



$(document).ready(function(){


					$.ajax({

						type:"POST",
						url:"../control/consulta_gerente_control.php?acao=sem_botao",
						data:null,

					}).done(function(html){
						
						
						$("#gerente_body").append(html);
						
			        });


		$("#ver_gerente").on("click",function(){

				$("#gerente_body").empty();
				param = $("form").serializeArray();


				$.ajax({

						type:"POST",
						url:"../control/consulta_gerente_control.php?acao=botao",
						data:param,

					}).done(function(html){
						
						
						$("#gerente_body").append(html);
						
			        });

		});



					$(document).on('click','.editar',function(){

						nome_gerente  = $(this).parents('tr').children('th:first').text();
					
						nome_especie  = $(this).parents('tr').children().eq(1).html();
						

						var id = $(this).parents('tr').children('th:first').attr('id');
						var id_especie = $(this).parents('tr').children().eq(1).attr('id');

							$('#nome_label').text(nome_gerente);
							$('#especie_label').text(nome_especie);
							
							$('#funcionario').val(id);
							$('#codigo_especie').val(id_especie);
					
						
					});

					$(document).on('click','#update',function(){


							param = $('form').serializeArray();

							$.ajax({

							type:'POST',
							url:'../control/consulta_gerente_control.php?acao=editar',
							data:param,

						}).done(function(html){
							
							
							//$('#saida').append(html);
							if(parseInt(html,10) == 1)
							{
								novaMensagem('sucesso','The Data was updated!');
								$('#corp').load('../view/view_consulta_gerente.php');
								return 0;
							}
							else if(parseInt(html,10) == 0)
							{
								novaMensagem('erro','Operation failed!');
								return 1;
							}

						});
					});




		


		


});

