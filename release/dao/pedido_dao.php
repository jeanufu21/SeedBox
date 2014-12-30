<?php 

/*
Title: Dao para Pedidos
Author:Jean Fabrício
Date:12/03/2014
*/

include_once("../model/pedido_model.php");
include_once("conexao.php");
include_once("historico_dao.php");
include_once("parceiro_dao.php");
include_once("funcionario_dao.php");

 class PedidoDAO
{
	 function inserePedido(Pedido $pedido_obj)
	{
		try
		{
			$conexao = Conexao::getInstance();

			$sql = "INSERT INTO `pedido`(`COD_PEDIDO`, `DATA_PEDIDO`, `COD_PARCEIRO`, `COD_FUNC`,`STATUS`)
					 VALUES (null,:dataPedido,:codParceiro,:codFunc,'Em espera')";

			$stmt = $conexao->prepare($sql);
			$stmt->bindParam(":dataPedido",$pedido_obj->getDataPedido());
			$stmt->bindParam(":codParceiro",$pedido_obj->getParceiro());
			$stmt->bindParam(":codFunc",$pedido_obj->getFuncionario());
			$stmt->execute();

			$parceiro = new ParceiroDAO();

			$stmt2 = $parceiro->buscaParceiro("COD_PARCEIRO",$pedido_obj->getParceiro());
			$quemParceiro =	$stmt2->fetch(PDO::FETCH_ASSOC);


			$funcionario = new FuncionarioDAO();

			$stmt3 = $funcionario->buscaFuncionario("ID_funcionario",$pedido_obj->getFuncionario());
			$usuario =	$stmt3->fetch(PDO::FETCH_ASSOC);

			Historico::registraHistorico("insert","pedido","cadastro de um pedido do gerente <b><i>".$usuario["NOME"]."</b></i> para o parceiro <b><i>".$quemParceiro["NOME"]."</b></i> na data <b><i>".$pedido_obj->getDataPedido()."</b></i>");

			return 1;
		}
		catch(PDOExecption $erro)
		{
			echo $erro->getMessage();
			return 0;
		}
	}

		function BuscaPedido()
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "SELECT * FROM  `pedido` ORDER BY  `COD_PEDIDO` DESC ";

				$stmt = $conexao->prepare($sql);
				$stmt->execute();

				return $stmt;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}

		}

		function Busca($type,$value)
		{
			try
			{
				$conexao = Conexao::getInstance();
				if($value == null)
					$sql = "SELECT * FROM  `pedido`";
				else
				$sql = "SELECT * FROM  `pedido` WHERE ".$type."=".$value;

				$stmt = $conexao->prepare($sql);
				$stmt->execute();

				return $stmt;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
		}


		function RemovePedido($cod)
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "DELETE FROM `pedido` WHERE COD_PEDIDO='".$cod."'";

				$stmt = $conexao->prepare($sql);
				$stmt->execute();

				return 1;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
		}

		function Atualiza($campo,$novoValor,$termo,$valor)
		{
			try
			{	
				$conexao = Conexao::getInstance();

				$sql = "UPDATE `pedido` SET ".$campo."='".$novoValor."' WHERE ".$termo."='".$valor."'";
				$stmt = $conexao->prepare($sql);
				$stmt->execute();

				return 1;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
			
		}
		

}

?>