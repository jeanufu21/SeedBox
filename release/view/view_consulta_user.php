<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/consulta_usuario.js"></script>
    <style>
    	
    	.editar:hover, .deletar:hover
    	{
    		cursor: pointer;
    		color:#71720b;
    	}
    </style>
</head>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Users</strong></div>
<div class="container">
<div class='panel panel-success'>
	  <div class='panel-heading'>View Users</div>
	  <div class='panel-body'>
	  	<form  class="form-horizontal has-success"  onSubmit="return false;"  role="form" >
				<div class="col-md-8 has-success">
				 	<div class="form-group">
				    	<label for="busca_nome" class="col-md-2 control-label s20"> Name </label>
				    	<div class="col-md-9">
						    <div class="input-group">
						      <input type="text" class="form-control" id="busca_nome" name="busca_nome">
						      <span class="input-group-btn">
								<button class="btn btn-success" type="button" style="top:-7px;"s id='ver_usuarios'><em class="fa fa-search"></em></button>
						      </span>
						    </div>
						  </div>
					</div>
				
			</div>
		</form>

		<div class='main-table col-md-11' id='caixa_tabela'>
			<br />
			<table class='table table-hover table-striped fo1' id='tabela_usuario' >
		        <thead>
		        <tr class='success'>
		        	<th>Name</th>
		        	<th>Type</th>
		        	<th>Login</th>
		        	<th>Password</th>
		        	<th>Mail</th>
		        	<th>Phone</th>
		        	<th>UF</th>
		        	<th>City</th>
		        	<th></th>
		        	<th></th>
		        	
		        </tr>
		        </thead>
		        <tbody id='usuario_body' >
		       		
		        </tbody>
		        
		    </table>
		
		</div>
</div>
		<div class="modal fade" id="edit"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit User</h4>
      </div>
      <div class="modal-body">
      	<form  class="form-horizontal has-success"  onSubmit="return false;" id="caixa_modal"  role="form" >
      		
      		<div class="form-group">

        		<label for="nome" class="col-md-3 control-label s16">Name:</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="nome" name="nome" >
				<input type="hidden" class="form-control" id="codigo_usuario" name="codigo_usuario" >
			</div>
			</div>

			<div class="form-group">
				<label for="tipo" class="col-md-3 control-label s16">Type:</label>
					<div class="col-sm-4">
						<select name="tipo_gerente" id="tipo_gerente" class="form-control">
							<option value="2">Manager</option>
							<option value="3">Valuer</option>
						</select>
					</div>
			</div>

			<div class="form-group">
				<label for="login" class="col-md-3 control-label s16">Login:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="login" name="login" >
					</div>
			</div>
			<div class="form-group">
				<label for="senha" class="col-md-3 control-label s16">Password:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="senha" name="senha" >
					</div>
			</div>

			<div class="form-group">
				<label for="email" class="col-md-3 control-label s16">Mail:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="email" name="email" >
					</div>
			</div>

			<div class="form-group">
				<label for="tel" class="col-md-3 control-label s16">Phone:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="tel" name="tel" >
					</div>
			</div>

			<div class="form-group">
				<label for="uf" class="col-md-3 control-label s16">UF:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="uf" name="uf" >
					</div>
			</div>

			<div class="form-group">
				<label for="cidade" class="col-md-3 control-label s16">City:</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="cidade" name="cidade" >
					</div>
			</div>


        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" id="atualizar" data-dismiss="modal">Save</button>
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