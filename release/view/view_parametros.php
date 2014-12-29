<br /><br /><br /><br /><br />
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../css/cadastro_parametro.css" media="screen" />
		<script type="text/javascript" src="../js/view_parametros.js"></script>
	</head>
	<div class="navigationBar">Registering &#62;&#62; <strong>Register Parameters of Species</strong></div>
	<div>

		<div class="col-md-10" id="content">
			<div class="panel panel-default">
			  <div class="panel-heading"><h1>Register Parameters of Species</h1></div>
			  <div class="panel-body">
			    
			    <form  class="form-horizontal has-success"  role="form" method="post">
					<div class="form-horizontal col-sm-12">
								<label class="control-label col-sm-1" for="name">Species </label>
								<div class="col-sm-3" >
									<select name="especie" id="nome_especie" class="form-control">
										<?php 
										// script que seleciona todos as especies do banco e mostra elas na view
									
											include_once("../dao/especie_dao.php");

												$especie_obj = new EspecieDao();
												$query = $especie_obj->buscaEspecie();

												while($dado = $query->fetch(PDO::FETCH_ASSOC))
												{
													echo "<option value='".$dado["COD_ESPECIE"]."'>".$dado["NOME"]."</option>";
												}
										?>		  

									</select>
								</div>
								<label class="control-label col-sm-1" for="name">Name </label>
								  <div class="form-group col-md-3">
								    <input type="text" class="form-control" name="nome" id="nome" placeholder="Parameter name">
								  </div>
								  <div class="col-md-2"></div>
								  <div class="col-md-2">
									<button type="button" id="add_valor" disabled class="btn btn-success btn-mini add_valor">
							  			<span class="fa fa-plus icon"></span> Add Values
									</button>
									<div class="col-md-2"><br /><br /></div />
								</div>

						</div><!-- fim do form-horizontal 12  -->
						<div class="col-md-12" id="valores"></div>
						<div class="col-md-5	"></div>   
				  			<div class="col-md-3">
				  				<br /><br />
									<button type="button" id="salvar" data-toggle='modal' data-target='.bs-modal-sm'  disabled class="btn btn-success btn-lg">
							  			<span class="fa fa-upload icon"></span> Register
									</button>
									<br /><br />
								</div>
			</form>	
			    <br /> 
			  </div>
			</div>
		</div>
		<div id="saida"></div>		

	</div>


