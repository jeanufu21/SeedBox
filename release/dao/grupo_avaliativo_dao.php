<?php 


		include_once("conexao.php");

		class grupo_avaliativo_dao
		{
			function busca($cod_set_valores)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `grupo_avaliativo` WHERE COD_SET_VALORES ='".$cod_set_valores ."'";
				
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