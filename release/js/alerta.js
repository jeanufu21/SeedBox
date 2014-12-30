	function novaMensagem(tipo,message)
	{
		$('#alerta').empty();
		
	 	if(tipo == 'erro')
	 	{
	 		$('#alerta').removeClass('panel-success');
			$('#alerta').addClass('panel-danger');
			span = "<div class='panel-heading'><div class='fa fa-times-circle fa-2x'></div><label style='font-size:20px;margin-left:10px;' class='control-label'>Error!</label></div></div></br><div class='panel-body'><span class='has-error'><label class='control-label' style='font-size: 15px'>"+message+"</label></span></div>";
					
		}	
		else if(tipo == 'sucesso')		
		{
			$('#alerta').removeClass('panel-danger');
			$('#alerta').addClass('panel-success');
			span = "<div class='panel-heading'><div class='fa fa-check-circle fa-2x'></div>"+
			"<label style='font-size:20px;margin-left:10px;' class='control-label'>Success</label></div></div></br>"+
			"<div class='panel-body'><span class='has-success'><label class='control-label' style='font-size: 15px'>"+message+"</label></span></div>";
				
		}

		$('#alerta').append(span).fadeIn('slow').delay(2000).fadeOut('slow');		
	}

	
		function confirmaMensagem(message,sim,nao)
	{

		var teste = 0;
		$('#alerta').empty();
		$('#alerta').addClass('panel-warning');
		span = "<div class='panel-heading'><div class='fa fa-question-circle fa-2x'></div><label style='font-size:20px;margin-left:10px' class='control-label'>Attention</label></div><div class='panel-body'><span class='has-warning'>"+message+"<br/><br/><div><button type='button' class='btn btn-success controleConfirma' style='width:60px' id='SIM'>Yes</button>&nbsp;<button type='button' style='width:60px' class='btn btn-default controleConfirma' id='NAO'>No</button></div></span></div>";
		$('#alerta').append(span).fadeIn('slow');

		$('.controleConfirma').click(function(){
			$('#alerta').fadeOut('slow');
		});

		$('#SIM').on("click",function(){
			$('#SIM').click(sim);
			return true;
		});

		$('#NAO').on("click",function(){
			$('#NAO').click(nao);
			return false;
		});
		
		

		

	}
