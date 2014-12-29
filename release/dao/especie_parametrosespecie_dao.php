<?php 


		include_once("conexao.php");

		class especie_parametrosespecie_dao
		{
			function busca($cod_especie)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `especie_parametrosespecie` WHERE COD_ESPECIE ='".$cod_especie ."'";
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}
		}// fim da classe

 ?>