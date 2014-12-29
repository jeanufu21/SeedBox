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


if($_GET['acao'] == "show")
{

// instancia os objetos
$pedido_dao        = new PedidoDAO();
$funcionario_dao   = new FuncionarioDAO();
$parceiro_dao      = new ParceiroDAO();
$itens_pedido_dao  = new ItemDAO();
$produto_dao       = new ProdutoDao();
// busca pedidos especifico do gerente logado
$stmt_1 = $pedido_dao->busca(null,null);

// busca o nome do gerente para mostrar na tabela
// $stmt_2 = $funcionario_dao->buscaFuncionario("ID_FUNCIONARIO",$_SESSION['codigoUser']);
// $nomeFunc = $stmt_2->fetch(PDO::FETCH_ASSOC);

function formatData($tipo,$date){ 
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
// dados_1 corresponde ao banco tabela pedidos



$i =0;
while($dados_1 = $stmt_1->fetch(PDO::FETCH_ASSOC))
{
	
	// busca o nome do parceiro pelo codigo
	$stmt_3 = $parceiro_dao->buscaParceiro("COD_PARCEIRO",$dados_1['COD_PARCEIRO']);
	$dados_2 =  $stmt_3->fetch(PDO::FETCH_ASSOC);
	// dados_2 corresponde ao banco tabela parceiros
	$data_view = formatData(2,$dados_1['DATA_PEDIDO']);


echo "<tr id='id".$dados_1['COD_PEDIDO']."' class='linha sub success'>
		<th>
			<span style='cursor:pointer' class='label label-success detalhe' id='detalhe'>More Details + </span>
		</th>
		 <th><label class='col-sm-12 busca_pedido' title='Search Product in stock' ></label></th>
		<th>".$data_view."</th>
		<th>".$dados_2['NOME']."</th>
		<th class='status'>".$dados_1['STATUS']."</th>		
	  </tr>";



echo "<tr style='text-align:center;' class='id".$dados_1['COD_PEDIDO']." danger'>
			<th></th>
			<th>Produto</th>
			<th>Quantidade</th>
			<th>Unidade de Medida</th>
			<th>Valor</th>
					
</tr>";


// busca os itens de cada pedido
	$stmt_itens_pedido = $itens_pedido_dao->BuscaItem("COD_PEDIDO",$dados_1['COD_PEDIDO']);

	while($dados_itens = $stmt_itens_pedido->fetch(PDO::FETCH_ASSOC))
	{
		$stmt_produto = $produto_dao->buscaProduto("COD_PRODUTO",$dados_itens['COD_PRODUTO']);
		$dados_produto =  $stmt_produto->fetch(PDO::FETCH_ASSOC);

	echo "<tr style='text-align:center;' class='id".$dados_1['COD_PEDIDO']."'>
			<th></th>
			<th>".$dados_produto['NOME']."</th>
			<th>".$dados_itens['QUANTIDADE']."</th>
			<th>".$dados_itens['UNIDADE_MEDIDA']."</th>
			<th>".$dados_itens['VALOR']."</th>
					
		  </tr>";


	}
}
echo "<script src='../js/ocultar_colunas_jquery.js' type='text/javascript'></script>";

}
?>