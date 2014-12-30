<?php
    
	/*
		*	Title: grupo_avaliativo.php
		*	Authors: Frederico, Gustavo
		*	Date: 27/03/2014
	*/

	include_once("conexao.php");

	class GrupoAvaliativoDAO{

		/* Esta função busca os parâmetros de avaliação que poderão ser inclusos em um determinado
		grupo avaliativo */
		function buscaParAval($cod_especie){

			$pdo = Conexao::getInstance();

	        $sql = "SELECT * FROM parametro_avaliacao WHERE COD_ESPECIE = :cod_especie";
	        $buscarParam = $pdo->prepare($sql);
	        $buscarParam->bindParam(':cod_especie', $cod_especie, PDO::PARAM_INT);
			$buscarParam->execute();

			return $buscarParam;
		}

		/* Esta função busca as espécies */

		/* Implementar utilizando ajax */
		function buscaEspecie(){

			$pdo = Conexao::getInstance();
			session_start();
			$cod_user = $_SESSION['codigoUser'];

			try{
				$sql = "SELECT * FROM funcionario WHERE ID_FUNCIONARIO = :id_func";
				$buscaParam = $pdo->prepare($sql);
				$buscaParam->bindParam(':id_func', $cod_user, PDO::PARAM_INT);
				$buscaParam->execute();
			}catch(Exception $e){
				//return $e;
			}
			$tipoUser = $buscaParam->fetch(PDO::FETCH_ASSOC);
			
			/* Verifica se o usuario logado e adm, caso seja todas as especies seram listadas */

			if($tipoUser['TIPO'] == 1){

				$sql2 = "SELECT * FROM especie ";
				$buscarParam = $pdo->prepare($sql2);
				$buscarParam->execute();


			}else{/* Caso o usuário nao seja adm somente as especies que ele e responsavel seram listadas */
				
				$sql2 = "SELECT * FROM especie WHERE ID_FUNCIONARIO = :id_func";
				$buscarParam = $pdo->prepare($sql2);
				$buscarParam->bindParam(':id_func', $cod_user, PDO::PARAM_INT);
				$buscarParam->execute();

			}
			return $buscarParam;

		}

		/* Esta função busca as fases de avaliação */
		function buscaFase(){

			$pdo = Conexao::getInstance();

			$sql = "SELECT * FROM fase";
			$buscarParam = $pdo->prepare($sql);
			$buscarParam->execute();

			return $buscarParam;
		}

		/* Esta função insere */
		function insertAvalParam($nome_parametroAvaliacao, $tipo_parametroAvaliacao, $cod_especie){

            $conecta = Conexao::getInstance();

            $sqlSelectValida = 'SELECT * FROM parametro_avaliacao WHERE NOME = :nome AND QUANTITATIVO = :quantitativo';
            $sqlSelectValida .= ' AND COD_ESPECIE = :specieCOD';

            try{

                $querrySelectValida = $conecta->prepare($sqlSelectValida);
                
                $querrySelectValida->bindParam(':nome', $nome_parametroAvaliacao, PDO::PARAM_STR);
                $querrySelectValida->bindParam(':quantitativo', $tipo_parametroAvaliacao, PDO::PARAM_INT);
                $querrySelectValida->bindParam(':specieCOD', $cod_especie, PDO::PARAM_INT);
                $querrySelectValida->execute();
			
			    
		    }catch(PDOEXception $selectValidaError){
		        echo $selectValidaError;
		    }

            if($querrySelectValida->rowCount() == 0){

                $sqlInsertParam = 'INSERT INTO parametro_avaliacao( NOME, QUANTITATIVO, COD_ESPECIE ) ';
		        $sqlInsertParam .= 'VALUES (:nomeParametro_parametroAvaliacao, :tipo_parametroAvaliacao, :specieCOD)';
                
                try{
                    $querry_insertParam = $conecta->prepare($sqlInsertParam);
			        $querry_insertParam->bindParam(':nomeParametro_parametroAvaliacao', $nome_parametroAvaliacao, PDO::PARAM_STR);
			        $querry_insertParam->bindParam(':tipo_parametroAvaliacao', $tipo_parametroAvaliacao, PDO::PARAM_INT);
	                $querry_insertParam->bindParam(':specieCOD', $cod_especie, PDO::PARAM_INT);
			        $querry_insertParam->execute();

	            }catch(PDOExeption $insert_errorParam){
		   			echo $insert_errorParam;
		        }
	            return 1;

            }else{
                return 0;
            }
		}

		/* Recupera os parâmetros de avaliação de uma espécie */
		function consultaParAva($cod_especie){
			$pdo = Conexao::getInstance();

			$sql = "SELECT * FROM conjunto_parametro_especie WHERE COD_ESPECIE = :cod_especie";	
			$query = $pdo->prepare($sql);
			$query->bindParam(':cod_especie', $cod_especie, PDO::PARAM_INT);
			$query->execute();

			return $query;
		}

		/* Recupera os valores para os parâmetros de avaliação de uma espécie */
		function consultaValParAva($cod_par_especie){
			$pdo = Conexao::getInstance();

			$sql = "SELECT * FROM valor_par_especie WHERE COD_PAR_ESPECIE = :cod_par_especie";

	        $query = $pdo->prepare($sql);
	        $query->bindParam(':cod_par_especie', $cod_par_especie, PDO::PARAM_INT);
	        $query->execute();

	        return $query;
		}

		/* Recupera o código de um set dado a string do set */
		function recuperaCodSet($set){
			$pdo = Conexao::getInstance();

			// busca o cod do set comparando com a variavel $set
			$sql = "SELECT * FROM set_valores WHERE VALORES_SET = :set";	

			$query = $pdo->prepare($sql);
	        $query->bindParam(':set', $set, PDO::PARAM_STR);
			$query->execute();

			$linha = $query->fetch(PDO::FETCH_ASSOC);
	        if($query->rowCount() == 0){
	        	return -1;
	        }else{
	        	return $linha["COD_SET_VALORES"];
			}
		}

		/* Recupera as informações de um grupo avaliativo dado um código de um set */
		function recuperaInfTrialG($cod_set){

			$pdo = Conexao::getInstance();

			$sql = "SELECT * FROM  grupo_avaliativo WHERE COD_SET_VALORES = :cod_set ";
	        $query = $pdo->prepare($sql);
	        $query->bindParam(':cod_set', $cod_set, PDO::PARAM_INT);
	        $query->execute(); 

	        return $query;

		}

		/* Recupera informações de um parâmetro de  avaliação de acordo com o código do parâmetro */
		function recuperaParAvaliacao($cod_par_avaliacao){

			$pdo = Conexao::getInstance();

			$sql = "SELECT * FROM parametro_avaliacao WHERE COD_PAR_AVALIACAO = :cod_par_avaliacao";
	        $query = $pdo->prepare($sql);
	        $query->bindParam(':cod_par_avaliacao', $cod_par_avaliacao, PDO::PARAM_INT);
	        $query->execute();

	        return $query;
		}

		/* Deleta todos os grupos avaliativos que possuem um código de set igual ao passado 
		por parâmetro */
		function deleteTrialG($cod_set){
			$pdo = Conexao::getInstance();

	        $sql = "DELETE FROM grupo_avaliativo WHERE COD_SET_VALORES = :cod_set";
	        try{
	            $query = $pdo->prepare($sql);
	            $query->bindParam(':cod_set', $cod_set, PDO::PARAM_INT);
	            $query->execute();
	        }catch(PDOExeption $delete_errorParam){
	    		    //echo'<h2>Error to delete data!</h2><br>'.$delete_errorParam->getMessage;
	    		    return 1;
	    
	    	}
	    	return 0;
		}

		/* Insere um Array de objetos do tipo Grupo Avaliativo */
		function insertTrialG($grupoAvaliativo, $qtIns){

			/*
			echo'<pre>';
				print_r($_POST);
			echo'</pre>';
			*/
			$pdo = Conexao::getInstance();
			
			$sql = "INSERT INTO grupo_avaliativo ( COD_SET_VALORES, COD_PAR_AVALIACAO, COD_ESPECIE, OBRIGATORIO, MIN, MAX, NRO_AVALIACOES, OBSERVACAO) ";
			$sql .= "VALUES (:cod_set_valores, :cod_par_avaliacao, :cod_especie, :obrigatorio, :min, :max, :nro_avaliacoes, :observacao)";
			$querry = $pdo->prepare($sql);

		    
		    for($i=0; $i<$qtIns; $i++){
		    	try{
		            $querry->bindParam(":cod_set_valores", $grupoAvaliativo[$i]->getCodSet(), PDO::PARAM_INT);
		            $querry->bindParam(":cod_par_avaliacao", $grupoAvaliativo[$i]->getCodParametroAvaliacao(), PDO::PARAM_INT);
		            $querry->bindParam(":cod_especie", $grupoAvaliativo[$i]->getCodEspecie(), PDO::PARAM_INT);
		            $querry->bindParam(":obrigatorio", $grupoAvaliativo[$i]->getObrigatorio(), PDO::PARAM_INT);
		            $querry->bindParam(":min", $grupoAvaliativo[$i]->getMin(), PDO::PARAM_INT);
		            $querry->bindParam(":max", $grupoAvaliativo[$i]->getMax(), PDO::PARAM_INT);
		            $querry->bindParam(":nro_avaliacoes", $grupoAvaliativo[$i]->getNroAvaliacoes(), PDO::PARAM_INT);
		            $querry->bindParam(":observacao", $grupoAvaliativo[$i]->getComentario(), PDO::PARAM_STR);
		            $querry->execute();
				}catch(PDOExeption $insert_errorParam){
		 		   //echo'<h2>Error to save data</h2><br />'.$insert_errorParam->getMessage;
				}
			}
		}

		/* Insere um set que ainda não havia sido cadastrado */
		function insertSet($set){
			$pdo = Conexao::getInstance();
			try{

				$sql = "INSERT INTO set_valores (VALORES_SET) VALUES (:set)";

				$querry = $pdo->prepare($sql);
				$querry->bindParam(":set", $set, PDO::PARAM_STR);

				$querry->execute();
			}catch(Exception $e){
				//return $e;
			}
			return 0;
		} 
	}
?>