<?php
    
    include_once("../dao/leitura_amostra_dao.php");

    $leitura_amostra_obj = new Leitura_Amostra_DAO();
    
    header('Content-Type: application/json');    
    
    $result = array();

    for ($i=0; $i < count($_POST['amostras']); $i++) {
     

      $query = $leitura_amostra_obj->busca($_POST['amostras'][ $i ], $_POST['cod_parametro'], $_POST['obrigatorio'] );
       $array_amostra = array();
      while($dados = $query->fetch(PDO::FETCH_ASSOC))
      {
          $complete_path = $dados['NOME_FOTO'] != "" ? $_POST['ensaio'] . '/' . $dados['COD_AMOSTRA'] . '/' . $_POST['cod_parametro'] . '/' . $dados['NOME_FOTO'] : "";
          $array = array( 
            'DATA_LEITURA' => $dados['DATA_LEITURA'],
            'LEITURA_VALOR' => $dados['LEITURA_VALOR'],
            'COMENTARIO' => $dados['COMENTARIO'],
            'PATH' =>  $complete_path
          );

          $array_amostra[] = $array;

      }

      $result[] = $array_amostra;
      
    }
    
    echo json_encode($result);
  
?>