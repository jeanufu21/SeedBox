<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/marca.js"></script>
</head>
<div class="navigationBar">Registering &#62;&#62; <strong>Sign Brand</strong></div>
<div style="padding-top: 2%; width: 50%;" class="container">
	<div class="panel panel-success">
		<div class="panel-heading">New Brand</div>
		<div class="panel-body">
			<form role="form" class="has-success">
				<div class="form-group">
					<label for="nome" class="control-label">Brand Name </label>
					<input type="text" class="form-control" name='originalBrand' id="nome" placeholder="Name">
				</div>
				<div class="form-group">
					<label for="fantasia" class="control-label">Fantasy Name </label>
						<input type="text" class="form-control" id="fantasia" name="nomeFantasia" placeholder="Fantasy Name">
				</div>
				<div class="form-group">
					<label for="parceiros" class="control-label">Partner </label>
					<select class="form-control" name="parceiro">
						<option value=""></option>
						<?php 
								include_once("../dao/parceiro_dao.php");

								$parceiro_dao = new ParceiroDAO();

								$stmt = $parceiro_dao->buscaParceiro(null,null);
								while($dados_parceiro_1 = $stmt->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='".$dados_parceiro_1['COD_PARCEIRO']."'>".strtoupper($dados_parceiro_1['NOME'])."</option>";
								}
						 ?>
					</select>
				</div>
			</form>
			<button id="enviar"  class="btn btn-success center-block btn-lg">Submit ✔ </button>
		</div>
	</div>
	<div id="saida"></div>
</div>
