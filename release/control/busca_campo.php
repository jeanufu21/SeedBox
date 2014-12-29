<?php

    include_once("../dao/campo_dao.php");
    include_once("../dao/ensaio_dao.php");

    header('Content-Type: application/json');
    
     $campo_obj = new CampoDao();
     $ensaio_obj = new EnsaioDao();

     if( !isset( $_POST['ensaio'] ) )
     { 
        $query = $campo_obj->buscaCampo(null, null);
     }
     else
     {
        $query2 = $ensaio_obj->buscaEnsaio( 'COD_ENSAIO', $_POST['ensaio']);
        $dados2 = $query2->fetch(PDO::FETCH_ASSOC);

        $query = $campo_obj->buscaCampo('COD_CAMPO', $dados2['COD_CAMPO']);     
     }
     
     $result = array();
     
    while($dados = $query->fetch(PDO::FETCH_ASSOC))
    {
        $array = array(
            'NOME' => utf8_encode($dados["NOME"]), 
            'COD_CAMPO' => $dados["COD_CAMPO"], 
            'CIDADE' => utf8_encode($dados["CIDADE"]),
            'UF' => $dados["UF"]

        );

        $result[] = $array;

    }

    echo json_encode($result);
    
  
?>