<?php
			/*
				Title: Funções para a pagina de Consulta do historico
				Author:Washington Soares 
				Date:23/03/2014
		*/


	include_once("../dao/historico_dao.php");


	$historicoDao = new Historico();

		
		// $termo_busca = $_POST['termo_busca'];
		// $valor_buscado = $_POST['valor_busca'];

		//echo $termo_busca."<br>".$valor_buscado;


		$tipo=$_GET['tipo'];

   		if($tipo=='listagem'){
	   		$pag=$_GET['pag'];
	   		$maximo=$_GET['maximo'];
			$inicio = ($pag * $maximo) - $maximo; //Variável para LIMIT da sql
	
		

			$stmt = $historicoDao->consultaHistorico($inicio,$maximo);

			while($dado = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr>";
					echo "<td>";
						echo $dado['USUARIO'];
					echo "</td>";
					echo "<td>";
					 	echo $dado['TABELA'];
					echo "</td>";
					echo "<td>";
						echo $dado['OPERACAO'];
					echo "</td>";
					echo "<td>";
					 	echo $dado['DESCRICAO'];
					echo "</td>";
					echo "<td>";		 	
					 	echo $dado['DATA_HORA'];
					echo "</td>";
			    echo "</tr>";
			}
	    }
	    else if($tipo=='contador'){
	   		$stmt2 = $historicoDao->listaHistorico();
			$result = $stmt2->fetchAll();
			echo count($result);
   		}
   		 else if($tipo=='contadorTecla'){
	   		$stmt4 = $historicoDao->consultaHistoricoTecla($_GET['termo_busca'],$_GET['valor_busca'],0,5000000000000);
			$result = $stmt4->fetchAll();
			echo count($result);
			
   		}
   		else if($_REQUEST['tipo'] == 'tecla'){
	   		// echo $_GET['tipo'];
	   		// echo "<br>";
	   		// echo $_GET['termo_busca'];
	   		// echo "<br>";
	   		// echo $_GET['valor_busca'];
	   		// echo "<br>";
	   		// echo $_GET['maximo'];
	   		// echo "<br>";
	   		// echo $_GET['pag'];
	   		$pag=$_GET['pag'];
	   		$maximo=$_GET['maximo'];
			$inicio = ($pag * $maximo) - $maximo;

	   		$stmt3 = $historicoDao->consultaHistoricoTecla($_GET['termo_busca'],$_GET['valor_busca'],$inicio,$maximo);
	   		while($dado2 = $stmt3->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr>";
					echo "<td>";
						echo $dado2['USUARIO'];
					echo "</td>";
					echo "<td>";
					 	echo $dado2['TABELA'];
					echo "</td>";
					echo "<td>";
						echo $dado2['OPERACAO'];
					echo "</td>";
					echo "<td>";
					 	echo $dado2['DESCRICAO'];
					echo "</td>";
					echo "<td>";		 	
					 	echo $dado2['DATA_HORA'];
					echo "</td>";
			    echo "</tr>";
			}
   		}



?>