$(document).ready(function(){	
	$("#salvafuncionario").on("click",function(){
		

		var newnome = $("#newnome").val().trim();
		var newlogin = $("#newlogin").val().trim();
		var newpsw   = $("#newpsw").val();
		var newemail = $("#newemail").val();
		var newtelefone = $("#newtelefone").val();
		var newuf = $("#newuf").val();
		var newcidade = $("#newcidade").val();
		var requerido = "";
		
		if (!alphanumeric(newlogin)){
			novaMensagem("erro", "LOGIN: just letters and numbers.");
			return 0;
		}

		if(newpsw == "")
			requerido = "Password";
		if(newlogin == "")
			requerido = "Login";
		if(newnome == "")
			requerido = "Name";

		if(requerido != ""){
			novaMensagem("erro", requerido+" required.");
			return 0;
		}
        
		

	     			$.ajax({

						type:"POST",
						url:"../control/funcionario_control.php?acao=update", 	
						data: {newnome:newnome,newlogin:newlogin,newpsw:newpsw,newemail:newemail,newtelefone:newtelefone,newuf:newuf,newcidade:newcidade},
					}).done(function(html){

						if(parseInt(html,10) == 1)
							novaMensagem("sucesso","Profile updated.");
						if(parseInt(html,10) == 2)
							novaMensagem("erro","Unable to update the profile.");
						if (parseInt(html,10) == 3)
							novaMensagem("erro","Login already exists.");	
		});

$('#myModal').modal('hide');
		

		$("#corp").load("../view/view_perfil.php");

	});
});