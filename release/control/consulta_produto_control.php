	<?php 


	/*
	Title:Controle de Consulta de Produto
	Author:Jean Fabrício
	Date:  01/03/2014
	*/
	
	include_once("../dao/produto_dao.php");
	include_once("../model/produto_model.php");
	include_once("../dao/marca_dao.php");
	include_once("../dao/especie_dao.php");
	include_once("../dao/fase_dao.php");
	include_once("../dao/set_dao.php");

	$produtoDao = new ProdutoDao();
	$marcaDao = new MarcaDao();
	$especie_dao = new EspecieDao();
	$fase_dao = new FaseDAO();
	$set_dao = new SetDAO();


	if(isset($_GET['buscarTudo']))
	{


		$stmt = $produtoDao->buscaProduto(null,null);
		$limit = 0;
		while($dado = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo "<tr>";
			// utilizo do id que está na string do set para buscar a especie
			$stmtSet = $set_dao->BuscaSetId($dado['COD_SET_VALORES']);
			$SetDado = $stmtSet->fetch(PDO::FETCH_ASSOC);
			$id_especie = explode("#",$SetDado['VALORES_SET']);
			// busco a especie via o id
			  $stmtEp = $especie_dao->buscaEspecie("COD_ESPECIE",$id_especie[0]);
			  $especieDados = $stmtEp->fetch(PDO::FETCH_ASSOC);

			          	echo "<td>".strtoupper($especieDados['NOME'])."</td>";

			          	$arraySet = explode("#",$SetDado['VALORES_SET']);
			          	
			          	echo "<td>
								<div class='dropdown'>
								  <a data-toggle='dropdown' href='#'> View Set </a>
								  <ul class='dropdown-menu fundo-lista' role='menu' aria-labelledby='dLabel'>";
								  	$size = count($arraySet);// quantidade de valores de parametros no set
									 for($j=1;$j<$size-1;$j++)
									 {
									 	if($j == $size-2)
									 		echo   "<li class='linhas'><span>".strtoupper($arraySet[$j])."</span></li>";
									 	else
									 	{
									 		echo   "<li class='linhas'><span>".strtoupper($arraySet[$j])."</span></li>
									 		<li  class='divider'></li>";
									 	}
									 }
									
									  
								 echo " </ul>
								</div>

			          		  </td>";

			          	echo "<td id='".$dado['COD_PRODUTO']."''>".strtoupper($dado['NOME'])."</td>";
			// busca o nome da marca
			    $query = $marcaDao->busca("COD_MARCA",$dado['COD_MARCA']); 
			    $marca = $query->fetch(PDO::FETCH_ASSOC);

			          	echo "<td>".strtoupper($marca['ORIGINAL_BRAND'])."</td>";
			          	echo "<td>".strtoupper($marca['NOME_FANTASIA'])."</td>";
			          	echo "<td>".strtoupper($dado['PEDIGREE_ORIGINAL'])."</td>";
			          	echo "<td>".strtoupper($dado['PEDIGREE_BRASIL'])."</td>";
				$stmtFs = $fase_dao->buscaFase($dado['COD_FASE']);
			          $FaseDado = $stmtFs->fetch(PDO::FETCH_ASSOC);

			          	echo "<td>".strtoupper($FaseDado['NOME'])."</td>";
						echo "<td>".strtoupper($dado['RESISTENCIA'])."</td>";

						if($dado['PELETIZADA'] == 1)
			          	echo "<td>PELLETED</td>";
			            else if($dado['PELETIZADA'] == 0)
			            echo "<td>NAKED</td>";

			        	if($dado['ORGANICA'] == 1)
			          	echo "<td>ORGANIC</td>";
			          	else if($dado['ORGANICA'] == 0)
			          	echo "<td>CONVENTIONAL</td>";
			          	echo "<td><em class='fa fa-edit editar' style='cursor:pointer;' data-toggle='modal' data-target='#edit_produto' >&nbsp;&nbsp;</em></td>";
		        		
		        		echo "<td hidden>".$dado['PELETIZADA']."</td>";
		        		echo "<td hidden>".$dado['ORGANICA']."</td>";

		          	echo "</tr>";

		          	$limit++;
		          	if($limit == 100)
		          		break;
		}
			
}


if(isset($_GET['modal_search']))
{
	$codigo = $_GET["codigo"];

	$stmt = $produtoDao->buscaProduto("COD_PRODUTO",$codigo);

	$dado = $stmt->fetch(PDO::FETCH_ASSOC);

	$produto_array = array();

		$produto_array["COD_PRODUTO"] = $dado['COD_PRODUTO'];
		$produto_array['NOME'] = $dado['NOME'];
		$produto_array['COD_MARCA'] = $dado['COD_MARCA'];
		$produto_array['COD_FASE'] = $dado['COD_FASE'];
		$produto_array['PEDIGREE_BRASIL'] = $dado['PEDIGREE_BRASIL'];
		$produto_array['RESISTENCIA'] = $dado['RESISTENCIA'];
		$produto_array['PELETIZADA'] = $dado['PELETIZADA'];
		$produto_array['ORGANICA'] = $dado['ORGANICA'];

	$json = json_encode($produto_array);
	echo $json;
}

if(isset($_GET['update']))
{
		

		$produto_obj = new Produto();
		$produto_dao = new ProdutoDao();


		$produto_obj->setCodProduto($_POST['codigo']);
		$produto_obj->setNome($_POST['nome_produto']);
		$produto_obj->setCodMarca($_POST['marca']);
		$produto_obj->setCodFase($_POST['fases']);
		$produto_obj->setPdgNacional($_POST['pbrasil']);
		$produto_obj->setResistencia($_POST['resistencia']);
		$produto_obj->setPeletizado($_POST['peletizado']);
		$produto_obj->setOrganico($_POST['organico']);

		if($produto_dao->update($produto_obj))
		{
			echo "1";
		}
		else
			echo "0";

		

}


// verifica se a busca está sendo filtrada por um termo especifico
	if(isset($_GET['buscaTermo']))
	{

	
		$termo_busca = $_POST['termo_busca'];
		$valor_buscado = $_POST['valor_busca'];
		// testa se o termo buscado é por especie;

		if($termo_busca == "COD_SET_VALORES")
		{
			/*
				Se o usuario não digitar nada e o filtro estiver
				em especie, a busca retorna todos os produtos de 
				todas especies
			*/
			if($valor_buscado == null)
				$stmt = $produtoDao->buscaProduto(null,null);
			
			//caso contrario busca de acordo com a especie especificada
			else
			{
				// busca a especie por nome
				$stmtEs = $especie_dao->buscaEspecieNome($valor_buscado);
				$dadoEsp = $stmtEs->fetch(PDO::FETCH_ASSOC);
				
				// valida se existe alguma especie com o nome digitado
				if($stmtEs->rowCount() == 0)
					return 0;
				$id = $dadoEsp['COD_ESPECIE'];
				// comparar o id da especie com o id no set

				$stmtSet2 = $set_dao->BuscaSetId(null);
				$valor_buscado = [];

				while($SetDado2 = $stmtSet2->fetch(PDO::FETCH_ASSOC))
				{
					$stringset = explode("#",$SetDado2['VALORES_SET']);
					if($stringset[0] == $id)
					{
						/*
						 guarda em um array todos os codigos dos sets da 
						 especie buscada para retorna-los
						*/
						$valor_buscado[] = $SetDado2['COD_SET_VALORES'];

					}
				}

				if(count($valor_buscado) == 0)
					return 0;
				else
					$stmt = $produtoDao->buscaProdutos_porSets($valor_buscado);
			}
			
		}
		else 
		{
				// caso a busca seja feita por outro filtro, sem ser especie
			// a busca é realizada normalmente dentro da função do produto_dao
			$stmt = $produtoDao->buscaProduto($termo_busca,$valor_buscado);

		}
		$limit = 0;
		while($dado = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo "<tr>";
			// utilizo do id que está na string do set para buscar a especie
			$stmtSet = $set_dao->BuscaSetId($dado['COD_SET_VALORES']);
			$SetDado = $stmtSet->fetch(PDO::FETCH_ASSOC);
			$id_especie = explode("#",$SetDado['VALORES_SET']);
			// busco a especie via o id
			  $stmtEp = $especie_dao->buscaEspecie("COD_ESPECIE",$id_especie[0]);
			  $especieDados = $stmtEp->fetch(PDO::FETCH_ASSOC);

			          	echo "<td>".strtoupper($especieDados['NOME'])."</td>";

			          	$arraySet = explode("#",$SetDado['VALORES_SET']);
			          	
			          	echo "<td>
								<div class='dropdown'>
								  <a data-toggle='dropdown' href='#'> View Set </a>
								  <ul class='dropdown-menu fundo-lista' role='menu' aria-labelledby='dLabel'>";
								  	$size = count($arraySet);// quantidade de valores de parametros no set
									 for($j=1;$j<$size-1;$j++)
									 {
									 	if($j == $size-2)
									 		echo   "<li class='linhas'><span>".strtoupper($arraySet[$j])."</span></li>";
									 	else
									 	{
									 		echo   "<li class='linhas'><span>".strtoupper($arraySet[$j])."</span></li>
									 		<li  class='divider'></li>";
									 	}
									 }
									
									  
								 echo " </ul>
								</div>

			          		  </td>";

			          	echo "<td id='".$dado['COD_PRODUTO']."''>".strtoupper($dado['NOME'])."</td>";
			// busca o nome da marca
			    $query = $marcaDao->busca("COD_MARCA",$dado['COD_MARCA']); 
			    $marca = $query->fetch(PDO::FETCH_ASSOC);

			          	echo "<td>".strtoupper($marca['ORIGINAL_BRAND'])."</td>";
			          	echo "<td>".strtoupper($marca['NOME_FANTASIA'])."</td>";
			          	echo "<td>".strtoupper($dado['PEDIGREE_ORIGINAL'])."</td>";
			          	echo "<td>".strtoupper($dado['PEDIGREE_BRASIL'])."</td>";
				$stmtFs = $fase_dao->buscaFase($dado['COD_FASE']);
			          $FaseDado = $stmtFs->fetch(PDO::FETCH_ASSOC);

			          	echo "<td>".strtoupper($FaseDado['NOME'])."</td>";
						echo "<td>".strtoupper($dado['RESISTENCIA'])."</td>";

						if($dado['PELETIZADA'] == 1)
			          	echo "<td>PELLETED</td>";
			            else if($dado['PELETIZADA'] == 0)
			            echo "<td>NAKED</td>";

			        	if($dado['ORGANICA'] == 1)
			          	echo "<td>ORGANIC</td>";
			          	else if($dado['ORGANICA'] == 0)
			          	echo "<td>CONVENTIONAL</td>";
			           echo "<td><em class='fa fa-edit editar' style='cursor:pointer;' data-toggle='modal' data-target='#edit_produto' >&nbsp;&nbsp;</em></td>";
		          	echo "</tr>";
		          	$limit++;
		          	if($limit == 100)
		          		break;
		}
	}


	


	?>