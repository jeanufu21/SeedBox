
/*
	Title:Jquery para tratar dos eventos e dinamica de Pedidos Consolidados
	Author:Jean Fabrício
	Date: 15/03/2014
*/

$(function(){



	// na medida em que o documento carrega
	// é mostrado na tela os pedidos para aquele gerente que está logado
	$("#resultado_busca").load("../control/pedido_consolidado_control.php?acao=consolidado");

	$('#itens_aprovados').on("click",function(){

			var str;
/*
	 str é uma string no formato cod_estoque/quant_liberada/medida
	 onde assim que o usuario finaliza a liberação essa str passa
	 a ser o value dos inputs.
*/
		var  valida = false;

		$('input.valor').each(function(){

			if($(this).parents('tr').children('th').children(".validacao").val() != ''
				&& $(this).val() != '')
			{
				valida = true;
				return 0;
			}
			
		});

		// validaão se o campo valor e quantidade foi preenchido
		if(!valida)
		{
			novaMensagem("erro",'Fill in the fields Quantity and Price!');
			return 0;
		}

		$('input.valor').each(function(){
			if($(this).val() != '' && $(this).parents('tr').children('th').children(".validacao").val() != ''
				&& $(this).val() != '')
			{	
				str = "";
				str+= $(this).parents('tr').children('.numero_estoque').attr('id')+"/";
				str+= $(this).parents('tr').children('th').children(".validacao").val()+"/";
				str+= $(this).parents('tr').children('.medida').attr('id')+"/";
				str+= $(this).val();
				$(this).val(str);	

			}
			else
			{
				$(this).attr('name','');
			}

			
		});
			

		param = $("form").serializeArray();

		$.ajax({

			type:"POST",
			url:"../control/pedido_consolidado_control.php?acao=itens_aprovado", 
			data: param
									
		}).done(function(html){

			$("#saida").append(html);
		});
		
		// limpo o campo de itens do pedido
		$("#busca_itens").empty();

		// limpo o corpo da tela e redireciono para a tela Nota Fiscal
		// passando um Get como controlador
		$("#corp").empty();
		$("#corp").load("../view/view_notaFiscal.php?acao=gerarNota");
		
		
			
	});

/*
	se o usuario clicar em limpar ele limpa toda tela de estoque e itens pedido.
*/
	$("#limpar").on("click",function(){

		$("#busca_itens").empty();

		$('#itens_aprovados').attr('disabled',true);

	});


});// fim do document

