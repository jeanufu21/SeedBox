		/*
				Title: Funções para a pagina de Consulta do historico
				Author:Washington Soares 
				Date:23/03/2014
		*/



	$(document).ready(function(){
		
		// realiza a busca ao carregar a pagina
			$("#resultado_busca").empty();
				valor_busca = $(this).val().trim();
				termo_busca = $("#termo_busca option:selected").val();		
					
					$.ajax({

						type:"POST",
						url:"../control/consulta_historico_control.php", 
						data: {termo_busca:termo_busca,valor_busca:valor_busca},
												
					}).done(function(html){

						$("#resultado_busca").append(html);
			});
		//  realiza a busca ao clicar no botao buscar
			$("#queryHistorico").on("keyup",function(){
				$("#resultado_busca").empty();
				valor_busca = $(this).val().trim();
				termo_busca = $("#termo_busca option:selected").val();		
				$(".xxx").empty();
				$(".xxx").append("texto da busca = "+valor_busca+"<br> termo da busca = "+termo_busca);
					$.ajax({

						type:"POST",
						url:"../control/consulta_historico_control.php", 
						data: {termo_busca:termo_busca,valor_busca:valor_busca},
												
					}).done(function(html){

						$("#resultado_busca").append(html);
					});
			});
				
	});