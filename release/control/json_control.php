<?php 
/*
		Title:Funções Json para os autoCompletes do Jquery UI
		Author:Jean Fabrício
		Date:24/03/2014
*/

	include_once("../dao/produto_dao.php");
	include_once("../dao/especie_dao.php");
	include_once("../dao/set_dao.php");
	include_once("../dao/parceiro_dao.php");
	include_once("../dao/funcionario_dao.php");
	include_once("../dao/campo_dao.php");
/* 
	controle que faz busca de todos os produtos do banco 
	de dados para o autocomplete do jquery UI.
*/
	if(isset($_GET['json']))
	{
		$produto_dao = new ProdutoDao();
		$stmt = $produto_dao->buscaProduto(null,null);
			
		echo json_encode($feth = $stmt->fetchAll(PDO::FETCH_ASSOC));
		
	}
/* 
	controle que faz busca de todos os produtos especificos
	 do banco de dados que um gerente administra para o autocomplete do jquery UI.
*/
	if(isset($_GET['gerente']))
	{
		// busca a especie que o gerente administra
		$especie_dao = new EspecieDao();
		$stmt_especie = $especie_dao->buscaEspecie("ID_FUNCIONARIO",$_GET['gerente']);
		$dados_especie = $stmt_especie->fetchAll(PDO::FETCH_ASSOC);

		$set_dao = new SetDAO();
		$stmt_set = $set_dao->BuscaSetId(null);
		// busca todos os sets de parametros das especies
		
		$dados_set = $stmt_set->fetchAll(PDO::FETCH_ASSOC);


		foreach($dados_set as $set)
		{
			// recupera o codigo da especie para cada set string.
			$array_set = explode("#",$set['VALORES_SET']);
			
			foreach($dados_especie as $especie)
			{
				if($array_set[0] == $especie['COD_ESPECIE'])
				{
					// guarda todos os codigos dos sets de mesma especie
					 $ar_codigos[] = $set['COD_SET_VALORES'];

				}

			}

		}

		$produto_dao = new ProdutoDao();
/* 
	A função buscaProdutos_porSets() é uma função muito especifica,
	onde faço uma busca de todos os produtos que contem os codigos de sets
	correspondentes a  $ar_codigos[]
*/
		$stmt_produto = $produto_dao->buscaProdutos_porSets($ar_codigos);
			
		echo json_encode($feth = $stmt_produto->fetchAll(PDO::FETCH_ASSOC));
	}

/* 
	controle que faz busca de todos os produtos especificos
	o banco de dados que contem o mesmo sets de parametros
	para o autocomplete do jquery UI.
*/
if(isset($_GET['produto']))
	{
	
		$produto_dao = new ProdutoDao();
		$stmt_produto = $produto_dao->buscaProduto("NOME",$_GET['produto']);
		$dado_produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

		$stmt_produto_json = $produto_dao->buscaProduto("COD_SET_VALORES",$dado_produto['COD_SET_VALORES']);
		echo json_encode($feth = $stmt_produto_json->fetchAll(PDO::FETCH_ASSOC));
	}

/* 
	controle que faz busca de todos os parceiros
	para o autocomplete do jquery UI.
*/
	if(isset($_GET['jsonParceiro']))
	{
		$parceiro_dao = new ParceiroDAO();
		$stmt_Parceiro_1  = $parceiro_dao->buscaParceiro(null,null);

		if($stmt_Parceiro_1 == null)
			echo "101";
		else
		echo json_encode($fetch = $stmt_Parceiro_1->fetchAll(PDO::FETCH_ASSOC));
	}
/* 
	controle que faz busca de todos os funcionarios cadastrados
	 no sistema para o autocomplete do jquery UI.
*/	
	if(isset($_GET['jsonFuncionario']))
	{



		$funcionario_dao = new FuncionarioDAO();
		$stmt_funcionario_1  = $funcionario_dao->getGerenteforAutoComplete();

		echo json_encode($fetch = $stmt_funcionario_1->fetchAll(PDO::FETCH_ASSOC));
	}
	
	if(isset($_GET['jsonCampo']))
	{

		$campo_dao = new CampoDao();
		$stmt_campo  = $campo_dao->buscaCampo(null,null);

		echo json_encode($fetch = $stmt_campo->fetchAll(PDO::FETCH_ASSOC));
	}


 ?>