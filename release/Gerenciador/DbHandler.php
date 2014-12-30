<?php

	class DbHandler
	{
			private $conexao;

			function __construct(){
				require_once "../dao/conexao.php";

				$this->conexao = Conexao::getInstance();

			}

			public function checkLogin($login,$senha)
			{
				try
				{
					$sql = "SELECT * FROM `funcionario` WHERE LOGIN=:login AND SENHA=:senha";
				
					$stmt = $this->conexao->prepare($sql);
					$stmt->bindParam(":login",$login);
					$stmt->bindParam(":senha",$senha);
					$stmt->execute();

					if($stmt->rowCount() > 0)
						return true;
					else
						return false;
					
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
			}

		    public function getUser($login,$senha)
		    {
		    	try
				{
					$sql = "SELECT * FROM `funcionario` WHERE LOGIN=:login AND SENHA=:senha AND TIPO= '2'";
				
					$stmt = $this->conexao->prepare($sql);
					$stmt->bindParam(":login",$login);
					$stmt->bindParam(":senha",$senha);
					$stmt->execute();

					return $stmt->fetch(PDO::FETCH_ASSOC);
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
		    }

		    public function getAllCampos()
		    {
		    	try
				{
					$sql = "SELECT * FROM `campo`";
				
					$stmt = $this->conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
		    }

		    public function getAllEnsaios($cod_campo,$cod_user)
		    {
		    	try
				{
					$sql = "SELECT * FROM ensaio natural join set_valores inner join especie on 
					substring(set_valores.valores_set,1,1) = cod_especie where id_funcionario = :cod_user 
					AND cod_campo = :cod_campo";
				
					$stmt = $this->conexao->prepare($sql);
					$stmt->bindValue(":cod_user",$cod_user);
					$stmt->bindValue(":cod_campo",$cod_campo);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
		    }

		    public function getAmostras_Ensaio($cod_ensaio)
		    {
		    	try
				{
					$sql = "SELECT * FROM amostras_ensaio 
					natural join produto where COD_ENSAIO = :cod_ensaio";
				
					$stmt = $this->conexao->prepare($sql);
					$stmt->bindValue(":cod_ensaio",$cod_ensaio);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
		    }



	}
?>

