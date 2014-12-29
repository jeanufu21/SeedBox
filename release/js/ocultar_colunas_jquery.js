$(document).ready(function(){
	$("tbody tr:not(.sub)").hide();

	$(".detalhe").click(function(){
		if($(this).text() == "More Details + "){
			$(this).text("Less Details - ");
			
			teste = $(this).parents("tr").attr("id");
			$('.'+teste).show();

			$(this).removeClass("label label-success").addClass("label label-warning");
			

		}else{
			$(this).text("More Details + ");
			
			teste = $(this).parents("tr").attr("id");
			$('.'+teste).hide();

			$(this).removeClass("label label-warning").addClass("label label-success");
		}
	});

});