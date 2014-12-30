/**
 * @author Clube dos Geeks
 */
var numitens=10; //quantidade de itens a ser mostrado por página
var pagina=1;	//página inicial - DEIXE SEMPRE 1
$(document).ready(function(){
	
	getitens(pagina,numitens); //Chamando função que lista os itens
	$("#queryHistorico").on("keyup",function(){

				$("#resultado_busca").empty();
				var valor_busca = $(this).val().trim();
				var termo_busca = $("#termo_busca option:selected").val();
				var tipo = "tecla";
				// $(".xxx").empty();
				// $(".xxx").append("texto da busca = "+valor_busca+"<br> termo da busca = "+termo_busca);
					$.ajax({

						type:"GET",
						url:"../control/consulta_historico_control.php", 
						data: {tipo:tipo,termo_busca:termo_busca,valor_busca:valor_busca,maximo:numitens,pag:pagina},
												
					}).done(function(html){

						$("#resultado_busca").append(html);
						contadorTecla(termo_busca,valor_busca);
					});
			});
});
function contadorTecla(termo_busca,valor_busca){
	var valor_busca = $("#queryHistorico").val().trim();
	var termo_busca = $("#termo_busca option:selected").val();
	$.ajax({
      	type: 'GET',
      	data: 'tipo=contadorTecla&termo_busca='+termo_busca+'&valor_busca='+valor_busca,
      	url:'../control/consulta_historico_control.php',
   		success: function(retorno_pg){
        	paginadorTecla(retorno_pg);
      	}
    })
}


function contador(){
	$.ajax({
      	type: 'GET',
      	data: 'tipo=contador',
      	url:'../control/consulta_historico_control.php',
   		success: function(retorno_pg){
        	paginador(retorno_pg);
      	}
    })
}

function getitensTecla(pag, maximo){
	tipo = "tecla";
	var valor_busca = $("#queryHistorico").val().trim();
	var termo_busca = $("#termo_busca option:selected").val();
	pagina=pag; 
	$.ajax({
	type: 'GET',
	//data: 'tipo=tecla&pag='+pag +'&maximo='+maximo,
	data: {tipo:tipo,termo_busca:termo_busca,valor_busca:valor_busca,maximo:numitens,pag:pagina},
	url:'../control/consulta_historico_control.php',
   	success: function(retorno){
    	$('#resultado_busca').html(retorno); 
        	contadorTecla(); //Chamando função que conta os itens e chama o paginador
     	}
    })
}
function paginadorTecla(cont){
	if(cont<=numitens){
		$('#paginador').html('Apenas uma Página');
	}else{
		$('#paginador').html('');
		if(pagina!=1){
			$('#paginador').append('<li><a href="javascript:void(0)" onclick="getitensTecla('+(pagina-1)+', '+numitens+')">Página Anterior</a></li>');
		}

		var qtdpaginas = Math.ceil(cont/numitens);
		$('#paginador').append('<li><a href="javascript:void(0)" > '+pagina +' of '+qtdpaginas+' </a></li>');			
		// for(var i=1;i<=qtdpaginas;i++){
		// 	if(pagina==i){
		// 		$('#paginador').append('<li class="active" id="active"><a href="#" onclick="getitens('+i+', '+numitens+')">'+i+'</a></li>');
		// 	}else{
		// 		$('#paginador').append('<li><a href="#" onclick="getitensTecla('+i+', '+numitens+')">'+i+'</a></li>');
		// 		}
		// }
		
		if(pagina!=qtdpaginas){
			$('#paginador').append('<li><a href="javascript:void(0)" onclick="getitensTecla('+(pagina+1)+', '+numitens+')">Próxima Página</a></li>');
		}
	}
}
			




function getitens(pag, maximo){
	pagina=pag; 
	$.ajax({
	type: 'GET',
	data: 'tipo=listagem&pag='+pag +'&maximo='+maximo,
	url:'../control/consulta_historico_control.php',
   	success: function(retorno){
    	$('#resultado_busca').html(retorno); 
        	contador(); //Chamando função que conta os itens e chama o paginador
     	}
    })
}
function paginador(cont){
	if(cont<=numitens){
		$('#paginador').html('Apenas uma Página');
	}else{
		$('#paginador').html('');
		if(pagina!=1){
			$('#paginador').append('<li><a href="javascript:void(0)" onclick="getitens('+(pagina-1)+', '+numitens+')">Página Anterior</a></li>');
		}

		var qtdpaginas = Math.ceil(cont/numitens);
		$('#paginador').append('<li><a href="javascript:void(0)" > '+pagina +' of '+qtdpaginas+' </a></li>');			
		// for(var i=1;i<=qtdpaginas;i++){
		// 	if(pagina==i){
		// 		$('#paginador').append('<li class="active" id="active"><a href="#" onclick="getitens('+i+', '+numitens+')">'+i+'</a></li>');
		// 	}else{
		// 		$('#paginador').append('<li><a href="#" onclick="getitens('+i+', '+numitens+')">'+i+'</a></li>');
		// 		}
		// }
		
		if(pagina!=qtdpaginas){
			$('#paginador').append('<li><a href="javascript:void(0)" onclick="getitens('+(pagina+1)+', '+numitens+')">Próxima Página</a></li>');
		}
	}
}
			