<?php

/*
	Cadastro de Especies com parametros definidos
	Author: Washington Soares
	date:22/02/2014
*/

 	session_start();

	include_once("conexao.php");
	include_once("funcionario_dao.php");

      

	class Historico{

		public static function registraHistorico($operacao,$tabela,$descricao){

			// echo $operacao."<br>".$tabela."<br>".$descricao;

			try{

				$conecta = Conexao::getInstance();
				$funcionario = new FuncionarioDAO();

				$stmt = $funcionario->buscaFuncionario("ID_funcionario",$_SESSION['codigoUser']);
				$usuario =	$stmt->fetch(PDO::FETCH_ASSOC);

				$sql = "INSERT INTO historico (COD_HISTORICO, TABELA, OPERACAO,USUARIO,DESCRICAO,DATA_HORA) VALUES (NULL,:tabela,:operacao,:usuario,:descricao,:data_hora)";	
				
				$stmt = $conecta->prepare($sql);
				$stmt->bindValue(':tabela',$tabela);
				$stmt->bindValue(':operacao',$operacao);
				$stmt->bindValue(':usuario',$usuario["NOME"]);
				$stmt->bindValue(':descricao',$descricao);
				$stmt->bindValue(':data_hora',null);
				$stmt->execute();

				return 1;
			} 
			catch(PDOExecption $erro){
				echo $erro->getMessage();
				return 0;
			}
		}


		public function consultaHistorico($inicio,$maximo){

			//echo $termo_busca;
			//echo $valor_buscado;

			try{
				$conecta = Conexao::getInstance();
				
				// if(empty($valor_buscado)){
				// 	$sql = "SELECT * FROM historico ORDER BY COD_HISTORICO DESC";
				// 	//echo "vazio";
				// }	
				// else{
				// 	//$sql = "SELECT * FROM historico WHERE ".$termo_busca." LIKE '%".$valor_buscado."%' ORDER BY COD_HISTORICO DESC";

				// 	//SELECT * FROM historico WHERE OPERACAO LIKE '%e%'
				// 	//echo $sql;
				// }	
					$sql  = "SELECT * FROM historico ORDER BY COD_HISTORICO DESC LIMIT $inicio, $maximo";
					
					$query = $conecta->prepare($sql);
					$query->execute();
					return $query;

				
			}catch(PDOExecption $erro){
			
				echo $erro->getMessage();

				return 0;
			}
		}

		public function listaHistorico(){
			try{
				$conecta = Conexao::getInstance();

					$sql  = "SELECT * FROM historico";
					
					$query = $conecta->prepare($sql);
					$query->execute();
					return $query;

				
			}catch(PDOExecption $erro){
			
				echo $erro->getMessage();

				return 0;
			}
		}




		public function consultaHistoricoTecla($termo_busca,$valor_buscado,$inicio,$maximo){
			try{
				$conecta = Conexao::getInstance();
				
				if(empty($valor_buscado)){
					$sql = "SELECT * FROM historico ORDER BY COD_HISTORICO DESC LIMIT ".$inicio.",".$maximo;
				}	
				else{
					$sql = "SELECT * FROM historico WHERE ".$termo_busca." LIKE '%".$valor_buscado."%' ORDER BY COD_HISTORICO DESC LIMIT ".$inicio.",".$maximo;
					
					//SELECT * FROM historico WHERE OPERACAO LIKE '%e%'
					//echo $sql;
				}	
					$query = $conecta->prepare($sql);
					$query->execute();
					return $query;

				
			}catch(PDOExecption $erro){
			
				echo $erro->getMessage();

				return 0;
			}
		}



	}


?>