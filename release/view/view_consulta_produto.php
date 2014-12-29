<!-- VIEW DA TELA CONSULTA PRODUTO -->
<br /><br /><br /><br /><br />
<head>
		
		<link rel="stylesheet" type="text/css" href="../css/consultStyle.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
		<script type="text/javascript" src="../js/consultaProduto.js"></script>
</head>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Product</strong></div>
<div class="body_contant">
	<div class="container">
		<div class="panel panel-success">
		<div class="panel-heading">Search Product By </div>
		<div class="panel-body">
			
		<div class="col-md-12">
			<div class="col-md-4" >
				<form class="form-horizontal has-success" id="form_consult" role="form" >
					<select name="termo_busca" id="termo_busca" class="form-control">
						<option value="NOME">Name Product</option>
						<option value="COD_SET_VALORES">Name Specie</option>
						<option value="PEDIGREE_ORIGINAL">Original pedgree</option>
						<option value="PEDIGREE_BRASIL">Brasil Pedgree</option>
					</select>
				</form>
			</div>

<!-- <div><input type="text" class="form-control" id="pesquisa"></div> -->
			<div class="col-md-8 has-success">
				 	<div class="form-group">
				    	<label for="pesquisa" class="col-md-2 control-label s20">KeyWord </label>
				    	<div class="col-md-9">
						    <div class="input-group">
						      <input type="text" class="form-control" id="pesquisa">
						      <span class="input-group-btn">
								<button class="btn btn-success" style="top:-7px;" type="button" id='buscar'><em class="fa fa-search"></em></button>
						      </span>
						    </div>
						  </div>
					</div>
				
			</div>
			<br /><br /><br />
		</div>
		</div>
	</div>
	</div>
	<div class="main-table" id='caixa_tabela'>
		<br />
		<table class="table table-hover table-striped fo1" id="tabela" >
	        <thead>
	        <tr class="success">
	        	<th>Species</th>
	        	<th>Type</th>
	        	<th>Product</th>
	        	<th>Original brand</th>
	        	<th>Fantasy brand</th>
	        	<th>Original Pedgree</th>
	        	<th>Brazil Pedgree</th>
	        	<th>Phase</th>
	        	<th>Resistence</th>
	        	<th>Pelleted/Naked</th>
	        	<th>Organic/Conventional</th>
	        	<th></th>
	        	
	        </tr>
	        </thead>
	        <tbody id="resultado_busca" >
	       		
	        </tbody>
	        
	    </table>
	</div>
	<br /><br />


	<div class="modal fade" id="edit_produto"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:55em;" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Product</h4>
      </div>
      <div class="modal-body">
      	<form  class="form-horizontal has-success"  onSubmit="return false;"  role="form" >
      		
        	<div class="form-group col-md-12">

        		<label for="nome_produto" class="col-md-3 control-label s16">Name Product</label>
			<div class="col-sm-3">
				<input type="hidden"  name="codigo" id="codigo" >
				<input type="text" class="form-control" id="nome_produto" name="nome_produto" >
				
			</div>
				<label for="nome_fantasia" class="col-md-3 control-label s16">Original Brand</label>
				<div class="col-sm-3">
					<select name="marca" id="marca_busca" class="form-control">

							<?php 
								// script que seleciona todos as especies do banco e mostra elas na view
									include_once("../dao/marca_dao.php");

										$marca_dao = new MarcaDao();
										$query = $marca_dao->busca(null,null);

									while($dados = $query->fetch(PDO::FETCH_ASSOC))
									{
										echo "<option value='".$dados["COD_MARCA"]."'>".$dados["ORIGINAL_BRAND"]."</option>";
									}
							?>						
							
						</select>			
				</div>

			</div>
			<div class="form-group col-md-12">
				<label for="nome_produto" class="col-md-3 control-label s16">Pedgree Brazil</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="pbrasil" name="pbrasil" >
				</div>
				<label for="fase" class="col-sm-2 control-label">Phases </label>
					<div class="col-sm-4">
						<select name="fases" id="fases" class="form-control">
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
			</div>
			<div class="form-group col-md-12">
				<label for="resistencia" class="col-md-3 control-label s16">Resistence</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="resistencia" name="resistencia" >
					
				</div>
			</div>
			<div class="form-group col-md-12">
				<div class="col-sm-6 caixa_destaque">
					<span class="title">Seed Treatment </span>
					<br>
					
						<label class="radio-inline col-sm-5">
							<input id="pel" type="radio" class='radios' name="peletizado" checked value="1">Pelleted
						</label>
						<label class="radio-inline col-sm-5">
							<input id="nak" type="radio" class='radios' name="peletizado" value="0">Naked
						</label><br>
					
				</div>
				<div class="col-sm-6 caixa_destaque">
					
					<span class="title">Seed Treatment </span>
					<br>
					<label class="radio-inline col-sm-5">
						<input id="org" type="radio" class='radios' name="organico" checked value="1">Organic
					</label>
					<label class="radio-inline col-sm-5">
						<input id="con" type="radio" class='radios' name="organico" value="0">Conventional
					</label>
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

	<div id="saida"></div>
</div>

