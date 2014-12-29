<?php
    
	/*
		*	Title: menu_dao.php
		*	Author: Frederico
		*	Date: 17/07/2014
	*/
    
    include_once("conexao.php");

	class  MenuDAO{

		function getTipoUser(){
			
            $pdo = Conexao::getInstance();
			
			//Perguntar ao Tácio
			//session_start();

			$id_func = $_SESSION['codigoUser'];
			try{
				$sql = "SELECT * FROM funcionario WHERE ID_FUNCIONARIO = :id_func";
				$buscaParam = $pdo->prepare($sql);
				$buscaParam->bindValue(":id_func", $id_func, PDO::PARAM_STR);
				$buscaParam->execute();
			}catch(Exception $e){
				return $e;
			}

			$tipoUser = $buscaParam->fetch(PDO::FETCH_ASSOC);

			return $tipoUser["TIPO"];
		}
	}
?>