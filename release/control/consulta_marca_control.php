<?php 

/*

		Title: Controle da Tela de Busca e edição de Marcas
		date:01/06/2014
		Author:Jean Fabricio

*/




		include_once("../dao/marca_dao.php");
		include_once("../model/marca_model.php");


		$marca_dao = new MarcaDao();

		if($_GET['acao'] == "sem_botao")
		{

			
			

			$stmt = $marca_dao->busca_2(null,null);

			while($dados_gerais = $stmt->fetch(PDO::FETCH_ASSOC))
			{

				echo"<tr>";
		        	echo"<th id='".$dados_gerais['COD_MARCA']."'>".$dados_gerais['ORIGINAL_BRAND']."</th>";
		        	echo"<th>".$dados_gerais['NOME_FANTASIA']."
		        	<input type='hidden' class='form-control' id='codParceiro' value='".$dados_gerais['COD_PARCEIRO']."' />
		        	</th>";
		        	echo"<th><em class='fa fa-edit editar' data-toggle='modal' data-target='#edit'>&nbsp;&nbsp;</em></th>";
                    //<th><em class='fa fa-trash-o deletar'>&nbsp;&nbsp;</em></th>
		        echo"</tr>";
			}


		}
		if($_GET['acao'] == "botao")
		{

			$stmt = $marca_dao->busca_2("NOME_FANTASIA",$_POST['palavra_busca']);

			while($dados_gerais = $stmt->fetch(PDO::FETCH_ASSOC))
			{

				echo "<tr >
		        	<th id='".$dados_gerais['COD_MARCA']."'>".$dados_gerais['ORIGINAL_BRAND']."</th>
		        	<th>".$dados_gerais['NOME_FANTASIA']."
		        	<input type='hidden' class='form-control'  value='".$dados_gerais['COD_PARCEIRO']."' />
		        	</th>
		        	<th><em class='fa fa-edit editar' data-toggle='modal' data-target='#edit'>&nbsp;&nbsp;</em></th>
		        	<th><em class='fa fa-trash-o deletar'>&nbsp;&nbsp;</em></th>
		        	</tr>";
			}

		}

		if($_GET['acao'] == "deletar")
		{

			$codigo_marca = $_POST['codigo_deleta'];

			$stmt = $marca_dao->busca("COD_MARCA",2);

			$marca = $stmt->fetch(PDO::FETCH_ASSOC);

			if($marca["COD_PARCEIRO"] == null)
			{
				if($marca_dao->deleta($codigo_marca))
				{
						echo "1";
				}
				else echo "0";
			}
			else echo "2";	

			

			


		}

		if($_GET['acao'] == "editar")
		{

				
				$marca_model = new Marca();

				$marca_model->setOriginalBrand($_POST['nome_original']);
				$marca_model->setNomeFantasia($_POST['nome_fantasia']);
				if($_POST['parceiro'] == "")
				$marca_model->setParceiro(-1);
				else
				$marca_model->setParceiro($_POST['parceiro']);
				$marca_model->setCodigo($_POST['codigo']);


				if($stmt = $marca_dao->update($marca_model))
				{
					echo "1";
				}
				else
					echo "0";



		}



		echo "<script>

				$(document).ready(function(){

					$('.editar').on('click',function(){

						nome_original  = $(this).parents('tr').children('th:first').text();
						nome_fantasia =  $(this).parents('tr').children('th:eq(1)').text();
						var codParceiro = $(this).parents('tr').children('th:eq(1)').children('input[type=hidden]').val();

						var id = $(this).parents('tr').children('th:first').attr('id');

							$('#nome_original').val(nome_original);
							$('#nome_fantasia').val(nome_fantasia);
							$('#codigo').val(id);

							$('select option').filter(function() {
							    
							    return $(this).val() == codParceiro; 
							}).prop('selected', true);
						
					});

					
					
					$('.deletar').on('click',function(){
						var id = $(this).parents('tr').children('th:first').attr('id');

							$.ajax({

							type:'POST',
							url:'../control/consulta_marca_control.php?acao=deletar',
							data:{codigo_deleta:id},

						}).done(function(html){
							
							
							//$('#saida').append(html);

							if(parseInt(html,10) == 1)
							{
								novaMensagem('sucesso','The brand was removed!');
								$('#corp').load('../view/view_consulta_marca.php');
								return 0;
							}
							else if(parseInt(html,10) == 0)
							{
								novaMensagem('erro','Operation failed!');
								return 1;
							}
							else if(parseInt(html,10) == 2)
							{
								novaMensagem('erro','Remove the association of the brand with partner!');
								return 1;
							}



							
				        });
					});

					$('#update').on('click',function(){


							param = $('form').serializeArray();

							$.ajax({

							type:'POST',
							url:'../control/consulta_marca_control.php?acao=editar',
							data:param,

						}).done(function(html){
							
							
							//$('#saida').append(html);
							if(parseInt(html,10) == 1)
							{
								novaMensagem('sucesso','The brand was updated!');
								$('#corp').load('../view/view_consulta_marca.php');
								return 0;
							}
							else if(parseInt(html,10) == 0)
							{
								novaMensagem('erro','Operation failed!');
								return 1;
							}

						});
					});

				});

		</script>";
		


 ?>


