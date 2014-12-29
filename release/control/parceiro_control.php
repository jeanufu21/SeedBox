<?php


/*
		Title:Controle de Parceiro
		Author:Tacio
		Date:  27/02/2014
		*/

include_once("../model/parceiro_model.php");
include_once("../dao/parceiro_dao.php");

if ($_REQUEST['acao'] == 'cadastrar')
{

	$parceiro = new Parceiro();
	$parceiro->setCodigo(null);
	$parceiro->setNome($_POST['nome']);
	$parceiro->setCpf($_POST['cpf']);
	$parceiro->setCnpj($_POST['cnpj']);
	//$parceiro->setInscricao(null);
	$parceiro->setBairro($_POST['bairro']);
	//$parceiro->setFax($_POST['fax']);
	$parceiro->setComplemento($_POST['complemento']);
	$parceiro->setSite($_POST['site']);
	$parceiro->setPais($_POST['country']);
	$parceiro->setUF($_POST['state']);
	$parceiro->setMunicipio($_POST['city']);
	$parceiro->setEndereco($_POST['address']);
	$parceiro->setCep($_POST['cep']);
	$parceiro->setEmail($_POST['email']);
	$parceiro->setTelefone1($_POST['tel1']);
	$parceiro->setTelefone2($_POST['tel2']);
	$parceiro->setObservacoes($_POST['observations']);

	$parceiroDao = new ParceiroDao();
	if($parceiroDao->insere($parceiro))
	{
		echo "1";
	}
	else
	{
		echo "2";
	}
	

	//Parte para cadastrar na segunda tabela
}


elseif ($_REQUEST['acao'] == 'buscarParceiros')
{


	$parceiroDao = new ParceiroDao();
	$parceiros = $parceiroDao->selecionarTodos();

	$html = "";

	foreach ($parceiros as $p )
	{
		
		$html = $html."<option value='".$p->getCodigo()."'>".$p->getNome()."</option>";
	}
	echo $html;
	
	//Parte para cadastrar na segunda tabela
}

elseif ($_REQUEST['acao'] == 'selecionarParceiro')
{

	$parceiroDao = new ParceiroDao();
	
	$parceiro = $parceiroDao->selecionarPorRegistro($_POST['codParceiro']);
	
		$html = "<tr>
					<td>".$parceiro->getNome()."</td>
					<td class='registro'>".$parceiro->getRegistro()."</td>
					</tr>";
		

	echo $html;
	

	//Parte para cadastrar na segunda tabela
}


else {}

?>