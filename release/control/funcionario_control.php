<?php
	

/*
		Title:controller do funcionario
		Author:Washington
		Date:  25/03/2014
*/


	include_once("../model/funcionario_model.php");
	include_once("../dao/funcionario_dao.php");


	if ($_REQUEST['acao'] == 'cadastrar'){

		$funcionario = new Funcionario();
		$funcionario->setCodigo(null);
		$funcionario->setNomeFuncionario($_POST['nome_funcionario']);
		$funcionario->setLoginFuncionario($_POST['login_funcionario']);
		$funcionarioDao = new FuncionarioDAO();
		$result = $funcionarioDao->buscaFuncionario("LOGIN",$_POST['login_funcionario']);
		if($result->rowCount())
		{
			echo "3";
			return 0;
		}

		$senha = base64_encode($_POST['senha_funcionario']);
		$funcionario->setSenha($senha);
		$funcionario->setLevel($_POST['privilegio_usuario']);
		$funcionario->setEmail($_POST['email']);
		$funcionario->setTelefone($_POST['telefone']);
		$funcionario->setCidade($_POST['cidade']);
		$funcionario->setUf($_POST['uf']);

		if($funcionarioDao->insereFuncionario($funcionario)){
			echo "1";
		}
		else{
			echo "2";
		}
	

	//Parte para cadastrar na segunda tabela
   }else if($_REQUEST['acao'] == 'buscar'){
echo "<script type='text/javascript' src='../js/update_profile.js'></script>";
echo "<div class='container'>";
		echo "<div class='panel panel-success'>";
			echo "<div class='panel-heading'>Profile</div>";
			echo "<div class='panel-body'>";
				echo "<div class='col-md-2'>";
					echo "<img src='../img/_user.png' class='img-responsive img-thumbnail' alt=' style='width: 140px; height: 180px;'/>";
				echo "</div>";
				echo "<div class='col-md-10'></div>";
				echo "<div class='com-md-12' id='dataUser' >";

						$funcionario_dao = new FuncionarioDAO();

						$stmt = $funcionario_dao->buscaFuncionario('ID_FUNCIONARIO',$_SESSION['codigoUser']);

						$dadosUser = $stmt->fetch(PDO::FETCH_ASSOC);
						if($dadosUser['TIPO']==1){
							$nivel = "ADMINISTRADOR";
						}else if($dadosUser['TIPO']==2){
							$nivel = "GERENTE";
						}else{
							$nivel = "AVALIADOR";
						}
						echo '<h1>Name: <i>'.$dadosUser['NOME'].'</i></h1>
								<h2>Login: '.$dadosUser['LOGIN'].'</h2>
								 <h3>Level: '.$nivel.'</h3>
								';
					 echo "<button class='btn btn-success ' data-toggle='modal' data-target='#myModal'>Edit</button>";
				
			   echo "</div>";
		    echo "</div>";
			
	  echo "</div>";
   echo "</div>";

	echo "<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>";
	 echo " <div class='modal-dialog'>";
	   echo " <div class='modal-content'>";
	      echo "<div class='modal-header'>";
	       echo " <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>";
	        echo "<h4 class='modal-title' id='myModalLabel'>Edit Profile</h4>";
	     echo " </div>";
	     echo " <div class='modal-body'>";
	       echo " <form role='form'>";
			 echo " <div class='form-group has-success'>";
			   echo " <label for='name'>Name </label>";
			   echo "<input type='text' class='form-control' id='newnome' value='".$dadosUser['NOME']."' placeholder='Name'>";
			 echo " </div>";
			 echo " <div class='form-group has-success'>";
			    echo "<label for='name'>Login </label>";
			   echo " <input type='text' class='form-control' id='newlogin' value='".$dadosUser['LOGIN']."' placehoder='Login'>";
			  echo "</div>";

			 echo " <div class='form-group has-success'>";
			   echo " <label for='pw'>Password </label>";
			   
			   echo " <input type='password' class='form-control' id='newpsw'  placeholder='Password'>";
			 echo " </div>";
			 echo " <div class='form-group has-success'>";
			    echo "<label for='newemail'>Email </label>";
			   echo " <input type='text' class='form-control' id='newemail' value='".$dadosUser['EMAIL']."' placeholder='Email'>";
			  echo "</div>";
			  echo " <div class='form-group has-success'>";
			    echo "<label for='newtelefone'>Telephone </label>";
			   echo " <input type='text' class='form-control' id='newtelefone' data-mask='(99)9999-9999' value='".$dadosUser['TELEFONE']."' placeholder='Phone...'>";
			  echo "</div>";
			  echo " <div class='form-group has-success'>";
			    echo "<label for='newuf'>UF </label>";
			   echo " <input type='text' class='form-control' maxlength='2' id='newuf' value='".$dadosUser['UF']."' placeholder='UF'>";
			  echo "</div>";
			  echo " <div class='form-group has-success'>";
			    echo "<label for='newcidade'>City </label>";
			   echo " <input type='text' class='form-control' id='newcidade' value='".$dadosUser['CIDADE']."' placeholder='City'>";
			  echo "</div>";
			echo "</form>";
	     echo " </div>";
	     echo " <div class='modal-footer'>";
	       echo " <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
	       echo " <button type='button' class='btn btn-success' id='salvafuncionario'>Save changes</button>";
	      echo "</div>";
	    echo "</div>";
	 echo " </div>";
	echo "</div>";
	
   }
  if ($_REQUEST['acao'] == 'update'){


  		$funcionario_dao = new FuncionarioDAO();

		$stmt = $funcionario_dao->buscaFuncionario_dif_id('LOGIN', $_POST['newlogin'], $_SESSION['codigoUser']);
		if($dadosUser = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo "3";
			return 0;
		}

	   		$funcionario = new Funcionario();
	   		
			$funcionario->setNomeFuncionario($_POST['newnome']);
			$funcionario->setLoginFuncionario($_POST['newlogin']);

			$senha_2 = base64_encode($_POST['newpsw']);
			$funcionario->setSenha($senha_2);
			$funcionario->setEmail($_POST['newemail']);
			$funcionario->setTelefone($_POST['newtelefone']);
			$funcionario->setUf($_POST['newuf']);
			$funcionario->setCidade($_POST['newcidade']);

			$funcionarioDao = new FuncionarioDAO();
			if($funcionarioDao->updateProfile($_POST['newnome'],$_POST['newlogin'],$senha_2,$_POST['newemail'],$_POST['newtelefone'],$_POST['newuf'],$_POST['newcidade'])){
				echo "1";
			}
			else{
				echo "2";
			}
		


  }
?>