<?php 

/*
		Dao de estoque
		Author:Jean Fabrício
		Date:19/03/2014
*/


		include_once("conexao.php");
		include_once("historico_dao.php");

	class EstoqueDAO
	{

		function buscaEstoque($termo,$value)
		{
			try
			{
					$conexao = Conexao::getInstance();
					if($value == null)
					$sql = "SELECT * FROM `estoque`";
					else
					$sql = "SELECT * FROM `estoque` WHERE ".$termo."='".$value."'";
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

		function AtualizaQuantEstoque($codEstoque,$value)
		{
			try
			{
					$conexao = Conexao::getInstance();
					
					$sql = "UPDATE `estoque` SET `QUANT_ATUAL`='".$value."' WHERE COD_ESTOQUE='".$codEstoque."'";
					
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					Historico::registraHistorico("update","estoque","Update no estoque ".$codEstoque." para a quantidade ".$value);

					return 1;

			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
		}


		function produtosEmEstoque($array)
		{
			try
			{
					$conexao = Conexao::getInstance();
					
					$sql = "SELECT * FROM ((estoque INNER JOIN produto ON estoque.COD_PRODUTO=produto.COD_PRODUTO) 
					INNER JOIN marca ON produto.COD_MARCA=marca.COD_MARCA)INNER JOIN itens_notafiscal ON estoque.COD_ESTOQUE=itens_notafiscal.COD_ESTOQUE";

					if(count($array)>0)
					{
						$sql.=" WHERE ";
						for($i=0;$i<count($array);$i++)
						{
							if($i==count($array)-1)
							$sql.=$array[$i];
							else
								$sql.=$array[$i]." AND ";
						}
					}
					$sql.="AND itens_notafiscal.NF_IO = 'I'";
						// echo $sql;
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

		function buscaEstoquePreco($value)
		{
			try
			{
					$conexao = Conexao::getInstance();
					
					 $sql = "SELECT * FROM estoque INNER JOIN itens_notafiscal ON estoque.COD_ESTOQUE=itens_notafiscal.COD_ESTOQUE
					 		WHERE estoque.COD_PRODUTO = '".$value."'";
					
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

	}// fim da classe
 ?>