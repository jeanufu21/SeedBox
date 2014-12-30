<?php
    
    include_once("../dao/ensaio_dao.php");
    include_once("../dao/grupoavaliativo_set_parametros_especie_dao.php");
    include_once("../dao/controle_leitura_dao.php");
    include_once("../dao/amostra_produto_ensaio_dao.php");
    include_once("../dao/leituras_resumo_dao.php");

    $leituras_resumo_obj = new leituras_resumo_dao();
    
    header('Content-Type: application/json');    
     $ensaio_obj = new EnsaioDao();
     $grupoavaliativo_set_parametros_especie_obj = new grupoavaliativo_set_parametros_especie_dao();
     $controle_leitura_obj = new Controle_Leitura_DAO();
     $amostra_produto_ensaio_obj = new amostra_produto_ensaio_dao();
    

     $query = $ensaio_obj->buscaEnsaio('COD_ENSAIO', $_POST['ensaio']);
     
        
     $dados = $query->fetch(PDO::FETCH_ASSOC);
     $cod_campo =  $dados['COD_CAMPO'];
      
     $query2 = $grupoavaliativo_set_parametros_especie_obj->busca( $dados['COD_SET_VALORES']);

     $parametros = array();


    while($dados = $query2->fetch(PDO::FETCH_ASSOC))
    {

        $query3 = $controle_leitura_obj->busca( $dados['COD_PAR_AVALIACAO'], $_POST['ensaio']);
        $dados2 = $query3->fetch(PDO::FETCH_ASSOC);   
        
        $qtde_leituras = $dados2 == false ? 0 : $dados2['LEITURAS_FEITAS'];

        $array = array( 
          'COD_PAR_AVALIACAO' => $dados['COD_PAR_AVALIACAO'],
          'PARAMETRO_AVALIACAO' => $dados['PARAMETRO_AVALIACAO'],
          'QUANTITATIVO' => $dados['QUANTITATIVO'],
          'OBRIGATORIO' => $dados['OBRIGATORIO'],
          'MIN' => $dados['MIN'],
          'MAX' => $dados['MAX'],
          'NRO_AVALIACOES' => $dados['NRO_AVALIACOES'],
          'OBSERVACAO' =>  $dados['OBSERVACAO'],
          'LEITURAS_FEITAS' => $qtde_leituras
        );

        $parametros[] = $array;

    }
    


    
    $query4 = $amostra_produto_ensaio_obj->busca('COD_ENSAIO', $_POST['ensaio']);

    $amostras = array();

    while($dados = $query4->fetch(PDO::FETCH_ASSOC))
    {

        $array = array( 
          'COD_AMOSTRA' => $dados['COD_AMOSTRA'],
          'PRODUTO_NOME' => $dados['PRODUTO_NOME'],
          'PEDIGREE_ORIGINAL' => $dados['PEDIGREE_ORIGINAL'],
          'PEDIGREE_NACIONAL' => $dados['PEDIGREE_BRASIL'],
          'PELETIZADA' => $dados['PELETIZADA'],
          'OBSERVACAO' => $dados['OBSERVACAO'],
          'NRO_ESTACA' => $dados['NRO_ESTACA'],
          'QUANTIDADE_SEMENTES' =>  $dados['QUANTIDADE_SEMENTES']
        );

        $amostras[] = $array;

    }

    

    $query5 = $leituras_resumo_obj->busca('COD_ENSAIO', $_POST['ensaio']);

    $bool = true;

    while($dados = $query5->fetch(PDO::FETCH_ASSOC))
    {
       
        if( $dados['LEITURAS_FEITAS'] != $dados['NRO_AVALIACOES'] && $dados['OBRIGATORIO'] == 1  ) $bool = false;
    }

    $result = array();
    $result[] = $parametros;
    $result[] = $amostras;
    $result[] = $bool;
    $result[] = $cod_campo;

    echo json_encode($result);
    
  
  
?>