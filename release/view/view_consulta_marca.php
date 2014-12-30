<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/consulta_marca.js"></script>
    <style>
    	
    	.editar:hover, .deletar:hover
    	{
    		cursor: pointer;
    		color:#71720b;
    	}
    </style>
</head>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Brand</strong></div>
<div class="container">
<div class='panel panel-success'>
	  <div class='panel-heading'>Search for Brand</div>
	  <div class='panel-body'>
	  	<form  class="form-horizontal has-success"  onSubmit="return false;"  role="form" >
				<div class="col-md-8 has-success">
				 	<div class="form-group">
				    	<label for="pesquisa" class="col-md-2 control-label s20"> KeyWord </label>
				    	<div class="col-md-9">
						    <div class="input-group">
						      <input type="text" class="form-control" id="pesquisa" name="palavra_busca">
						      <span class="input-group-btn">
								<button class="btn btn-success" style="top:-7px;" type="button" id='ver_marcas'><em class="fa fa-search"></em></button>
						      </span>
						    </div>
						  </div>
					</div>
			</div>
		</form>

		<div class='main-table col-md-7' id='caixa_tabela'>
			<br />
			<table class='table table-hover table-striped fo1' id='tabela_marcas' >
		        <thead>
		        <tr class='success'>
		        	<th>Original Name</th>
		        	<th>Fantasy Name</th>
		        	<th>&nbsp;</th>
		        	<!-- <th>&nbsp;</th> -->
		        </tr>
		        </thead>
		        <tbody id='marcas_body' >
		       		
		        </tbody>
		        
		    </table>
		
		</div>

		<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
      	<form  class="form-horizontal has-success"  onSubmit="return false;"  role="form" >
      		
        	<div class="form-group">

        		<label for="pesquisa" class="col-md-3 control-label s20"> Original Name  </label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="nome_original" name="nome_original" >
				<input type="hidden" class="form-control" id="codigo" name="codigo" >
			</div>
				<label for="pesquisa" class="col-md-3 control-label s20"> Fantasy Name </label>
			<div class="col-sm-3">
				<input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia" >

			</div>

			</div>
			<div class="form-group">

        		<label for="pesquisa" class="col-md-3 control-label s20"> Partners  </label>
			<div class="col-sm-3">
				<select name="parceiro" id="parceiro" class="form-control">
					<option value = ""></option>
						<?php 
							// script que seleciona todos as especies do banco e mostra elas na view
								include_once("../dao/parceiro_dao.php");

									$parceiro_dao = new ParceiroDAO();
									$query = $parceiro_dao->buscaParceiro(null,null);

								while($dados = $query->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='".$dados["COD_PARCEIRO"]."'>".$dados["NOME"]."</option>";
								}
						?>						
						
					</select>
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