<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/jasny-bootstrap.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../css/general.css" type="text/css" media="screen" />
</head>
<div class="navigationBar">Registering &#62;&#62; <strong>Partners</strong></div>
<div style="padding-top: 2%;" class="container">
	<div class="panel panel-success">
		<div class="panel-heading">New Partner</div>
		<div class="panel-body">
			<form id="cadastro" role="form">
				<div class="row form-group has-success">
					<label for="nome" class="col-sm-1 control-label">*Name </label>
					<div class="col-sm-5">
							<input type="text" name="nome" class="form-control" id="nome" placeholder="Name">
					</div>
					<label for="cpf" class="col-sm-1 control-label">CPF </label>
					<div class="col-sm-2">
						<input type="text" name="cpf" class="form-control" id="cpf" placeholder="CPF" data-mask="999.999.999-99">
					</div>
					<label for="cnpj" class="col-sm-1 control-label">CNPJ </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="CNPJ" data-mask="99.999.999/9999-99">
					</div>
				</div>
				<div class="row form-group has-success">
					<!-- <label for="ccir" class="col-sm-1 control-label">CCIR</label>
					<div class="col-sm-2">
							<input type="text" class="form-control" id="ccir" name="ccir" placeholder="CCIR" data-mask="9999999999">
					</div> -->
					<label for="Country" class="col-sm-1 control-label">Country </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="country" name="country" placeholder="Country">
					</div>
					<label for="state" class="col-sm-1 control-label">State </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="state" name="state" placeholder="State">
					</div>
					<label for="city" class="col-sm-1 control-label">City </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="city" name="city" placeholder="City">
					</div>
				</div>
				<div class="row form-group has-success">
					<label for="bairro" class="col-sm-1 control-label">District </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="bairro" name="bairro" placeholder="District">
					</div>
					<label for="address" class="col-sm-1 control-label">Address </label>
					<div class="col-sm-5">
							<input type="text" class="form-control" id="address" name="address" placeholder="Address">
					</div>
					<label for="complemento" class="col-sm-1 control-label">Complement </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="complement" name="complemento" placeholder="Complement">
					</div>
				</div>
				<div class="row form-group has-success">
					<label for="cep" class="col-sm-1 control-label">CEP </label>
					<div class="col-sm-2">
						<input type="text" class="form-control" id="cep"  name="cep" placeholder="CEP" >
					</div>
					<label for="email" class="col-sm-1 control-label">E-mail </label>
					<div class="col-sm-3">
							<input type="text" class="form-control" id="email"  name="email" placeholder="E-mail">
					</div>
					<label for="site" class="col-sm-1 control-label">Site </label>
					<div class="col-sm-4">
							<input type="text" class="form-control" id="site"  name="site" placeholder="Site">
					</div>
				</div>
				<div class="row form-group has-success">
					<!--<label for="fax" class="col-sm-1 control-label">Fax </label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="fax"  name="fax" placeholder="Fax">
					</div>-->
					<label for="tel1" class="col-sm-1 control-label">Telephone1</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="tel1"  name="tel1" maxlength="30" placeholder="First phone number">
					</div>
					<label for="tel2" class="col-sm-1 control-label">Telephone2</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="tel2" name="tel2" maxlength="30" placeholder="Second phone number">
					</div>
				</div>
				<div class="form-group has-success">
					<textarea class="form-control" rows="3" name="observations" placeholder="Observations" id="obs"></textarea>
				</div>
				<a id="save_parceiro" class="btn btn-success center-block btn-lg" data-toggle='modal' data-target='.bs-modal-sm' style="width: 150px;">Submit ✔ </a>
			</form>
		</div>
	</div>
	<div id="saida"></div>
	<script type="text/javascript" src="../js/parceiro.js"></script>
</div>
