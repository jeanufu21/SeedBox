<?php 

		include_once("conexao.php");
		include_once("../model/leitura_amostra_model.php");

		class Leitura_Amostra_DAO
		{
			function busca($cod_amostra, $cod_par_avaliacao, $obrigatorio)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `LEITURA_AMOSTRA` WHERE cod_amostra = " . $cod_amostra . " AND cod_par_avaliacao =".$cod_par_avaliacao . " AND obrigatorio =".$obrigatorio;
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}

			function insereLeitura_Amostra( $leitura_amostra_obj)
			{
				try
				{
					$conexao  = Conexao::getInstance();

					$sql = 'INSERT INTO LEITURA_AMOSTRA( `COD_AMOSTRA`, `COD_PAR_AVALIACAO`, `OBRIGATORIO`,  `DATA_LEITURA`, `LEITURA_VALOR`, `NOME_FOTO`, `COMENTARIO` ) VALUES( ' . $leitura_amostra_obj->getCod_amostra() . ', ' . $leitura_amostra_obj->getCod_par_avaliacao() . ', ' . $leitura_amostra_obj->getObrigatorio() . ", '" . $leitura_amostra_obj->getData_leitura() . "'," . $leitura_amostra_obj->getLeitura() . ",'" . $leitura_amostra_obj->getNome_foto() . "','" . $leitura_amostra_obj->getComentario() . "')";

					$stmt = $conexao->prepare($sql);

					$stmt->execute();
					return 1;
				}
				catch(PDOException $erro)
				{
					echo $erro->getMessage();
					return 0;
				}
			}
		}

 ?>
