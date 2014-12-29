/*
Title: Funções para o cadastro de parceiro
Author:Tacio medeiros
Date: 14/03/2014
*/

$(document).ready(function(){


$("#save_parceiro").on("click",function(){
$("#cpf").val($("#cpf").val().replace(/[.-]/g,''));
$("#cnpj").val($("#cnpj").val().replace(/[.\-\/]/g,''));

	$(".somenteNumero").bind("keyup", function(){
        var expre = /[^0-9,.]/g;

        // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
        if ($(this).val().match(expre))
            $(this).val($(this).val().replace(expre,''));
    });



/*
	Foi definido que o parceiro só é obrigatório 
	o nome para cadastro. Assim a validação é apenas
	para o nome.
*/
	if($("input[name=nome]").val() == "")
	{
		novaMensagem("erro","Field \"Name\" required!");
		return 0;
	}
		


	dados = $("#cadastro").serializeArray();

	$.ajax({

		type:"POST",
		url:"../control/parceiro_control.php?acao=cadastrar",
		data: dados,
		cache:false,
		
		
	}).done(function(html){

		// $("#saida").append(html);

		if(parseInt(html,10) == 1)
		{
			novaMensagem("sucesso","Partner successfully saved!!");

			// limpa todos os campos
			$("input").each(function(){

				$(this).val('');
			});

			$("textarea").val('');
		}
		else if(parseInt(html,10) == 2)
		novaMensagem("erro","Partner not registered!");
	});

});


});

