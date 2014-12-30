<?php 

	/*

		Title: Controle para gerenciar a busca de gerente 
		data: 04/06/2014
		author: Jean Fabricio
		email:jeanufu21@gmail.com
	*/

		include_once("../dao/funcionario_dao.php");
		include_once("../dao/especie_dao.php");
		include_once("../model/especie_model.php");


		if($_GET['acao'] == "sem_botao")
		{
				$especie_dao = new EspecieDao();
				$funcionario_dao = new FuncionarioDAO();

				$stmt = $funcionario_dao->buscaFuncionario(null,null);
				

				$dados = $stmt->fetchall(PDO::FETCH_ASSOC);
				// pega todos o funcionarios
				foreach($dados as $funcionario){
					// se for um gerente ou administrador lista as especies para ele
					if($funcionario['TIPO'] == 2 || $funcionario['TIPO'] == 1)
					{
						
						//todas as especies do funcionario
						$stmt_especie = $especie_dao->buscaEspecie("ID_FUNCIONARIO",$funcionario['ID_FUNCIONARIO']);
						$especie_dado = $stmt_especie->fetchall(PDO::FETCH_ASSOC);
						if($_SESSION['tipoUser'] == 1){
						foreach($especie_dado as $especie){
							echo "<tr>
							     <th id=".$funcionario['ID_FUNCIONARIO'].">".$funcionario['NOME']."</th>
							     <th id=".$especie['COD_ESPECIE'].">".$especie['NOME']."</th>
							     <th><em class='fa fa-edit editar' data-toggle='modal' data-target='#edit'>&nbsp;&nbsp;</em></th>
				        		 </tr>";
		        			 }
		        			}
		        		else{
		        			foreach($especie_dado as $especie){
								echo "<tr>
							     <th id=".$funcionario['ID_FUNCIONARIO'].">".$funcionario['NOME']."</th>
							     <th id=".$especie['COD_ESPECIE'].">".$especie['NOME']."</th>
							     <th></th>
				        		 </tr>";
				        		}

		        		} 

					}
				
				}

			
		}
		if($_GET['acao'] == "botao")
		{
			$funcionario_dao = new FuncionarioDAO();

				$stmt = $funcionario_dao->buscaFuncionario_2("NOME",$_POST['gerente_busca']);
				$especie_dao = new EspecieDao();

				while($dados = $stmt -> fetch(PDO::FETCH_ASSOC))
				{
					if($dados['TIPO'] == 2)
					{

						$stmt_especie = $especie_dao->buscaEspecie("ID_FUNCIONARIO",$dados['ID_FUNCIONARIO']);
						$especie_dado = $stmt_especie->fetch(PDO::FETCH_ASSOC);

						echo "<tr>
					        	<th>".$dados['NOME']."</th>
					        	<th>".$especie_dado['NOME']."</th>
					        	<th><em class='fa fa-edit editar' data-toggle='modal' data-target='#edit'>&nbsp;&nbsp;</em></th>
		        				
		        			 </tr>";

					}
				}
				
				
		}

		if($_GET['acao'] == "editar")
		{
			$especie_dao = new EspecieDao();
			$especie_obj = new Especie();

			//$stmt = $especie_dao->buscaEspecie("ID_FUNCIONARIO",$_POST['codigo_gerente']);
			//$especie_busca = $stmt->fetch(PDO::FETCH_ASSOC);

			$especie_obj->setId($_POST['codigo_especie']);
			$especie_obj->setFuncionario($_POST['funcionario']);

			if($especie_dao->upDate($especie_obj))
				$valida = true;
			else
				$valida = false;

			if($valida)
				echo "1";
			else
				echo "0";



		}
		if($_GET['acao'] == "deletar")
		{
			$especie_dao = new EspecieDao();
			

			  if($especie_dao->delete($_POST['id']))
			{
				echo "1";
			}
			else 
				echo "0";


		}


 ?>