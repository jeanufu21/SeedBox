<?php 

		include_once("conexao.php");

		class leituras_resumo_dao
		{
			function busca($termo,$value)
			{
				try
				{

					$conexao = Conexao::getInstance();

					if($value == null)
						$sql = "SELECT * FROM `leituras_resumo`";

					else if($value != null)
						$sql = "SELECT * FROM `leituras_resumo` WHERE ".$termo."='".$value."'";
				
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