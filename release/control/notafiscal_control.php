<?php 

	include_once("../model/nota_fiscal_model.php");
	include_once("../dao/notafiscal_dao.php");
	include_once("../dao/pedido_dao.php");
	include_once("../dao/parceiro_dao.php");
	include_once("../dao/produto_dao.php");
	include_once("../dao/itens_nota_dao.php");
	include_once("../model/item_nota_fiscal_model.php");
	include_once("../dao/estoque_dao.php");
	include_once("../model/ensaio_model.php");
	include_once("../dao/ensaio_dao.php");
	include_once("../model/amostra_ensaio_model_nota.php");
	include_once("../dao/amostra_ensaio_dao_nota.php");
	include_once("../dao/campo_dao.php");
/*
	Função que fecha o pedido gerando uma nota que esteja associada
	ao pedido ja no sistema
*/

	if($_GET['acao'] == "fecharNotaPedido")
	{
		$valida_cadastrados = null;

		$ensaio = new ensaio();
		// $ensaio->setCodEnsaio(null);
		$ensaio->setCod_set_valores($_POST['codigo_set']);
		$campo_dao = new CampoDao();

		$stmt_campo = $campo_dao->buscaCampo("NOME",$_POST['nome_campo']);
		$campo =	$stmt_campo->fetch(PDO::FETCH_ASSOC);

		// echo "COD CAMPO ".$campo['COD_CAMPO'];

		$ensaio->setCod_campo($campo['COD_CAMPO']);
		
		// $data_formatada = formatData(1,$_POST['data_semeio']);

		$ensaio->setData_semeio(null);

		// $data_formatada = formatData(1,$_POST['data_transplante']);

		$ensaio->setData_transplante(null);

		// $data_formatada = formatData(1,$_POST['data_colheita']);
		
		$ensaio->setData_colheita(null);
		if(isset($_POST['produto_testemunha']))
		{
			if($_POST['produto_testemunha'] != "")
			$ensaio->setCod_prod_check($_POST['produto_testemunha']);
		}
		if(isset($_POST['prd_tes']))
		{
			if($_POST['prd_tes'] != "")
			$ensaio->setCod_prod_check($_POST['prd_tes']);
		}
		

		$ensaio->setQuantidade_amostra(null);
		$ensaio->setQuantidade_semente(null);
		$ensaio->setRepeticao(null);
		$ensaio->setEmpresa($_POST['empresa']);
		$ensaio->setProdutor($_POST['produtor']);
		$ensaio->setResponsavel($_POST['responsavel']);
		$ensaio->setSupervisor($_POST['supervisor']);
		$ensaio->setAvaliador(null);
		$ensaio->setStatus(0);
		
		$ensaioDAO = new EnsaioDao();
		if($ensaioDAO->insereEnsaio($ensaio)){
			$valida_cadastrados = true;
		}
		else{
			$valida_cadastrados = false;
		}

		$nomexx = $_POST['produto'];
		$unico = array_unique($nomexx);

		$valores_chaves = array_keys($unico);

		// echo "<br>";
		// print_r($unico);
		$size =  count($unico);
		// echo "<br>";

		$stmt2 = $ensaioDAO->buscaEnsaioDesc();

		
		$dado_ensaio = $stmt2->fetch(PDO::FETCH_ASSOC);
		 


		$amostra = new AmostraEnsaio();
		$produto_dao = new ProdutoDao();

		$amostra->setcodEnsaio($dado_ensaio["COD_ENSAIO"]);
		if(isset($_POST['produto_testemunha'] ))
		{
			if($_POST['produto_testemunha'] != "")
			{
				$produto_stmt = $produto_dao->buscaProduto("NOME",$_POST['produto_testemunha']);
				$resultado_busca = $produto_stmt->fetch(PDO::FETCH_ASSOC);

				$amostra->setcodProduto($resultado_busca['COD_PRODUTO']);
			}
		}
		
		if(isset($_POST['prd_tes']))
		{
			if($_POST['prd_tes'] != "")
			{
				$produto_stmt = $produto_dao->buscaProduto("NOME",$_POST['prd_tes']);
				$resultado_busca = $produto_stmt->fetch(PDO::FETCH_ASSOC);
				$amostra->setcodProduto($resultado_busca['COD_PRODUTO']);
			}
		}
		$amostra->setnroEstaca(null);
		$amostra->setquantidadeSementes(null);


		$AmostraEnsaioDAO = new AmostraEnsaioDAO();
		if($AmostraEnsaioDAO->insereAmostraEnsaio($amostra)){
			$valida_cadastrados = true;
		}
		else{
			$valida_cadastrados = false;
		}

		for($i=0;$i<$size;$i++){

			$amostra->setcodEnsaio($dado_ensaio["COD_ENSAIO"]);
			$amostra->setcodProduto($unico[$valores_chaves[$i]]);
			$amostra->setnroEstaca(null);
			$amostra->setquantidadeSementes(null);


			$AmostraEnsaioDAO = new AmostraEnsaioDAO();
			if($AmostraEnsaioDAO->insereAmostraEnsaio($amostra)){
				$valida_cadastrados = true;
			}
			else{
				$valida_cadastrados = false;
			}
		}
/*=====================================================================================
							Cadastro Nota Fiscal
=======================================================================================*/

		
		$notafiscal_obj =  new NotaFiscal();
		$notafiscal_dao = new NotaDAO();

		
		// busca os dados do pedido consolidado no XML.
		$xml = simplexml_load_file("../xml/".$_SESSION['codigoUser'].".xml");
			
			foreach($xml->itens_aprovados as $itens_aprovados)
			{
				$codigoPedido =  $itens_aprovados->CODIGO_PEDIDO;
			}


		$pedido_dao = new PedidoDAO();
		$stmt_pedido = $pedido_dao->Busca("COD_PEDIDO",$codigoPedido);
		$dado_pedido = $stmt_pedido->fetch(PDO::FETCH_ASSOC);
		// busco o codigo do parceiro por meio do codigo do pedido
		$codParceiro = $dado_pedido['COD_PARCEIRO'];

		$data_formatada = formatData(1,$_POST['dataPedido']);


		// objeto Nota Fiscal
		$notafiscal_obj->setCodParceiro($codParceiro);
		$notafiscal_obj->setDataPedido($data_formatada);
		// $notafiscal_obj->setStatusPagamento($_POST['statusPag']);
		// $notafiscal_obj->setStatusEntrega($_POST['statusEntr']);
		$notafiscal_obj->setValorTotal($_POST['valorTotal']);

		$data_formatada = formatData(1,$_POST['dataEntr']);

		$notafiscal_obj->setDataEntrega($data_formatada);

		// $data_formatada = formatData(1,$_POST['dataPrevista']);
		//------------------- COMENTADO POIS FOI RETIRADO DO CODIGO
		//$notafiscal_obj->setDataPrevista($data_formatada);

		$notafiscal_obj->setDescricao($_POST['descricaoNota']);
		$notafiscal_obj->setIO("O");
      
		// cadastra a nota Fiscal
		if($notafiscal_dao->CriaNota($notafiscal_obj))
			$valida_cadastrados = true;
		else 
			$valida_cadastrados = false;


		$stmt_notafiscal = $notafiscal_dao->buscaNotaDesc($notafiscal_obj->getCodParceiro());

		$ultima_nota = $stmt_notafiscal->fetch(PDO::FETCH_ASSOC);

		// ultima_nota corresponde ao codigo da ultima nota cadastrada


/*=========================================================================

				cadastrando os itens da nota que estão no XML

===========================================================================*/


		
		$itensNota_obj = new ItemNotaFiscal();
		$itens_nota_dao = new ItensNotaDAO();
		$estoque_dao = new EstoqueDAO();

		foreach($xml->itens_aprovados as $itens_aprovados)
		{

			// para cada item de acordo com o loop do foreach
			$code_esto =  $itens_aprovados->COD_ESTOQUE;

			$codigoProduto =  $itens_aprovados->COD_PRODUTO;
			$quantidade =  $itens_aprovados->QUANTIDADE;
			$medida =  $itens_aprovados->UNIDADE_MEDIDA;
			$valor_uni = $itens_aprovados->VALOR_UNITARIO;

			// objeto itens Nota que é modificado a cada loop do foreach
			$itensNota_obj->setCodNotaFiscal($ultima_nota['COD_NOTAFISCAL']);
			$itensNota_obj->setCodParceiro($codParceiro);
			$itensNota_obj->setCodEstoque($code_esto);
			$itensNota_obj->setIO("O");
			$itensNota_obj->setCodProduto($codigoProduto);
			$itensNota_obj->setQuantidade($quantidade);
			$itensNota_obj->setUnidadeMedida($medida);
			$itensNota_obj->setValor($valor_uni);
			
			// cadastra um item a cada loop do foreach
			if($itens_nota_dao->insereItensNota($itensNota_obj))
				$valida_cadastrados = true;
			else
				$valida_cadastrados = false;


			// Atualiza o estoque subtraindo o valor liberado pelo gerente
			$stmt_estoque_1 = $estoque_dao->buscaEstoque("COD_ESTOQUE",$code_esto);

			$dados_estoque_1 = $stmt_estoque_1->fetch(PDO::FETCH_ASSOC);

			$novoVal = $dados_estoque_1['QUANT_ATUAL'] - $itensNota_obj->getQuantidade();
			
			// update do estoque com o novo Valor calculado
			if($estoque_dao->AtualizaQuantEstoque($code_esto,$novoVal))
				$valida_cadastrados = true;
			else
				$valida_cadastrados = false;
			
		}// fim do for

		// cadastrando possiveis itens adicionados depois

		if(isset($_POST['estoque_cod'][0]))
		{
			$size = count($_POST['estoque_cod']);
			for($i=0;$i<$size;$i++)
			{
				
				// objeto itens Nota que é modificado a cada loop do foreach
				$itensNota_obj->setCodNotaFiscal($ultima_nota['COD_NOTAFISCAL']);
				$itensNota_obj->setCodParceiro($_POST['parceiroCodigo']);
				$itensNota_obj->setCodEstoque($_POST['estoque_cod'][$i]);
				$itensNota_obj->setIO("O");
				$itensNota_obj->setCodProduto($_POST['produto_new'][$i]);
				$itensNota_obj->setQuantidade($_POST['liberada_quant'][$i]);
				$itensNota_obj->setUnidadeMedida($_POST['medida_uni'][$i]);
				$itensNota_obj->setValor($_POST['valor_item'][$i]);
				
				// cadastra um item a cada loop do foreach
				if($itens_nota_dao->insereItensNota($itensNota_obj))
					$valida_cadastrados = true;
				else
					$valida_cadastrados = false;

				// Atualiza o estoque subtraindo o valor liberado pelo gerente
				$stmt_estoque_1 = $estoque_dao->buscaEstoque("COD_ESTOQUE",$_POST['estoque_cod'][$i]);

				$dados_estoque_1 = $stmt_estoque_1->fetch(PDO::FETCH_ASSOC);

				$novoVal = $dados_estoque_1['QUANT_ATUAL'] - $itensNota_obj->getQuantidade();
				
				// update do estoque com o novo Valor calculado
				if($estoque_dao->AtualizaQuantEstoque($_POST['estoque_cod'][$i],$novoVal))
					$valida_cadastrados = true;
				else
					$valida_cadastrados = false;
			}
		}

		// atualiza o status do pedido para Aprovado
		$pedido_dao = new PedidoDAO();
		$stmt = $pedido_dao->Atualiza("STATUS","Aprovado","COD_PEDIDO",$codigoPedido);
		
		if($valida_cadastrados)
			echo "1";
		else
			echo "0";
	}
/**********************************************************************************************
	Essa função está associada ao modulo individual onde se possa gerar uma Nota fiscal sem
	estar linkada com um pedido, ou seja, faz-se uma nota sem pedido.
*/
	if($_GET['acao'] == "fecharNota")
	{
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		$validaNota = null;

		$notafiscal_obj =  new NotaFiscal();
		$notafiscal_dao = new NotaDAO();
		
		$codParceiro = $_POST['parceiroCodigo'];
		// objeto Nota Fiscal
		$notafiscal_obj->setCodParceiro($codParceiro);

		$data_formatada = formatData(1,$_POST['dataPedido']);
		
		$notafiscal_obj->setDataPedido($data_formatada);
		// $notafiscal_obj->setStatusPagamento($_POST['statusPag']);
		// $notafiscal_obj->setStatusEntrega($_POST['statusEntr']);
		$notafiscal_obj->setValorTotal($_POST['valorTotal']);

		$data_formatada = formatData(1,$_POST['dataEntr']);

		$notafiscal_obj->setDataEntrega($data_formatada);

		// $data_formatada = formatData(1,$_POST['dataPrevista']);

	//	$notafiscal_obj->setDataPrevista($data_formatada);
		$notafiscal_obj->setDescricao($_POST['descricaoNota']);
		$notafiscal_obj->setIO("O");

		//cadastra a Nota Fiscal
		if($notafiscal_dao->CriaNota($notafiscal_obj))
			$validaNota = true;
		else 
			$validaNota = false;

/*
	    recupera o cod da ultima nota cadastrada com
	    uma busca em ordenação decrescente.
*/
		$stmt_notafiscal = $notafiscal_dao->buscaNotaDesc($notafiscal_obj->getCodParceiro());

		$ultima_nota = $stmt_notafiscal->fetch(PDO::FETCH_ASSOC);

		$itensNota_obj = new ItemNotaFiscal();
		$itens_nota_dao = new ItensNotaDAO();
		$produto_dao = new ProdutoDao();

		// calcula quantos itens a nota terá
		$size_post = count($_POST['produto_new']);

		for($i=0;$i<$size_post;$i++)
		{
			// atualiza o estoque

			$codigo_estoque = $_POST['estoque_cod'][$i];

			// $stmt_produto = $produto_dao->buscaProduto("NOME",$_POST['produto'][$i]);
			// $dado_produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

			//objeto Item Nota que é alterado a cada loop do for
			$itensNota_obj->setCodNotaFiscal($ultima_nota ['COD_NOTAFISCAL']);
			$itensNota_obj->setCodParceiro($codParceiro);
			$itensNota_obj->setCodEstoque($codigo_estoque);
			$itensNota_obj->setIO("O");
			$itensNota_obj->setCodProduto($_POST['produto_new'][$i]);
			$itensNota_obj->setQuantidade($_POST['liberada_quant'][$i]);
			$itensNota_obj->setUnidadeMedida($_POST['medida_uni'][$i]);
			$itensNota_obj->setValor($_POST['valor_item'][$i]);

			// cadastro do item da Nota que é alterado a cada loop do for.
			if($itens_nota_dao->insereItensNota($itensNota_obj))
				$validaNota = true;
			else
				$validaNota = false;

			$estoque_dao = new EstoqueDAO();


			$stmt_estoque_1 = $estoque_dao->buscaEstoque("COD_ESTOQUE",$codigo_estoque);

			$dados_estoque_1 = $stmt_estoque_1->fetch(PDO::FETCH_ASSOC);

			$novoVal = $dados_estoque_1['QUANT_ATUAL'] - $itensNota_obj->getQuantidade();
			
			// update do estoque com o novo Valor calculado
			if($estoque_dao->AtualizaQuantEstoque($codigo_estoque,$novoVal))
				$validaNota = true;
			else
				$validaNota = false;


		}

		if($validaNota)
			echo "1";
		else
			echo "0";
		
	}// fima da função

/**********************************************************************************************
	Uma vez que o usuario clicou para seguir para a tela de Nota estando terminado de aprovar o 
	pedido, os Dados do parceiro ja são contruidos dinamicamente da tela de Nota Fiscal de 
	acordo com os dados do XML.

	Função dividida em duas condições:
	 	1 - se na tela de Nota não existe a variavel buscaParceiro então os dados
	 		vem do XML, pois essa variavel só é passada na requisição ajax da tela
	 		nota fiscal quando o usuario busca os dados direto do input.

	 	2 - se a variavel existe então entra na parte onde o usuario está gerando
	 		uma nota fiscal sem linkação com um pedido, Na propria tela de Nota Fiscal
	 		modulo independente, ha um campo onde o usuario pode procurar por algum parceiro
	 		onde queira associar a nota fiscal, ao pesquisar pelo mesmo ele gera a chamada
	 		ajax que passa a variavel $_POST['buscaParceiro'];

*/
	if($_GET['acao'] == 'preencheParceiro')
	{
		$validaParceiro = false;
	/*

	 abrindo o xml e consultando o codigo do pedido para
	 fazer a busca do parceiro

	*/
	 	if(!isset($_POST['buscaParceiro']))
	 	{
	 		
	 		$xml = simplexml_load_file("../xml/".$_SESSION['codigoUser'].".xml");
		
			foreach($xml->itens_aprovados as $itens_aprovados)
			{
				$codigoPedido =  $itens_aprovados->CODIGO_PEDIDO;
			}


			$pedido_dao = new PedidoDAO();
			$stmt_pedido = $pedido_dao->Busca("COD_PEDIDO",$codigoPedido);
			$dado_pedido = $stmt_pedido->fetch(PDO::FETCH_ASSOC);

			$codParceiro = $dado_pedido['COD_PARCEIRO'];
			// busca codigo do parceiro por meio do codigo do pedido gravado no XML.
			$parceiro_dao = new ParceiroDAO();
			$stmt_parceiro = $parceiro_dao->buscaParceiro("COD_PARCEIRO",$codParceiro);
			$dado_parceiro = $stmt_parceiro->fetch(PDO::FETCH_ASSOC);
			/*
				$dado_parceiro contem as informações gerais do parceiro no banco onde será
				atribuido ao html gerado abaixo.
			*/
				$validaParceiro = true;

	 	}
	 	else
	 	{
	 		// valida se o usuario digitou null no campo busca parceiro assim não mostra nada.
	 		if($_POST['buscaParceiro'] == "")
		 	{
		 		$validaParceiro = false;
		 		return 0;
		 	}

	 		$parceiro_dao = new ParceiroDAO();
			$stmt_parceiro = $parceiro_dao->buscaParceiro("NOME",$_POST['buscaParceiro']);
			$dado_parceiro = $stmt_parceiro->fetch(PDO::FETCH_ASSOC);
			if($stmt_parceiro->rowCount() == 0)
				$validaParceiro = false;
			else
				$validaParceiro = true;
			/*
				$dado_parceiro contem as informações gerais do parceiro no banco onde será
				atribuido ao html gerado abaixo, essa busca foi por meio do nome digitado.
			*/
				

	 	}
		
	// construo os campos parceiro ja com os valores buscados.
	 	if($validaParceiro)
	 	{
	 		echo "
	<div class='form-group col-sm-12'>
		<label for='Obrand' class='col-sm-1 control-label'>Code Partners:</label>
			<div class='col-sm-2'>
				<input type='text' class='form-control'id='hiden' name='parceiroCodigo' readonly value='".$dado_parceiro['COD_PARCEIRO']."'>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>Name:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['NOME']."</label>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>CNJP</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['CNPJ']."</label>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>Address:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['ENDERECO']."</label>
			</div>
	</div>
	<div class='form-group col-sm-12' >
		<label for='Obrand' class='col-sm-1 control-label'>CEP:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['CEP']."</label>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>City:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['MUNICIPIO']."</label>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>Estate:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['UF']."</label>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>Country:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['PAIS']."</label>
			</div>
	</div>
	<div class='form-group col-sm-12'>
		<label for='Obrand' class='col-sm-1 control-label'>Phone:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['TELEFONE1']."</label>
			</div>
		<label for='Obrand' class='col-sm-1 control-label'>Cellular:</label>
			<div class='col-sm-2'>
				<label class='col-sm-12 control-label'>".$dado_parceiro['TELEFONE2']."</label>
			</div>
	</div>";
	 	}
	 	else
	 	{
	 		echo "-3";
	 		return 0;
	 	}

	}
/**********************************************************************************************
	Se o usuario for direcionado para a tela Nota Fiscal vindo do Pedido Consolidado,
	então ele preenche os campos dos itens liberados no estoque pelo gerente automaticamente
	compondo assim os itens da nota.

*/

	if($_GET['acao'] == "preencheItensNota")
	{
		
		$xml = simplexml_load_file("../xml/".$_SESSION['codigoUser'].".xml");
		
		$produto_dao = new ProdutoDao();

		$cont = 1;			
		foreach($xml->itens_aprovados as $itens_aprovados)
		{
			$codigoEstoque =  $itens_aprovados->COD_ESTOQUE;
			$codigoProduto =  $itens_aprovados->COD_PRODUTO;
			$quantidade =  $itens_aprovados->QUANTIDADE;
			$medida =  $itens_aprovados->UNIDADE_MEDIDA;
			$valor_unitario =  $itens_aprovados->VALOR_UNITARIO;
			$stmt = $produto_dao->buscaProduto("COD_PRODUTO",$codigoProduto);

			$dado_produto = $stmt->fetch(PDO::FETCH_ASSOC);

			// gera os campos itens nota ja preenchidos e não editaveis.
			echo "<tr  id='linhasItens'>
		       			<!-- readonly para desabilitar o input -->
		       			<th><input type='checkbox' name='prd_tes' value='".$dado_produto['NOME']."'></th>
		       			<th>
		       				<label class='col-sm-8 control-label ' style='text-align:left;' id='produto_name".$cont."'>".trim($dado_produto['NOME'])."</label>
								<input type='hidden' class='form-control' name='produto[]' value='".$codigoProduto."'>
						</th>
						<th>
		       				<label class='col-sm-6 control-label '>".$codigoEstoque."</label>
								<input type='hidden' class='form-control' name='estoque[]' value='".$codigoEstoque."'>
						</th>
		       			<th>
		       					<label class='col-sm-3 control-label'>".$medida."</label>
								<input type='hidden' class='form-control' name='medida[]'  value='".$medida."'>
						</th>
		       			<th>
		       				<label class='col-sm-3 control-label '>".$quantidade."</label>
								<input type='hidden' class='form-control account' name='quantidade[]'  value='".$quantidade."'>
						</th>
		       			<th colspan='2'>
		       				<label class='col-sm-4 control-label'>".$valor_unitario."</label>
							<input type='hidden' class='form-control valor' name='valor_uni[]'  value='".$valor_unitario."'>
						</th>

		       			<th><span class='fa fa-times icon_black remove' onclick='removeItem(this)' title='Delete Item'></span>
						
		       			</th>
		       				
		       		</tr>";
			$cont++;
		}


		jqueryScript();

	}

	if($_GET['acao'] == "dataPedido")
	{
		
		$xml = simplexml_load_file("../xml/".$_SESSION['codigoUser'].".xml");
		
			foreach($xml->itens_aprovados as $itens_aprovados)
			{
				$codigoPedido =  $itens_aprovados->CODIGO_PEDIDO;
			}

			
		$pedido_dao = new PedidoDAO();
		$stmt = $pedido_dao->Busca("COD_PEDIDO",$codigoPedido);
		$dado = $stmt->fetch(PDO::FETCH_ASSOC);
		$data_formatada = formatData(2,trim($dado['DATA_PEDIDO']));

		echo $data_formatada;
	}


	if($_GET['acao'] == "preencheCodSet")
	{
		
		$xml = simplexml_load_file("../xml/".$_SESSION['codigoUser'].".xml");
		
			foreach($xml->itens_aprovados as $itens_aprovados)
			{
				$codigoProduto =  $itens_aprovados->COD_PRODUTO;
			}

		$produto_dao = new ProdutoDao();
		$stmt = $produto_dao->buscaProduto("COD_PRODUTO",$codigoProduto);
		$dado = $stmt->fetch(PDO::FETCH_ASSOC);
		
		echo $dado['COD_SET_VALORES'];

	}

if($_GET['acao'] == "busca_produto_nota")
	{
		// $_POST['busca'] equivale ao nome do produto

		$produto_dao = new ProdutoDao();

		$stmt = $produto_dao->buscaProduto("NOME",$_POST['busca']);
		$dado_produto_busca = $stmt->fetch(PDO::FETCH_ASSOC);

		$estoque_dao = new EstoqueDAO();

		$stmt_estoque = $estoque_dao->buscaEstoque("COD_PRODUTO",$dado_produto_busca['COD_PRODUTO']);
		        // busca todo estoque para determinado produto via codigo do produto

		        while($dado_estoque = $stmt_estoque->fetch(PDO::FETCH_ASSOC))
		        {
		        	// constroi a tabela estoque
		        	echo "<tr id='stok".$dado_estoque['COD_ESTOQUE']."'>
		        		<input type='hidden' name='produto_name' value='".$_POST['busca']."'>
			        	<th>".$dado_estoque['COD_ESTOQUE']."
							<input type='hidden' value='".$dado_estoque['COD_ESTOQUE']."' name='cod_estoque[]'>
			        	</th>
			        	<th>".$dado_estoque['COD_LOTE']."</th>
			        	<th>".$dado_estoque['DATA_VENCIMENTO']."</th>
			        	<th>".$dado_estoque['UNIDADE_MEDIDA']."
							<input type='hidden' value='".$dado_estoque['UNIDADE_MEDIDA']."' name='uni_medida[]'>
			        	</th>
			        	<th>".$dado_estoque['TIPO_EMBALAGEM']."</th>
			        	<th>".$dado_estoque['PESO_POR_EMBALAGEM']."</th>
			        	<th>".$dado_estoque['QUANT_ATUAL']."
							<input type='hidden' value='".$dado_estoque['QUANT_ATUAL']."' name='quant_atual[]'>
			        	</th>
			        	<th>
			        		<input type='text' class='form-control quant_liberada' name='quant_liberada[]'
			        		 maxlength='4' style='width:80px;text-align:center'>
			        	</th>
			        	<th>
			        		<input type='text' class='form-control valor_nota' name='valor_nota[]'
			        		 maxlength='4' style='width:80px;text-align:center'>
			        	</th>
			        </tr>";
		        }

		        validaQuantidadeDisponivel();
	}


	if($_GET['acao'] == "add_itens_nota")
	{


		if(isset($_POST['cod_estoque']))
		{
			$size = count($_POST['cod_estoque']);

		}
		else
			return 0;
		

		for($i=0;$i<$size;$i++)
		{

			$produto_dao = new ProdutoDao();
			$stmt_produto = $produto_dao->buscaProduto("NOME",$_POST['produto_name']);
			$dado_produto = $stmt_produto->fetch(PDO::FETCH_ASSOC);

			echo "<tr id='linhasItens'>
						<th><input type='checkbox' name='prd_tes' value='".$_POST['produto_name']."'></th>
						<th><label class='col-sm-8 control-label 'style='text-align:left;'>".trim($_POST['produto_name'])."</label>
							<input type='hidden' value='".$dado_produto['COD_PRODUTO']."' name='produto_new[]'>
			        	</th>
			        	<th><label class='col-sm-6 control-label '>".$_POST['cod_estoque'][$i]."</label>
							<input type='hidden' value='".$_POST['cod_estoque'][$i]."' name='estoque_cod[]'>
			        	</th>
			        	<th><label class='col-sm-3 control-label'>".$_POST['uni_medida'][$i]."</label>
			        		<input type='hidden' value='".$_POST['uni_medida'][$i]."' name='medida_uni[]'>
			        	</th>
			        	<th><label class='col-sm-3 control-label'>".$_POST['quant_liberada'][$i]."</label>
			        		<input type='hidden' class='account' value='".$_POST['quant_liberada'][$i]."' name='liberada_quant[]'>
			        	</th>
			        	<th colspan='2'><label class='col-sm-4 control-label'>".$_POST['valor_nota'][$i]."</label>
			        		<input type='hidden' value='".$_POST['valor_nota'][$i]."' class='valor' name='valor_item[]'>
			        	</th>
			        	<th><span class='fa fa-times icon_black remove' onclick='removeItem(this)'  title='Delete Item'></span></th>
			        </tr>";
		}
		jqueryScript();
	}

function validaQuantidadeDisponivel()
{
	echo "<script>

			$('.quant_liberada').focusin(function(){

				alert('oi');
			});

		</script>";

}
function jqueryScript()
	{
		
		echo "<script>

		$('input[type=checkbox]:not(.search)').on('click',function(){
		
				if($(this).is(':checked'))
					selecionado = true;
				else
					selecionado = false;
			
				if(selecionado)
				{
					$('#produto_testemunha_texto').hide().attr('name','');
					$('textarea').val('');
					$(this).parents('tr').children('th:eq(6)').children('span').hide();
					$(this).addClass('select');
					$('input[type=checkbox]:not(.select,.search)').each(function(){
						$(this).attr('disabled',true);
					});
			
				}
				else
				{
					$('#produto_testemunha_texto').show().attr('name','produto_testemunha');
					$(this).parents('tr').children('th:eq(6)').children('span').show();
					$('input[type=checkbox]:not(.select)').each(function(){
						
						$(this).attr('disabled',false);
						
					});

				}
				$(this).removeClass('select');
					
		});

		</script>";
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

function debug()
{
	echo "<pre>";
	print_r($_POST);
	echo "</pre>";
}

 ?>