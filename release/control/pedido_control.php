<?php 

/*
	Title: Controle de Pedido
	Author:Jean Fabrício/Washington Soares
	Date: 13/03/2014
*/
		include_once("../dao/pedido_dao.php");
		include_once("../model/pedido_model.php");
		include_once("../dao/itens_dao.php");
		include_once("../model/itens_model.php");
		include_once("../dao/produto_dao.php");
		include_once("../dao/parceiro_dao.php");
		include_once("../dao/funcionario_dao.php");
		include_once("email/envia.php");

/*
	tipos de erros para validação:

	0 - Parceiro não cadastrado
	14 - Sucesso no cadastro do pedido/Sucesso no cadatro do item do pedido
	25 - Erro no cadastro do pedido/Erro no cadatro do item do pedido
	3 - Produto não Cadastrado


*/		

//     instancio objetos
		$pedido = new Pedido();
		$pedido_dao = new PedidoDAO();
		$parceiro_dao = new ParceiroDAO();
		$funcionario_dao = new FuncionarioDAO();
		$validacao  = null;
		$stmtParceiro = $parceiro_dao->buscaParceiro("NOME",$_POST['parceiro']);
		$dadosParc = $stmtParceiro->fetch(PDO::FETCH_ASSOC);
		//$dadosParc corresponde aos dados do parceiro buscado por nome

		// if($dadosParc['COD_PARCEIRO'] == "")
		// 	$validacao = false;
			
		$data_formatada = formatData(1,$_POST['dataPedido']);


		// objeto pedido
		$pedido->setFuncionario($_POST['gerente']);
		$pedido->setDataPedido($data_formatada);
		$pedido->setParceiro($dadosParc['COD_PARCEIRO']);

		

		// quantidade de itens a ser cadastrado
		$size = count($_POST['produto']);
		
		$produto_dao = new ProdutoDao();
		

		// valida os produtos inseridos se estão cadastrados.
		for($i=0;$i<$size;$i++)
		{
			

			$stmtPro = $produto_dao->buscaProduto("NOME",$_POST['produto'][$i]);

			$dadoProduto = $stmtPro->fetch(PDO::FETCH_ASSOC);

			if($dadoProduto == "")
			{
				echo "2";
				return 0;
			}

		}

		// pedido cadastro
		if($pedido_dao->inserePedido($pedido))
			$validacao = true;
		else
			$validacao = false;
			
		
			

		// a busca do pedido retorna em ordem decrescente para 
		// recuperar o id do ultimo pedido cadastrado
		$stmtPed = $pedido_dao->BuscaPedido();

		$PedidoDados = $stmtPed->fetch(PDO::FETCH_ASSOC);

		
		$item_obj = new Item();
		$item_dao = new ItemDAO();

		if($validacao)
		{
			for($i=0;$i<$size;$i++)
			{
				$stmtPro = $produto_dao->buscaProduto("NOME",$_POST['produto'][$i]);
				$dadoProduto = $stmtPro->fetch(PDO::FETCH_ASSOC);

				$item_obj->setCodPedido($PedidoDados['COD_PEDIDO']);
				$item_obj->setCodProduto($dadoProduto['COD_PRODUTO']);
				$item_obj->setQuantidade($_POST['quantidade'][$i]);
				$item_obj->setMedida($_POST['medida'][$i]);

				if($item_dao->insereItem($item_obj)){
					$validacao = true;
                    echo "1";
                }
				else
				{
					$validacao = false;
					return 0;
				}
			}
		}
		// cadastra todos os itens de um pedido 


		$stmtFuncionario = $funcionario_dao->buscaFuncionario("ID_FUNCIONARIO",$_POST['gerente']);
		$funcionario = $stmtFuncionario->fetch(PDO::FETCH_ASSOC);

        $data_email = date("j / n / Y");
        enviaEmail($_POST['parceiro'],$data_email,$_POST['descricao'],$funcionario["NOME"],$_POST['produto'],$_POST['quantidade'],$_POST['medida'],$size,$funcionario["EMAIL"]);

		//echo $validacao;

		

	/*
		Array Post formato:
		Array
(
    [gerente] => 1
    [dataPedido] => 14/03/25
    [parceiro] => Farias Gomes
    [descricao] => Descrição do pedido
    [produto] => Array
        (
            [0] => Tomate Sol
            [1] => Tomate Sol
            [2] => Tomate Batido
        )

    [quantidade] => Array
        (
            [0] => 12
            [1] => 2
            [2] => 5
        )

    [medida] => Array
        (
            [0] => KG
            [1] => KG
            [2] => MX
        )

)

	*/

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
