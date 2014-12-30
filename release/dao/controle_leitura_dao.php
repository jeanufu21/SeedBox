<?php 

		include_once("conexao.php");
		 include_once("../model/controle_leitura_model.php");

		 class Controle_Leitura_DAO
		 {

			function insereControleLeitura($controle_leitura_obj)
			{
				try
				{
					$conexao  = Conexao::getInstance();


					$sql = 'CALL InsertControleLeitura( ' . $controle_leitura_obj->getCod_ensaio() . ', ' . $controle_leitura_obj->getCod_par_avaliacao() . ', ' . $controle_leitura_obj->getObrigatorio() . ')';
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return 1;
				}
				catch(PDOException $erro)
				{
					//echo $erro->getMessage();
					return 0;
				}
			}

			function updateControleLeitura($controle_leitura_obj)
			{
				try
				{
					$conexao  = Conexao::getInstance();

					$sql = 'UPDATE CONTROLE_LEITURA SET `LEITURAS_FEITAS` = (`LEITURAS_FEITAS` + 1) WHERE `COD_PAR_AVALIACAO` = ' + $controle_leitura_obj->getCod_par_avaliacao() + ' AND `COD_ENSAIO` = ' + $controle_leitura_obj->getCod_ensaio();
					
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return 1;
				}
				catch(PDOException $erro)
				{
					//echo $erro->getMessage();
					return 0;
				}

			}

			function getLeiturasFeitas($controle_leitura_obj )
			{
				try
				{
					$conexao  = Conexao::getInstance();

					$sql = 'SELECT * FROM CONTROLE_LEITURA WHERE `COD_PAR_AVALIACAO` = ' + $controle_leitura_obj->getCod_par_avaliacao() + ' AND `COD_ENSAIO` = ' + $controle_leitura_obj->getCod_ensaio();
					
					$stmt = $conexao->prepare($sql);
					$stmt->execute();
					
					return $stmt;

					
				}
				catch(PDOException $erro)
				{
					//echo $erro->getMessage();
					return 0;
				}
			}

			function busca($cod_par_avaliacao, $cod_ensaio)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `controle_leitura` WHERE cod_par_avaliacao ='".$cod_par_avaliacao. "' AND cod_ensaio ='".$cod_ensaio."'";
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}

		}

 ?>