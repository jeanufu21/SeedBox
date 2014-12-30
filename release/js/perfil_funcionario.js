		/*
				Title: Funções para a pagina de Consulta do historico
				Author:Washington Soares 
				Date:23/03/2014
		*/



	$(document).ready(function(){
		
		// realiza a busca ao carregar a pagina
			  $("#dataUser").empty();
				
					$.ajax({

						type:"POST",
						url:"../control/funcionario_control.php?acao=buscar", 			
					}).done(function(html){

						$("#corpo").append(html);
			        });
	
		
			
	});