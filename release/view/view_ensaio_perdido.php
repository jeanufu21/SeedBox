<br /><br /><br /><br /><br />
<head>
    <link rel="stylesheet" href="../css/general.css" media="screen" />
	<script type="text/javascript" src="../js/ensaio_perdido.js"></script>
</head>
<div class="navigationBar">Evaluation &#62;&#62;<strong>&nbsp;Assay Lost</strong></div>
<h1 style="color:#238e23; padding-left:20px" >Assay Lost</h1>

<div class="panel panel-default">

		<div class="has-success">

      <br />
			<div class="row" style="padding-bottom: 15px;" id="setCampos">
				<div class="form-group" style="padding-bottom: 5px; padding-left:20px;" >
					<label class="col-sm-1 control-label">Camp </label>
					    <div class="col-sm-2 form-inline">
                            <!-- <input type="hidden" name="nInserts" id="nInserts" value="0" /> -->
							<select id="select_campo" class="form-control" name="campo" style="width:  80%;">
							   <option value="-1"></option>
							</select>
                        </div>
                        <label class="col-sm-1 control-label">Assay </label>
                        <div class="col-sm-2 form-inline">
                           <!-- Criar codigo php para gerar dinamicamente este menu de selecao -->
                        	<select id="select_ensaio" name="ensaio" class="form-control" style="width:  80%;">
                             <option value="-1"></option>      	
                          </select>
						</div>


						<br /><br /><br />
						<label class="col-sm-1 control-label">Reason </label>
						<div class="col-xs-12 col-sm-6 col-md-8 form-inline">
							<textarea id="motivo" class="form-control" rows="3" style="width:500px; max-width:850px;"></textarea>
						</div>

						<div class="col-sm-1 form-inline" style="vertical-align:text-bottom;">
							<button type="submit" id="ensaio_perdido" class="btn btn-success btn-lg" >
				                Submit
				            </button>
				        </div>

				</div>
			</div>
		</div>
</div>