/*
		Title: Funções para auto-complete do campo para gerar o ensaio
		Author:Washington Soares Braga
		Date: 24/04/2014
*/
var validacampo = false;

var verifica = false;
$(document).ready(function(){

		$("#nome_campo").focusin(function(){
//alert("entrando no foco  = "+verifica);
			$.getJSON("../control/json_control.php?jsonCampo=true",function(data){

				// console.log(data);
		          var item = [];
		          $(data).each(function(key,value){
		          	
		            item.push(value.NOME);
		            // console.log(value.NOME);
		          });


		          $("#nome_campo").autocomplete(
		          {
						source: item,
						change: function (event,ui)
						{
							if(!ui.item){
								verifica = true;
								$("#nome_campo").val('');
								novaMensagem("erro","Error:Unable to Valid CoutrySide!");
								 
							}
							else
								validacampo = true;
						}				
						    
		          }).autocomplete("widget").addClass("fixed-height");
	      	});

		});
		// $("#nome_campo").focusout(function(){
		// 	alert("saindo do foco "+verifica);
		// });
		
});