<?php

    include_once("../dao/ensaio_dao.php");

  	 $ensaio_obj = new EnsaioDao();

     $query = $ensaio_obj->setDataSemeio( $_POST['ensaio'], $_POST['data_semeio'] ); 
	     
  
?>