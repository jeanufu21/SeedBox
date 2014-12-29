<?php 

		include_once("conexao.php");

		class amostra_produto_ensaio_dao
		{
			function busca($termo_busca,$valor_busca)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `amostra_produto_ensaio` WHERE " . $termo_busca . " = '". $valor_busca ."'";
				
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