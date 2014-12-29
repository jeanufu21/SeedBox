<br /><br /><br /><br /><br />
	<head>
		<link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="../css/pedido_consolidado.css" />
		<link rel="stylesheet" type="text/css" href="../css/alerts.css" />
		<script type="text/javascript" src="../js/pedido_consolidado.js"></script>
	</head>
	<div class="navigationBar">Request &#62;&#62;<strong>&nbsp;Order Box </strong></div>

	<div class="col-md-9">
		<div class="col-sm-12 he"></div>

		<!-- caixa de alerta de mensagem -->
		<div class="alert alert-warning little cor1" id="alerta"></div>
		

		<div style="padding-top: 2%;" class="container">
	<div class="panel panel-success">
		<div class="panel-heading">Consolidated Orders</div>
		<div class="panel-body">
		
			<br /><br />
				<div class="main-table" id='div_pedidos' >
				<br /><br />
					
					<table class="table table-hover table-striped" id="pedidos">
						
				        <thead>
				        <tr class="success">
				        	<th>Manager</th>
				        	<th>Date</th>
				        	<th>Partners</th>
				        	<th>Status</th>
				        	<th colspan='3'></th>
				        </tr>
				        </thead>
				        <tbody id="resultado_busca" ></tbody>
				    </table>
				</div>
			
			<br /><br />
				<h3>Data Inventory</h3>
				<form class="form-horizontal has-success" role="form">
					
					<div class="main-table" id="tabela_estoque" >
				<table class="table table-hover table-striped " id="itens_pedido">
					
			        <thead>
			        <tr class="success">
			        	<th>Name Product</th>
			        	<th>Ammount</th>
			        	<th>Unit of Measure</th>
			        	
			        </tr>
			        </thead>
			        <tbody id="busca_itens">
			        </tbody>
			    </table>
			    
			</div>		
				
				
			<br /><br /><br />
			<div class="col-md-12">
				<div class="col-md-5"></div>
				<button type="button" id="itens_aprovados" disabled class="btn btn-success btn-lg">
					<span class="fa fa-check icon"></span> Approve
				</button>
				<button type="button" id="limpar"  class="btn btn-warning btn-lg">
					<span class="fa fa-exclamation icon"></span> Empty
				</button>
			</div>
			</form>
			<br /><br /><br />

		</div>
	</div>
		  <br /><br /><br />
			<div id="saida"></div>
							
						
	</div>
</div>


