<br /><br /><br /><br /><br />
<head>
    <link rel="stylesheet" type="text/css" href="../css/produtocss.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/produtoquery.js"></script>
</head>
<div class="navigationBar">Registering &#62;&#62;<strong>&nbsp;Sign Product</strong></div>
<div class="container" id="content">
	<div class="col-md-12"></div>
	<h1>Sign Product</h1>
	<form class="form-horizontal has-success" role="form">
	<div class="col-sm-12 he"></div>
	<div class="panel panel-success">
		<div class="panel-heading">Set Data</div>
		<div class="panel-body">
			<div class="form-group col-sm-12" id="set">
				<label class="control-label col-sm-1">Specie Search </label>
				<div class="col-sm-3" >
					<select name="especie" id="especie_busca" class="form-control" style='text-transform:uppercase;'>

						<?php 
							// script que seleciona todos as especies do banco e mostra elas na view
								include_once("../dao/especie_dao.php");

									$especie_obj = new EspecieDao();
									$query = $especie_obj->buscaEspecie(null);

								while($dados = $query->fetch(PDO::FETCH_ASSOC))
								{
									echo "<option value='".$dados["COD_ESPECIE"]."'>".$dados["NOME"]."</option>";
								}
						?>						
						
					</select>			
				</div>
			</div>
			<div class="col-md-12"  id="outros_param">
			<!--
					Nesta area da pagina é o lugar em que será contruido as tags dos parametros
					cadastrados para especies dinamicamente. Esses parametros são os variaveis.
			-->
			</div>
		</div>
	</div>
<br /><br />
<div class="panel panel-success">
	<div class="panel-heading">Product Data</div>
	<div class="panel-body">
	<div class="form-group col-sm-12" >
		<label for="name" class="col-sm-1 control-label"> *Name </label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="name" style="text-transform:uppercase;" id="name"  placeholder="Product name...">
		</div>
		<label for="obrand" class="col-sm-1 control-label">*Original Brand </label>
		<div class='col-sm-3'>
				<select name='obrand' id='obrand' class='form-control'>
					<option></option>;
        <?php 
						include_once("../dao/marca_dao.php");

						$marcaDAO = new MarcaDao();
						$query = $marcaDAO->busca(null,null);

						while($dado = $query->fetch(PDO::FETCH_ASSOC))
						{
							echo "<option value='".$dado["COD_MARCA"]."'>".strtoupper($dado["ORIGINAL_BRAND"])."</option>";
						}
		 ?>
				</select>
		</div>
		<label for="fbrand" class="col-sm-1 control-label">*Fantasy Brand </label>
		<div class="col-sm-3" >
			<input type="text" class="form-control fbrand" style="text-transform:uppercase;" name="fbrand" readonly="readonly" id="fbrand"   value=''>
		</div>		
	</div>
	<div class="form-group col-sm-12">
		<label for="opedgree" class="col-sm-1 control-label">*Original Pedgree </label>
		<div class="col-sm-3">
			<input type="text" class="form-control" style="text-transform:uppercase;" name="opedgree" id="opedgree" placeholder="Original Pedgree...">
		</div>
		<label for="bpedgree" class="col-sm-1 control-label">*Brazil Pedgree </label>
		<div class="col-sm-3">
			<input type="text" class="form-control" style="text-transform:uppercase;" name="bpedgree" id="bpedgree" placeholder="Brazil Pedgree...">
		</div>

		<div class="col-sm-4 caixa_destaque">
			<span class="title">Seed Treatment </span>
			<label class="radio-inline">
				<input type="radio" class='radios' name="peletizado" value="1" >Pelleted
			</label>
			<label class="radio-inline">
				<input type="radio" class='radios' name="peletizado" value="0" checked>Naked
			</label><br>
		</div>
		<br><br>
	</div>
	<div class="form-group col-sm-12">
			<label for="fases" class="col-sm-1 control-label">*Phases </label>
			<div class="col-sm-3">
				<select name="fases" id="fases" class="form-control" style='text-transform:uppercase;'>
					<?php 
							include_once("../dao/fase_dao.php");

							$fase_dao = new FaseDAO();
							$stmtFa = $fase_dao->buscaFase(null);
							
							while($FaseDados = $stmtFa->fetch(PDO::FETCH_ASSOC))
							{
								echo "<option value='".$FaseDados['COD_FASE']."'>".$FaseDados['NOME']."</option>";
							}


					 ?>
				</select>
			</div>
			<!--<div class="col-md-1"></div>-->
			<label for="resistence" class="col-sm-1 control-label">Resistence </label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="resistence" id="resistence" style="text-transform:uppercase;" placeholder="Resistence...">
		</div>
		<div class="col-md-3"></div>
		<div class="col-sm-4 caixa_destaque">
			<span class="title">Seed Treatment </span>
			<label class="radio-inline">
				<input type="radio" class='radios' name="organico" value="1" >Organic
			</label>
			<label class="radio-inline">
				<input type="radio" class='radios' name="organico" value="0" checked>Conventional
			</label>
		</div>

		</div>
			<br><br>
		<label for="obs_interno" class="col-sm-2 control-label">Observations </label>
			<div class="col-md-9">
					<textarea class="form-control" name="obs_interno" style="resize:vertical;min-height:40px;" rows="3" placeholder="Internal Observations"></textarea>
				<br>
			</div>
			<br><br>
			<div class="col-md-5"></div>
			<div class="col-md-3">
				<br>
				<button type="button" id="cd_produto" class="btn btn-success btn-lg">

					<span class="fa fa-check icon"></span> Submit Data
				</button>
				<br><br><br>

			</div>
	</div>
</div>
</form>
<!-- <div id="saida"></div> -->
<br /><br /><br />
</div>
</div>



