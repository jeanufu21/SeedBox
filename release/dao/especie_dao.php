<?php 

/*
	Cadastro de Especies com parametros definidos
	Author: Jean Fabrício
	date:22/02/2014
*/
include_once("conexao.php");
include_once("../model/especie_model.php");
include_once("historico_dao.php");
include_once("funcionario_dao.php");

class EspecieDao {

	function insere(Especie $especie)
	{
		try{
		$conecta = Conexao::getInstance();

		$sql = "INSERT INTO especie (COD_ESPECIE, NOME, DATA_CADASTRO,ID_FUNCIONARIO) 
				VALUES (NULL,:nome,:data,:codFunc)";	
		

	   $nome = $especie->getNome();
	   $data = $especie->getData();
	   $funcionario = $especie->getFuncionario();

		$stmt = $conecta->prepare($sql);
		$stmt->bindParam(":nome",$nome);
		$stmt->bindParam(":data",$data);
		$stmt->bindParam(":codFunc",$funcionario);
		$stmt->execute();

		$funcionario = new FuncionarioDAO();

		$stmt2 = $funcionario->buscaFuncionario("ID_funcionario",$especie->getFuncionario());
		$usuario =	$stmt2->fetch(PDO::FETCH_ASSOC);


		 Historico::registraHistorico("insert","especie","cadastro da espécie <b><i>".$especie->getNome()."</b></i> para o gerente <b><i>".$usuario["NOME"]."</b></i>");

		return 1;
		} 
		catch(PDOExecption $erro){
			//echo $erro->getMessage();

			return 0;
		}
	}


	function buscaEspecie($termo,$value)
	{
		try
		{
			$conecta = Conexao::getInstance();
			
			if($value == null)
				$sql = "SELECT * FROM especie ORDER BY NOME ASC";
			else if($value != null)
				$sql = "SELECT * FROM especie WHERE ".$termo."='".$value."'";

				$query = $conecta->prepare($sql);
				$query->execute();
						
			return $query;
		}
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}//fim da funcao


	function buscaEspecieNome($nome)
	{
		try
		{
			$conecta = Conexao::getInstance();
			
			if($nome == null)
				$sql = "SELECT * FROM especie";
			else if($nome != null)
				$sql = "SELECT * FROM especie WHERE NOME LIKE '%".$nome."%'";

				$query = $conecta->prepare($sql);
				$query->execute();
						
			return $query;
		}
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}//fim da funcao

	function upDate($espcie_obj)
	{
		try
		{
			$conecta = Conexao::getInstance();
			
			
				$sql = "UPDATE `especie` SET `ID_FUNCIONARIO`= '".$espcie_obj->getFuncionario()."' 
				WHERE COD_ESPECIE = '".$espcie_obj->getId()."'";

				$query = $conecta->prepare($sql);
				$query->execute();
						
			return 1;
		}
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}//fim da funcao

	function busca_especieParamVal()
	{
		try
		{
			$conecta = Conexao::getInstance();
			
			$sql = "SELECT especie.nome,conjunto_parametro_especie.nome_par_especie,
			valor_par_especie.valor FROM `especie` natural join conjunto_parametro_especie 
			natural join valor_par_especie ORDER BY especie.nome ASC";
			

				$query = $conecta->prepare($sql);
				$query->execute();
						
			return $query;
		}
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}//fim da funcao
	



}
	

	
	

	
?>