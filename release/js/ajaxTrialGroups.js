/*
	*	Title: ajaxTrialGroups.js
	*	Authors: Frederico, Gustavo
	*	Date: 27/03/2014
*/

/* Esta funcao busca os parâmetros de uma especie e seus valores que serão utilizados 
para compor o set */

$(document).ready(function (){
	$(".species").on("click", function (){
		// validaSpecie() verifica se existem espécies cadastradas, se existirem a função retorna 1;
		if(verificaSpecie()){
			//valor_busca guarda a especie que foi selecionada
			
			var valor_busca = $("#specie option.species:selected").val();		
			
			// Input hidden que recebe o código da especie selecionada que será utilizado 
			// na inserção de grupos avaliativos 
	        $("#codEspecie").val(valor_busca);

	        $.ajax({

				type:"POST",
				url:"../control/grupo_avaliativo_control.php?acao=selectParEsp", 
				data: {valor_busca:valor_busca}
										
			}).done(function(html){

				
				// Esta funcao busca todos os paramêtros de avaliação que serão avaliados em um
				// determinado grupo avaliativo 
				selectAvaliationParam();

				// Habilita o botão do modal, e adiciona o atributo
				// a abertura do modal dado que a espécie foi seleciona 
				$("#openModal").attr("data-toggle", "modal");	
				// O resultado da execucao do case "selectParEsp" será exibido em $("#speciesAtt" ) 
				$("#speciesAtt").html(html); 
				limpaTrialG();

			});
		}
	});
});



/* Esta função busca todos os parâmetros de avaliação de um grupo avaliativo já cadastrado
no banco de dados de acordo com o código do set deste grupo avaliativo */

$(document).ready(function (){
    $(".phases").on("click", function (){
    	if(verificaSpecie()){
    		limpaTrialG();
        	selectTrialG();	
    	}
    });
});

/* Recupera os valores selecionados, Especie, conjunto de valores para os 
parametros da especie e fase para compor o set */

$(document).ready(function (){
    $("#submit").on("click", function (){
        var set = montaSet();
        $.ajax({

			type:"POST",
			url:"../control/grupo_avaliativo_control.php?acao=deleteTrialG", 
			data: {'set' :set}
												
		}).done(function(html){
			//$("#debug").html(html);
			parametro = $("#insert").serializeArray(); 
	        $.ajax({

				type:"POST",
				url:"../control/grupo_avaliativo_control.php?acao=insertTrialG", 
				data: parametro
				//error: function(retorno){ alert(retorno);}
													
			}).done(function(html){
				limpaTrialG();
				$("#qtIns").val(0);
				selectTrialG();
				novaMensagem("sucesso", html);
				//$("#debug").html(html);
			});
		});		
	}); 
});

/* Insere um parametro de avaliação dado que uma espécie foi selecionada */
$(document).ready(function () {
    $("#saveAttribute").on("click", function () {
        insertAvaAtt = $("#insertAvaAtt").serializeArray();
        $.ajax({

            type: "POST",
            url: "../control/grupo_avaliativo_control.php?acao=insertAvaliationParam",
            data: insertAvaAtt

        }).done(function (html) {
            //$("#debug").html(html);
            selectAvaliationParam();
            var html = parseInt(html);
            if(html == 1){
                novaMensagem("sucesso", "Parameter successfully saved!");   
            }else{
                novaMensagem("erro", "Parameter already exists!");
            }
            
        });
    });
});

// Limpa a caixa que configura o grupo avaliativo
function limpaTrialG(){
	$("#ItemRows").empty();	
	$("#newatts").empty();
};

// Monta o set de acordo com as informações selecionadas
function montaSet(){
	// Recupera a espécie selecionada e atribui a variável set
	var set = $("#specie option.species:selected").val();

    /* Recupera os valores dos parâmetros relativos a espécie e concatena a variável set */
    for (i = 0; i < $("#qtValores").val(); i++) {
        set += "#"+$(".valorAtt" + i + ":selected").text();          
    };

    // Recupera o código da fase selecionada e concatena a variável set
    set += "#"+$(".phases:selected").val();
    return set;
};

/* Busca todos os parametros de avaliação para uma determinada espécie */
function selectAvaliationParam(){
	var valor_busca = $("#specie option.species:selected").val();

		/* Input hidden que recebe o código da espécie selecionada que será utilizado
		na inserção de novos parametros de avaliação */
        $("#specieID").val(valor_busca);	

        $.ajax({
			type:"POST",
			url:"../control/grupo_avaliativo_control.php?acao=selectAvaParam", 
			data: {valor_busca:valor_busca}
									
		}).done(function(html){
			// O resultado da execucao do case "selectAvaParam" sera exibido em $("#avaliationParam" )
			$("#avaliationParam").html(html); 
		});
};

/* Executa o case "selectTrialG" do arquivo "grupo_avaliativo_control.php" que irá buscar
todos os parâmetros cadastrados para um determinado grupo avaliativo apartir do seu código de set
*/
function selectTrialG(){
	var set = montaSet();
	var res = set.split("#");
	verificaSet(set).done(function(html){
		if(res.length > 2){

			if(html == "-1"){
				$("#submit").attr("disabled", "disabled");
				novaMensagem("erro","Product wasn't registered, please register him first!");
			}
			else{
				/* Habilita o botão de submissão */
				$("#submit").removeAttr("disabled");
				$.ajax({

					type:"POST",
					url:"../control/grupo_avaliativo_control.php?acao=selectTrialG", 
					data: {'set' :set},
					async: false
												
				}).done(function(html){

				$("#ItemRows").html(html);

				});
			}
		}else{
			novaMensagem("erro","Parameters of species not recorded!<br />Please record them!");
		}
	});	
};


function verificaSet(set){
	return $.ajax({

		type:"POST",
		url:"../control/grupo_avaliativo_control.php?acao=verificaSet", 
		data: {'set' :set},
		async: false
											
	})
};
