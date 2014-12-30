<?php 
/*
		Title:Controle que valida o usuario para entrar no sistema.
		Author:Jean Fabrício
		Date: 15/03/2014
*/


		include_once("../dao/funcionario_dao.php");


		// consultando no Banco o usuario

		$funcionario_dao = new FuncionarioDAO();

		$senha = base64_encode($_POST['senha']);
		
		$stmt = $funcionario_dao->ValidaFuncionario($_POST['login'],$senha);

		$dadosUser = $stmt->fetch(PDO::FETCH_ASSOC);
		$num = $stmt->rowCount();

		if($num > 0)
		{
			
			session_start();

			$_SESSION['codigoUser'] = $dadosUser['ID_FUNCIONARIO'];
			$_SESSION['tipoUser'] = $dadosUser['TIPO'];

			header("Location:../view/menu_view.php");
		}
		else 

			header("Location:../index.php?erro=invalido");

 ?>