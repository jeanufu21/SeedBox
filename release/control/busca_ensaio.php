<?php

    include_once("../dao/ensaio_dao.php");
    include_once("../dao/set_dao.php");

    header('Content-Type: application/json');
    
     $ensaio_obj = new EnsaioDao();  
     $set_obj = new SetDAO();
     if( !isset( $_POST['campo'] ) )
     {
        //busca todos os ensaios
        $query = $ensaio_obj->buscaEnsaio(null,  null);
     }
     else
     {
        if( $_POST['campo'] == -1 )
        {
            $query = $ensaio_obj->buscaEnsaio(null,  null);
        }
        else
        {
            $query = $ensaio_obj->buscaEnsaio('COD_CAMPO',  $_POST['campo'] );
        }

     }
     

     $result = array();
    
    
    while($dados = $query->fetch(PDO::FETCH_ASSOC) )
    {
        if( $dados['STATUS'] == $_GET['estado'] )
        {
            $query2 = $set_obj->BuscaSetId( $dados['COD_SET_VALORES'] );
            $dados2 = $query2->fetch(PDO::FETCH_ASSOC);

            $array = array( 
                'COD_ENSAIO' => $dados["COD_ENSAIO"],
                'VALORES_SET' => $dados2["VALORES_SET"]
             );

            $result[] = $array;

        }
        
    }

    echo json_encode($result);
    
  
?>