		/*
				Title: Funções para a pagina de Cadastro de Produto
				Author:Jean Fabrício
				Date:02/02/2014
		*/



	$(document).ready(function()
	{

		// realiza a busca ao carregar a pagina
			$("#resultado_busca").empty();
				valor_busca = $("#pesquisa").val();
				termo_busca = $("#termo_busca option:selected").val();		
					
					$.ajax({

						type:"POST",
						url:"../control/consulta_produto_control.php?buscarTudo", 
						data: {termo_busca:termo_busca,valor_busca:valor_busca},
												
					}).done(function(html){

						$("#resultado_busca").append(html);
					});
		//  realiza a busca ao clicar no botao buscar
			$("#buscar").on("click",function(){
				$("#resultado_busca").empty();
				valor_busca = $("#pesquisa").val();
				termo_busca = $("#termo_busca option:selected").val();		
					
					$.ajax({

						type:"POST",
						url:"../control/consulta_produto_control.php?buscaTermo", 
						data: {termo_busca:termo_busca,valor_busca:valor_busca},
												
					}).done(function(html){

						$("#resultado_busca").append(html);
					});
			});
		//  realiza a busca ao pressionar o enter
			$("#pesquisa").keypress(function(e){
				if(e.which == 13)
				{
					$("#resultado_busca").empty();
				valor_busca = $(this).val();
				termo_busca = $("#termo_busca option:selected").val();		
					
					$.ajax({

						type:"POST",
						url:"../control/consulta_produto_control.php?buscaTermo", 
						data: {termo_busca:termo_busca,valor_busca:valor_busca},
												
					}).done(function(html){

						$("#resultado_busca").append(html);
					});
				}

			});

	})// fim do document



			$(document).on('click','.editar',function()
			{

				
				var id = $(this).parents('tr').children('td:eq(2)').attr('id');
				

				$.ajax({

						type:'GET',
						url:'../control/consulta_produto_control.php?modal_search=true', 
						data: {codigo:id},
						dataType:'json',
						success: function(result)
						{
							

							$('#codigo').val(result.COD_PRODUTO);
							$('#nome_produto').val(result.NOME);
							$('#marca_busca').val(result.COD_MARCA);
							$('#fases').val(result.COD_FASE);
							$('#resistencia').val(result.RESISTENCIA);
							$('#pbrasil').val(result.PEDIGREE_BRASIL);
							var pelleted = result.PELETIZADA;
							if (pelleted == 1)
								$('#pel').prop('checked', true);
							else
								$('#nak').prop('checked', true);
							
							var organic = result.ORGANICA;
							if(organic == 1)
								$('#org').prop('checked', true);
							else
								$('#con').prop('checked', true);
						}
												
					});




			});



			$(document).on('click','#update',function(){
				param = $('form').serializeArray();

				valida = true;
				if($('#nome_produto').val() == '')
				{
					valida = false;
				}
				if(!valida)
				{
					novaMensagem('erro', 'Fill out all fields!');
					return 0;
				}
				$.ajax({

						type:'POST',
						url:'../control/consulta_produto_control.php?update', 
						data: param,
						success:function(html)
						{
							// $('#saida').append(html);

							if(parseInt(html,10)==1)
							{
								novaMensagem('sucesso','Updating Data!');
								$('#corp').empty();
								$('#corp').load('../view/view_consulta_produto.php');
							}
							if(parseInt(html,10)==0)
							{
								novaMensagem('erro','Could not update!');
							}
						}
												
					});
			});


