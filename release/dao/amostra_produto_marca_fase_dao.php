<?php 


		include_once("conexao.php");

		class amostra_produto_marca_fase_dao
		{
			function busca($cod_ensaio, $cod_set_valores)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `amostra_produto_marca_fase` WHERE cod_ensaio ='".$cod_ensaio."' AND cod_set_valores ='".$cod_set_valores."'";
				
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