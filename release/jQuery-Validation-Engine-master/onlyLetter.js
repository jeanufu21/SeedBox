function onlyLetter(field, rules, i, options)  
{  
	var valor = field.val();
	 var letterNumber = /^[a-zA-Z]+$/;  

	 if(!(valor.match(letterNumber))){
	   return "Only letters."; 
	}
} 
