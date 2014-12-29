/*

		Title: Jquery da Tela de Busca e edição de Marcas
		date:01/06/2014
		Author:Jean Fabricio

*/



$(document).ready(function(){


					$.ajax({

						type:"POST",
						url:"../control/consulta_marca_control.php?acao=sem_botao",
						data:null,

					}).done(function(html){
						
						
						$("#marcas_body").append(html);
						
			        });


	$("#ver_marcas").on("click",function(){


		$("#marcas_body").empty();
		if($("#pesquisa").val() == "")
		{
			novaMensagem("erro","fill in all fields!");
			return 0;
		}

		var param = $("form").serializeArray();

					$.ajax({

						type:"POST",
						url:"../control/consulta_marca_control.php?acao=botao",
						data:param,

					}).done(function(html){
						
						
						$("#marcas_body").append(html);
						
			        });


	});

});