<?php

		/*
				Title:Controle de Especie
				Author:Jean Fabrício
				Date:  21/02/2014
		*/
			include_once("../model/especie_model.php");
			include_once("../dao/especie_dao.php");
			include_once("../dao/funcionario_dao.php");



if(isset($_GET['cd_especie']))
{
	$especie = new Especie();
	$funcionario_dao = new FuncionarioDAO();

	$especie->setNome($_POST['nome_especie']);
	$especie->setData(date("Y/m/d"));

	$stmt = $funcionario_dao->buscaFuncionario("NOME",$_POST['nome_gerente']);
	$dados_Fun = $stmt->fetch(PDO::FETCH_ASSOC);
	$especie->setFuncionario($dados_Fun['ID_FUNCIONARIO']);
	
	$especieDao = new EspecieDao();
	
	if($especieDao->insere($especie))
	{
		echo "1";
	}
	else
	{
		echo "2";
	}
		
}	

if(isset($_GET['bc_especie']))
{
	$especieDao = new EspecieDao();

	$query = $especieDao->busca_especieParamVal();
	
	while($dadoEspecie = $query->fetch(PDO::FETCH_ASSOC))
	{
		echo "<tr>";
				if(isset($dadoEspecie['nome']))
					echo "<th>".$dadoEspecie['nome']."</th>";
				if(isset($dadoEspecie['nome_par_especie']))
					echo "<th>".$dadoEspecie['nome_par_especie']."</th>";
				if(isset($dadoEspecie['valor']))
						echo "<th>".$dadoEspecie['valor']."</th>";
		echo "</tr>";

	}

}


//
if(isset($_GET['verifica_especie']))
{
	$especie = new Especie();
	$especie_dao = new EspecieDao();

	$especie->setNome($_POST['nome_especie']);
	$especie->setData(date("Y/m/d"));

	$stmt = $especie_dao->buscaEspecie("NOME",$especie->getNome());


	$dados_Especie = $stmt->fetch(PDO::FETCH_ASSOC);

	if($dados_Especie)
	{
		echo "1";
	}
	else
	{
		echo "2";
	}
		
}	


			
?>
