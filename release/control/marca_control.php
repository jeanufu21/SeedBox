<?php


/*
		Title:Controle de Marca
		Author:Tacio
		Date:  27/02/2014
		*/

include_once("../model/parceiro_model.php");
include_once("../dao/parceiro_dao.php");
include_once("../dao/marca_dao.php");

if ($_REQUEST['acao'] == 'cadastrar')
{
	$marca = new Marca();
	$marca->setOriginalBrand($_POST["originalBrand"]);
	$marca->setNomeFantasia($_POST["nomeFantasia"]);
	$marca->setParceiro($_POST["parceiro"]);

	try 
	{
		$marcaDao = new MarcaDAO();
		if($marcaDao->insere($marca))
			echo "1";				
		else
			echo "2";

	}catch(Exception $erro){
		echo "2";
	}
}


?>