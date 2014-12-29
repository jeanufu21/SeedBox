<?php 


/*
Title:Controle de Produto
Author:Jean Fabrício
Date:  22/02/2014
*/
include_once("../model/produto_model.php");
include_once("../dao/produto_dao.php");
include_once("../dao/set_dao.php");
include_once("../dao/marca_dao.php");



if(isset($_GET['marca']))
{
	$marca_dao = new MarcaDao();

	$stmt = $marca_dao->busca("COD_MARCA",$_POST['marca_busca']);

	$dado = $stmt->fetch(PDO::FETCH_ASSOC);
	
	echo strtoupper($dado['NOME_FANTASIA']);
}
if(isset($_GET['cd_produto']))
{

	$produto_obj = new Produto();
	$set_dao = new SetDAO();

	$validacao = null;
	// cadastro e busca do set para juntar com o produto...
	$set = montaSet($_POST);
	$stmt = $set_dao->BuscaSet($set);
	$resultadoBusca = $stmt->fetch(PDO::FETCH_ASSOC);
	$CodSet = $resultadoBusca['COD_SET_VALORES'];
	
	if( $CodSet == null)
	{

		if($set_dao->cadastraSet($set))
			$validacao = true;
		else 
			 $validacao = false;

		$stmt = $set_dao->BuscaSet($set);
		$resultadoBusca = $stmt->fetch(PDO::FETCH_ASSOC);
		$CodSet = $resultadoBusca['COD_SET_VALORES'];

	}

	$produto_obj->setNome($_POST['name']);
	$produto_obj->setCodSetValores($CodSet);
	$produto_obj->setCodMarca($_POST['obrand']);
	$produto_obj->setPdgOriginal($_POST['opedgree']);
	$produto_obj->setPdgNacional($_POST['bpedgree']);
	$produto_obj->setPeletizado($_POST['peletizado']);
	$produto_obj->setOrganico($_POST['organico']);
	$produto_obj->setObservacao($_POST['obs_interno']);
	$produto_obj->setCodFase($_POST['fases']);
	$produto_obj->setResistencia($_POST['resistence']);


	$produtoDao = new ProdutoDao();


	$stmt_valida = $produtoDao->buscaProdutoCase("PEDIGREE_ORIGINAL",$produto_obj->getPdgOriginal());


	/*
		As validações abaixo são iguais ou maiores que 1 devido a busca ocorrer pelo like do SQL
		assim é necessario que o usuario entre com dados completos para que seja cadastrado
	*/
	if($stmt_valida->rowCount() >=1)
	{
		echo "-1";
		return 0;
	}
	
	$stmt_valida_2 = $produtoDao->buscaProdutoCase("PEDIGREE_BRASIL",$produto_obj->getPdgNacional());

	if($stmt_valida_2->rowCount()>=1)
	{
		echo "-1";
		return 0;
	}


 if($produtoDao->insereProduto($produto_obj))
 		$validacao = true;
 else
	    $validacao = false;

		if($validacao)
			echo "1";
 		else
 			echo "0";


}

function montaSet($array)
{

	$str = "";

		foreach ($array as $key => $value) 
		{
			
			if(strcmp($key,"name") == 0)
			break;

			$str.= $value."#";
		}
		
		$str.=$array['fases'];
		return $str;
}

function postar()
{
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
}
?>