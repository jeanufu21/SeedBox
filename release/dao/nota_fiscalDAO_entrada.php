<?php 

	/*
	Cadastro de Nota Fiscal
	Author: Gustavo Moreira
	date:20/03/2014
	*/
	include_once("conexao.php");
	include_once("../model/nota_fiscal_model_entrada.php");
	include_once("historico_dao.php");

	class NotaFiscalDao {

		function insereNota(NotaFiscal $nota, $parceiro)
		{
			try{

				$conecta = Conexao::getInstance();

                /* Consulta Original
				$sql = "INSERT INTO `nota_fiscal`(`COD_NOTAFISCAL`, `COD_PARCEIRO`, `DESCRICAO`, `DATA_PEDIDO`, `STATUS_PAGAMENTO`,
				 		`STATUS_ENTREGA`, `VALOR_TOTAL`, `DATA_ENTREGA`, `DATA_PREVISTA`, `NF_IO`, `DELETADA`) 
						VALUES (:cod_nota, :cod_parceiro,:descricao,:data_pedido,:status_pagamento,:status_entrega,:valor_total,:data_entrega,:data_prevista, :io, 0)";
                */

                $sql = "INSERT INTO `nota_fiscal`(`COD_NOTAFISCAL`, `COD_PARCEIRO`, `DESCRICAO`, `DATA_PEDIDO`, `NF_IO`, `DELETADA`) 
						VALUES (:cod_nota, :cod_parceiro,:descricao,:data_pedido, :io, 0)";
				
				$stmt = $conecta->prepare($sql);
				$stmt->bindParam(':cod_nota',$nota->getCodNota());
				$stmt->bindParam(':cod_parceiro',$nota->getCodParceiro());
				$stmt->bindParam(':descricao',$nota->getDescricao());
				$stmt->bindParam(':data_pedido',$nota->getDataPedido());
				/*
                $stmt->bindParam(':status_pagamento',$nota->getStatusPagamento());
				$stmt->bindParam(':status_entrega',$nota->getStatusEntrega());
				$stmt->bindParam(':valor_total',$nota->getValorTotal());
				$stmt->bindParam(':data_entrega',$nota->getDataEntrega());
				$stmt->bindParam(':data_prevista',$nota->getDataPrevista());
				*/
                $stmt->bindParam(':io',$nota->getIO());

				$stmt->execute();
				Historico::registraHistorico("insert","nota_fiscal","New bill of sale with the code: <b><i>".$nota->getCodNota()."</b></i> from partner <b><i>".$parceiro."</b></i>");

				return 1;

			} catch(Exception $erro) {
				echo $erro->getMessage();

				return 0;
			}
		}//fim da funcao

		function buscaNota($nota, $parceiro, $io)
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "SELECT * FROM `nota_fiscal` WHERE COD_NOTAFISCAL = :nota AND NF_IO = :io AND COD_PARCEIRO = :parceiro";

				$stmt = $conexao->prepare($sql);
				$stmt->bindValue(':nota', $nota);
				$stmt->bindValue(':parceiro', $parceiro);
				$stmt->bindValue(':io', $io);
				$stmt->execute();

				return $stmt;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
			}
		}
		function cancelaNota($nota, $parceiro, $io){
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "UPDATE `nota_fiscal` SET DELETADA = 1 WHERE COD_NOTAFISCAL = :nota AND NF_IO = :io AND COD_PARCEIRO = :parceiro";

				$stmt = $conexao->prepare($sql);
				$stmt->bindValue(':nota', $nota);
				$stmt->bindValue(':parceiro', $parceiro);
				$stmt->bindValue(':io', $io);
				$stmt->execute();

				Historico::registraHistorico("update","nota_fiscal","Cancelled bill of sale with the code: <b><i>".$nota."</b></i>");

				return $stmt;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
			}
		}

		function buscaUltimaNota()
		{

			try
			{
				$conexao = Conexao::getInstance();

				$sql = "SELECT COD_NOTAFISCAL FROM `nota_fiscal` ORDER BY COD_NOTAFISCAL LIMIT 1";

				$stmt = $conexao->prepare($sql);
				$stmt->execute();

				return $stmt;
			}
			catch(PDOExecption $erro)
			{
				echo $erro->getMessage();
			}

		}


	}
?>