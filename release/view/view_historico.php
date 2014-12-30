<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" type="text/css" href="../css/historico.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
	<!--<script type="text/javascript" src="../js/consultaHistorico.js"></script>-->
    <script type="text/javascript" src="../js/paginador.js"></script>
</head>
<div id="corpo">
	<div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">Filter by:</div>
			<div class="panel-body">
				<form class="form-inline" role="form">
					<div class="form-group has-success col-md-2">
					    <select name="termo_busca" id="termo_busca" class="form-control ">
							<option value="OPERACAO">Action</option>
							<option value="USUARIO">User</option>
							<option value="TABELA">Table</option>
							<option value="DESCRICAO">Operation</option>
							<option value="DATA_HORA">Date-hour</option>
						</select>
					</div>
					
					<div class="form-group has-success col-md-3">
					    <label class="sr-only" for="queryHistorico"></label>
						<input type="text" class="form-control" id="queryHistorico" placeholder="Text ">
					</div>
				</form>
				<div class="xxx"></div>
			</div>
		</div>
		<div class="panel panel-success">
			<div class="panel-heading">Historic</div>
			<table class="table table-hover table-bordered table-striped table-condensed">
	        <thead>
	          <tr>
	            <th>User</th>
	            <th>Table</th>
	            <th>Action</th>
	            <th>Operation</th>
	            <th>Time</th>
	          </tr>
	        </thead>
	        <tbody id="resultado_busca">
	          
	        </tbody>
	      </table>
		</div>
	    <ul class="pagination pagination-sm pull-right" id="paginador">
	        
     	</ul> 
  
	</div>
	
</div>