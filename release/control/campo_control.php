<?php
/*
				Title: Funções para o campo
				Author:washington soares
				Date: 24/03/2014
		*/

include_once("../dao/campo_dao.php");
include_once("../model/campo_model.php");

if($_GET['acao'] == "cadastrar"){





		$campo = new campo();
		$campo->setCod_campo(null);
		$campo->setNome($_POST['nome_campo']);
		$campo->setCidade($_POST['city']);
		$campo->setUf($_POST['uf']);
		$campo->setAltitude($_POST['altitude']);
		$campo->setLatitude($_POST['latitude']);
		$campo->setLongitude($_POST['longitude']);

		$campo_dao = new CampoDao();

		$stmt = $campo_dao->buscaCampo("NOME",$campo->getNome());
		

		if($stmt->rowCount()>0)
		{
			echo "-1";
			return 0;
		}
			

		if($campo_dao->insereCampo($campo))
		{
			echo "1";
		}
		else{
			echo "2";
		}






}








?>