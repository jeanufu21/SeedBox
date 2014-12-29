<?php 

		include_once("conexao.php");
		include_once("../model/item_nota_fiscal_model.php");
		include_once("historico_dao.php");

		class ItensNotaDAO
		{
				
			function insereItensNota(ItemNotaFiscal $itens_nota_obj)
			{
				try
				{
					$conexao  = Conexao::getInstance();

					$sql = "INSERT INTO `itens_notafiscal`(`COD_PARCEIRO`,`COD_NOTAFISCAL`,`NF_IO`, `COD_ESTOQUE`,`COD_PRODUTO`, `QUANTIDADE`, `UNIDADE_MEDIDA`, `VALOR`) 
					VALUES (:codParc,:codNota,:nf_io,:codEsto,:codProduto,:quant,:medida,:valor)";

					$stmt = $conexao->prepare($sql);
					$stmt->bindParam(":codParc",$itens_nota_obj->getCodParceiro());
					$stmt->bindParam(":codNota",$itens_nota_obj->getCodNotaFiscal());
					$stmt->bindParam(":nf_io",$itens_nota_obj->getIO());
					$stmt->bindParam(":codEsto",$itens_nota_obj->getCodEstoque());
					$stmt->bindParam(":codProduto",$itens_nota_obj->getCodProduto());
					$stmt->bindParam(":quant",$itens_nota_obj->getQuantidade());
					$stmt->bindParam(":medida",$itens_nota_obj->getUnidadeMedida());
					$stmt->bindParam(":valor",$itens_nota_obj->getValor());

					$stmt->execute();

					Historico::registraHistorico("insert","itens nota fiscal ","Inserção de um item na nota fiscal ".$itens_nota_obj->getCodNotaFiscal()." para o produto ".$itens_nota_obj->getCodProduto());

					return 1;
				}
				catch(PDOException $erro)
				{
					echo $erro->getMessage();
					return 0;
				}
			}
		}

 ?>