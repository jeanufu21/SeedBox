<?php 
/*
	Title: Dao para gerenciamento de Itens do pedido
	Author:Jean Fabrício
	Date:12/03/2014
*/


	include_once("../model/itens_model.php");
	include_once("conexao.php");
	include_once("historico_dao.php");

 class ItemDAO
	{

	 function insereItem(Item $item_obj)
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "INSERT INTO `itens_pedido`(`COD_ITEMPED`, `COD_PEDIDO`, `COD_PRODUTO`, `QUANTIDADE`, `UNIDADE_MEDIDA`, `VALOR`)
					    VALUES (null,:codPedido,:codProduto,:quant,:unidMed,null)";

				$stmt = $conexao->prepare($sql);
				$stmt->bindParam(":codPedido",$item_obj->getCodPedido());
				$stmt->bindParam(":codProduto",$item_obj->getCodProduto());
				$stmt->bindParam(":quant",$item_obj->getQuantidade());
				$stmt->bindParam(":unidMed",$item_obj->getMedida());
				$stmt->execute();

				Historico::registraHistorico("insert","itens pedido","Inserção do pedido ".$item_obj->getCodPedido()." para o produto ".$item_obj->getCodProduto());
				
				return 1;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
			 


		}// fim da função

		function BuscaItem($termo,$codPedido)
		{
			try
			{
				$conexao = Conexao::getInstance();
				if($codPedido == null)
				$sql = "SELECT * FROM `itens_pedido`";
				else if($codPedido !=null)
				$sql = "SELECT * FROM `itens_pedido` WHERE ".$termo."='".$codPedido."'";
					
				$stmt = $conexao->prepare($sql);
				$stmt->execute();

				
				return $stmt;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
		}// fim da função

		function Removeitem($termo,$value)
		{
			try
			{
				$conexao = Conexao::getInstance();
				$sql = "DELETE FROM `itens_pedido` WHERE ".$termo."='".$value."'";
					
				$stmt = $conexao->prepare($sql);
				$stmt->execute();
			
				return 1;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
		}// fim da função

	}

 ?>