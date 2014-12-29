<?php 
/*
		Title: Dao para as Fases
		Author:Jean Fabrício
		Date: 09/03/2014
*/


include_once("conexao.php");



class FaseDAO
{

	function buscaFase($idFase)
	{
		try{
			$conecta = Conexao::getInstance();
			
			if($idFase == null)
				$sql = "SELECT * FROM `fase`";

			else if($idFase != null)
				$sql = "SELECT * FROM `fase` WHERE COD_FASE='".$idFase."'";	
			
			
			$stmt = $conecta->prepare($sql);
			$stmt->execute();
			return $stmt;
			} 
			catch(PDOExecption $erro){
				echo $erro->getMessage();

				return 0;
			}
	}
}
?>