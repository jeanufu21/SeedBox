

$(document).ready(function(){

	$("#pesquisar").on("click",function(e){

		
			$("#itens_estoque").empty();
			// var value_check_select = new Array();
			// value_check_select.push($(this).val());
		$("input[type=checkbox]:checked").each(function(){

			$(this).attr("name","tipo_pesquisa[]");

		});


		var filtros = Array();



		var pesquisa = $("form").serializeArray();

			
			        $.ajax({

						type:"POST",
						url:"../control/pedido_gerente_control.php?acao=pesquisa_estoque",
						data:pesquisa,

					}).done(function(html){
						if(parseInt(html,10) == 0 || parseInt(html,10) == -1)
						{
							novaMensagem("erro","Data not found");
							return 0;

						}
						else if(parseInt(html,10) == -2)
						{
							msg = "Write the key words separated with commas:Example 'MKS,Capitao'";

							novaMensagem("erro",msg);
							return 0;
						}
						
						$("#itens_estoque").append(html);
						
			        });
			
				
		

	});


});


