<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/consulta_gerente.js"></script>
    <style>
    	
    	.editar:hover, .deletar:hover
    	{
    		cursor: pointer;
    		color:#71720b;
    	}
    </style>
</head>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Manager</strong></div>
<div class="container">
<div class='panel panel-success'>
	  <div class='panel-heading'>View Manager</div>
	  <div class='panel-body'>
	  	<form  class="form-horizontal has-success"  onSubmit="return false;"  role="form" >
				<div class="col-md-8 has-success">
				 	<div class="form-group">
				    	<label for="pesquisa" class="col-md-2 control-label s20"> KeyWord </label>
				    	<div class="col-md-9">
						    <div class="input-group">
						      <input type="text" class="form-control" id="pesquisa" name="gerente_busca" placeholder='Place the name of the manager'>
						      <span class="input-group-btn">
								<button class="btn btn-success" type="button" style="top:-7px;" id='ver_gerente'><em class="fa fa-search"></em></button>
						      </span>
						    </div>
						  </div>
					</div>
				
			</div>
		</form>

		<div class='main-table col-md-7' id='caixa_tabela'>
			<br />
			<table class='table table-hover table-striped fo1' id='tabela_gerente' >
		        <thead>
		        <tr class='success'>
		        	<th>Manager Name</th>
		        	<th>Species</th>
		        	<th></th>
		        	
		        </tr>
		        </thead>
		        <tbody id='gerente_body' >
		       		
		        </tbody>
		        
		    </table>
		
		</div>

		<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Manager</h4>
      </div>
      <div class="modal-body">
      	<form  class="form-horizontal has-success"  onSubmit="return false;"  role="form" >
      		
        	<div class="form-group">

        		<label for="pesquisa" class="col-md-3 control-label s20" >Name Manager  </label>
			<div class="col-sm-9">
				<select name="funcionario" id="funcionario" class="form-control">
					<?php 
						// script que seleciona todos as especies do banco e mostra elas na view
						include_once("../dao/funcionario_dao.php");

							$funcionario_dao = new FuncionarioDao();
							$query = $funcionario_dao->getGerenteforAutoComplete();

							while($funcionario = $query->fetch(PDO::FETCH_ASSOC))
							{
								echo "<option value='".strtoupper($funcionario["ID_FUNCIONARIO"])."'>".$funcionario["NOME"]."</option>";
							}
						?>		
				</select>
				<!--label for="pesquisa" class="col-md-6 control-label " id="nome_label"></label>
				<input type="hidden" class="form-control" id="codigo_gerente" name="codigo_gerente" -->
			</div>
			<br><br><br>

				<label for="pesquisa" class="col-md-3 control-label s20"> Specie</label>
				<div class="col-sm-2"></div>
			<div class="col-sm-4" >

				<label for="pesquisa" class="col-md-6 control-label " id="especie_label"></label>
				<input type="hidden" class="form-control" id="codigo_especie" name="codigo_especie" >
				<!--select name="especie" id="especie_busca" class="form-control">

						<?php /*
							// script que seleciona todos as especies do banco e mostra elas na view
								include_once("../dao/especie_dao.php");

									$especie_obj = new EspecieDao();
									$query = $especie_obj->buscaEspecie(null,null);

								while($dados = $query->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='".$dados["COD_ESPECIE"]."'>".$dados["NOME"]."</option>";
								}*/
						?>						
						
					</select-->
			</div>

			</div>
						
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="update" data-dismiss="modal">Save</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		<br /><br /><br />
		
	</div>
</div>

<div id="saida"></div>
</div>