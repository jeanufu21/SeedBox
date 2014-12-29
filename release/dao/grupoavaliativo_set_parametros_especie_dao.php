<?php 


		include_once("conexao.php");

		class grupoavaliativo_set_parametros_especie_dao
		{
			function busca($cod_set_valores)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `grupoavaliativo_set_parametros_especie` WHERE cod_set_valores ='".$cod_set_valores ."' ORDER BY PARAMETRO_AVALIACAO ASC, OBRIGATORIO DESC";
				
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