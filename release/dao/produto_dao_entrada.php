<?php 

/*
Cadastro de Produtos
Author: Jean Fabrício
date:22/02/2014
*/
include_once("conexao.php");
include_once("../model/produto_model_entrada.php");
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

}

?>