<?php 

		/*
		Cadastro de Itens no estoque
		Author: Gustavo Moreira
		date:27/03/2014
		*/

		include_once("conexao.php");
		include_once("../model/item_nota_fiscal_model_entrada.php");

		class EstoqueDAO{
			function insereEstoque(Estoque $estoque){
				try{
					$conecta = Conexao::getInstance();
					$sql = "INSERT INTO `estoque`(`COD_PRODUTO`, `COD_LOTE`, `QNT_ENTRADA`, `QUANT_ATUAL`, `UNIDADE_MEDIDA`, `TIPO_EMBALAGEM`, `PESO_POR_EMBALAGEM`, `DATA_ENTRADA`, `DATA_VENCIMENTO`) 
							VALUES (:codProduto, :codLote, :qntEntrada, :quantAtual, :unidadeMedida, :tipoEmbalagem, :pesoEmbalagem, :dataEntrada, :dataVencimento)";

					$stmt = $conecta->prepare($sql);
					$stmt->bindParam(':codProduto',$estoque->getCodProduto());
					$stmt->bindParam(':codLote',$estoque->getCodLote());
					$stmt->bindParam(':qntEntrada',$estoque->getQtdEntrada());
					$stmt->bindParam(':quantAtual',$estoque->getQtdAtual());
					$stmt->bindParam(':unidadeMedida',$estoque->getUnidadeMedida());
					$stmt->bindParam(':tipoEmbalagem',$estoque->getTipoEmbalagem());
					$stmt->bindParam(':pesoEmbalagem',$estoque->getPesoEmbalagem());
					$stmt->bindParam(':dataEntrada',$estoque->getDataEntrada());
					$stmt->bindParam(':dataVencimento',$estoque->getDataVencimento());

					$stmt->execute();
					

					return 1;
				}

				catch(PDOException $erro){
					echo $erro->getMessage();

					return 0;
				}
			}

			function buscaUltimoEstoque(){

				try{
					$conecta = Conexao::getInstance();

					$sql = "SELECT * FROM `estoque` ORDER BY `COD_ESTOQUE` DESC";

					$stmt = $conecta->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro){
					echo $erro->getMessage();
				}
			}
		}
?>