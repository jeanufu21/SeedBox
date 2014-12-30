<?php 

/*
		Title:
		Author:Jean Fabrício/Washington Soares
		Date: 14/03/2014
*/
		include_once("conexao.php");
		include_once("../model/funcionario_model.php");
		include_once("historico_dao.php");

		class FuncionarioDAO
		{
			function buscaFuncionario($termo,$value)
			{
				try
				{

					$conexao = Conexao::getInstance();

					if($value == null)
						$sql = "SELECT * FROM funcionario";

					else if($value != null)
						$sql = "SELECT * FROM funcionario WHERE ".$termo."='".$value."'";
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}

			function buscaFuncionario_2($termo,$value)
			{
				try
				{

					$conexao = Conexao::getInstance();

					
						$sql = "SELECT * FROM funcionario WHERE ".$termo." LIKE '%".$value."%'";
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}

			function buscaFuncionario_dif_id($termo, $value, $id)
			{

				try
				{

					$conexao = Conexao::getInstance();

					
					$sql = "SELECT * FROM funcionario WHERE ".$termo." = '".$value."' 
					AND ID_FUNCIONARIO <> ".$id;
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
			}

			function getGerenteforAutoComplete()
			{
				try
				{

					$conexao = Conexao::getInstance();

					
					$sql = "SELECT * FROM funcionario WHERE TIPO = 2 OR TIPO = 1 AND ID_FUNCIONARIO <> 1";
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}

			function insereFuncionario(Funcionario $funcionario){
				try{
					$conecta = Conexao::getInstance();

					$sql = "INSERT INTO funcionario (ID_FUNCIONARIO, NOME, TIPO,LOGIN,SENHA,EMAIL,TELEFONE,UF,CIDADE) 
							VALUES (NULL,:nome,:level,:login,:senha,:email,:telefone,:uf,:cidade)";	


					$nomeFuncionario = $funcionario->GetNomeFuncionario();
					$levelFuncionario = $funcionario->GetLevel();
					$loginFuncionario = $funcionario->GetLoginFuncionario();
					$senhaFuncionario = $funcionario->GetSenha();
					$emailFuncionario = $funcionario->GetEmail();
					$telefoneFuncionario = $funcionario->GetTelefone();
					$ufFuncionario = $funcionario->GetUf();
					$cidadeFuncionario = $funcionario->GetCidade();


					$stmt = $conecta->prepare($sql);
					$stmt->bindParam(":nome",$nomeFuncionario);
					$stmt->bindParam(":level",$levelFuncionario);
					$stmt->bindParam(":login",$loginFuncionario);
					$stmt->bindParam(":senha",$senhaFuncionario);
					$stmt->bindParam(":email",$emailFuncionario);
					$stmt->bindParam(":telefone",$telefoneFuncionario);
					$stmt->bindParam(":uf",$ufFuncionario);
					$stmt->bindParam(":cidade",$cidadeFuncionario);
					$stmt->execute();

					if($levelFuncionario=="1"){
						$level = "Admin";
					}elseif ($levelFuncionario=="2") {
						$level = "Gerente";
					}else{
						$level = "Avaliator";
					}

 					Historico::registraHistorico("insert","funcionario","cadastro do funcionario <b><i>".$nomeFuncionario." </b></i>com o nível de acesso <b><i>".$level."</b></i>");

					return 1;
				}catch(PDOExecption $erro){
					//echo $erro->getMessage();

					return 0;
				}



			}



			function ValidaFuncionario($value1,$value2)
			{
				try
				{

					$conexao = Conexao::getInstance();

					
					$sql = "SELECT * FROM `funcionario` WHERE LOGIN='".$value1."' AND SENHA='".$value2."'";
				
					$stmt = $conexao->prepare($sql);
					$stmt->execute();

					return $stmt;
				}
				catch(PDOExecption $erro)
				{
					echo $erro->getMessage();
				}
				
			}

           function updateProfile($nome,$login,$psw,$email,$telefone,$uf,$cidade){
           	  try
				{
					$conecta = Conexao::getInstance();
					
					$sql = "UPDATE  funcionario SET NOME = :nome , LOGIN = :login , SENHA = :senha , EMAIL = :email , TELEFONE = :telefone , UF = :uf , CIDADE = :cidade WHERE ID_FUNCIONARIO = ".$_SESSION['codigoUser']."";
							

					$stmt = $conecta->prepare($sql);
					$stmt->bindParam(":nome",$nome);
					//$stmt->bindParam(":level",$funcionario->GetLevel());
					$stmt->bindParam(":login",$login);
					$stmt->bindParam(":senha",$psw);
					$stmt->bindParam(":email",$email);
					$stmt->bindParam(":telefone",$telefone);
					$stmt->bindParam(":uf",$uf);
					$stmt->bindParam(":cidade",$cidade);
					
					if ($stmt->execute()){
						$nnome = "Nome: <b><i>".$nome."</b></i><br>";
						$nlogin = "Login: <b><i>".$login."</b></i><br>";
						$nemail = "E-mail: <b><i>".$email."</b></i><br>";
						$ntel = "Telefone: <b><i>".$telefone."</b></i><br>";
						$nuf = "Estado: <b><i>".$uf."</b></i><br>";
						$ncidade = "Cidade: <b><i> ".$cidade."</b></i><br>";
						$registro = "Update no: <br>".$nnome.$nlogin.$nemail.$ntel.$nuf.$ncidade;
						Historico::registraHistorico("update","funcionario", $registro);
					}

					return 1;

			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
           }


           function editaUserAdmin($codigoUser,$nome,$tipo,$login,$psw,$email,$telefone,$uf,$cidade){
           	  try
				{
					$conecta = Conexao::getInstance();
					
					$sql = "UPDATE  funcionario SET NOME = :nome ,TIPO = :tipo, LOGIN = :login , SENHA = :senha , EMAIL = :email , TELEFONE = :telefone , UF = :uf , CIDADE = :cidade WHERE ID_FUNCIONARIO = '".$codigoUser."'";
							

					$stmt = $conecta->prepare($sql);
					$stmt->bindParam(":nome",$nome);
					$stmt->bindParam(":tipo",$tipo);
					$stmt->bindParam(":login",$login);
					$stmt->bindParam(":senha",$psw);
					$stmt->bindParam(":email",$email);
					$stmt->bindParam(":telefone",$telefone);
					$stmt->bindParam(":uf",$uf);
					$stmt->bindParam(":cidade",$cidade);
					$stmt->execute();

					Historico::registraHistorico("update","funcionario","Update no nome do funcionario <b><i>".$nome."</i></b>");

					return 1;

			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();
				return 0;
			}
           }


           function deletaFuncionario($codigoUser)
           {
           		try
				{
					$conecta = Conexao::getInstance();
					
					$sql = "DELETE FROM `funcionario` WHERE ID_FUNCIONARIO = '".$codigoUser."'";
							

					$stmt = $conecta->prepare($sql);
					
					$stmt->execute();

					Historico::registraHistorico("Delete","funcionario"," Um usuario foi removido!</i></b>");

					return 1;

			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();
				return 0;
			}

           }


		}// fim da classe

 ?>