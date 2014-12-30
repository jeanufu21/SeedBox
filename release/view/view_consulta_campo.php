<!-- 
    *	Title: view_consulta_campo.php
	*	Author: Frederico
	*	Date: 17/07/2014
-->
<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/consulta_campo.js"></script>
    <style>	
    	.editar:hover
    	{
    		cursor: pointer;
    		color:#71720b;
    	}
    </style>
</head>
<?php 
    include_once("../control/consulta_campo_control.php") 
?>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Countryside</strong></div>
<div class="container">
    <div class='panel panel-success'>
	      <div class='panel-heading'>View Countryside</div>
	      <div class='panel-body'>
	  	    <form  id="searchMethod" class="form-horizontal"  onsubmit="return false" role="form" >
				<div class="has-success">
				 	<div class="form-group">
                        <label for="search-term" class="col-md-1 control-label"> Filter By </label>
                        <div class="col-md-2">
                            <select id="searchOp" class="form-control" name="searchOp">
                                <option value="0"></option>
                                <option value="name">Name</option>
                                <option value="city">City</option>
                                <option value="state">State</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group form-horizontal">
						        <input type="text" id="searchValue" class="form-control" name="searchValue" onkeypress="">
						        <span class="input-group-btn">
								    <button id="searchCountryside" style="top:-7px;" class="btn btn-success" type="button"><em class="fa fa-search"></em></button>
						        </span>
						    </div>
                        </div>
                    </div>
			    </div>
		    </form>
		    <div class='main-table col-md-12' id='caixa_tabela' style="overflow: auto;">
			    <br />
			    <table class='table table-hover table-striped'>
		            <thead>
		                <tr class='success'>
		        	        <th>Name</th>
		        	        <th>City</th>
                            <th>State</th>
                            <th>Altitude</th>
		        	        <th>Latitude</th>
                            <th>Longitude</th>
                            <th></th>
		                </tr>
		            </thead>
		            <tbody id="exibeCampos">
		            </tbody>
		        </table>
		    </div>
        </div>
        <div class="modal fade" id="editCountryside" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Countryside</h4>
                    </div>
                <div class="modal-body">
                    <form  class="form-horizontal has-success"  onSubmit="return false;" id="countrysideData"  role="form">     		
      		            <div class="form-group">
        		            <label for="nome" class="col-md-3 control-label s16">Name: </label>
			                <div class="col-sm-8">
				                <input type="text" class="validate[required] form-control" id="name" name="name" />
				                <input type="hidden" class="form-control" id="countrysideCod" name="countrysideCod" />
			                </div>
			            </div>
			            <div class="form-group">
				            <label for="uf" class="col-md-3 control-label s16">City: </label>
					        <div class="col-sm-8">
						        <input type="text" class="validate[required] form-control" id="city" name="city" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="tel" class="col-md-3 control-label s16">State: </label>
					        <div class="col-sm-8">
						        <input type="text" class="validate[required] form-control" id="state" name="state" />
					        </div>
			            </div>
			            <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Altitude: </label>
					        <div class="col-sm-8">
						        <input type="text" class="coordinate form-control" id="altitude" name="altitude" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Latitude: </label>
					        <div class="col-sm-8">
						        <input type="text" class="coordinate form-control" id="latitude" name="latitude" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Longitude: </label>
					        <div class="col-sm-8">
						        <input type="text" class="coordinate form-control" id="longitude" name="longitude" />
					        </div>
			            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="updateCountryside" data-dismiss="">Save</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <br /><br /><br />
    </div>
</div>
    <div id="saida"></div>
</div>