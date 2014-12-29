<br /><br /><br /><br /><br />
	<head>
		
		<link rel="stylesheet" type="text/css" href="../css/especie.css"  charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="../css/general.css" charset="utf-8" />
		<script type="text/javascript" src="../js/cadastro_especie.js"></script>
		<script type="text/javascript" src="../jquery-ui-1.10.4.custom/js/jquery-ui-1.10.4.custom.min.js?ver=<?php echo time() ?>"></script>
	</head>
	<div class="navigationBar">Registering &#62;&#62; <strong>Register of Species</strong></div>

	<div class="container">
		<form  class="form-horizontal has-success" id="dados_first" role="form"  method="post">
			<div class="col-sm-12 he"></div>
			<div class="panel panel-success">
				<div class="panel-heading">Species Data</div>
				<div class="panel-body">
					<div class="form-group fo1 col-md-8" id="dados_left">
						  <div class="form-group fo1">
						    <label for="name_specie" class="col-sm-3 control-label">Specie Name </label>
						    <div class="col-sm-7">
						      <input type="text" class="form-control"  name="nome_especie" id="name_sp" placeholder="Name new specie...">
						    </div>
						  </div>
						  <div class="form-group fo1">
						    <label for="name_specie" class="col-sm-3 control-label">Manager </label>
						    <div class="col-sm-6">
						      <input type="text" class="form-control"  name="nome_gerente" id='gerente'  placeholder="Name Manager...">
						    </div>
						  </div>
					</div><!--Fim da div dados_left -->
						<br /><br /><br /><br />
						  <div class="col-md-2"></div>
						  <button type="button" id="save_especie"  data-toggle='modal' data-target='.bs-modal-sm' class="btn btn-success btn-lg">
				  			<span class="fa fa-upload icon"></span> Submit Specie
						</button>
						<br /><br />
				  </div>
			</div>
		</form>

		<div class="panel panel-principsal">
			<div class="panel-heading">
				<h3>Table of the Parameters configured to the species</h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover table-striped" id="config_especie">
			        <thead>
			        <tr class="success">
			        	<th>Specie Name</th>
			        	<th>Parameter Name</th>
			        	<th>Value of Parameter</th>
			        </tr>
			        </thead>
			        <tbody id="resultado_busca" class="fixed-height">
			       		
			        </tbody>
			    </table>
			</div>
	</div>	
    <div id="saida"></div>		
</div>