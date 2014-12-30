<?php 

/*
	Title: Controle que gera a tabela dinamica de estoque no pedido consolidado
	Author:Jean Fabrício
	Date: 24/03/2014
*/

	
	include_once("../dao/estoque_dao.php");
	include_once("../dao/itens_dao.php");
	include_once("../dao/produto_dao.php");


// função que controi a tabela de estoque dentro da tabela de itens pedido

	if($_GET['acao'] == 'busca_estoque')
	{
		$itens_dao = new ItemDAO();
		$produto_dao = new ProdutoDao();

		$estoque_dao = new EstoqueDAO();
		// busca os itens do pedido primeiro
		$stmt = $itens_dao->BuscaItem("COD_PEDIDO",$_POST['cod']);

		while($dado_itens = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			
			$stmt_prod = $produto_dao->buscaProduto("COD_PRODUTO",$dado_itens['COD_PRODUTO']);
			$dados_produto = $stmt_prod->fetch(PDO::FETCH_ASSOC);
			// $dados_produto deseja-se apenas o nome dos produtos

echo "<tr class='color'>
    	<th>".$dados_produto['NOME']."</th>
    	<th>".$dado_itens['QUANTIDADE']."</th>
    	<th>".$dado_itens['UNIDADE_MEDIDA']."</th>
    </tr>
    <tr>
    	<th colspan='3'>
    	<div>
    	<table class='table table-hover table-striped table-condensed' id='estoque'>
				
		        <thead>
		        <tr class='success'>
		        	<th>Cod stock</th>
			        	<th>Code Batch</th>
			        	<th>Validity Date</th>
			        	<th>Unit of Measure</th>
			        	<th>Type of Pack</th>
			        	<th>Pack Weight</th>
			        	<th>Amount Available</th>
			        	<th>Amount Released</th>
			        	<th>Price Unit</th>
		        </tr>
		        </thead>
		        <tbody id='busca_estoque'>";

		        $stmt_estoque = $estoque_dao->buscaEstoque("COD_PRODUTO",$dado_itens['COD_PRODUTO']);
		        // busca todo estoque para determinado produto via codigo do produto

		        while($dado_estoque = $stmt_estoque->fetch(PDO::FETCH_ASSOC))
		        {
		        	// constroi a tabela estoque
		        	echo "<tr class='label-secundario'>
			        	<th id='".$dado_estoque['COD_ESTOQUE']."' class='numero_estoque'>".$dado_estoque['COD_ESTOQUE']."</th>
			        	<th>".$dado_estoque['COD_LOTE']."</th>
			        	<th>".$dado_estoque['DATA_VENCIMENTO']."</th>
			        	<th id='".$dado_estoque['UNIDADE_MEDIDA']."' class='medida'>".$dado_estoque['UNIDADE_MEDIDA']."</th>
			        	<th>".$dado_estoque['TIPO_EMBALAGEM']."</th>
			        	<th>".$dado_estoque['PESO_POR_EMBALAGEM']."</th>
			        	<th id='".$dado_estoque['QUANT_ATUAL']."' class='quant_atual'>".$dado_estoque['QUANT_ATUAL']."</th>
			        	<th>
			        		<input type='text' class='form-control validacao somenteNumero' 
			        		 maxlength='4' style='width:60px;'>
			        	</th>
			        	<th >
							<div class='col-sm-12' >
								<input type='text' class='form-control valor somenteNumero' name='".$dado_itens['COD_PRODUTO']."[]' style='width:60px;'>
							</div>	
		       			</th>
			        </tr>";
		        }
/*
	a tabela cima possui algumas colunas um id: as colunas estoque, unidade de medida, quantidade atual
	possuem id onde recupero seus valores para guardar no XML de acordo com que o usuario vai liberando
	e mechendo no estoque. São por meio desses id que eu recupero os dados e gravo no XML.

*/
		echo "</tbody>
		    </table>
		 </div>
	  </th>	
	</tr>";
		}
		// crio um hidden para guardar o codigo do pedido para gravar no XML.
		echo "<input type='hidden' name='valorPedido' value='".$_POST['cod']."'>";
/*
	Jquery abaixo verifica na medida em que o input onde o usuario digita
	os valores liberados do estoque para amostra, se o valor que foi digitado
	e maior do que o disponivel no estoque,se sim o botão fechar pedido e desabilitado
	e uma mensagem de alerta aparece na tela.

	* ValorDigitado e ValorEstoque foram dividos por 1 para forçar a tipagem inteira
	do js, assim o if trata esses dados como numeros inteiros e não como strings.



*/
		echo "<script type='text/javascript'>
			
			$('.somenteNumero').bind('keyup', function(){
	
		        var expre = /[^0-9]/g;

		        // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
		        if ($(this).val().match(expre))
		            $(this).val($(this).val().replace(expre,''));
		    });
			$('.validacao').blur(function(){
				
				// valida se o valor digitado e maior que disponivel no estoque
				
				
			var	valorDigitado = ($(this).val())/1;

			var valorEstoque = ($(this).parents('tr').children('.quant_atual').attr('id'))/1;

				if(valorDigitado > valorEstoque)
				{
					$('#alerta').empty();
					$('#alerta').addClass('alert-warning').addClass('cor1');
					span = '<span>Amount requested exceeds available value in stock!</span>';
					
					$('#alerta').append(span).fadeIn('slow').delay(3000).fadeOut('slow');
					$('#itens_aprovados').attr('disabled',true);
					
				}
				else
					$('#itens_aprovados').attr('disabled',false);
				
			});	

		</script>";
	}// fim da função


	function debug()
	{
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
	}

 ?>