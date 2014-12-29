/*
		JS para a nota fiscal
		Author: Jean Fabrício
		Date:22/03/2014
*/

$(document).ready(function(){

/*
	A variavel acao corresponde a um controle que informa que 
	a pagina foi invocada a partir de pedidos consolidados.
*/

	

	 $(".somenteNumero").bind("keyup", function(){
        var expre = /[^0-9,.]/g;

        // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
        if ($(this).val().match(expre))
            $(this).val($(this).val().replace(expre,''));
    });


	if($("#acao").val() != null)
	{

		// busca todos os produtos para mostrar na autocomplete
			$(".produtoGeral").focusin(function(){

				nomeProduto = $("#produto_name1").text();
				
				$.getJSON("../control/json_control.php?produto="+nomeProduto,function(data){

						// console.log(data);
				          var item = [];
				          $(data).each(function(key,value){
				          	
				            item.push(value.NOME);
				            // console.log(value.NOME);
				          });

				          $(".produtoGeral").autocomplete(
				          {
								source: item
								    
								    
				          }).autocomplete("widget").addClass("fixed-height");
				      });

			});

		    // preenche os dados do parceiro e os itens da nota a partir do xml linkado com o pedido
			$("#parceiro").load("../control/notafiscal_control.php?acao=preencheParceiro");

			$.ajax({

				type:"GET",
				url:"../control/notafiscal_control.php?acao=preencheItensNota", 
				
										
			}).done(function(html){

				$("#itens_nota").append(html);

				cont = 0;
					$('.valor').each(function(){

						acount = parseFloat($(this).parents("tr").children("th").children(".account").val());

						preco = parseFloat($(this).val());

						resultado = acount * preco;

						if($(this).val() != '')
						cont+= resultado;

					});
					 cont = cont.toFixed(2);
						

						$('#precofinal').text(cont);
						$('#precofinal_hidden').val(cont);
			});

			// função que retorna na nota a data em que o pedido foi realizado.

			$.ajax({

				type:"GET",
				url:"../control/notafiscal_control.php?acao=dataPedido", 
				
										
			}).done(function(html){

				$("input[name=dataPedido]").val(html.trim()).attr('readonly',true);
			
            });

			$(".data-picker:first").removeClass('data-picker');

			// função que preenche o codigo do set no ensaio de acordo com os produtos
			// do pedido
			$.ajax({

				type:"GET",
				url:"../control/notafiscal_control.php?acao=preencheCodSet", 
				
										
			}).done(function(html){

				
				$("input[name=codigo_set]").val(html.trim()).attr('readonly',true);
			});



	}

$("#buscar_estoque").keypress(function(e){

		if(e.which == 13)
		{


			$("#add_item").attr("disabled",false);
			$("#itens_estoque").empty();
			// var value_check_select = new Array();
			// value_check_select.push($(this).val());
		$("input[type=checkbox]:checked").each(function(){

			$(this).attr("name","tipo_pesquisa[]");

		});

		var pesquisa = $("form").serializeArray();
			

			var query = "";
			if($("#acao").val() != null)
			{
				if($("#itens_nota tr").length == 0)
				{
					novaMensagem("erro","Sorry! Not is possible to make the search.");
					return 0;
				}
				else
					query = "../control/pedido_gerente_control.php?acao=buscar_mesmoSet";
			}
				
			else
				query = "../control/pedido_gerente_control.php?acao=buscar";
			

			
				
				$.ajax({

						type:"POST",
						url:query,
						data:pesquisa,

					}).done(function(html){
						if(parseInt(html,10) == 0 || parseInt(html,10) == -1)
						{
							novaMensagem("erro","Data not found");
							return 0;

						}
						else if(parseInt(html,10) == -2)
						{
							msg = "Please! Fill the search camp with any word.";

							novaMensagem("erro",msg);
							return 0;
						}
						
						$("#itens_estoque").append(html);
						
			        });
				
		}

	});
/*
		Faz um autocomplete no campo de parceiro para o gerente buscar
		caso a nota não esteja linkada com o pedido.
*/
	$.getJSON("../control/json_control.php?jsonParceiro=true",function(data){

		// console.log(data);
          var item = [];
          $(data).each(function(key,value){
          	
            item.push(value.NOME);
            // console.log(value.NOME);
          });

          $("#nomeParceiro").autocomplete(
          {
				source: item     
				    
          }).autocomplete("widget").addClass("fixed-height");
      });

/******************************************************************
					CADASTRO DE NOTA FISCAL
******************************************************************/
	$("#cd_nota").on("click",function(){		

		var valida = false;
			$("#dados_nota input:not(#nomeParceiro)").each(function(){
				if($(this).val() == '')
					valida = true;
			});

			$("#dados_ensaio input").each(function(){
				if($(this).val() == '')
					valida = true;
			});
		

		if(valida)
		{
			novaMensagem("erro","Fill out all fields!");
			return 0;
		}	
		
		if($("#itens_nota tr").length ==  0 )
		{
			novaMensagem("erro","It is not possible without registering note items!");
			
			return 0;
		}
		


/*
	A variavel acao corresponde a um controle que informa que 
	a pagina foi invocada a partir de pedidos consolidados.
*/	
		if($("#acao").val() != null)
		{
			// cadastra a nota de acordo com o pedido consolidado liberado
			param = $("form").serializeArray();

			$.ajax({

				type:"POST",
				url:"../control/notafiscal_control.php?acao=fecharNotaPedido", 
				data: param,
				cache:false
										
			}).done(function(html){

				//				$("#saida").append(html);

				//alert(html);
				if(html=="1")
				{
					novaMensagem("sucesso","Invoice was registered!");

					$("#corp").empty();
					$("#corp").load("../view/view_pedido_consolidado.php");
				}
				else if(parseInt(html,10) == 0)
				{
					novaMensagem("erro","Failed to register the invoice!");
					return 0;
				}

			});

			
		}
		else// se acao não existe significa que a nota não está ligada a um pedido
		{

			if($("#parceiro").find("div").length == 0)
			{
				novaMensagem("erro","Please, select a partners!");
				return 0;
			}

			param = $("form").serializeArray();
			$.ajax({

				type:"POST",
				url:"../control/notafiscal_control.php?acao=fecharNota", 
				data: param,
				cache:false
										
			}).done(function(html){

                $("#saida").append(html);
				/*$("#saida").append(html);*/
                
				if(parseInt(html,10)==1)
				{
					novaMensagem("sucesso","Invoice was registered!");
					// limpa os itens da tela após cadastro

					$("#itens_nota").empty();
					$("#parceiro").empty();
					$("input[type=text]").each(function()
						{
							$(this).val("");
						});
				}
				else if(parseInt(html,10) == 0)
				{
					novaMensagem("erro","Failed to register the invoice!");
					return 0;
				}/**/
			});

			
		}

	});// fim da função

// pesquisa os dados do parceiro no banco e retorna-os na tela de nota fiscal	
	$("#consultar_parceiro").on("click",function(e)
	{
		
			$("#parceiro").empty();

			buscaParceiro = $("#nomeParceiro").val();

			$.ajax({

				type:"POST",
				url:"../control/notafiscal_control.php?acao=preencheParceiro", 
				data: {buscaParceiro:buscaParceiro},
				cache:false
										
			}).done(function(html){
				if(parseInt(html,10) == -3)
				{
					novaMensagem("erro","Partners not found!");
					return 0;
				}
				$("#parceiro").append(html);
			});
		
	});


// função do data-picker do jquery UI

$(".data-picker").datepicker(
	{
		autoSize:true,
		changeMonth:true,
		changeYear:true,
	});

/*
	Função adiciona os produtos liberados no estoque para os itens da nota fiscal

*/

	$("#add_item").on("click",function(){


		$("#itens_estoque tr").each(function(){

			campo1 = $(this).children("th").children(".quant_liberada");
			campo2 = $(this).children("th").children(".valor_nota");
			if($(campo1).val() == "" || $(campo2).val() == "")
			{
				$(this).children("th").children("input").each(function(){
					$(this).attr("name","");
				});
			}
		});

		param = $("form").serializeArray();

		$.ajax({

				type:"POST",
				url:"../control/notafiscal_control.php?acao=add_itens_nota", 
				data: param,
				cache:false
										
			}).done(function(html){

					$("#itens_nota").append(html);

					cont = 0;
					$('.valor').each(function(){

						acount = parseFloat($(this).parents("tr").children("th").children(".account").val());


						preco = parseFloat($(this).val());

						resultado = acount * preco;

						if($(this).val() != '')
						cont+= resultado;

					});
					 cont = cont.toFixed(2);
						

						$('#precofinal').text(cont);
						$('#precofinal_hidden').val(cont);
			});


			// soma todos os valores dos inputs abertos 

			$("#itens_estoque").empty();


	});// fim da função


});// fim do document

function removeItem(dom)
{
	valor_unit = parseFloat($(dom).parents("tr").children("th").children(".valor").val()).toFixed(2);
	acount_item = parseFloat($(dom).parents("tr").children("th").children(".account").val());

	valorRetirado = valor_unit * acount_item;

	valor = parseFloat($("#precofinal_hidden").val());

	valor-=valorRetirado;
	

	$("#precofinal").text(valor.toFixed(2));
	$("#precofinal_hidden").val(valor);
	elemento = $(dom).parents('tr');

	elemento.remove();
}