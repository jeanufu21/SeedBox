<?php

	/*
	Title:Controle de Nota Fiscal
	Author:Gustavo Moreira
	Date:  20/03/2014
	*/

	include_once("../model/nota_fiscal_model.php");
	include_once("../model/item_nota_fiscal_model.php");
	include_once("../model/estoque_model.php");
	include_once("../dao/item_nota_fiscalDAO.php");
	include_once("../dao/estoqueDAO.php");
	include_once("../dao/nota_fiscalDAO.php");
	include_once("../dao/parceiro_dao.php");
	include_once("../dao/produto_dao.php");

	if(isset($_GET['cd_nota']))
	{
		$nota_obj = new NotaFiscal();
		$itens = new ItemNotaFiscal();
		$itemDao = new ItemNotaFiscalDAO();
		$estoqueDAO = new EstoqueDAO();
		$estoque = new Estoque();
		$parceiro_dao = new ParceiroDAO();
		$produto_dao = new ProdutoDAO();

		$erro=0;

		$i=0;

		$parceiro_nome = $parceiro_dao->buscaParceiro('NOME',$_POST['parceiro']);
		$dados = $parceiro_nome->fetch(PDO::FETCH_ASSOC);

		$nota_obj->setCodNota($_POST['cod_nota']);
		$nota_obj->setCodParceiro($dados['COD_PARCEIRO']);
		$nota_obj->setDescricao($_POST['descricao']);
		$nota_obj->setDataPedido($_POST['data_pedido']);
		$nota_obj->setStatusPagamento($_POST['status_pagamento']);
		$nota_obj->setStatusEntrega($_POST['status_entrega']);
		$nota_obj->setValorTotal($_POST['valor']);
		$nota_obj->setDataEntrega($_POST['data_entrega']);
		$nota_obj->setDataPrevista($_POST['data_prevista']);
		$nota_obj->setIO('I');

		$notaDao = new NotaFiscalDao();
		if($notaDao->insereNota($nota_obj)==0){
			$erro=1;
		}

		while($i < $_POST['rownum']){
			$produto_nome = $produto_dao->buscaProduto('NOME',$_POST['cod_produto'.$i]);
			$dados1 = $produto_nome->fetch(PDO::FETCH_ASSOC);

			$estoque->setCodProduto($dados1['COD_PRODUTO']);
			$estoque->setCodLote($_POST['lote'.$i]);
			$estoque->setQtdEntrada($_POST['quantidade'.$i]);
			$estoque->setQtdAtual($_POST['quantidade'.$i]);
			$estoque->setUnidadeMedida($_POST['unidade_medida'.$i]);
			$estoque->setTipoEmbalagem($_POST['tipo_embalagem'.$i]);
			$estoque->setPesoEmbalagem($_POST['peso_por_embalagem'.$i]);
			$estoque->setDataVencimento($_POST['data_vencimento'.$i]);
			$estoque->setDataEntrada($nota_obj->getDataEntrega());

			if($estoqueDAO->insereEstoque($estoque)==0){
				$erro=2;
			}

			$itembusca = $estoqueDAO->buscaUltimoEstoque();
			$dados2 = $itembusca->fetch(PDO::FETCH_ASSOC);

			$itens->setCodNotaFiscal($nota_obj->getCodNota());
			$itens->setCodProduto($dados1['COD_PRODUTO']);
			$itens->setQuantidade($_POST['quantidade'.$i]);
			$itens->setUnidadeMedida($_POST['unidade_medida'.$i]);
			$itens->setValor($_POST['valor_item'.$i]);
			$itens->setCodEstoque($dados2['COD_ESTOQUE']);
			$itens->setCodParceiro($dados['COD_PARCEIRO']);
			$itens->setIO('I');

			if($itemDao->insereItemNotaFiscal($itens)==0){
				$erro=3;
			}
			$i++;
		}
		if($erro==0)
			echo '<script>novaMensagem("sucesso","Success!")</script>';
		else if ($erro==1)
			echo '<script>novaMensagem("erro","Error when registering bill of sale!")</script>';
		else if($erro==2)
			echo '<script>novaMensagem("erro","Error when registering stock")</script>';
		else
			echo '<script>novaMensagem("erro","Error when registering Item")</script>';


	}

	else if(isset($_GET['jsonParceiro']))
	{
		$parceiro_dao = new ParceiroDAO();
		$stmt_Parceiro_1  = $parceiro_dao->buscaParceiro(null,null);

		echo json_encode($fetch = $stmt_Parceiro_1->fetchAll(PDO::FETCH_ASSOC));
	}

	else if(isset($_GET['jsonProduto']))
	{
		$produto_dao = new ProdutoDAO();
		$stmt_Produto_1  = $produto_dao->buscaProduto(null,null);

		echo json_encode($fetch = $stmt_Produto_1->fetchAll(PDO::FETCH_ASSOC));
	}
	else if(isset($_GET['verifica']))
	{
		$parceiro_dao = new ParceiroDAO();
		$estoqueDAO = new EstoqueDAO();
		$itemDao = new ItemNotaFiscalDAO();

		$parceiro_nome = $parceiro_dao->buscaParceiro('NOME',$_POST['parceiro']);
		$dados = $parceiro_nome->fetch(PDO::FETCH_ASSOC);

		$buscaEstoque = $estoqueDAO->buscaEstoque($_POST['cod_nota'], $dados['COD_PARCEIRO'], 'I');

		if(count($res)>0){



			echo '<script>
				
			</script>';
		}
	}

?>