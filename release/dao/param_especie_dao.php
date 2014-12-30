<?php 

		/*
			Cadastro de Parametros da Especie
			Author: Jean Fabrício
			date:22/02/2014
		*/
include_once("conexao.php");
include_once("../model/param_especie_model.php");
include_once("historico_dao.php");
include_once("especie_dao.php");

class Param_EspecieDao {

	function insere(ParametrosEspecie $param_especie)
	{
		try{
		$conecta = Conexao::getInstance();

		$sql = "INSERT INTO conjunto_parametro_especie (COD_PAR_ESPECIE,NOME_PAR_ESPECIE,COD_ESPECIE)
				VALUES(:codparam, :nomeparam, :codespecie)";
		
		$stmt = $conecta->prepare($sql);
		$stmt->bindParam(':codparam',$param_especie->getCodParamEspecie());
		$stmt->bindParam(':nomeparam',$param_especie->getNomeParam());
		$stmt->bindParam(':codespecie',$param_especie->getCodEspecie());
		$stmt->execute();


		$buscaEspecie = new EspecieDao();

		$stmt2 = $buscaEspecie->buscaEspecie("COD_ESPECIE",$param_especie->getCodEspecie());
		$Especie =	$stmt2->fetch(PDO::FETCH_ASSOC);

		Historico::registraHistorico("insert","parametro de avaliação","cadastro do parametro <b><i>".$param_especie->getNomeParam()."</b></i> para a espécie <b><i>".$Especie['NOME']."</b></i>");

		return 1;
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}


	function buscaParam($termo,$value)
	{
		try{
		$conecta = Conexao::getInstance();

		$sql = "SELECT * FROM `conjunto_parametro_especie` WHERE ".$termo."='".$value."'";
		$stmt = $conecta->prepare($sql);
		$stmt->execute();

		return $stmt;

		
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}

	function buscaParamNome_Especie($nome,$codEspecie)
	{
		try{
		$conecta = Conexao::getInstance();

		$sql = "SELECT * FROM `conjunto_parametro_especie` WHERE COD_ESPECIE='".$codEspecie."' AND NOME_PAR_ESPECIE='".$nome."'";
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