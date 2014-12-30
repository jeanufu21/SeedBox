<?php 
	
/*
		Title: Conexão de Banco para cadastro do Set 
		Author:Jean Fabrício
		Date: 09/03/2014
*/

	include_once("conexao.php");
	include_once("historico_dao.php");

	class SetDAO
	{
		function cadastraSet($setString)
		{

			try{
			$conecta = Conexao::getInstance();

			$sql = "INSERT INTO `set_valores`(`COD_SET_VALORES`, `VALORES_SET`) 
					VALUES (null,:valorSet)";
			
			$stmt = $conecta->prepare($sql);
			$stmt->bindParam(':valorSet',$setString);

			 $stmt->execute();

			  Historico::registraHistorico("insert","Set","Cadastro do Set: <b><i>".$setString."</b></i>");
				return 1;
			} 
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();

				return 0;
			}
		}// fim da funcao

		function BuscaSet($setString)
		{
			try{
			$conecta = Conexao::getInstance();
			if($setString != null)
			$sql = "SELECT `COD_SET_VALORES`, `VALORES_SET` FROM `set_valores` WHERE VALORES_SET='".$setString."'";
			
			else if($setString == null)
			$sql = "SELECT * FROM `set_valores` ";
				
			$stmt = $conecta->prepare($sql);
			$stmt->execute();
			
				return $stmt;
			} 
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();

				return 0;
			}	
		}

		function BuscaSetId($idSet)
		{
			try{
			$conecta = Conexao::getInstance();
			if($idSet != null)
			$sql = "SELECT * FROM `set_valores` WHERE COD_SET_VALORES='".$idSet."'";
			
			else if($idSet == null)
			$sql = "SELECT * FROM `set_valores`";
				
			$stmt = $conecta->prepare($sql);
			$stmt->execute();
			
				return $stmt;
			} 
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();

				return 0;
			}	
		}
	}
 ?>