<?php 
	
	include_once("conexao.php");
	include_once("../model/ensaio_model.php");
	include_once("historico_dao.php");
	
	class EnsaioDao
	{
		function insereEnsaio(Ensaio $ensaio_obj)
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "INSERT INTO ensaio (COD_ENSAIO,COD_SET_VALORES,COD_CAMPO,DATA_SEMEIO,DATA_TRANSPLANTE,DATA_COLHEITA,PRODUTO_TESTEMUNHA,QUANTIDADE_AMOSTRAS,QUANTIDADE_SEMENTES,EMPRESA,PRODUTOR,RESPONSAVEL,SUPERVISOR,AVALIADOR,STATUS) 
				VALUES (NULL,:codigo_set_valores,:codigo_campo,:data_semeio,:data_transplante,:data_colheita,:produto_testemunha,:quantidade_amostra,:quantidade_semente,:empresa,:produtor,:responsavel,:supervisor,:avaliador,:status)";

				$stmt = $conexao->prepare($sql);
				$stmt->bindParam(":codigo_set_valores",$ensaio_obj->getCod_set_valores());
				$stmt->bindParam(":codigo_campo",$ensaio_obj->getCod_campo());
				$stmt->bindParam(":data_semeio",$ensaio_obj->getData_semeio());
				$stmt->bindParam(":data_transplante",$ensaio_obj->getData_transplante());
				$stmt->bindParam(":data_colheita",$ensaio_obj->getData_colheita());
				$stmt->bindParam(":produto_testemunha",$ensaio_obj->getCod_prod_check());
				$stmt->bindParam(":quantidade_amostra",$ensaio_obj->getQuantidade_amostra());
				$stmt->bindParam(":quantidade_semente",$ensaio_obj->getQuantidade_semente());
				//$stmt->bindParam(":repeticao",$ensaio_obj->getRepeticao());
				$stmt->bindParam(":empresa",$ensaio_obj->getEmpresa());
				$stmt->bindParam(":produtor",$ensaio_obj->getProdutor());
				$stmt->bindParam(":responsavel",$ensaio_obj->getResponsavel());
				$stmt->bindParam(":supervisor",$ensaio_obj->getSupervisor());
				$stmt->bindParam(":avaliador",$ensaio_obj->getAvaliador());
				$stmt->bindParam(":status",$ensaio_obj->getStatus());
				
				$stmt->execute();


				Historico::registraHistorico("insert","ensaio","cadastro de um ensaio para a empresa <b><i>".$ensaio_obj->getEmpresa()."</b></i> do produtor <b><i>".$ensaio_obj->getProdutor()."</b></i>");

				return 1;
			}
			catch(PDOException $erro)
			{

				echo $erro->getMessage();

				return 0;
			}


		}


		function buscaEnsaio($termo_busca,$valor_busca)
	{
		try
		{
			$conexao = Conexao::getInstance();

			if( $termo_busca == null &&  $valor_busca == null )
				$sql = "SELECT * FROM ensaio";	
			else 
				$sql = "SELECT * FROM ensaio WHERE  ".$termo_busca." LIKE '%".$valor_busca."%'";
				

			$query = $conexao->prepare($sql);
			$query->execute();

			return $query;
		}
		catch(PDOExecption $error)
		{
			echo $error->getMessage();
	                return 0;
		}


	}

	function buscaEnsaioNaoConcluido($termo_busca,$valor_busca)
	{
		try
		{
			$conexao = Conexao::getInstance();

			if( $termo_busca == null &&  $valor_busca == null )
				$sql = "SELECT * FROM ensaio WHERE STATUS = 0";	
			else 
				$sql = "SELECT * FROM ensaio WHERE  ".$termo_busca." LIKE '%".$valor_busca."%' AND STATUS = 0";
				

			$query = $conexao->prepare($sql);
			$query->execute();

			return $query;
		}
		catch(PDOExecption $error)
		{
			echo $error->getMessage();
	                return 0;
		}


	}

	function concluiEnsaio( $cod_ensaio )
	{
		try
		{
			$conexao = Conexao::getInstance();

			
			$sql = "UPDATE ENSAIO SET STATUS = 1 WHERE COD_ENSAIO = $cod_ensaio";	

			$query = $conexao->prepare($sql);
			$query->execute();

			return 1;
		}
		catch(PDOExecption $error)
		{
			echo $error->getMessage();
	                return 0;
		}


	}

	function setDataSemeio( $cod_ensaio, $data_semeio )
	{
		try
		{
			$conexao = Conexao::getInstance();

			
			$sql = "UPDATE ENSAIO SET DATA_SEMEIO = $data_semeio, STATUS = 1 WHERE COD_ENSAIO = $cod_ensaio";	

			$query = $conexao->prepare($sql);
			$query->execute();

			return 1;
		}
		catch(PDOExecption $error)
		{
			echo $error->getMessage();
	                return 0;
		}


	}

	function cancelaEnsaio( $cod_ensaio, $motivo )
	{
		include_once "../auxiliar/Debug.php";
		try
		{
			$conexao = Conexao::getInstance();

			
			$sql = "UPDATE ENSAIO SET STATUS = 3, MOTIVO = '" . $motivo .  "' WHERE COD_ENSAIO = $cod_ensaio";	
			Debug::gravaEmArquivo( $sql );
			$query = $conexao->prepare($sql);
			$query->execute();

			return 1;
		}
		catch(PDOExecption $error)
		{
			echo $error->getMessage();
	                return 0;
		}


	}

	function ensaioPerdido( $cod_ensaio, $motivo )
	{
		try
		{
			$conexao = Conexao::getInstance();

			
			$sql = "UPDATE ENSAIO SET STATUS = 4, MOTIVO = '" . $motivo .  "' WHERE COD_ENSAIO = $cod_ensaio";

			$query = $conexao->prepare($sql);
			$query->execute();

			return 1;
		}
		catch(PDOExecption $error)
		{
			echo $error->getMessage();
	                return 0;
		}


	}

	function buscaEnsaioDesc()
			{
				try
				{
					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `ensaio` ORDER BY  `COD_ENSAIO` DESC ";
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOException $erro)
				{
					echo $erro->getMessage();
					return 0;
				}
			}
}

 ?>