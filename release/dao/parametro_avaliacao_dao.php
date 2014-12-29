<?php 


		include_once("conexao.php");

		class parametro_avaliacao_dao
		{
			function busca($cod_par_avaliacao)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `parametro_avaliacao` WHERE cod_par_avaliacao ='".$cod_par_avaliacao ."'";
				
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