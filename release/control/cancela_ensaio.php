<?php

    include_once("../dao/ensaio_dao.php");

    
     $ensaio_obj = new EnsaioDao();

     $query = $ensaio_obj->cancelaEnsaio( $_POST['ensaio'], $_POST['motivo'] ); 
     
?>