/*
		Title: Funções para o cadastro de especies
		Author:Jean Fabrício
		Date: 01/02/2014
*/

var validaGerente = false;
var validaNome = true;

		$(document).ready(function(){

		$("#gerente").focusin(function(){

			$.getJSON("../control/json_control.php?jsonFuncionario=true",function(data){

			// console.log(data);
	          var item = [];
	          $(data).each(function(key,value){
	          	
	            item.push(value.NOME);
	            // console.log(value.NOME);
	          });

	          $("#gerente").autocomplete(
	          {
					source: item,
					change: function (event,ui)
					{
						if(!ui.item){
							
						}
						else
							validaGerente = true;
					}				
					    
	          }).autocomplete("widget").addClass("fixed-height");
	      });

		});
		

			$("#save_especie").on("click",function(){

					valida = false;

					//verifica se o campo é vazio
					$("input").each(function(){

					 	if($(this).val() == "")
					 		valida =true;
					});
						

					if(valida)
					{
						novaMensagem("erro","Fill out all fields!");
						return 0;
					}
					else
					{
						if (validaNome)
						{
								nomeEspecie = $("#name_sp");
								$.ajax({

									type:"POST",
									url:"../control/especie_control.php?verifica_especie=true",
									data: nomeEspecie

								}).done(function(html){
									if(parseInt(html,10) == 1)
									{
										novaMensagem("erro","The specie already exists.");
									}						
									else if (validaGerente)
									{
										param = $("form").serializeArray();
										$.ajax({

											type:"POST",
											url:"../control/especie_control.php?cd_especie=true",
											data: param
											//success: function(){alert("Cadatro Realizado!");}
											
										}).done(function(html){

											// $("#saida").append(html);

											if(parseInt(html,10) == 1)
											{
												novaMensagem("sucesso","Species Registered!");

												$("input").each(function(){
														$(this).val('');
												});
											}
											else if(parseInt(html,10) == 0)
											{
												novaMensagem("erro","Unable to register the Species!!");
												
											}
											
										});

									}
									else
										novaMensagem("erro","This manager doen't exist !<br/> Make a register first");
							});
						}
					}
			});

			$("#resultado_busca").load("../control/especie_control.php?bc_especie=true");

		});