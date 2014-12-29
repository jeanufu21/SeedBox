<?php 

/*
Cadastro e busca de campo
Author: Washington /Jean 
date:07/03/2014
*/

include_once("conexao.php");
include_once("historico_dao.php");

class CampoDao {


	function buscaCampo($termo_busca,$valor_busca){
		try
		{
			$conexao = Conexao::getInstance();

			if($valor_busca != null)
			$sql = "SELECT * FROM campo WHERE  ".$termo_busca." LIKE '%".$valor_busca."%'";	
			else if($valor_busca == null)
			$sql = "SELECT * FROM campo";	

			$query = $conexao->prepare($sql);
			$query->execute();

			return $query;
		}
		catch(PDOExecption $error)
		{
			echo "<script>alert('".$error->getMessage()."');</script>";
		}


	}
	function insereCampo(campo $campo){
				try{
					$conecta = Conexao::getInstance();

					$sql = "INSERT INTO campo (COD_CAMPO, NOME, CIDADE,UF,ALTITUDE,LATITUDE,LONGITUDE) 
							VALUES (NULL,:nome,:cidade,:uf,:altitude,:latitude,:longitude)";	

					$stmt = $conecta->prepare($sql);
					$stmt->bindParam(":nome",$campo->getNome());
					$stmt->bindParam(":cidade",$campo->getCidade());
					$stmt->bindParam(":uf",$campo->getUf());
					$stmt->bindParam(":altitude",$campo->getAltitude());
					$stmt->bindParam(":latitude",$campo->getLatitude());
					$stmt->bindParam(":longitude",$campo->getLongitude());
					$stmt->execute();

					

 					Historico::registraHistorico("insert","campo","cadastro do campo <b><i>".$campo->getNome()." </b></i>");

					return 1;
				}catch(PDOExecption $erro){
					return 0;
				}



	}

}

?>