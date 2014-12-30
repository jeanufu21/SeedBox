function numeric(inputtxt)  
{  
	 var number = /^[0-9]+$/;  
	  
	 if(inputtxt.match(number))
	 	return true;
	 
	 else
	   return false;   
} 
