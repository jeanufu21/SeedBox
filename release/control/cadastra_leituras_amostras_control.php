<?php // You need to add server side validation and better error handling here

$data = array();

if(isset($_GET['files']))
{	
	$error = false;
	$files = array();

	$uploaddir = '../uploads/';
	foreach($_FILES as $file)
	{
		if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
		{
			$files[] = $file['name'];
		}
		else
		{
		    $error = true;
		}
	}
	$data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
}
else
{
	include_once('../dao/leitura_amostra_dao.php');
	include_once('../model/leitura_amostra_model.php');
	include_once('../dao/controle_leitura_dao.php');
	include_once('../model/controle_leitura_model.php');

	 $leitura_amostra_dao = new Leitura_Amostra_DAO();
	 $controle_leitura_dao = new Controle_Leitura_DAO();
	 

	for ($i=0; $i < count( $_POST['amostras'] ); $i++) { 
		for ($j=0; $j < count( $_POST['parametros'] ); $j++) {

			
			$path = '../uploads/' . $_POST[ 'ensaio' ] . '/' . $_POST[ 'amostras' ][ $i ] . '/' . $_POST[ 'parametros' ][ $j ]['cod_parametro']; 
			
			if( !is_dir($path ) )
			{
				if( mkdir( $path, 0777, true ) )
				{
					
				}
			}
			
			$ext = pathinfo($_POST['valores'][ $i ][ $j ]['file'], PATHINFO_EXTENSION);

			$file_name = $_POST['valores'][ $i ][ $j ]['file'] != "" ? $_POST[ 'ensaio' ] . '_' .  $_POST[ 'amostras' ][ $i ] . '_' . $_POST[ 'parametros' ][ $j ] . '_' . date('Y-m-d-H-i-s') . '.' . $ext : "" ; 
			$old = '../uploads/' . $_POST['valores'][ $i ][ $j ]['file'];
			$new = $path . '/' . $file_name;
			
			if( $_POST['valores'][ $i ][ $j ]['file'] != "" )
			{
				if( rename( $old, $new ) )
				{

				}
			}
			

			$leitura_amostra_obj = new leitura_amostra();	
			$leitura_amostra_obj->setCod_amostra( $_POST[ 'amostras' ][ $i ] );
			$leitura_amostra_obj->setCod_par_avaliacao( $_POST[ 'parametros' ][ $j ]['cod_parametro'] );
			$leitura_amostra_obj->setObrigatorio( $_POST[ 'parametros' ][ $j ]['obrigatorio'] );
			$leitura_amostra_obj->setData_leitura( date('Y-m-d-H-i-s') );
			$leitura_amostra_obj->setLeitura(  $_POST['valores'][ $i ][ $j ]['value'] );
			$leitura_amostra_obj->setNome_foto(  $file_name );
			$leitura_amostra_obj->setComentario( $_POST['valores'][ $i ][ $j ]['comment'] );

			$leitura_amostra_dao->insereLeitura_Amostra( $leitura_amostra_obj );
			
		}
	}
	
	
	foreach ($_POST[ 'parametros' ] as $value) {
		$controle_leitura_obj = new controle_leitura();
		$controle_leitura_obj->setCod_par_avaliacao( $value['cod_parametro'] );
		$controle_leitura_obj->setObrigatorio( $value['obrigatorio'] );
		$controle_leitura_obj->setCod_ensaio( $_POST[ 'ensaio' ] );
		$controle_leitura_dao->insereControleLeitura( $controle_leitura_obj );

	}


	$data = array('success' => 'Form was submitted');
}

echo json_encode($data);

?>