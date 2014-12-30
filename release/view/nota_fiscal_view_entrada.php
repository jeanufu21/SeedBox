<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
</head>
<div>
	<div class="navigationBar">Request &#62;&#62;<strong>&nbsp;Entrance Invoice</strong></div>
    <div class="container">
		<form role="form" id="nota">
            <div class="panel panel-success">
				<div class="panel-heading">Invoice</div>
				<div class="panel-body has-success" id="corpopainel">
					<div class="form-group col-sm-4">
						<label for="data_pedido" class="col-sm-5 control-label">Order date</label>
					    <div class="col-sm-7">
					    	<input type="data" class="form-control" id="data_pedido" name="data_pedido">
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<label for="parceiro" class="col-sm-3 control-label">Partner</label>
					    <div class="col-sm-9">
					    	<input type="text" class="form-control notnull" id="parceiro" name="parceiro" placeholder="Partner">
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<label for="cod_nota" class="col-sm-3 control-label">Invoice Code</label>
					    <div class="col-sm-6">
					    	<input type="text" class="form-control notnull" id="cod_nota" name="cod_nota" placeholder="Invoice code">
					    </div>
					    <div>
						<div class="checkbox col-sm-3">
							<label>
								<input id="invalida" type="checkbox">Invalid
							</label>
						</div>
					    </div>
					</div>
                    <!--
					<div class="form-group col-sm-4">
						<label for="data_prevista" class="col-sm-5 control-label">Expected date </label>
					    <div class="col-sm-7">
					    	<input type="data" class="form-control" id="data_prevista" name="data_prevista">
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<label for="data]_entrega" class="col-sm-5 control-label">Delivery date </label>
					    <div class="col-sm-7">
					    	<input type="data" class="form-control" id="data_entrega" name="data_entrega">
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<label for="status_entrega" class="col-sm-3 control-label">Delivery Status </label>
					    <div class="col-sm-9">
					    	<input type="text" class="form-control" id="status_entrega" name="status_entrega" placeholder="Delivery Status">
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<label for="status_pagamento" class="col-sm-3 control-label">Payment Status </label>
					    <div class="col-sm-9">
					    	<input type="text" class="form-control" id="status_pagamento" name="status_pagamento" placeholder="Payment Status">
					    </div>
					</div>
					<div class="form-group col-sm-4">
						<label for="valor" class="col-sm-3 control-label">Value </label>
					    <div class="col-sm-9">
					    	<input type="text" class="form-control" id="valor" name="valor" value="0" readonly="readonly">
					    </div>
					</div>-->
					<div class="form-group col-sm-10">
						<label for="descricao" class="col-sm-2 control-label">Description </label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="3" id="descricao" name="descricao" placeholder="Description"></textarea>
						</div>
                        <div class="clearfix"></div>
					</div>
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">
					Items
					<div style="clear: both;"></div>
				</div>
				<div class="panel-body" id="corpo">
					<div class="well has-success" id="box">
						<div class="row">
							<div class="form-group col-sm-4">
								<label for="cod_produto" class="col-sm-4 control-label">Product</label>
							    <div class="col-sm-8">
							    	<input type="text" class="form-control formitem" id="cod_produto" placeholder="Product">
							    </div>
							</div>
							<div class="form-group col-sm-4">
								<label for="lote" class="col-sm-4 control-label">Lot Code</label>
							    <div class="col-sm-8">
							    	<input type="text" class="form-control formitem" id="lote" placeholder="Lot Code">
							    </div>
							</div>
							<div class="form-group col-sm-4">
								<label for="data_vencimento" class="col-sm-5 control-label">Expiration Date</label>
							    <div class="col-sm-7">
							    	<input type="data" class="form-control formitem" id="data_vencimento" placeholder="Expiration Date">
							    </div>
							</div>
							<div class="form-group col-sm-4">
								<label for="quantidade" class="col-sm-4 control-label">Quantity</label>
							    <div class="col-sm-8">
							    	<input type="text" class="form-control formitem somenteNumero" id="quantidade" placeholder="Quantity">
							    </div>
							</div>
							<div class="form-group col-sm-4">
								<label for="unidade_medida" class="col-sm-6 control-label">Measurement Unity</label>
								<div class="col-sm-6">
									<select class="form-control" id="unidade_medida">
										<option>Kg</option>
										<option>Mx</option>
									</select>
								</div>
							</div>
							<div class="form-group col-sm-4">
								<label for="tipo_embalagem" class="col-sm-5 control-label">Package type</label>
							    <div class="col-sm-7">
							    	<input type="text" class="form-control formitem" id="tipo_embalagem" placeholder="Package Type">
							    </div>
							</div>
							<div class="form-group col-sm-4">
								<label for="peso_por_embalagem" class="col-sm-4 control-label">Weight per Package</label>
							    <div class="col-sm-8">
							    	<input type="text" class="form-control formitem somenteNumero" id="peso_por_embalagem" placeholder="Weight per Package">
							    </div>
							</div>
                            <!--
							<div class="form-group col-sm-4">
								<label for="valor_item" class="col-sm-4 control-label">Value</label>
							    <div class="col-sm-8">
							    <input type="text" class="form-control formitem" id="valor_item" placeholder="Value">
							    </div>
							</div>
                            -->
						</div>
						<button type="button" class="btn btn-success center-block" id="add" style="width:300px;">Add</button>
					</div>
					<table class="table table-condensed table-hover table-striped table-bordered has-success">
						<thead>
                            <tr>
							    <th>Product</th>
							    <th>Lot Code</th>
							    <th>Exiration Date</th>
							    <th>Quantity</th>
							    <th>Measurement Unity</th>
							    <th>Package Type</th>
							    <th>Weight per Package</th>
                                <!--<th>Value</th>-->
                            </tr>
						</thead>    
						<tbody id="tabela_itens">
							
						</tbody>
					</table>
					<div class="panel little" id="alerta"></div>
					<div class="panel little" id="saida"></div>
				</div>

			</div>
			<div class="well" style="height:85px;" id="botoes">
				<input type="button" class="btn btn-lg btn-default col-sm-6" id="cancel" value="Cancel" />
				<input type="button" class="btn btn-lg btn-success col-sm-6" id="submit" value="Submit" />	
			</div>
			<div class="well" style="height:85px; visibility:hidden;" id="botoes1">
				<input type="button" class="btn btn-lg btn-danger col-sm-6" id="supercancel" value="Cancel Bill of Sale">
				<input type="button" class="btn btn-lg btn-success col-sm-6" id="ok" value="OK" />	
			</div>
		</form>
	</div>

	<script type="text/javascript" src="../js/notafiscal_entrada.js"></script>
</div>
</html>