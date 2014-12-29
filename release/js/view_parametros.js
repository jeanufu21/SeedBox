		/*
		Jquery para a tela de cadastro de parametros.
		author: Jean Fabrício
		date:22/01/2014
		*/

$(document).ready(function(){


	$("#nome").keyup(function(){
		
		if(($(this).val() == ""))
		{
			$("#add_valor").attr("disabled",true);
			$("#salvar").attr("disabled",true);
		}
		else
		{
			$("#add_valor").attr("disabled",false);

			$("#salvar").attr("disabled",false);
		}
			
	});

	$("#nome").focusout(function (){ $(this).val($(this).val().trim())});


num = 0;

$("#add_valor").on("click",function(){
	num++;
	var campos_valores = "<div class='form-group col-md-11' id='val' >"+
		"<span class='fa fa-times icon_black' id='fechar' onclick='remover(this)'></span>"+
	    "<label for='valor' class='col-sm-1 control-label'>Value</label>"+
	    "<div class='col-sm-10'>"+
	      "<input type='text' class='form-control value' name='valores[]' >"+
	    "</div>"+
	  "</div>";
	  
 
	$("#valores").append(campos_valores);
});


$("#salvar").on("click",function(){

	var valida = true;
	var campo_vazio = false;
	// resgata o valor do primeiro campo de valores parametros

	if($("#valores div div input").size() > 0)
		valida = false;

	
	if(valida)
	{
		novaMensagem("erro","Register at least one value!");
		
		return 0;

	}
	
	$("#valores").children("div").each(function(){
		var input = $(this).children("div").children("input").val();

		if(input == "")
			campo_vazio = true;

	});

	if(campo_vazio)
	{
		novaMensagem("erro","Fill out all fields!");
		
		return 0;
	}

	
	

	parametro_s = $("form").serializeArray();

	$.ajax({

		type:"POST",
		url:"../control/param_especie_control.php?botao=salvar", 
		data: parametro_s
		
		
	}).done(function(html){

		// $("#saida").append(html);


		if(parseInt(html,10) == 1)
		{
			novaMensagem('sucesso','Registered parameters!');
			$('#nome').val('');

			var size = num;

			for(i=0;i<size;i++){
			remover();

			}
		}
		else if(parseInt(html,10) == 0)
			novaMensagem('erro','Unable to register the parameters!');
		else if(parseInt(html,10) == -1)
			novaMensagem('erro','Limit parameter reached!');
		else if(parseInt(html,10) == -2)
			novaMensagem("erro","This parameter already exists!");
		else if(parseInt(html,10) == -3)
			novaMensagem("erro","There is already a product associated with this set!");
		else if(parseInt(html,10) == -15)
			novaMensagem("erro","This value already exists!");

	});

	// echo "<script>novaMensagem('erro','Limit parameter reached!');</script>";
	// echo "<script>novaMensagem('sucesso','Registered parameters!');
	// 		$('#nome').val('');

	// 		var size = num;

	// 		for(i=0;i<size;i++){
	// 		remover();

	// 		}
	
	// 		</script>";
	// echo "<script>novaMensagem('erro','Unable to register the parameters!');</script>";
});



});// fim do document


function remover(dom)
{
/*
Função remover remove  os campos adicionados e decrementa seu contador
para ajustar o numero maximo de campos que é 4.
*/

if(dom == null)
{
	$("#val").remove();
	num--;
}
else
{
	$(dom).parent().remove();
	num--;
}

}


