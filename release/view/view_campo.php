<!--
    *	Title: view_campo.php
	*	Author: Frederico
	*	Date: 17/07/2014
-->

<br /><br /><br /><br /><br />
<head>
	
	<link rel="stylesheet" type="text/css" href="../css/general.css" />

    <script type="text/javascript" src="../js/campoFuncs.js"></script>
    <script type="text/javascript" src="../js/numeric.js"></script>
    <script type="text/javascript" src="../js/validate.js"></script>
    
</head>
<div class="navigationBar">Registering &#62;&#62; <strong>Sign countryside</strong></div>
<div style="padding-top: 2%; width: 50%;" class="container">
	<div class="panel panel-success">
		<div class="panel-heading">New countryside</div>
		<div class="panel-body">
			<form role="form" name="new_countryside" id="new_countryside">
				<div class="form-group has-success">
					<label for="nome" class="control-label"> * Name of countryside</label>
					<input type="text" class=" form-control required" name='nome_campo' id="nome_campo" placeholder="Name of Countryside">
				</div>
				<div class="form-group has-success">
					<label for="fantasia" class="control-label">* City </label>
						<input type="text" class=" form-control required" id="city" name="city" placeholder="City">
				</div>
				<div class="form-group has-success">
					<label for="fantasia" class="control-label">* UF </label>
					<input type="text" class=" form-control required" id="uf" name="uf" placeholder="UF" maxlength="2">
				</div>
				<div class="form-group has-success">
					<label for="fantasia" class="control-label">Altitude</label>
					<input type="text" class="coordinate validate[custom[number]] form-control " id="altitude" name="altitude" placeholder="Altitude">
				</div>
				<div class="form-group has-success">
					<label for="fantasia" class="control-label">Latitude </label>
					<input type="text" class="coordinate validate[custom[number]] form-control " id="latitude" name="latitude" placeholder="Latitude">
				</div>
				<div class="form-group has-success">
					<label for="fantasia" class="control-label">Longitude </label>
					<input type="text" class="coordinate validate[custom[number]] form-control " id="longitude" name="longitude" placeholder="Longitude">
				</div>
			</form>
			<button id="vai"  class="btn btn-success center-block btn-lg">Submit ✔ </button>
		</div>
	</div>
	<!--<div id="saida"></div>-->
</div>
