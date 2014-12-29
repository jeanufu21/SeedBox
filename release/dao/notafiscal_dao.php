<?php 

		include_once("conexao.php");
		include_once("historico_dao.php");

		class NotaDAO
		{
			function CriaNota(NotaFiscal $nota_obj)
			{
				try
				{
					$conexao = Conexao::getInstance();

                    /*sql original

                    $sql = "INSERT INTO `nota_fiscal`(`COD_PARCEIRO`,`NF_IO`,`DESCRICAO`, 
					`DATA_PEDIDO`, `STATUS_PAGAMENTO`, `STATUS_ENTREGA`, `VALOR_TOTAL`, `DATA_ENTREGA`, `DATA_PREVISTA`) 
					VALUES (:codParceiro,:nf_io,:descricao,:dataPedido,:statusPagamento,:statusEntrega,:valorTotal,
						   :dataEntrega,:dataPrevista)";
                    */

					$sql = "INSERT INTO `nota_fiscal`(`COD_PARCEIRO`,`NF_IO`,`DESCRICAO`, `DATA_PEDIDO`, `VALOR_TOTAL`, `DATA_ENTREGA`) 
                    VALUES (:codParceiro,:nf_io,:descricao,:dataPedido,:valorTotal,:dataEntrega)";

					$stmt = $conexao->prepare($sql);

					$stmt->bindParam(":codParceiro",$nota_obj->getCodParceiro());
					$stmt->bindParam(":nf_io",$nota_obj->getIO());
					$stmt->bindParam(":descricao",$nota_obj->getDescricao());
					$stmt->bindParam(":dataPedido",$nota_obj->getDataPedido());
                    /*
					$stmt->bindParam(":statusPagamento",$nota_obj->getStatusPagamento());
					$stmt->bindParam(":statusEntrega",$nota_obj->getStatusEntrega());
                    */
					$stmt->bindParam(":valorTotal",$nota_obj->getValorTotal());
					$stmt->bindParam(":dataEntrega",$nota_obj->getDataEntrega());
                    /*
					$stmt->bindParam(":dataPrevista",$nota_obj->getDataPrevista());
                    */

					$stmt->execute();

					Historico::registraHistorico("insert","nota fiscal ","Cadastro de uma nota fiscal para o parceiro ".$nota_obj->getCodParceiro()." ");

					return 1;
				}
				catch(PDOException $erro)
				{
					echo $erro->getMessage();
					return 0;
				}
			}

			function buscaNotaDesc($codParceiro)
			{
				try
				{
					$conexao = Conexao::getInstance();

					$sql = "SELECT MAX(`COD_NOTAFISCAL`) AS COD_NOTAFISCAL FROM `nota_fiscal` WHERE NF_IO='O' AND COD_PARCEIRO='".$codParceiro."'";
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOException $erro)
				{
					echo $erro->getMessage();
					return 0;
				}
			}
		}// fim da classe

 ?>