<?php 

/*
	Title: Faz Validação do Login no banco.
	Author:Jean Fabrício
	Date:25/03/2014
*/

	session_start();

	if(!isset($_SESSION['codigoUser']))
	{
		header("Location:../index.php");
	}

	if(isset($_GET['acao']) && $_GET['acao'] == "deslogar")
	{
		session_destroy();

		header("Location:index.php");
	}
	
		

 ?>