<?php 
	
	include_once("conexao.php");
	include_once("../model/amostra_ensaio_model_nota.php");
	
	class AmostraEnsaioDAO
	{
		function insereAmostraEnsaio(AmostraEnsaio $ensaio_obj)
		{
			try
			{
				$conexao = Conexao::getInstance();

				$sql = "INSERT INTO amostras_ensaio (COD_ENSAIO,COD_PRODUTO,NRO_ESTACA,QUANTIDADE_SEMENTES) 
				VALUES (:cod_ensaio,:cod_produto,:nro_estaca,:quantidade_sementes)";

				$stmt = $conexao->prepare($sql);
				$stmt->bindParam(":cod_ensaio",$ensaio_obj->getcodEnsaio());
				$stmt->bindParam(":cod_produto",$ensaio_obj->getcodProduto());
				$stmt->bindParam(":nro_estaca",$ensaio_obj->getnroEstaca());
				$stmt->bindParam(":quantidade_sementes",$ensaio_obj->getquantidadeSementes());
				
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