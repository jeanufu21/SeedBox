<?php
    
    /*
		*	Title: consulta_parceiro_control.php
		*	Author: Frederico
		*	Date: 17/07/2014
	*/
    
    include_once("../dao/consulta_parceiroDAO.php");
    include_once("../model/parceiro_model.php");
    

    if(isset($_GET['acao'])){

        $consultaParceiroDAO = new ConsultaParceiroDAO();

        switch($_GET['acao']){
        
            case 'getAllPartners':        

                //var_dump($dadosParceiros->fetch(PDO::FETCH_ASSOC));
                printPartnersData($consultaParceiroDAO->buscaInformacoesParceiros());
                break;
    
            case 'updatePartner':
                /*
                echo"<pre>";
                    var_dump($_POST);
                echo"</pre>";
                */
                try{
                    $parceiro = new Parceiro();
                    $parceiro->setCodigo($_POST['partnerCod']);
                    $parceiro->setNome($_POST['name']);
                    $parceiro->setCpf($_POST['cpf']);
                    $parceiro->setCnpj($_POST['cnpj']);
                    $parceiro->setPais($_POST['country']);
                    $parceiro->setUf($_POST['state']);
                    $parceiro->setMunicipio($_POST['city']);
                    $parceiro->setBairro($_POST['district']);
                    $parceiro->setEndereco($_POST['address']);
                    $parceiro->setComplemento($_POST['complement']);
                    $parceiro->setCep($_POST['cep']);
                    $parceiro->setEmail($_POST['email']);
                    $parceiro->setSite($_POST['site']);
                    $parceiro->setTelefone1($_POST['telephone1']);
                    $parceiro->setTelefone2($_POST['telephone2']);

                    echo $consultaParceiroDAO->atualizaParceiro($parceiro);
                }catch(Exception $e){
                    //echo $e;
                }
                break;
            case 'searchByTerm':
                /*echo"<pre>";
                    var_dump($_POST);
                echo"</pre>";*/
                    $partnersData = $consultaParceiroDAO->searchPartnerBy($_POST['searchOp'], $_POST['searchValue']);
                    if($partnersData->rowCount() == 0){
                        echo"0";
                    }else{
                        printPartnersData($partnersData);
                    }
                         
                break;
        }
    }

    function printPartnersData($partnersData){
        $limit = 0;
        while($partner = $partnersData->fetch(PDO::FETCH_ASSOC)){

            echo"<tr  data-partnercod='".$partner['COD_PARCEIRO']."'>";
            echo"<td>".strtoupper($partner['NOME'])."</td>";
		    echo"<td>".strtoupper($partner['CPF'])."</td>";
		    echo"<td>".strtoupper($partner['CNPJ'])."</td>";
		    echo"<td>".strtoupper($partner['PAIS'])."</td>";
		    echo"<td>".strtoupper($partner['UF'])."</td>";
		    echo"<td>".strtoupper($partner['MUNICIPIO'])."</td>";
		    echo"<td>".strtoupper($partner['BAIRRO'])."</td>";
		    echo"<td>".strtoupper($partner['ENDERECO'])."</td>";
		    echo"<td>".strtoupper($partner['COMPLEMENTO'])."</td>";
		    echo"<td>".strtoupper($partner['CEP'])."</td>";
            echo"<td>".strtoupper($partner['EMAIL'])."</td>";
            echo"<td>".strtoupper($partner['SITE'])."</td>";
            echo"<td>".$partner['TELEFONE1']."</td>";
            echo"<td>".$partner['TELEFONE2']."</td>";
            echo"<td><em class='fa fa-edit editar' data-target='#editPartner' data-toggle='modal'>&nbsp;&nbsp;</em></td>";
        echo"</tr>";
        $limit++;
        if($limit == 30)
            break;

        }
    }

?>