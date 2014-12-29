<?php
    
    /*
		*	Title: consulta_campo_control.php
		*	Author: Frederico
		*	Date: 17/07/2014
	*/
    
    include_once("../dao/consulta_campoDAO.php");
    include_once("../model/parceiro_model.php");
    

    if(isset($_GET['acao'])){

        $consultaCampoDAO= new ConsultaCampoDAO();

        switch($_GET['acao']){
        
            case 'getAllCamps':        

                //var_dump($dadosParceiros->fetch(PDO::FETCH_ASSOC));
                printCampsData($consultaCampoDAO->buscaInformacoesCampos());
                script();
                break;

            case 'updateCountryside':
                /*
                echo"<pre>";
                    var_dump($_POST);
                echo"</pre>";
                */
                
                try{

                    $campo = new Campo();
                    $campo->setCod_Campo($_POST['countrysideCod']);
                    $campo->setNome($_POST['name']);
                    $campo->setUf($_POST['state']);
                    $campo->setCidade($_POST['city']);
                    $campo->setAltitude($_POST['altitude']);
                    $campo->setLatitude($_POST['latitude']);
                    $campo->setLongitude($_POST['longitude']);

                    echo $consultaCampoDAO->atualizaCampo($campo);
                }catch(Exception $e){
                    //echo $e;
                }
                break;
            
            case 'searchByTerm':
                /*echo"<pre>";
                    var_dump($_POST);
                echo"</pre>";
                */
                    $campsData = $consultaCampoDAO->searchCountrysidesBy($_POST['searchOp'], $_POST['searchValue']);
                    if($campsData->rowCount() == 0){
                        echo"0";
                    }else{
                        printCampsData($campsData);
                    }
                         
                break;
        }
    }

    function printCampsData($CampsData){
        while($camp = $CampsData->fetch(PDO::FETCH_ASSOC)){
            echo"<tr class='bold' data-countrysidecod='".$camp['COD_CAMPO']."'>";
            echo"<td>".$camp['NOME']."</td>";
		    echo"<td>".$camp['CIDADE']."</td>";
            echo"<td>".$camp['UF']."</td>";
            echo"<td>".$camp['ALTITUDE']."</td>";
            //echo"<td>".$partner['FAX']."</td>";
            echo"<td>".$camp['LATITUDE']."</td>";
            echo"<td>".$camp['LONGITUDE']."</td>";
            echo"<td><em class='fa fa-edit editar' data-target='#editCountryside' data-toggle='modal'>&nbsp;&nbsp;</em></td>";
        echo"</tr>";
        }
    }

    function script(){
        echo"<script type='text/javascript'>";
            echo"$(document).ready(function(){

                $('.editar').on('click', function(){

                    $('#countrysideData').validationEngine();
                    $('.coordinate').mask('+099.00000', {translation:  {'+': {pattern: /[-+]/, optional: true}}});

                    var linha = $(this).parent().parent().find('td');
                    var modalCamps = [
                            'name',
                            'city',
                            'state',
                            'altitude',
                            'latitude',
                            'longitude'];

                    for(i=0; i<modalCamps.length; i++){
                        if(linha.eq(i).text().length > 1){
                            $('#'+modalCamps[i]).val(linha.eq(i).text());   
                        }else{
                            $('#'+modalCamps[i]).val('');
                        }
                    }

                    $('#countrysideCod').val($(this).parent().parent().data('countrysidecod'));
                });
            })";
        echo"</script>";
    }
?>