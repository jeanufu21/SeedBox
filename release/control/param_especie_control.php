<?php

		/*
		Title:Controle de Parametros de Especie
		Author:Jean Fabrício
		Date:  21/02/2014
		*/

		
	include_once("../model/param_especie_model.php");
	include_once("../model/valor_param_model.php");
	include_once("../dao/param_especie_dao.php");
	include_once("../dao/valor_param_dao.php");
	include_once("../dao/set_dao.php");
	/*
	Aqui foi instanciado os objetos para Valor Parametro Modelo
	Chamada do Dao do Parametro Especie e Dao do Valor Parametro
	*/
	$validacao = null;

	$parametros = new ParametrosEspecie();
	$valores_param = new ValorParametros();
	$param_especieDao = new Param_EspecieDao();
	$valor_paramDao = new ValorParamDao();

	// primeiro cadastra o parametro no banco
	if(isset($_GET['botao']))
	{
		


		$parametros->setNomeParam($_POST['nome']);
		$parametros->setCodParamEspecie(null);
		$parametros->setCodEspecie($_POST['especie']);


		$set_dao = new SetDAO();
		$stmt_set = $set_dao->BuscaSet(null);

		while($dado_set = $stmt_set->fetch(PDO::FETCH_ASSOC))
		{

			$query_set = $dado_set['VALORES_SET'];
			$especie = split("#", $query_set)[0];
			if($especie == $parametros->getCodEspecie())
			{
				echo "-3";
				return 0;
			}
				


		}

		$stmt_1 = $param_especieDao->buscaParam("NOME_PAR_ESPECIE",$parametros->getNomeParam());
			
		$repetido = 0;// parametros repetidos para uma mesma especie

		while($dados = $stmt_1->fetch(PDO::FETCH_ASSOC))
		{
			if($dados['NOME_PAR_ESPECIE'] == $parametros->getNomeParam() &&
				$dados['COD_ESPECIE'] == $parametros->getCodEspecie())
			{
				$repetido++;

			}
		}

		

		if($repetido ==1)
		{
			
			
			$stmt = $param_especieDao->buscaParamNome_Especie($parametros->getNomeParam(),$parametros->getCodEspecie());

			$dados = $stmt->fetch(PDO::FETCH_ASSOC);

			$valores_param->setCodParamEspecie($dados['COD_PAR_ESPECIE']);
			

			$stmt_valida = $valor_paramDao->busca_valores($valores_param->getCodParamEspecie());


			$size = count($_POST['valores']);
			// alimenta o array de valores no modelo valor Param
				for($i=0;$i<$size;$i++)
				{
					while($array_list = $stmt_valida->fetch(PDO::FETCH_ASSOC))
					{
						if($_POST['valores'][$i] == $array_list["VALOR"])
						{
							echo "-15";
							return 0;
						}
					}
					$valores_param->setValorParam($_POST['valores'][$i]);
				}

				if($valor_paramDao->insere_valore($valores_param,$size))
					$validacao = true;
				else
					$validacao = false;
			
			echo "1";
			return 0;
		}

		$stmt = $param_especieDao->buscaParam("COD_ESPECIE",$parametros->getCodEspecie());
		$quant_param_cadastrado = $stmt->rowCount();


		if($quant_param_cadastrado <4)
		{
			if($param_especieDao->insere($parametros))
				$validacao = true;
			else
			$validacao = false;

			// depois consulta pelo nome o parametro para descobrir qual é o id
			// do parametro cadastrado que é gerado automaticamente 'funcão buscaParam'
			$stmt = $param_especieDao->buscaParamNome_Especie($parametros->getNomeParam(),$parametros->getCodEspecie());

			$dados = $stmt->fetch(PDO::FETCH_ASSOC);

			$valores_param->setCodParamEspecie($dados['COD_PAR_ESPECIE']);


			// so cadastra valores se esses forem digitados na view
				if(isset($_POST['valores']))
				{
					$size = count($_POST['valores']);
					// alimenta o array de valores no modelo valor Param
						for($i=0;$i<$size;$i++)
						
							$valores_param->setValorParam($_POST['valores'][$i]);

						if($valor_paramDao->insere_valore($valores_param,$size))
							$validacao = true;
						else
							$validacao = false;
						
				}
		}
		else
			$validacao = -1;

		
		echo $validacao;


		
	}



?>