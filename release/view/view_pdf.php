<br /><br /><br /><br /><br />
<head>
    <link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
	<script type="text/javascript" src="../js/pdf.js"></script>
</head>
<div class="navigationBar">Evaluation &#62;&#62;<strong>&nbsp;PDF</strong></div>
<h1 style="color:#238e23; padding-left:20px" >PDF</h1>

<div class="panel panel-default">

		<div class="has-success">

      <br />
			<div class="row" style="padding-bottom: 15px;padding-left:20px;" id="setCampos">
				<div class="form-group" style="padding-bottom: 5px;" >
				<form method="post" action="../control/gera_pdf.php" target="_blank" >
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

					    <button type="submit" class="btn btn-success btn-lg" >
                Generate PDF
            </button>
						</form>
				</div>
			</div>
		</div>

</div>