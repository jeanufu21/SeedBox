<?php 
/*
Title:Controle que Gera a Tabela de Pedidos para Cada Gerente
Author:Jean Fabrício
Date: 15/03/2014
*/

include_once("../dao/pedido_dao.php");
include_once("../dao/itens_dao.php");
include_once("../model/pedido_model.php");
include_once("../dao/funcionario_dao.php");
include_once("../dao/parceiro_dao.php");
include_once("../dao/produto_dao.php");
include_once("../dao/estoque_dao.php");
include_once("../dao/itens_nota_dao.php");




if($_GET['acao'] == "consolidado")
{
/*
	Função responsavel por construir dinamicamente a tabela
	de pedidos para cada usuario gerente.
	Assim o gerente visualiza apenas pedidos feito para ele.

	formato:

	Manager          |   Date       |     Partners     | Status    |
	jean Fabricio    |  2014/03/12  |     Joao         | Em espera |

*/

// instancia os objetos
$pedido_dao = new PedidoDAO();
$funcionario_dao = new FuncionarioDAO();
$parceiro_dao = new ParceiroDAO();


// 

// busca pedidos especifico do gerente logado
$stmt_1 = $pedido_dao->busca("COD_FUNC",$_SESSION['codigoUser']);

// busca o nome do gerente para mostrar na tabela
$stmt_2 = $funcionario_dao->buscaFuncionario("ID_FUNCIONARIO",$_SESSION['codigoUser']);
$nomeFunc = $stmt_2->fetch(PDO::FETCH_ASSOC);

// dados_1 corresponde ao banco tabela pedidos
while($dados_1 = $stmt_1->fetch(PDO::FETCH_ASSOC))
{
	// busca o nome do parceiro pelo codigo
	$stmt_3 = $parceiro_dao->buscaParceiro("COD_PARCEIRO",$dados_1['COD_PARCEIRO']);
	$dados_2 =  $stmt_3->fetch(PDO::FETCH_ASSOC);
	// dados_2 corresponde ao banco tabela parceiros

	$data_view = formatData(2,$dados_1['DATA_PEDIDO']);


echo "<tr id='".$dados_1['COD_PEDIDO']."' class='linha'>
		<th><label class='col-sm-12 busca_pedido' title='Search Product in stock' >".$nomeFunc['NOME']."</label></th>
		<th>".$data_view."</th>
		<th>".$dados_2['NOME']."</th>
		<th class='status'>".$dados_1['STATUS']."</th>
		<th style='width:25px;'>
			<span class='fa fa-times rejeitar rejeitar_pedido' title='Reject Request'>&nbsp;&nbsp;</span>
		</th>
	  </tr>";
/*
	* Cada linha da tabela possui um id que representa o codigo do pedido
	* O 1º th corresponde ao link onde clicado abre o pedido com seus itens e o estoque de cada item.
	* A 4º th tem uma class status onde a primeira função do jquery desse documento logo abaixo, valida
	  status do pedido, não permitindo que seja reaberto
*/

}


/*
	o script abaixo corresponde as seguintes funções:

	1 - Na medida em que o status do pedido é rejeitado ou
		aprovado, o usuario não pode alterar mais o pedido.
	2 - O usuario clicou no botão rejeitar pedido ele atualiza
		o status para rejeitado.
	3- Quando o usuario clica no link do pedido ele busca
		os itens do pedido com as tabelas de estoque para aquele
		item
*/

echo "<script type='text/javascript'>

	$('#resultado_busca tr').each(function(){

		// verifico se na linha da tabela de pedidos o status está Rejeitado/Aprovado.

		if(($(this).children('th.status').text()) == 'Rejeitado' ||
			($(this).children('th.status').text()) == 'Aprovado')
		{
			// removo o link associado a busca_pedido

			// $(this).children('th').children('label').removeClass('busca_pedido');
			// $(this).children('th').children('span').remove();
			$(this).hide();
		}

	});


$('.rejeitar_pedido').on('click',function(){

		// codigo do pedido da linha clicada.
		cod = $(this).parents('tr').attr('id');

		// var teste = confirmaMensagem('Deseja cancelar o pedido?','OK','CANCEL');
		
	
	// if(teste)
	// {
		$.ajax({
			
		type:'POST',
		url:'../control/pedido_consolidado_control.php?exclui_pedido&acao',
		data:{cod:cod}
		}).done(function(html){
			// $('#saida').append(html);
			if(parseInt(html,10) == 1)
			{
				novaMensagem('sucesso','The request was deleted!');
			}

		});
		
		$('#corp').delay(4000).empty();
		$('#corp').delay(4000).load('../view/view_pedido_consolidado.php');
	// }


});



$('.busca_pedido').on('click',function(){

		$('#busca_itens').empty();

		/*
			Função de destacar a linha que o usuario buscou
			no estoque com cor amarelada
		*/

		$('.linha th').each(function(){
			$(this).removeClass('selecionado');
		});

		var codPedido =$(this).parents('tr').attr('id');

	$(this).parents('tr').children('th').addClass('selecionado');

	// fim da função de colorir a linha e resgata o valor do pedido.

	$.ajax({

		type:'POST',
		url:'../control/pedido_consolidado_control.php?acao=busca_estoque',
		data:{cod:codPedido}

	}).done(function(html){
		$('#busca_itens').append(html);
	});
	$('#itens_aprovados').attr('disabled',false);

});





</script>";
}

// atualiza o status pedido se ele rejeitar
	if(isset($_GET['exclui_pedido']))
	{
		$pedido_dao = new PedidoDAO();

		$codigo = $_POST['cod'];

		$stmt = $pedido_dao->Atualiza("STATUS","Rejeitado","COD_PEDIDO",$codigo);

		echo "1";
		
	}


/*
	Aprova o Pedido gerando um arquivo XML dos dados
	liberados para o pedido de acordo com o estoque 
	e direciona para a tela de Nota Fiscal

	formato do arquivo XML:
	<itens_pedido_aprovado>
		  <itens_aprovados>
		    <COD_ESTOQUE></COD_ESTOQUE>
		    <COD_PRODUTO></COD_PRODUTO>
		    <QUANTIDADE></QUANTIDADE>
		    <UNIDADE_MEDIDA></UNIDADE_MEDIDA>
		    <CODIGO_PEDIDO></CODIGO_PEDIDO>
		    <VALOR_UNITARIO></VALOR_UNITARIO>
		  </itens_aprovados>
  	<itens_pedido_aprovado>
*/

	if($_GET['acao'] == 'itens_aprovado')
	{

		  
/*
	Gera xml com os dados da itens_aprovados
*/
	$dom = new DOMDocument("1.0", "ISO-8859-1");
	$dom->preserveWhiteSpace = false;
	$dom->formatOutput = true;

	

	$root = $dom->createElement("itens_pedido_aprovado");

		$array_key = array_keys($_POST);
		$size1 = count($array_key);

/*
	ATENÇAO: O POST ESTÁ FORMATADO NA SEGUINTE MANEIRA

	Array
(
    [4 'codigo do produto e name da view'] => Array
     
        (
            [0] => 1/11/KG
            [1] => 
            [2] => 3/33/MX
        )

    [5] => Array
        (
            [0] => 
            [1] => 5/22/MX
        )

)
	________________________________________________________________
	IMPORTANTE: o size1 gerencia quais são o lenght do post porém
	eu não quero contar a chave [codigoPedido] do post, quero apenas
	as chaves do codigoProduto, assim subtraio -1 no for abaixo
	__________________________________________________________________

	$array_key é um array de array, seu valor são as chaves do array
	Post, assim posso saber quais são as chaves que o post possui.

	$size1 calcula o lenght do array_key utilizo ele para poder cadastrar
	os itens para cada produto individualmente.
*/
		for($i=0;$i<$size1-1;$i++)// primeiro loop itera para cada cod de produto
		{
			// a variavel $array_key[$i] acessa o valor do codigo do produto


			$size2 = count($_POST[$array_key[$i]]);

/*
	size2 calcula o lenght para os sub arrays do post, visto que para cada
	codigo de produto possui varios itens aprovados.

*/			
			for($j=0;$j<$size2;$j++) // itera para cada item de produto
			{

			// elimina valores não digitados pelo usuario
				if($_POST[$array_key[$i]][$j] != null)
				{

					$palavraDados = explode("/",$_POST[$array_key[$i]][$j]);
					$codigoEstoque = $palavraDados[0];
					$valorLiberado = $palavraDados[1];
					$medida = $palavraDados[2];
					$valor_unitario = $palavraDados[3];

					
					/*
						cada valor do html value='' foi passado uma string
						no formato 

							'cod_estoque/valor_liberado/medida'.

						Assim aqui divido a string e recebo os valores individuais
						para guarda-los no xml itens_aprovados;
					*/
					

					#utilizando a funcao para criar contatos
					$item = addItem($dom,$codigoEstoque,$array_key[$i],$valorLiberado,$medida,$_POST['valorPedido'],$valor_unitario);
					

					#adicionando no root

					$root->appendChild($item);
					$dom->appendChild($root);

						
				}
			}// fim do segundo for

		}// fim do primeiro for
		
		#salvando o arquivo

		

		$dom->save("../xml/".$_SESSION['codigoUser'].".xml");

		#mostrar dados na tela
		// header("Content-Type: text/xml");
		// print $dom->saveXML();
	}



// funções Gerais


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



	function addItem($document, $cod_itemap, $cod_produto, $quant , $uni,$codPedido,$valor_unitario)
{
 #criar contato
 $itens_aprovados = $document->createElement("itens_aprovados");


 $cod_itemapElm = $document->createElement("COD_ESTOQUE", $cod_itemap);


 $cod_produtoElm = $document->createElement("COD_PRODUTO", $cod_produto);


 $quantElm = $document->createElement("QUANTIDADE", $quant);

  $uniElm = $document->createElement("UNIDADE_MEDIDA", $uni);

  $id_pedido = $document->createElement("CODIGO_PEDIDO",$codPedido);

  $valor_unitario = $document->createElement("VALOR_UNITARIO",$valor_unitario);

 $itens_aprovados->appendChild($cod_itemapElm);
 $itens_aprovados->appendChild($cod_produtoElm);
 $itens_aprovados->appendChild($quantElm);
 $itens_aprovados->appendChild($uniElm);
 $itens_aprovados->appendChild($id_pedido);
 $itens_aprovados->appendChild($valor_unitario);
 
 return $itens_aprovados;
}


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

		        $stmt_estoque = $estoque_dao->buscaEstoquePreco($dado_itens['COD_PRODUTO']);
		        // busca todo estoque para determinado produto via codigo do produto
		        


		        while($dado_estoque = $stmt_estoque->fetch(PDO::FETCH_ASSOC))
		        {

		        			if(strcmp($dado_estoque['NF_IO'],"I") == 0)
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
					        		 maxlength='6' style='width:60px;'>
					        	</th>
					        	<th >
									<div class='col-sm-12' >
										<input type='text' class='form-control valor somenteNumero' value='".$dado_estoque['VALOR']."' name='".$dado_itens['COD_PRODUTO']."[]' 
										style='width:60px;'maxlength='6'>
									</div>	
				       			</th>
					        </tr>";
		        			}
				        		
			        	
		        	
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
	
		        var expre = /[^0-9,.]+/g;

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
					
					novaMensagem('erro','Unavailable Quantity in stock!');
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