<?php

	/*
	Title:Controle de Nota Fiscal
	Author:Gustavo Moreira
	Date:  20/03/2014
	*/

	include_once("../model/nota_fiscal_model_entrada.php");
	include_once("../model/item_nota_fiscal_model_entrada.php");
	include_once("../model/estoque_model_entrada.php");
	include_once("../dao/item_nota_fiscalDAO_entrada.php");
	include_once("../dao/estoqueDAO_entrada.php");
	include_once("../dao/nota_fiscalDAO_entrada.php");
	include_once("../dao/parceiro_dao_entrada.php");
	include_once("../dao/produto_dao_entrada.php");

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
		$data_formatada = formatData(1,$_POST['data_pedido']);
		$nota_obj->setDataPedido($data_formatada);
		/*
        $nota_obj->setStatusPagamento($_POST['status_pagamento']);
		$nota_obj->setStatusEntrega($_POST['status_entrega']);
		$nota_obj->setValorTotal($_POST['valor']);
        $data_formatada = formatData(1,$_POST['data_entrega']);
		$nota_obj->setDataEntrega($data_formatada);
		$data_formatada = formatData(1,$_POST['data_prevista']);
        $nota_obj->setDataPrevista($data_formatada);
		*/
        $nota_obj->setIO('I');

		$notaDao = new NotaFiscalDao();
		if($notaDao->insereNota($nota_obj, $_POST['parceiro'])==0){
			$erro=1;
		}
		if($erro==0){

			while($i < $_POST['rownum']){
				
				$produto_nome = $produto_dao->buscaProduto('NOME',$_POST['cod_produto'.$i]);
				$dados1 = $produto_nome->fetch(PDO::FETCH_ASSOC);

				echo"Cod produto: ".$dados1['COD_PRODUTO'];
				
				$estoque->setCodProduto($dados1['COD_PRODUTO']);
				$estoque->setCodLote($_POST['lote'.$i]);
				$estoque->setQtdEntrada($_POST['quantidade'.$i]);
				$estoque->setQtdAtual($_POST['quantidade'.$i]);
				$estoque->setUnidadeMedida($_POST['unidade_medida'.$i]);
				$estoque->setTipoEmbalagem($_POST['tipo_embalagem'.$i]);
				$estoque->setPesoEmbalagem($_POST['peso_por_embalagem'.$i]);
				$data_formatada = formatData(1,$_POST['data_vencimento'.$i]);
				$estoque->setDataVencimento($data_formatada);
                
                /*Pega a data atual do servidor*/
                $dt =  new DateTime();
                $estoque->setDataEntrada($dt->format('Y-m-d'));
				
                /*$data_formatada = formatData(1,$nota_obj->getDataEntrega());
				$estoque->setDataEntrada($data_formatada);*/

				if($estoqueDAO->insereEstoque($estoque)==0){
					$erro=2;
				}

				if($erro == 0){
					$itembusca = $estoqueDAO->buscaUltimoEstoque();
					$dados2 = $itembusca->fetch(PDO::FETCH_ASSOC);

					$itens->setCodNotaFiscal($nota_obj->getCodNota());
					$itens->setCodProduto($dados1['COD_PRODUTO']);
					$itens->setQuantidade($_POST['quantidade'.$i]);
					$itens->setUnidadeMedida($_POST['unidade_medida'.$i]);
					
                    /*$itens->setValor($_POST['valor_item'.$i]);*/

					$itens->setCodEstoque($dados2['COD_ESTOQUE']);
					$itens->setCodParceiro($dados['COD_PARCEIRO']);
					$itens->setIO('I');

					if($itemDao->insereItemNotaFiscal($itens)==0){
						$erro=3;
					}
				}
				$i++;
			}
		}
		if($erro==0)
			//echo '<script>novaMensagem("sucesso","Success!")</script>';
			echo 'sucesso';
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
		$itemDao = new ItemNotaFiscalDAO();
		$produto_dao = new ProdutoDAO();
		$notaDao = new NotaFiscalDao();


		$parceiro_nome = $parceiro_dao->buscaParceiro('NOME',$_POST['parceiro']);
		$dados = $parceiro_nome->fetch(PDO::FETCH_ASSOC);

		$buscaItem = $itemDao->buscaItem($_POST['cod_nota'], $dados['COD_PARCEIRO'], 'I');

		if($buscaItem->rowCount()>0){


			echo"<script>$('#box').hide(); var row;";
			while($dados1 = $buscaItem->fetch(PDO::FETCH_ASSOC)){
				$produto_nome = $produto_dao->buscaProduto('COD_PRODUTO',$dados1['COD_PRODUTO']);
				$dados2 = $produto_nome->fetch(PDO::FETCH_ASSOC);

				echo "
						row += '<tr>'+
						'<td><label class=\'control-label\'>".$dados2['NOME']."</label></td>'+
						'<td><label class=\'control-label\'>".$dados1['COD_LOTE']."</label></td>'+			
						'<td><label class=\'control-label\'>".formatData(2, $dados1['DATA_VENCIMENTO'])."</label></td>'+
						'<td><label class=\'control-label\'>".$dados1['QUANTIDADE']."</label></td>'+
						'<td><label class=\'control-label\'>".$dados1['UNIDADE_MEDIDA']."</label></td>'+
						'<td><label class=\'control-label\'>".$dados1['TIPO_EMBALAGEM']."</label></td>'+
						'<td><label class=\'control-label\'>".$dados1['PESO_POR_EMBALAGEM']."</label></td>'+
						'<td><label class=\'control-label\'>".$dados1['VALOR']."</label></td>'+
					'</tr>';
				";
			}
			$nota = $notaDao->buscaNota($_POST['cod_nota'], $dados['COD_PARCEIRO'], 'I');
			$dadosnota = $nota->fetch(PDO::FETCH_ASSOC);

			echo"
				$('#data_pedido').val('".formatData(2, $dadosnota['DATA_PEDIDO'])."');
				$('#data_prevista').val('".formatData(2, $dadosnota['DATA_PREVISTA'])."');
				$('#data_entrega').val('".formatData(2, $dadosnota['DATA_ENTREGA'])."');
				$('#status_entrega').val('".$dadosnota['STATUS_ENTREGA']."');
				$('#status_pagamento').val('".$dadosnota['STATUS_PAGAMENTO']."');
				$('#valor').val('".$dadosnota['VALOR_TOTAL']."');
				$('#descricao').val('".$dadosnota['DESCRICAO']."');
				
				$('.form-control').attr('disabled', true);
				$('#tabela_itens').append(row);
				$('#botoes').hide();";
			if($dadosnota['DELETADA']!=1){
				echo"$('#botoes1').css('visibility', 'visible');</script>";
			}
			else{
				echo"
					$('#botoes1').css('visibility', 'visible');
					$('#supercancel').hide();
					alert('Bill of sale already cancelled!');
				</script>
				";
			}
		}
	}
	else if(isset($_GET['cancel_nota'])){
		$parceiro_dao = new ParceiroDAO();
		$notaDao = new NotaFiscalDao();
		$itemDao = new ItemNotaFiscalDAO();

		$parceiro_nome = $parceiro_dao->buscaParceiro('NOME',$_POST['parceiro']);
		$dados = $parceiro_nome->fetch(PDO::FETCH_ASSOC);

		$notaDao->cancelaNota($_POST['cod_nota'], $dados['COD_PARCEIRO'], 'I');
		$itemDao->cancelaNota($_POST['cod_nota'], $dados['COD_PARCEIRO'], 'I');
	}


	if(isset($_GET['geraNumero']))
	{

			$notaDao = new NotaFiscalDao();
			$stmt = $notaDao->buscaUltimaNota();
			$num_ultimo = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$stmt->rowCount()){
                echo "-1";
            }else{
                echo --$num_ultimo['COD_NOTAFISCAL'];
            }



	}

	function formatData($tipo,$date)
	{
		if($tipo == 1)
		{
			$data_array = explode("/",$date);

			$formated = $data_array[2].$data_array[0].$data_array[1];

			return $formated;
		}
		else if($tipo == 2)
		{
			$data_array = explode("-",$date);

			$formated = $data_array[1]."/".$data_array[2]."/".$data_array[0];

			return $formated;
		}
		else
			return 0;
	}

?>