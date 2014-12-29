<br /><br /><br /><br /><br />

<head>
	<link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/nota.css" media="screen" />
    <script type="text/javascript" src="../js/notafiscal.js"></script>
    <script type="text/javascript" src="../js/auto_complete_campo.js"></script>
</head>
<div class="navigationBar">Request &#62;&#62;<strong>&nbsp;Invoice</strong></div>
<div>
<?php 
	// crio um hidden que identificara se a pagina foi sequencia da pedido consolidado.
	if(isset($_GET['acao']))
	echo "<input type='hidden' id='acao' value='".$_GET['acao']."''>"

 ?>
<div class="col-md-10" id="content">
<div class="col-md-12"></div>
<h1>Invoice</h1>
<form class="form-horizontal has-success" role="form">

<div class='panel panel-success'>
  <div class='panel-heading'>Invoice Data</div>
  <div class='panel-body' id='dados_nota'>
<div class="form-group col-sm-12">
	<label for="name" class="col-sm-1 control-label">Date Request </label>
	<div class="col-sm-3">
		<input type="text" class="form-control data-picker" name="dataPedido"  placeholder="Date Request ..." >
	</div>
    <!--
	<label for="Obrand" class="col-sm-1 control-label">Status Payment </label>
	<div class="col-sm-3">
		<input type="text" class="form-control" name="statusPag"   placeholder="Status Payment...">
	</div>
	<label for="Fbrand" class="col-sm-1 control-label">Delivery Status </label>
	<div class="col-sm-3" >
		<input type="text" class="form-control" name="statusEntr"  placeholder="Delivery Status...">
	</div>-->
    <label for="Obrand" class="col-sm-1 control-label">Delivery Date </label>
	<div class="col-sm-3">
		<input type="text" class="form-control data-picker" name="dataEntr" placeholder="Delivery Date..." >
	</div>
</div>
<!--
<div class="form-group col-sm-12" >
	<label for="Obrand" class="col-sm-1 control-label">Delivery Date </label>
	<div class="col-sm-3">
		<input type="text" class="form-control data-picker" name="dataEntr" placeholder="Delivery Date..." >
	</div>
	<label for="Fbrand" class="col-sm-1 control-label">Scheduled </label>
	<div class="col-sm-3" >
		<input type="text" class="form-control data-picker" name="dataPrevista"  placeholder="Scheduled..." >
	</div>
</div>-->
<div class="form-group col-sm-12" >
	
	<label for="Fbrand" class="col-sm-1 control-label">Description </label>
	<div class="col-md-11">
		<textarea class="form-control" name="descricaoNota" style="resize:vertical;min-height:40px;" rows="3" placeholder="Observations"></textarea>
	    <br />
	</div>	
</div>
<?php 
	if(!isset($_GET['acao']))
	{
		echo "
	<div class='form-group col-sm-12'>
		<label for='parceiro' class='col-sm-1 control-label'>Partner </label>
			<div class='col-sm-7	'>
				<input type='text' class='form-control' id='nomeParceiro'>
			</div>
			<button type='button' id='consultar_parceiro' class='btn btn-success btn-mini'>
								<span class='fa fa-search icon'></span> 
							</button>
	</div>";
	}
 ?>
 <div id="parceiro">
</div>
</div>
</div>
<br /><br /><br />
<?php 
		if(isset($_GET['acao']))
		{
echo "

<div class='panel panel-success'>
  <div class='panel-heading'>Test Data</div>
  <div class='panel-body'id='dados_ensaio' >
    <div class='form-group col-sm-12 row-hide'>
	<label for='codigo_set' class='col-sm-1 control-label'>Code SET Values </label>
	<div class='col-sm-3'>
		<input type='text' class='form-control' name='codigo_set' placeholder='Code SET values ...'>
	</div>
	<label for='codigo_campo' class='col-sm-1 control-label'>Countryside </label>
	<div class='col-sm-3' >
		<input type='text' class='form-control' name='nome_campo' id='nome_campo' placeholder='Countryside name  ...'>
	</div>
	<label for='empresa' class='col-sm-1 control-label'>Business </label>
	<div class='col-sm-3'>
		<input type='text' class='form-control' name='empresa' placeholder='Business ...'>
	</div>	
		
</div>";


echo "<div class='form-group col-sm-12 row-hide'>
	<label for='produtor' class='col-sm-1 control-label'>Producer </label>
	<div class='col-sm-3'>
		<input type='text' class='form-control' name='produtor' placeholder='Producer ...'>
	</div>
	<label for='responsavel' class='col-sm-1 control-label' style='font-size:13px;'>Responsible </label>
	<div class='col-sm-3' >
		<input type='text' class='form-control' name='responsavel' placeholder='Responsible ...'>
	</div>	
	<label for='supervisor' class='col-sm-1 control-label'>Supervisor </label>
	<div class='col-sm-3'>
		<input type='text' class='form-control' name='supervisor' placeholder='Supervisor ...'>
	</div>	
</div>
<div class='form-group col-sm-12 row-hide'>
	<label for='avaliador' class='col-sm-1 control-label'>Appraiser </label>
	<div class='col-sm-3'>
		<input type='text' class='form-control' name='avaliador' placeholder=Appraiser ...'>
	</div>
		
</div>
  </div>
</div>

<br /><br /><br />";
}

 ?>
<div class='panel panel-success'>
  <div class='panel-heading'>Invoice Items</div>
  <div class='panel-body'>
	<?php 
		
		
			echo "<div class='checkbox-inline col-md-4' >
				        <label class='checkbox-inline'>
				          <input type='checkbox' class='search' value='marca.NOME_FANTASIA'> Brand
				        </label>
				        <label class='checkbox-inline'>
				          <input type='checkbox' class='search' value='produto.NOME'> Product
				        </label>
				        <label class='checkbox-inline'>
				          <input type='checkbox' class='search' value='produto.PEDIGREE_ORIGINAL'> Pedgree Original
				        </label>
				      </div>
						<div class='col-md-8 has-success'>
				 	<div class='form-group'>
				    	<label for='pesquisa' class='col-md-2 control-label s20'>Search</label>
				    	<div class='col-md-9'>
						    <input type='text' class='form-control consulta_geral' id='buscar_estoque' name='pesquisa_estoque' placeholder='For multiple filters use example,example,example'>
						</div>
						<button type='button' id='add_item' disabled class='btn btn-success btn-mini'>
								<span class='fa fa-plus icon'></span> 
							</button>
					</div>
			</div>
	<div class='main-table' id='caixa_tabela'>
		<br />
		<table class='table table-hover table-striped fo1' id='tabela_estoque' >
	        <thead>
	        <tr class='success'>
	        	<th>Code Stock</th>
	        	<th>Brand</th>
	        	<th>Product</th>
	        	<th>Batch Code</th>
	        	<th>Amount</th>
	        	<th>Quantity Available</th>
	        	<th>Unit of measure</th>
	        	<th>Type of packaging</th>
	        	<th>Weight package</th>
	        	<th>Delivery Date</th>
	        	<th>Date validity</th>
	        	<th>Output</th>
	        	<th>Price</th>
	        </tr>
	        </thead>
	        <tbody id='itens_estoque' >
	       		
	        </tbody>
	        
	    </table>
	
	</div>";
	 ?>
	<br /><br /><br />
	
		<div class='main-table'>
			<br />
			<table class='table table-hover table-striped fo1' id='tabela'>
		        <thead>
		        <tr class='success'>
		        	<th style='width:40px;'></th>
		        	<th><div class='col-sm-12'>Product</div></th>
		        	<th><div class='col-sm-12'>ID Stock</div></th>
		        	<th><div class='col-sm-12'>Measure</div></th>
		        	<th><div class='col-sm-12'>Amount</div></th>
		        	<th><div class='col-sm-12'>Price</div></th>
		        	<th></th>
		        	<th></th>
		        </tr>
		        </thead>
		        <tbody id='itens_nota'>
		        	
		      </tbody>
		        <tr class='final-line' id='lasting'>
		        	<th colspan='8'><label class='col-sm-10 control-label' >Total Value </label>
		        	<label class='col-sm-1 control-label' id='precofinal'></label>
		        	<input type='hidden' class='form-control' name='valorTotal' id='precofinal_hidden' >
		        	</th>
		        </tr>
		    </table>
		</div>
	<div id='produto_testemunha_texto'>
		<label for='produto_testemunha' class='col-sm-1 control-label'>Check Product </label>
		<div class='col-sm-10'>
			<textarea  class='form-control'  id="produto_testemunha" name='produto_testemunha' style="resize:vertical;" rows="3" ></textarea>
		</div>
	</div>
</div>
</div>

<div class="col-md-5"></div>
		<div class="col-md-3">
			<br />
			<button type="button" id="cd_nota"  class="btn btn-success btn-lg">
				<span class="fa fa-check icon"></span> Create Invoice
			</button>
			<br /><br /><br />

		</div>
</form>
<!--div id="saida"></div-->
<br /><br /><br />
</div>
</div>



