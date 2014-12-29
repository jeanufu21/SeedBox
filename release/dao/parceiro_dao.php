<?php 

/*
			DAO de Parceiro
			Author: Tacio / Washington 
			last modified:24/03/2014
*/
include_once("conexao.php");
include_once("../model/parceiro_model.php");
include_once("historico_dao.php");

class ParceiroDAO {


	
	function buscaParceiro($termo,$value)
	{
		try
		{
			$conexao = Conexao::getInstance();
			if($value == null)
				$sql = "SELECT * FROM `parceiro` ORDER BY nome ASC";
			else if($value != null)
				$sql = "SELECT * FROM `parceiro` WHERE ".$termo."='".$value."'";

			$stmt = $conexao->prepare($sql);
			$stmt->execute();

			return $stmt;
		}
		catch(PDOExecption $erro)
		{
			echo $erro->getMessage();
		}
	}

	function insere($parceiro)
	{
		try{
			$conecta = Conexao::getInstance();
            
            /*Querry Original
			$sql = "INSERT INTO parceiro (NOME,CNPJ,EMAIL,SITE,ENDERECO,COMPLEMENTO,BAIRRO,MUNICIPIO,UF,CEP,PAIS,TELEFONE1,TELEFONE2,FAX,CPF,INSCRICAO_RURAL,OBSERVACOES)
					VALUES(:nome, :cnpj,:email,:site,:endereco,:complemento,:bairro,:municipio,:uf,:cep,:pais,:telefone1,:telefone2,:fax,:cpf,:inscricao,:observacoes)";
            */

			$sql = "INSERT INTO parceiro (NOME,CNPJ,EMAIL,SITE,ENDERECO,COMPLEMENTO,BAIRRO,MUNICIPIO,UF,CEP,PAIS,TELEFONE1,TELEFONE2,CPF,OBSERVACOES)
					VALUES(:nome, :cnpj,:email,:site,:endereco,:complemento,:bairro,:municipio,:uf,:cep,:pais,:telefone1,:telefone2,:cpf,:observacoes)";
			
            $stmt = $conecta->prepare($sql);
			$stmt->bindValue(':nome',$parceiro->getNome());
			$stmt->bindValue(':cnpj',$parceiro->getCnpj());
			$stmt->bindValue(':email',$parceiro->getEmail());
			$stmt->bindValue(':site',$parceiro->getSite());
			$stmt->bindValue(':endereco',$parceiro->getEndereco());
			$stmt->bindValue(':complemento',$parceiro->getComplemento());
			$stmt->bindValue(':bairro',$parceiro->getBairro());
			$stmt->bindValue(':municipio',$parceiro->getMunicipio());
			$stmt->bindValue(':uf',$parceiro->getUF());
			$stmt->bindValue(':cep',$parceiro->getCep());
			$stmt->bindValue(':pais',$parceiro->getPais());
			$stmt->bindValue(':telefone1',$parceiro->getTelefone1());
			$stmt->bindValue(':telefone2',$parceiro->getTelefone2());
			//$stmt->bindValue(':fax',$parceiro->getFax());
			$stmt->bindValue(':cpf',$parceiro->getCpf());
			//$stmt->bindValue(':inscricao',$parceiro->getInscricao());
			$stmt->bindValue(':observacoes',$parceiro->getObservacoes());
			$stmt->execute();


			Historico::registraHistorico("insert","parceiro","cadastro do parceiro <b><i>".$parceiro->getNome()."</b></i>");

			return 1;
		} 
		catch(PDOExecption $erro){
			echo $erro->getMessage();

			return 0;
		}
	}

// 	function selecionarTodos()
// 	{
// 		$parceiros = null;
// 		try{
// 			$conecta = Conexao::getInstance();

// 			$sql = "SELECT * FROM parceiro ";
				
// 			$stmt = $conecta->prepare($sql);
// 			$stmt->bindParam(':registro',$reg);
// 			$stmt->execute();
// 			$parceiros =  array();

// 			//atribui resultado no formato de um vetor indexado pelo nome do campo tabela
// 				$contador = 0;
// 				while ($dado = $stmt->fetch(PDO::FETCH_ASSOC))
// 				{
// 					$parceiro = new Parceiro();
// 					$parceiro->setCodigo($dado["COD_PARCEIRO"]);
// 					$parceiro->setNome($dado["NOME"]);	
// 					$parceiro->setRegistro($dado["CNPJ"]);	
					
// 					$parceiros[$contador] = $parceiro;
// 					$contador++;
// 				}	
// 			///terminar de buscar uma marca e inserir o parceiro +marca em comercializ

// 			} 
// 			catch(PDOExecption $erro){
// 				echo $erro->getMessage();

// 				return $parceiros;
// 			}
// 			return $parceiros;

// 	}

// function selecionarPorRegistro($reg)
// {

// 	$parceiro = null;
// 	try{
// 			$conecta = Conexao::getInstance();

// 			$sql = "SELECT * FROM parceiro WHERE CNPJ=:registro";
				
// 			$stmt = $conecta->prepare($sql);
// 			$stmt->bindValue(':registro',$reg);
// 			$stmt->execute();

// 			//atribui resultado no formato de um vetor indexado pelo nome do campo tabela
// 			$dado = $stmt->fetch(PDO::FETCH_ASSOC);
// 			if($dado)
// 			{
// 				$parceiro = new Parceiro();
// 				$parceiro->setCodigo($dado["COD_PARCEIRO"]);
// 				$parceiro->setNome($dado["NOME"]);	
// 				$parceiro->setRegistro($dado["CNPJ"]);	
// 			}
// 			else
// 			{
// 				echo "vazio";
// 			}

// 			///terminar de buscar uma marca e inserir o parceiro +marca em comercializ
	
// 		} 
// 			catch(PDOExecption $erro){
// 				echo $erro->getMessage();

// 				return $parceiro;
// 			}
// 	return $parceiro;
// }	

	function deleta($registro)
	{
		try{
				$conecta = Conexao::getInstance();

				$sql = "DELETE FROM parceiro WHERE CNPJ=':registro'";
				
				$stmt = $conecta->prepare($sql);
				$stmt->bindParam(':registro',$registro);
				$stmt->execute();
				return 1;
			} 
			catch(PDOExecption $erro){
				echo $erro->getMessage();

				return 0;
			}

	}


}

 ?>