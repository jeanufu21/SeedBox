

function validateFields(form)
{

	var selector = form+" .required";
	
	$(selector).each(function(){

		var nameField = $(this).attr("name");
		if($(this).val() == "")
		{
			novaMensagem("erro","Field  is required: "+nameField);
			return false;
		}

	});

}