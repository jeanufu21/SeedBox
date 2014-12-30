<?php 


		include_once("conexao.php");

		class campo_ensaio_set_dao
		{
			function busca($cod_campo,$cod_ensaio)
			{
				try
				{

					$conexao = Conexao::getInstance();

					$sql = "SELECT * FROM `campo_ensaio_set` WHERE cod_campo ='".$cod_campo."' AND cod_ensaio ='".$cod_ensaio."'";
				
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