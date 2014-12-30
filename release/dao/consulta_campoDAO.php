<?php
    
    /*
		*	Title: consulta_campoDAO.php
		*	Author: Frederico
		*	Date: 17/07/2014
	*/

    include_once("conexao.php");
    include_once("historico_dao.php");
    include_once("../model/campo_model.php");

    class ConsultaCampoDAO{
        
        function buscaInformacoesCampos(){
            
            $pdo = Conexao::getInstance();

            try{
                $sql = "SELECT * FROM campo";

                $querry = $pdo->prepare($sql);
                $querry->execute();
                
                return $querry;
            }catch(Exception $e){
                return $e;
            }
        }
        
        function atualizaCampo($campo){
            $pdo = Conexao::getInstance();

            try{
                $sql = "UPDATE campo SET NOME=:nome, CIDADE=:cidade, UF=:uf, ALTITUDE=:altitude, LATITUDE=:latitude, LONGITUDE=:longitude ";
                $sql .= "WHERE COD_CAMPO=:cod_campo";
                
                $querry = $pdo->prepare($sql);
                $querry->bindParam(':nome', $campo->getNome(), PDO::PARAM_STR);
                $querry->bindParam(':cidade', $campo->getCidade(), PDO::PARAM_STR);
                $querry->bindParam(':uf', $campo->getUf(), PDO::PARAM_STR);
                $querry->bindParam(':altitude', $campo->getAltitude(), PDO::PARAM_STR);
                $querry->bindParam(':latitude', $campo->getLatitude(), PDO::PARAM_STR);
                $querry->bindParam(':longitude', $campo->getLongitude(), PDO::PARAM_INT);
                $querry->bindParam(':cod_campo', $campo->getCod_campo(), PDO::PARAM_INT);
                $querry->execute();

                return 0;
            }catch(Exception $e){
                return $e;
            }
        }
        
        function searchCountrysidesBy($searchMethod, $value){
            
            $value = "%".$value."%";

            if($searchMethod == "name"){
                $sql = "SELECT * FROM campo WHERE NOME LIKE :value";    
            }else if($searchMethod == "city"){
                $sql = "SELECT * FROM campo WHERE CIDADE LIKE :value";
            }else if($searchMethod == "state"){
                $sql = "SELECT * FROM campo WHERE UF LIKE :value";
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
