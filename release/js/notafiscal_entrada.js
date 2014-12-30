var rownum = 0;

$(document).ready(function(){

	$("#invalida").on('click',function(){
		
			$.ajax({
				type:"POST",
				url:"../control/nota_fiscal_control_entrada.php?geraNumero",
										
			}).done(function(html){
				$("#cod_nota").val(html);
			});




	});

	$('.somenteNumero').bind('keyup', function(){
	
		        var expre = /[^0-9,.]+/g;

		        // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
		        if ($(this).val().match(expre))
		            $(this).val($(this).val().replace(expre,''));
		    });

	$("#submit").on("click",function(){

		var campoVazio = false;
		$("#corpopainel input").each(function(){
			if($(this).val() == "")
			{
				campoVazio = true;
				return 0;
			}

		});


		if(campoVazio)
		{
			novaMensagem("erro","Fill out all fields!");
			return 0;
		}
		
		if($("#tabela_itens tr").length == 0 )
		{
			novaMensagem("erro","Please, add at least one item in invoice!");
			return 0;
		}
		var go = 1;
		$(".notnull").each(function(i){
			if($(this).val()==''){
				novaMensagem('erro', $(this).attr('placeholder')+' is required!');
				go=2;
				return false;
			}
		});

		if(go==1){

			var row1 = $('<input class="hidden" name="rownum" value="'+rownum+'">');

			$("#saida").append(row1);
			
			valor_form = $("#nota").serializeArray();

			$.ajax({
				type:"POST",
				url:"../control/nota_fiscal_control_entrada.php?cd_nota=true",
				data: valor_form						
			}).done(function(html){
				$("#saida").append(html);
				if(html.search("sucesso")!=-1)
				{
					novaMensagem("sucesso", "Entrance Invoice Successfully Saved!");
					$("#corpopainel input").each(function(){
						$(this).val("");
					});
					$("#tabela_itens").empty();
				}
					
                    
			});
		}
	});

	$("#add").on("click",function(){
		var go1 = 1;
		$(".formitem").each(function(i){
			if($(this).val()==''){
				novaMensagem('erro', $(this).attr('placeholder')+' is required!');
				go1=2;
				return false;
			}
		});

		if(go1==1){
			var row = $('<tr>'+
				'<td><label class="control-label">'+$("#cod_produto").val()+'<input class="hidden" name="cod_produto'+rownum+'" value="'+$("#cod_produto").val()+'"></label></td>'+
				'<td><label class="control-label">'+$("#lote").val()+'<input class="hidden" name="lote'+rownum+'" value="'+$("#lote").val()+'"></label></td>'+			
				'<td><label class="control-label">'+$("#data_vencimento").val()+'<input class="hidden" name="data_vencimento'+rownum+'" value="'+$("#data_vencimento").val()+'"></label></td>'+			
				'<td><label class="control-label">'+$("#quantidade").val()+'<input class="hidden" name="quantidade'+rownum+'" value="'+$("#quantidade").val()+'"></label></td>'+
				'<td><label class="control-label">'+$("#unidade_medida").val()+'<input class="hidden" name="unidade_medida'+rownum+'" value="'+$("#unidade_medida").val()+'"></label></td>'+
				'<td><label class="control-label">'+$("#tipo_embalagem").val()+'<input class="hidden" name="tipo_embalagem'+rownum+'" value="'+$("#tipo_embalagem").val()+'"></label></td>'+
				'<td><label class="control-label">'+$("#peso_por_embalagem").val()+'<input class="hidden" name="peso_por_embalagem'+rownum+'" value="'+$("#peso_por_embalagem").val()+'"></label></td>'+
				/*'<td><label class="control-label">'+$("#valor_item").val()+'<input class="hidden" name="valor_item'+rownum+'" value="'+$("#valor_item").val()+'"></label></td>'+*/
			'</tr>');

			$("#tabela_itens").append(row);
			var mult = parseFloat($("#quantidade").val())*parseFloat($("#valor_item").val());
			var valor = parseFloat($("#valor").val());
			$("#valor").val(Math.round((valor+mult)*100)/100);
			$(".formitem").val('');	
			rownum++;
		}
	});

	$.getJSON("../control/nota_fiscal_control_entrada.php?jsonParceiro=true",function(data){

		 //alert(data);
          var item = [];
          $(data).each(function(key,value){
          	
            item.push(value.NOME);
             //alert(value.NOME);
          });

          $("#parceiro").autocomplete(
          {
				source: item,
				change: function (event, ui) {
	                if(!ui.item){
	                    $("#parceiro").val("");
	                }
            	}
				    
          });
      });// fim da função

	$.getJSON("../control/nota_fiscal_control_entrada.php?jsonProduto=true",function(data){

		 //alert(data);
          var item = [];
          $(data).each(function(key,value){
          	
            item.push(value.NOME);
             //alert(value.NOME);
          });

          $("#cod_produto").autocomplete(
          {
				source: item,
				change: function (event, ui) {
	                if(!ui.item){
	                    $("#cod_produto").val("");
	                }
            	}     
				    
          }).autocomplete("widget").addClass("fixed-height");	
      });// fim da função

	$("input[type=data]").datepicker(
		{
		autoSize:true,
		changeMonth:true,
		changeYear:true,
	});

	$(".alert").alert();

	$("#parceiro").focusout(function(){

		if($("#cod_nota").val() != ''){
			if($("#parceiro").val() != ''){
				verifica($("#cod_nota").val(),$("#parceiro").val());
			}
		}
	});

	$("#cod_nota").focusout(function(){

		if($("#cod_nota").val() != ''){
			if($("#parceiro").val() != ''){
				verifica($("#cod_nota").val(),$("#parceiro").val());
			}
		}
	});

	$("#ok").on("click", function(){
		location.reload(true);
	});
	$("#cancel").on("click", function(){
		location.reload(true);
	});
	$("#supercancel").on("click", function(){
		confirmaMensagem('Cancel Bill of Sale? This operation cannot be undone!',sim);
	});
});

function verifica(idnota,parceiro)
{
	$.ajax({
     type: "POST",
       data:{'cod_nota': idnota,'parceiro': parceiro},
       url: "../control/nota_fiscal_control_entrada.php?verifica=true"
		}).done(function(html){
    			$("#saida").append(html);
  		});
}


function sim()
{
	$('.form-control').attr('disabled', false);
	valor_form = $("#nota").serializeArray();
	$.ajax({
     		type: "POST",
     		data: valor_form,
       		url: "../control/nota_fiscal_control_entrada.php?cancel_nota=true"
		}).done(function(html){
			$("#saida").append(html);
			location.reload(true);
  		});
}
function nao()
{

;}