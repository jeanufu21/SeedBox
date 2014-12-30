<?php
    
    /*
		*	Title: consulta_parceiroDAO.php
		*	Author: Frederico
		*	Date: 17/07/2014
	*/

    include_once("conexao.php");
    include_once("historico_dao.php");
    include_once("../model/parceiro_model.php");

    class ConsultaParceiroDAO{
        
        function buscaInformacoesParceiros(){
            
            $pdo = Conexao::getInstance();

            try{
                $sql = "SELECT * FROM parceiro ORDER BY nome ASC";

                $querry = $pdo->prepare($sql);
                $querry->execute();
                
                return $querry;
            }catch(Exception $e){
                return $e;
            }
        }
        
        function atualizaParceiro($partner){
            $pdo = Conexao::getInstance();

            try{
                $sql = "UPDATE parceiro SET NOME=:nome, CNPJ=:cnpj, EMAIL=:email, SITE=:site, ENDERECO=:endereco, COMPLEMENTO=:complemento, ";
                $sql .= "BAIRRO=:bairro, MUNICIPIO=:municipio, UF=:uf, CEP=:cep, PAIS=:pais, TELEFONE1=:telefone1, TELEFONE2=:telefone2, CPF=:cpf ";
                $sql .= "WHERE COD_PARCEIRO=:cod_parceiro";

                $querry = $pdo->prepare($sql);
                $querry->bindParam(':nome', $partner->getNome(), PDO::PARAM_STR);
                $querry->bindParam(':cnpj', $partner->getCnpj(), PDO::PARAM_STR);
                $querry->bindParam(':email', $partner->getEmail(), PDO::PARAM_STR);
                $querry->bindParam(':site', $partner->getSite(), PDO::PARAM_STR);
                $querry->bindParam(':endereco', $partner->getEndereco(), PDO::PARAM_STR);
                $querry->bindParam(':complemento', $partner->getComplemento(), PDO::PARAM_INT);
                $querry->bindParam(':bairro', $partner->getBairro(), PDO::PARAM_STR);
                $querry->bindParam(':municipio', $partner->getMunicipio(), PDO::PARAM_STR);
                $querry->bindParam(':uf', $partner->getUf(), PDO::PARAM_STR);
                $querry->bindParam(':cep', $partner->getCep(), PDO::PARAM_STR);
                $querry->bindParam(':pais', $partner->getPais(), PDO::PARAM_STR);
                $querry->bindParam(':telefone1', $partner->getTelefone1(), PDO::PARAM_INT);
                $querry->bindParam(':telefone2', $partner->getTelefone2(), PDO::PARAM_INT);
                $querry->bindParam(':cpf', $partner->getCpf(), PDO::PARAM_INT);
                $querry->bindParam(':cod_parceiro', $partner->getCodigo(), PDO::PARAM_INT);
                $querry->execute();

                return 0;
            }catch(Exception $e){
                //return $e;
            }
        }

        function searchPartnerBy($searchMethod, $value){
            $value = "%".$value."%";

            if($searchMethod == "name"){
                $sql = "SELECT * FROM parceiro WHERE NOME LIKE :value ORDER BY nome ASC";    
            }else if($searchMethod == "cpf"){
                $sql = "SELECT * FROM parceiro WHERE CPF LIKE :value ORDER BY nome ASC";
            }else if($searchMethod == "cnpj"){
                $sql = "SELECT * FROM parceiro WHERE CNPJ LIKE :value ORDER BY nome ASC";
            }else if($searchMethod == "city"){
                $sql = "SELECT * FROM parceiro WHERE MUNICIPIO LIKE :value ORDER BY nome ASC";
            }else if($searchMethod == "state"){
                $sql = "SELECT * FROM parceiro WHERE UF LIKE :value ORDER BY nome ASC";
            }

            try{
                $pdo = Conexao::getInstance();
                $querry = $pdo->prepare($sql);
                $querry->bindParam(":value", $value, PDO::PARAM_STR);
                $querry->execute();

                return $querry;
            }catch(Exception $e){
                echo $e;
            }
        }    
    }
?>
