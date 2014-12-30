<?php
    
	/*
		*	Title: grupo_avaliativo_control.php
		*	Authors: Frederico, Gustavo
		*	Date: 27/03/2014
	*/

	include_once("../model/grupo_avaliativo_model.php");
	include_once("../dao/grupo_avaliativoDAO.php");

	// Busca os parâmetros de avaliação vinculados a uma espécie
	function selectAvaliationParam($valor_busca){

		$grupoAvalDAO = new GrupoAvaliativoDAO();
		$buscarParam = $grupoAvalDAO->buscaParAval($valor_busca);

        // Verifica se existem parâmetros de avaliação cadastrados no banco
        if($buscarParam->rowCount() != 0){
            $nParam = 0;
		    while($linha = $buscarParam->fetch(PDO::FETCH_ASSOC)){
			    echo'<tr>';
                	echo'<th>Name: </th>';

                	// A variavel $nParam fornece um numero para o id do elemento
			    	echo'<td id="nome'.$nParam.'"><input id="cod'.$nParam.'" type="hidden" class="hidden" value="'.$linha['COD_PAR_AVALIACAO'].'" />'.$linha['NOME'].'</td>';
			    	//echo'<th>Quantitativo: </th>';
			    if($linha['QUANTITATIVO'] == 1){
                    echo'<th id="quant'.$nParam.'" data-quant="1">Quantitative </th>';
			    	//echo'<td id="quant'.$nParam.'">Sim</td>';
			    }
				    
			    else{
                    echo'<th id="quant'.$nParam.'" data-quant="0">Qualitative</th>';
			    	//echo'<td id="quant'.$nParam.'">Não</td>';
			    }
                	echo'<td><input type="button" class="btn btn-success btn-xs pull-right addAttAva" onclick="addRow1(this.td, '.$nParam.',\''.$linha['COD_PAR_AVALIACAO'].'\');" value="Add"></td>';
                echo'</tr>';
		        $nParam++;
            }    
		}
        else{
            echo'<tr>';
            echo'<th>No parameter was found!</th>';
            echo'</tr>';
        }
    }

    // Busca todas as espécies cadastradas no banco de dados
	function selectSpecies(){
		// include_once("dao/grupo_avaliativoDAO.php");
		$grupoAvaliativoDAO = new GrupoAvaliativoDAO();
		$buscarParam = $grupoAvaliativoDAO->buscaEspecie();

        // Busca todas as espécies que estão cadastradas no banco
		if($buscarParam->rowCount() != 0){
			while($linha = $buscarParam->fetch(PDO::FETCH_ASSOC)){
		    echo'<option class="species" value="'.$linha['COD_ESPECIE'].'">'.$linha['NOME'].'</option>';
	    	}	
		} 
	}

	// Busca todas as fases de avaliação cadastradas no banco de dados
	function selectPhases(){

		$grupoAvaliativoDAO = new GrupoAvaliativoDAO();
		$buscarParam = $grupoAvaliativoDAO->buscaFase();

		// Busca todas as fases cadastradas no banco
	    while($linha = $buscarParam->fetch(PDO::FETCH_ASSOC)){
			echo'<option class="phases" value="'.$linha['COD_FASE'].'">'.$linha['NOME'].'</option>';			
	    }    
	}

	/*---------------------------------------AJAX---------------------------------------*/

	// Abaixo estão as funções chamadas via ajax

 	// Metodo isset verifica se algo existe, neste caso uma variável enviada pelo metodo $_GET
 	if(isset($_GET['acao'])){
 		$acao = $_GET['acao'];

 		$grupoAvaliativoDAO = new GrupoAvaliativoDAO();

 		switch($acao){
 			
 			/* Este primeiro case busca os parâmetros de uma espécie, que serão utilizados na composição do set */
 			case 'selectParEsp':{

 				// Recupera informações dos atributos de uma espécie de acordo com o código de uma espécie
 				$query = $grupoAvaliativoDAO->consultaParAva($_POST['valor_busca']);
 				
 				/* Recupera o código do funcionario, implementar depois! */
 				//session_start();
 				//echo $_SESSION['codigoUser'];
			    
	            $i = 0;

				while($_bd = $query->fetch(PDO::FETCH_ASSOC))
				{       
                    echo'<div class="pull-left parametersOfSpecie">';
					    echo'<h4 class="nomeAtt">'.$_bd['NOME_PAR_ESPECIE'].':</h4>';
				    echo'</div>';
              
				    /* Recupera os valores possíveis para um parâmetro avaliativo 
				    - eles serão usados para compor o set - */
                    $query2 = $grupoAvaliativoDAO->consultaValParAva($_bd["COD_PAR_ESPECIE"]);					
		
				    echo'<div class="pull-left parametersOfSpecie">';
					    echo'<select class="form-control">';

                        // Recupera os valores possíveis para um parâmetro de espécie
                        while($_bd2 = $query2->fetch(PDO::FETCH_ASSOC)){
						    echo'<option class="valorAtt'.$i.'" value="'.$_bd2["COD_PAR_ESPECIE"].'">'.$_bd2["VALOR"].'</option>';
                        }
                        echo'</select>';
				    echo'</div>';
                    $i++;
				}
				if($i == 0){
					echo'<script>novaMensagem("erro","Parameters of species not recorded!<br />Please record them!");</script>';
				}
				echo'<script>$("#qtValores").val('.$i.');</script>';
	 			break;
	 		}

	 		/* Este case recupera os parâmetros de avaliação de uma determinada espécie */
		 	case 'selectAvaParam':{
    			selectAvaliationParam($_POST['valor_busca']);
    			break;
		 	}

		 	/* Este case recupera os grupos avaliativos já cadastrados no banco de Dados */
		 	case 'selectTrialG':{

		 		/* Este case busca todos os parâmetros de avaliação ja cadastrados 
		 		para um grupo avaliativo */
				$set = $_POST['set'];

		        // Recupera o codSet e atribui a variável $cod_set
	            $cod_set = $grupoAvaliativoDAO->recuperaCodSet($set);
	            
	            // Recupera parâmetros de avaliação para um grupo avaliativo
	            $query2 = $grupoAvaliativoDAO->recuperaInfTrialG($cod_set);

	            // Preenche o campo hidden que guarda o código do set
                echo'<script type="text/javascript">$("#codSet").val('.$cod_set.');</script>';
                $i = 0;
            
                if($query2->rowCount() == 0){
                    echo'<h4>None parameter was registered!</h4>';
                }
                else{
                	echo'<table class="recoveredAtributes" class="table table-condensed table-hover has-success">';
                        echo'<caption id="oldAttsCap"><h4>Attributes already registered: </h4></caption>';

	                while($linha2 = $query2->fetch(PDO::FETCH_ASSOC)){
	                    
	                    /* Recupera informações de parâmetros de avaliação já cadastrados 
	                    para o grupo avaliativo dado o código do parâmetro */

	                	$query3 = $grupoAvaliativoDAO->recuperaParAvaliacao($linha2['COD_PAR_AVALIACAO']);
	                    $linha3 = $query3->fetch(PDO::FETCH_ASSOC);
                        
                        //$param = echo'<script>$(".attTrialG"'.$linha3['COD_PAR_AVALIACAO'].').length</script>';

                        echo'<tr class="line'.$i.' attTrialG'.$linha3["COD_PAR_AVALIACAO"].'">';
                            echo'<th><input name="codPar[]" type="hidden" class="hide" value="'.$linha3['COD_PAR_AVALIACAO'].'" /><h4>'.$linha3["NOME"].'</h4></th>';
                            if($linha2["OBRIGATORIO"] == 1){
                                echo'<td class="reqAtt'.$i.'">';
                                    echo'<input type="checkbox" class="req" value="1" onclick="alteraCheckbox($(this), '.$linha3['COD_PAR_AVALIACAO'].');" checked="checked" ><label>&nbsp;Required</label>';
                                    echo'<input id="required'.$i.'" type="hidden" class="hidden hidReq" name="required[]" value="1" />';
                                echo'</td>';
                            }
                            else{
                                //echo'<td><input type="checkbox" class="req" value="0" onclick="if($(this).val() == 1) $(this).val(0); else $(this).val(1); $(\'#required'.$i.'\').val($(this).val());"><label>&nbsp;Required</label>';
                                echo'<td class="reqAtt'.$i.'">';
                                    echo'<input type="checkbox" class="req" value="0" onclick="alteraCheckbox($(this), '.$linha3['COD_PAR_AVALIACAO'].');"><label>&nbsp;Required</label>';   
                                    echo'<input id="required'.$i.'" type="hidden" class="hidden hidReq" name="required[]" value="0"   />';
                                echo'</td>';
                            }
                            if($linha3["QUANTITATIVO"] == 1){
                                echo'<td class="form-group has-success form-inline">';
                                    echo'<table>';
                                        echo'<tr>';
                                            echo'<th><label>Min:&nbsp;</label></th>';
                                            echo'<td><input name="min[]" type="text" class="form-control input-sm min" value="'.$linha2["MIN"].'" onkeyup="justNumbers(\'min\');" /></td>';
                                        echo'</tr>';
                                        echo'<tr>';
                                            echo'<th><label>Max:&nbsp;</label></th>';
                                            echo'<td><input name="max[]" type="text" class="form-control input-sm max" value="'.$linha2["MAX"].'" onkeyup="justNumbers(\'max\');" /></td>';
                                        echo'</tr>';
                                    echo'</table>';
                                echo'</td>';
                            }
                            else{
                            	echo'<td>&nbsp;&nbsp;</td>';
                                echo'<td class="form-group has-success form-inline hidden">';
                                    echo'<table>';
                                        echo'<tr>';
                                            echo'<th><label>Min:&nbsp;</label></th>';
                                            echo'<td><input name="min[]" type="text" class="form-control input-sm" value="1" /></td>';
                                        echo'</tr>';
                                        echo'<tr>';
                                            echo'<th><label>Max:&nbsp;</label></th>';
                                            echo'<td><input name="max[]" type="text" class="form-control input-sm" value="5" /></td>';
                                        echo'</tr>';
                                    echo'</table>';
                                echo'</td>';
                            }

	                            echo'<td class="form-group has-success form-inline">';
	                                echo'<input type="button" value="Remove" class="btn btn-danger btn-sm pull-right" onclick="$(\'.line'.$i.'\').remove(); $(\'#qtIns\').val($(\'#qtIns\').val()-1); if($(\'.recoveredAtributes\').find(\'tr\').length == 0) $(\'.recoveredAtributes\').find(\'caption\').remove()" />';
	                            echo'</td>';
	                        echo'</tr>';
	                        echo'<tr class="line'.$i.'" style="border-bottom:1px solid black;">';
	                            echo'<th>Coments: </th>';
	                            echo'<td colspan="2"><textarea name="coments[]" class="form-control">'.$linha2["OBSERVACAO"].'</textarea></td>'; 
	                            echo'<td><label>N&deg; of usage:</label><input type="text" name="n_ava[]" class="form-control input-sm nava" value="'.$linha2['NRO_AVALIACOES'].'" onkeyup="justNumbers(\'nava\');" /></td>';
	                        echo'</tr>'; 

	                        $i++; 
	                }
            	/* Atualiza o valor do campo hidden que controla quantas inserções 
	            seram realizadas */
            
	            echo'<script type="text/javascript">$("#insert").find("#qtIns").val('.$i.');</script>';
	            echo'</table>';
	            }
	 			break;
		 	}

		 	/* Este case deleta todos os grupos avaliativos existentes no banco de dados */
		 	case 'deleteTrialG':{
			 	try{
			 		$cod_set = $grupoAvaliativoDAO->recuperaCodSet($_POST['set']);
		            $grupoAvaliativoDAO->deleteTrialG($cod_set);
	            }catch(Exception $e){
	            	//echo $e;
	            }
		 		break;
		 	}

		 	/* Este case insere grupos avalitivos no banco de dados */
		 	case 'insertTrialG':{
			    echo'<script type="text/javascript" src="../js/trialgroups.js"></script>';
			    /*
			    echo'<pre>';
			    	print_r($_POST);
			    echo'</pre>';		    
			    */
			    
			    $qtIns = $_POST['qtIns'];
			    try{
			    	for($i=0; $i<$qtIns; $i++){
			    		
			    		$grupoAvaliativo[$i] = new GrupoAvaliativo();

				    	$grupoAvaliativo[$i]->setCodSet($_POST['codSet']);
				    	$grupoAvaliativo[$i]->setCodParametroAvaliacao($_POST['codPar'][$i]);
				    	$grupoAvaliativo[$i]->setCodEspecie($_POST['codEspecie']);
				    	$grupoAvaliativo[$i]->setObrigatorio($_POST['required'][$i]);
				    	$grupoAvaliativo[$i]->setMin($_POST['min'][$i]);
				    	$grupoAvaliativo[$i]->setMax($_POST['max'][$i]);
				    	$grupoAvaliativo[$i]->setNroAvaliacoes($_POST['n_ava'][$i]);
				    	$grupoAvaliativo[$i]->setComentario($_POST['coments'][$i]);
			 			
			    	}
			    	if($qtIns == 0){
			    		echo'Changes successfully saved!';
			    	}
			    	else{
			    		$insert = $grupoAvaliativoDAO->insertTrialG($grupoAvaliativo, $qtIns);
			    		if(!$insert){
			    			echo'Trial Group successfully saved!';
			    		}
			    	}
			    }catch(Exception $e){
			    	//echo'Error to sabe objects'.$e;
			    }
	 			break;
	 		}

	 		/* Este case realiza a inserção de um novo parâmetro de avaliação */
	 		case 'insertAvaliationParam':{

	 			
			    $nome_parametroAvaliacao = strip_tags(trim($_POST['nome_parametroAvaliacao']));
			    $tipo_parametroAvaliacao = strip_tags(trim($_POST['tipo_parametroAvaliacao']));
		        $cod_especie = strip_tags(trim($_POST['specieCOD']));

		        if($grupoAvaliativoDAO->insertAvalParam($nome_parametroAvaliacao, $tipo_parametroAvaliacao, $cod_especie)==1){
		        	echo'1';
		        }else{
		            echo'0';
		        }
		        /*else
		        	//echo'Error to save data '.$insert_errorParam->getMessage;*/
	 			break;
	 		}
	 		
	 		/* Funcionabilidade removida
	 		case 'cadastraSet':{
	 			$retorno = $grupoAvaliativoDAO->insertSet($_POST['set']);
	 			if($retorno == 0){
	 				//echo'Set successfully inserted';
	 			}
	 			break;
	 		}

	 		*/

	 		/* Verifica se um set foi cadastrado no banco */
	 		case 'verificaSet':{
	 			$cod_set = $grupoAvaliativoDAO->recuperaCodSet($_POST['set']);
	 			echo $cod_set;
	 			break;
	 		}
	 	}	 	
 	}
	
?>