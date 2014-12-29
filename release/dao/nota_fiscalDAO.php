<?php 

	/*
	Cadastro de Nota Fiscal
	Author: Gustavo Moreira
	date:20/03/2014
	*/
	include_once("conexao.php");
	include_once("../model/nota_fiscal_model.php");

	class NotaFiscalDao {

		function insereNota(NotaFiscal $nota)
		{
			try{

				$conecta = Conexao::getInstance();
                
                $sql = "INSERT INTO `nota_fiscal`(`COD_NOTAFISCAL`, `COD_PARCEIRO`, `DESCRICAO`, `DATA_PEDIDO`, `STATUS_PAGAMENTO`,
				 		`STATUS_ENTREGA`, `VALOR_TOTAL`, `DATA_ENTREGA`, `DATA_PREVISTA`, `NF_IO`) 
						VALUES (:cod_nota, :cod_parceiro,:descricao,:data_pedido,:status_pagamento,:status_entrega,:valor_total,:data_entrega,:data_prevista, :io)";
				
                $stmt = $conecta->prepare($sql);
				$stmt->bindParam(':cod_nota',$nota->getCodNota());
				$stmt->bindParam(':cod_parceiro',$nota->getCodParceiro());
				$stmt->bindParam(':descricao',$nota->getDescricao());
				$stmt->bindParam(':data_pedido',$nota->getDataPedido());
				$stmt->bindParam(':status_pagamento',$nota->getStatusPagamento());
				$stmt->bindParam(':status_entrega',$nota->getStatusEntrega());
				$stmt->bindParam(':valor_total',$nota->getValorTotal());
				$stmt->bindParam(':data_entrega',$nota->getDataEntrega());
				$stmt->bindParam(':data_prevista',$nota->getDataPrevista());
				$stmt->bindParam(':io',$nota->getIO());

				$stmt->execute();
					return 1;

			} catch(Exception $erro) {
				echo $erro->getMessage();

				return 0;
			}
		}//fim da funcao

		function buscaNotaIn($nota, $parceiro)
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "SELECT * FROM `nota_fiscal` WHERE COD_NOTAFISCAL = :nota AND NF_IO = `I` AND COD_PARCEIRO = :parceiro";

				$stmt = $conexao->prepare($sql);
				$stmt->bindValue(':nota', $nota);
				$stmt->bindValue(':parceiro', $parceiro);
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