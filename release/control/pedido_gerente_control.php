<?php 
		/*
				Title: Controle de pesquisa do pedido gerente
				Author:Jean Fabrício
				Date: 23/04/2014
		*/


		include_once("../model/estoque_model_entrada.php");
		include_once("../model/produto_model.php");
		include_once("../model/marca_model.php");
		include_once("../dao/estoque_dao.php");
		include_once("../dao/produto_dao.php");
		include_once("../dao/marca_dao.php");

	if($_GET['acao'] == "buscar")
	{
		busca_estoque(1);
	}
	if($_GET['acao'] == "pesquisa_estoque")
		busca_estoque(2);

	function busca_estoque($value)
	{
		$query_consulta = $_POST['pesquisa_estoque'];
		$array_tipo_consulta = split(",", $query_consulta);
		if(isset($_POST['tipo_pesquisa']))
		$size = count($_POST['tipo_pesquisa']);
		else
		{
			echo "0";
			return 0;
		}

		if(count($array_tipo_consulta) != $size)
		{
			echo "-2";
		}
		
		$query_dao = [];
		for($i=0;$i<$size;$i++)
		{
			$string = $_POST['tipo_pesquisa'][$i]." LIKE '%".$array_tipo_consulta[$i]."%'";
			array_push($query_dao,$string);
			
		}
			$estoque_dao = new EstoqueDAO();

			$stmt_estoque = $estoque_dao->produtosEmEstoque($query_dao);

			if($stmt_estoque->rowCount() == 0)
			{
				echo "-1";
				return 0;
			}
			if($value == 1)
			{
				while($dados = $stmt_estoque->fetch(PDO::FETCH_ASSOC))
				{
						
							echo "<tr id='stok".$dados['COD_ESTOQUE']."'>";
							echo "<input type='hidden' value='".$dados['NOME']."' name='produto_name'></input>";
							echo "<th>".$dados['COD_ESTOQUE']."
								<input type='hidden' value='".$dados['COD_ESTOQUE']."' name='cod_estoque[]'></input>
							</th>";
							echo "<th>".$dados['NOME_FANTASIA']."</th>";
							echo "<th>".$dados['NOME']."</th>";
							echo "<th>".$dados['COD_LOTE']."</th>";
							echo "<th>".$dados['QNT_ENTRADA']."</th>";
							echo "<th>".$dados['QUANT_ATUAL']."
							<input type='hidden' value='".$dados['QUANT_ATUAL']."' name='quant_atual[]'></input>
							</th>";
							echo "<th>".$dados['UNIDADE_MEDIDA']."
							<input type='hidden' value='".$dados['UNIDADE_MEDIDA']."' name='uni_medida[]'></input>
							</th>";
							echo "<th>".$dados['TIPO_EMBALAGEM']."</th>";
							echo "<th>".$dados['PESO_POR_EMBALAGEM']."</th>";
							echo "<th>".$dados['DATA_ENTRADA']."</th>";
							echo "<th>".$dados['DATA_VENCIMENTO']."</th>";
							echo "<th class='has-success'><input type='text' class='form-control quant_liberada' name='quant_liberada[]' style='width:60px;'></th>";
						    echo "<th class='has-success'><input type='text' value='".$dados['VALOR']."' class='form-control valor_nota' name='valor_nota[]' style='width:60px;'></th>";
							echo "</tr>";
				}
			}
			else if($value == 2)
			{
				while($dados = $stmt_estoque->fetch(PDO::FETCH_ASSOC))
				{
						
							echo "<tr id='stok".$dados['COD_ESTOQUE']."'>";
							echo "<input type='hidden' value='".$dados['NOME']."' name='produto_name'></input>";
							echo "<th>".$dados['COD_ESTOQUE']."
								<input type='hidden' value='".$dados['COD_ESTOQUE']."' name='cod_estoque[]'></input>
							</th>";
							echo "<th>".$dados['NOME_FANTASIA']."</th>";
							echo "<th>".$dados['NOME']."</th>";
							echo "<th>".$dados['COD_LOTE']."</th>";
							echo "<th>".$dados['QNT_ENTRADA']."</th>";
							echo "<th>".$dados['QUANT_ATUAL']."
							<input type='hidden' value='".$dados['QUANT_ATUAL']."' name='quant_atual[]'></input>
							</th>";
							echo "<th>".$dados['UNIDADE_MEDIDA']."
							<input type='hidden' value='".$dados['UNIDADE_MEDIDA']."' name='uni_medida[]'></input>
							</th>";
							echo "<th>".$dados['TIPO_EMBALAGEM']."</th>";
							echo "<th>".$dados['PESO_POR_EMBALAGEM']."</th>";
							echo "<th>".$dados['DATA_ENTRADA']."</th>";
							echo "<th>".$dados['DATA_VENCIMENTO']."</th>";
							echo "</tr>";
				}
			}

			validaQuantidadeDisponivel();
			
	}
		

		if($_GET['acao'] == "buscar_mesmoSet")
	{
		

			$query_consulta = $_POST['pesquisa_estoque'];
			$array_tipo_consulta = split(",", $query_consulta);
			if(isset($_POST['tipo_pesquisa']))
			$size = count($_POST['tipo_pesquisa']);
			else
			{
				echo "0";
				return 0;
			}

			if(count($array_tipo_consulta) != $size)
			{
				echo "-2";
			}
		
		$query_dao = [];
			for($i=0;$i<$size;$i++)
			{
				$string = $_POST['tipo_pesquisa'][$i]." LIKE '%".$array_tipo_consulta[$i]."%'";
				array_push($query_dao,$string);
				
			}
			$estoque_dao = new EstoqueDAO();

			$stmt_estoque = $estoque_dao->produtosEmEstoque($query_dao);

			if($stmt_estoque->rowCount() == 0)
			{
				echo "-1";
				return 0;
			}


			$produto_dao = new ProdutoDao();
			$stmt_produto = $produto_dao->buscaProduto("COD_PRODUTO",$_POST['produto'][0]);
			$produto_table = $stmt_produto->fetch(PDO::FETCH_ASSOC);

			while($dados = $stmt_estoque->fetch(PDO::FETCH_ASSOC))
			{
				if($dados['COD_SET_VALORES'] == $produto_table['COD_SET_VALORES'])
				{
						echo "<tr id='stok".$dados['COD_ESTOQUE']."'>";
						echo "<input type='hidden' value='".$dados['NOME']."' name='produto_name'></input>";
						echo "<th>".$dados['COD_ESTOQUE']."
							<input type='hidden' value='".$dados['COD_ESTOQUE']."' name='cod_estoque[]'></input>
						</th>";
						echo "<th>".$dados['NOME_FANTASIA']."</th>";
						echo "<th>".$dados['NOME']."</th>";
						echo "<th>".$dados['COD_LOTE']."</th>";
						echo "<th>".$dados['QNT_ENTRADA']."</th>";
						echo "<th>".$dados['QUANT_ATUAL']."
						<input type='hidden' value='".$dados['QUANT_ATUAL']."' name='quant_atual[]'></input>
						</th>";
						echo "<th>".$dados['UNIDADE_MEDIDA']."
						<input type='hidden' value='".$dados['UNIDADE_MEDIDA']."' name='uni_medida[]'></input>
						</th>";
						echo "<th>".$dados['TIPO_EMBALAGEM']."</th>";
						echo "<th>".$dados['PESO_POR_EMBALAGEM']."</th>";
						echo "<th>".$dados['DATA_ENTRADA']."</th>";
						echo "<th>".$dados['DATA_VENCIMENTO']."</th>";
						echo "<th class='has-success'><input type='text' class='form-control quant_liberada' name='quant_liberada[]' style='width:60px;'></th>";
					    echo "<th class='has-success'><input type='text' value='".$dados['VALOR']."' class='form-control valor_nota' name='valor_nota[]' style='width:60px;'></th>";
						echo "</tr>";
				}
					
			}
			validaQuantidadeDisponivel();
	}


	function validaQuantidadeDisponivel()
{
	echo "<script>

			$('.quant_liberada').focusout(function(){

				
				var quantidade = $(this).val() / 1;

				if(quantidade < 0)
				{
					novaMensagem('erro','Value incorrect');
					$(this).val('');
				}
					
				var qtdisponivel = $(this).parents('tr').children('th:eq(5)').text()/1;
				var result = qtdisponivel - quantidade;
				if(result < 0)
				{
					novaMensagem('erro','Quantity unavailable!');
					quantidade = qtdisponivel;
					$(this).val(quantidade);
				}

				
				

			});

		</script>";

}


 ?>