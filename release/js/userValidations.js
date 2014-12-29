function validatePass(){
	senha1 = document.formInsertUser.senha_usuario.value
	senha2 = document.formInsertUser.cw.value

	if (senha1 != senha2)
	    alert("Passwords doesn't match!");
}