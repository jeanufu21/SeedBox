<!--
    *	Title: view_trialgroups.php
	*	Author: Frederico
	*	Date: 17/07/2014
-->
<br /><br /><br /><br /><br />
<head>
    <link rel="stylesheet" href="../css/trialgroups.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../css/general.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../js/trialgroups.js"></script>
    <script type="text/javascript" src="../js/ajaxTrialGroups.js"></script>
   	<title>TrialGroups</title>
</head>
<div>
	<div class="navigationBar">Registering &#62;&#62; <strong>Register of Trials</strong></div>
	<div class="container">
		<div class="panel panel-success">
		    <div class="panel-body">
			    <div class="row">
					<div class="col-sm-2">
						<h4>Species:</h4>
					</div>
					<div class="col-sm-8 has-success">
						<select class="form-control col-sm-3" id="specie">
                            <!--<option value="-1" class="species" selected="selected" disabled="disabled">Select Specie</option>-->
							<?php
								include_once("../control/grupo_avaliativo_control.php");
								//include_once("../dao/grupo_avaliativoDAO.php");
								selectSpecies();
							?>
						</select>
					</div>
					<div class="col-sm-2">
						<input type="button" id="searchSpecie" class="btn btn-success species" value="Ok!" />
					</div>
			    </div>
		    </div>
		</div>
		<div class="panel panel-success col-sm-6">
			<div class="panel-body">
				<h4 style="display: inline;">Select evaluation parameters:</h4>
				<input type="button" class="btn btn-success btn-sm pull-right" id="openModal" data-target="#myModal" value="New Parameter" />
				<br /><br />
				<table id="avaliationParam" class="table table-condensed table-hover table-striped table-bordered">
				
                </table>
			</div>
		</div>
		<div class="panel panel-success col-sm-6">
			<div class="panel-body">
                <!-- Attributos de especie seram colocados nesta div dinamicamente via ajax -->
				<div class="row has-success" id="speciesAtt">
					
				</div>
				<br />
				<div class="row">
					<div class="col-sm-2" style="padding:  0; width: auto;">
						<h4>Phase:</h4>
					</div>
					<div class="col-sm-8 has-success">
						<select class="form-control col-sm-3">
                            <!--<option id="phase" class="phases" value="-1" selected="selected" disabled="disabled">Select Phase</option>-->
							<?php
								selectPhases();
							?>
						</select>
					</div>
                    <div class="col-sm-2">
						<input type="button" id="searchSpecieAtt" class="btn btn-success phases" value="Search!" />
					</div>
				</div>
                <form method="post" id="insert">
                    <input name="qtIns" id="qtIns" class="hidden" type="hidden" value="0" />
                    <input name="codSet" id="codSet" class="hidden" type="hidden" value="0" />
                    <input name="codEspecie" id="codEspecie" class="hidden" type="hidden" value="0" />
                    <div id="ItemRows">
                        
                    </div>
                    <table id="newatts" class="table table-striped has-success">
                    
                    </table>
                    <input type="button" id="submit" class="btn btn-success btn-lg btn-block"  value="Submit" disabled="disabled" />
                </form>
                
                <input id="qtValores" type="hidden" class="hidden" value="0" />
			</div>
		</div>
	</div>

	<!-- MODAL -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<input type="button" class="close" data-dismiss="modal" aria-hidden="true" value="&times;" />
				<h4 class="modal-title">New Parameter</h4>
			</div>
			<div class="modal-body">
				<form id="insertAvaAtt" role="form"  method="post">
					<div class="form-group has-success">
						<span style="color:  red; font-weight: bold;">*&nbsp;</span><label>Parameter Name</label>
	   						 <input type="text" class="form-control" name="nome_parametroAvaliacao" placeholder="Name" required="required" />
	   						 <br />
	   					<span style="color:  red; font-weight: bold;">*&nbsp;</span>
	                    <input type="hidden" id="specieID" class="hide" name="specieCOD" value="0" />
	   					<input type="radio" name="tipo_parametroAvaliacao" value="1" required="required" /><label>&nbsp;Quantitative</label> 
	   					<input type="radio" name="tipo_parametroAvaliacao" value="0" required="required" /><label>&nbsp;Qualitative</label>
	   					<br />
	   					<span style="color:  red; font-weight: bold; font-size:11px;">*&nbsp;Required itens</span>
					</div>
				    <div class="modal-footer">
				        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel and Close" />
				        <input type="button" id="saveAttribute" class="btn btn-success" data-dismiss="modal" value="Save parameter" />
			        </div>
	            </form>
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="debug"></div>
</div>
