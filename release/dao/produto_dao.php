<?php 

/*
Cadastro de Produtos
Author: Jean Fabrício
date:22/02/2014
*/
include_once("conexao.php");
include_once("../model/produto_model.php");
include_once("historico_dao.php");

class ProdutoDao {

function insereProduto(Produto $produto)
{
	try{

	$conecta = Conexao::getInstance();

	$sql = "INSERT INTO `produto`(`COD_PRODUTO`, `NOME`, `COD_SET_VALORES`, `COD_MARCA`,
	 		`PEDIGREE_ORIGINAL`, `PEDIGREE_BRASIL`, `PELETIZADA`, `ORGANICA`, `OBSERVACAO`, `COD_FASE`, `RESISTENCIA`) 
			VALUES (null,:nome,:codSetVal,:codMarca,:pdgOrig,:pdgNac,:peletizada,:organico,
					:obs,:codFase,:resistencia)";
	
	$stmt = $conecta->prepare($sql);
	$stmt->bindParam(':nome',$produto->getNome());
	$stmt->bindParam(':codSetVal',$produto->getCodSetValores());
	$stmt->bindParam(':codMarca',$produto->getCodMarca());
	$stmt->bindParam(':pdgOrig',$produto->getPdgOriginal());
	$stmt->bindParam(':pdgNac',$produto->getPdgNacional());
	$stmt->bindParam(':peletizada',$produto->getPeletizado());
	$stmt->bindParam(':organico',$produto->getOrganico());
	$stmt->bindParam(':obs',$produto->getObservacao());
	$stmt->bindParam(':codFase',$produto->getCodFase());
	$stmt->bindParam(':resistencia',$produto->getResistencia());

	 $stmt->execute();

	 Historico::registraHistorico("insert","produto","cadastro do produto <b><i>".$produto->getNome()."</b></i>");
	 
		return 1;
	} 
	catch(PDOExecption $erro){
		echo $erro->getMessage();

		return 0;
	}
}//fim da funcao


function buscaProduto($termo_busca,$valor_busca)
{
	try
	{
		$conexao = Conexao::getInstance();

		if($valor_busca != null)
		$sql = "SELECT * FROM produto WHERE  ".$termo_busca." LIKE '%".$valor_busca."%'";	
		else if($valor_busca == null)
		$sql = "SELECT * FROM produto";	

		$query = $conexao->prepare($sql);
		$query->execute();

		return $query;
	}
	catch(PDOExecption $error)
	{
		echo "<script>alert('".$error->getMessage()."');</script>";
	}


}


function buscaProdutoCase($termo_busca,$valor_busca)
{
	try
	{
		$conexao = Conexao::getInstance();

		if($valor_busca != null)
		$sql = "SELECT * FROM produto WHERE  ".$termo_busca." = '".$valor_busca."'";	
		else if($valor_busca == null)
		$sql = "SELECT * FROM produto";	

		$query = $conexao->prepare($sql);
		$query->execute();

		return $query;
	}
	catch(PDOExecption $error)
	{
		echo "<script>alert('".$error->getMessage()."');</script>";
	}


}


// Busca todos os produtos com os codigos de sets especificos
// essa busca é usada na tela de pedido, no autocomplete de produtos

function buscaProdutos_porSets($array_cod_set)
{
	try
	{
		$size = count($array_cod_set);

		$conexao = Conexao::getInstance();

		$sql = "SELECT * FROM `produto` WHERE COD_SET_VALORES IN(";

		for($i=0;$i<$size;$i++)
		{
			if($i == $size-1)
				$sql.=$array_cod_set[$i];
			else
				$sql.=$array_cod_set[$i].",";
		}
			
		$sql.= ")";
		$query = $conexao->prepare($sql);
		$query->execute();

		return $query;
	}
	catch(PDOExecption $error)
	{
		echo "<script>alert('".$error->getMessage()."');</script>";
	}


}

function update($produto_obj)
{
	try
	{
		

		$conexao = Conexao::getInstance();

		$sql = "UPDATE `produto` SET `NOME`=:nome,`COD_MARCA`=:cod_marca,
		`PELETIZADA`= :peletizada,`ORGANICA`=:organica,`COD_FASE`=:cod_fase,`PEDIGREE_BRASIL`=:pbrasil,
		`RESISTENCIA`= :resistencia WHERE COD_PRODUTO=:cod_produto";
		
		$query = $conexao->prepare($sql);
		$query->bindValue(":nome",$produto_obj->getNome());
		$query->bindValue(":cod_marca",$produto_obj->getCodMarca());
		$query->bindValue(":peletizada",$produto_obj->getPeletizado());
		$query->bindValue(":organica",$produto_obj->getOrganico());
		$query->bindValue(":cod_fase",$produto_obj->getCodFase());
		$query->bindValue(":pbrasil",$produto_obj->getPdgNacional());
		$query->bindValue(":resistencia",$produto_obj->getResistencia());
		$query->bindValue(":cod_produto",$produto_obj->getCodProduto());
		$query->execute();

		Historico::registraHistorico("update","product","updating of the product <b><i>".$produto_obj->getNome()."</b></i>");
		return 1;
	}
	catch(PDOExecption $error)
	{
		echo $error->getMessage();
		return 0;
	}


}




}

?>