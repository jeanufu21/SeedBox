<?php 

/*
	DAO de Marca
	Author: Tacio
	date:27/02/2014
*/
include_once("conexao.php");
include_once("../model/marca_model.php");
include_once("historico_dao.php");
include_once("parceiro_dao.php");

class MarcaDao {

	function insere(Marca $marca)
	{
		try{
			$conecta = Conexao::getInstance();

			$sql = "INSERT INTO marca (COD_MARCA,ORIGINAL_BRAND,NOME_FANTASIA,COD_PARCEIRO)
					VALUES(NULL,:original, :fantasia,:codParceiro)";
			
			$stmt = $conecta->prepare($sql);
			$stmt->bindValue(':original',$marca->getOriginalBrand());
			$stmt->bindValue(':fantasia',$marca->getNomeFantasia());
			$stmt->bindValue(':codParceiro',$marca->getParceiro());
			$stmt->execute();
			

			$parceiro = new ParceiroDAO();

			$stmt2 = $parceiro->buscaParceiro("COD_PARCEIRO",$marca->getParceiro());
			$quemParceiro =	$stmt2->fetch(PDO::FETCH_ASSOC);

			Historico::registraHistorico("insert","marca","cadastro da marca <b><i>".$marca->getOriginalBrand().
				"</b></i> com o nome fantasia <b><i>".$marca->getNomeFantasia()."</b></i> para o parceiro <b><i>".$quemParceiro["NOME"]."</b></i>");


			if ($stmt->rowCount() > 0)
				return 1;	
			else 
				return 0;
			
			
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}

function busca($termo,$value)
{
	try{
			$conecta = Conexao::getInstance();
			
			if($value == null)
				$sql = "SELECT * FROM `marca` ORDER BY `marca`.`ORIGINAL_BRAND` ASC ";
			if($value !=null)
			$sql = "SELECT * FROM `marca` WHERE  ".$termo."='".$value."'";
				
			$stmt = $conecta->prepare($sql);
			$stmt->execute();

			//atribui resultado no formato de um vetor indexado pelo nome do campo tabela
			return $stmt;
	
		} 
		catch(PDOExecption $erro){
				echo $erro->getMessage();
		}
}

function busca_2($termo,$value)
{
	try{
			$conecta = Conexao::getInstance();
			
			if($value == null)
				$sql = "SELECT * FROM `marca`";
			if($value !=null)
			$sql = "SELECT * FROM `marca` WHERE  ".$termo." LIKE '%".$value."%'";
				
			$stmt = $conecta->prepare($sql);
			$stmt->execute();

			//atribui resultado no formato de um vetor indexado pelo nome do campo tabela
			return $stmt;
	
		} 
		catch(PDOExecption $erro){
				echo $erro->getMessage();
		}
}	

function deleta($codMarca)
{
	try{
			$conecta = Conexao::getInstance();

			$sql = "DELETE FROM marca WHERE COD_MARCA=".$codMarca;
			
			$stmt = $conecta->prepare($sql);
			$stmt->execute();
			return 1;
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}

}

function update($marca_obj)
{
	try{
			$conecta = Conexao::getInstance();

			$sql = "UPDATE `marca` SET `ORIGINAL_BRAND`='".$marca_obj->getOriginalBrand()."',";

			if($marca_obj->getParceiro() == -1)
				$sql.= "COD_PARCEIRO = NULL ,
					`NOME_FANTASIA`='".$marca_obj->getNomeFantasia()."'
				     WHERE COD_MARCA = '".$marca_obj->getCodigo()."'";
			else
				$sql.= "COD_PARCEIRO = '".$marca_obj->getParceiro()."',
				    `NOME_FANTASIA`='".$marca_obj->getNomeFantasia()."'
				     WHERE COD_MARCA = '".$marca_obj->getCodigo()."'";
			
			$stmt = $conecta->prepare($sql);
			$stmt->execute();
			// echo  $sql;
			return 1;
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}

}


}
	
