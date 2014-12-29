<?php 

		/*
		Cadastro de Itens da Nota fiscal
		Author: Gustavo Moreira
		date:27/03/2014
		*/

		include_once("conexao.php");
		include_once("../model/item_nota_fiscal_model_entrada.php");

		class ItemNotaFiscalDAO{
				function insereItemNotaFiscal(ItemNotaFiscal $item){
					try{
						$conecta = Conexao::getInstance();
						$sql = "INSERT INTO `itens_notafiscal`(`COD_NOTAFISCAL`, `COD_PRODUTO`, `QUANTIDADE`, `UNIDADE_MEDIDA`, `COD_ESTOQUE`, `COD_PARCEIRO`, `NF_IO`) 
								VALUES (:codNotaFiscal,:codProduto,:quantidade,:unidadeMedida,:estoque,:parceiro,:io)";

						$stmt = $conecta->prepare($sql);
						$stmt->bindParam(':codNotaFiscal',$item->getCodNotaFiscal());
						$stmt->bindParam(':codProduto',$item->getCodProduto());
						$stmt->bindParam(':quantidade',$item->getQuantidade());
						$stmt->bindParam(':unidadeMedida',$item->getUnidadeMedida());
						/*stmt->bindParam(':valor',$item->getValor());*/
						$stmt->bindParam(':estoque',$item->getCodEstoque());
						$stmt->bindParam(':parceiro',$item->getCodParceiro());
						$stmt->bindParam(':io',$item->getIO());
						$stmt->execute();

						return 1;
					}
					catch(PDOException $erro){
						echo $erro->getMessage();

						return 0;
					}
				}
				function buscaItem($nota, $parceiro, $io)
				{
					try
					{
						$conexao = Conexao::getInstance();

						$sql = "SELECT * FROM estoque INNER JOIN itens_notafiscal ON (estoque.COD_ESTOQUE = itens_notafiscal.COD_ESTOQUE AND estoque.UNIDADE_MEDIDA = itens_notafiscal.UNIDADE_MEDIDA) 
								WHERE COD_NOTAFISCAL = :nota AND COD_PARCEIRO = :parceiro AND NF_IO = :io";
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
				function cancelaNota($nota, $parceiro, $io)
				{
					try
					{
						$conexao = Conexao::getInstance();

						$sql = "SELECT COD_ESTOQUE FROM itens_notafiscal WHERE COD_NOTAFISCAL = :nota AND COD_PARCEIRO = :parceiro AND NF_IO = :io";
						$stmt = $conexao->prepare($sql);
						$stmt->bindValue(':nota', $nota);
						$stmt->bindValue(':parceiro', $parceiro);
						$stmt->bindValue(':io', $io);
						$stmt->execute();
						
						$sql2 = "UPDATE estoque SET QNT_ENTRADA = 0, QUANT_ATUAL = 0 WHERE COD_ESTOQUE = :cod_estoque";
						$stmt2 = $conexao->prepare($sql2);

						while($dados = $stmt->fetch(PDO::FETCH_ASSOC)){
							$stmt2->bindValue(':cod_estoque', $dados['COD_ESTOQUE']);

							$stmt2->execute();
						}
					}
					catch(PDOExecption $erro)
					{
						echo $erro->getMessage();
					}
				}

		}
?>