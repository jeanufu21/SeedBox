<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/consulta_estoque.js"></script>

</head>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Stock</strong></div>
<div class="container">
<div class='panel panel-success'>
	  <div class='panel-heading'>Search in Stock</div>
	  <div class='panel-body'>
	  	<form  class="form-horizontal has-success" id='pesquisa_filtros' onSubmit="return false;"  role="form" >
				<div class='checkbox-inline col-md-4' >
				        <label class='checkbox-inline'>
				          <input type='checkbox' class='search' value='marca.NOME_FANTASIA'> Brand
				        </label>
				        <label class='checkbox-inline'>
				          <input type='checkbox' class='search' value='produto.NOME'> Product
				        </label>
				        <label class='checkbox-inline'>
				          <input type='checkbox' class='search' value='produto.PEDIGREE_ORIGINAL'> Original Pedgree
				        </label>
				      </div>
						<div class='col-md-8 has-success'>
				 	<div class='form-group'>
				    	<label for='pesquisa' class='col-md-2 control-label s20'>Search</label>
				    	<div class='col-md-9'>
						    <input type='text' class='form-control' name="pesquisa_estoque" >
						</div>
						<button type='button' id='pesquisar' style="top:-7px;" class='btn btn-success btn-mini'>
								<span class='fa fa-search icon'></span> 
							</button>
					</div>
			</div>
		</form>

		<div class='main-table' id='caixa_tabela'>
			<br />
			<table class='table table-hover table-striped fo1' id='tabela_estoque' >
		        <thead>
		        <tr class='success'>
		        	<th>Stock Code</th>
		        	<th>Brand</th>
		        	<th>Product</th>
		        	<th>Batch Code</th>
		        	<th>Amount of input</th>
		        	<th>Quantity Available</th>
		        	<th>Unit of measure</th>
		        	<th>Type of packaging</th>
		        	<th>Weight package</th>
		        	<th>Date of delivery</th>
		        	<th>Date validity</th>
		        	
		        </tr>
		        </thead>
		        <tbody id='itens_estoque' >
		       		
		        </tbody>
		        
		    </table>
		
		</div>
		<br /><br /><br />
		
	</div>
</div>
</div>