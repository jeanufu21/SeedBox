<!-- 
    *	Title: view_consulta_parceiro.php
	*	Author: Frederico
	*	Date: 17/07/2014
-->
<br /><br /><br /><br /><br />
<head>
	<link rel="stylesheet" href="../css/general.css" media="screen" />
    <script type="text/javascript" src="../js/consulta_parceiro.js"></script>
    <style>	
    	.editar:hover
    	{
    		cursor: pointer;
    		color:#71720b;
    	}
    </style>
</head>
<?php 
    include_once("../control/consulta_parceiro_control.php") 
?>
<div class="navigationBar">Search &#62;&#62;<strong>&nbsp;Search for Partners</strong></div>
<div class="container">
    <div class='panel panel-success'>
	      <div class='panel-heading'>View Partners</div>
	      <div class='panel-body'>
	  	    <form  id="searchMethod" class="form-horizontal"  onsubmit="return false" role="form" >
				<div class="has-success">
				 	<div class="form-group">
                        <label for="search-term" class="col-md-1 control-label"> Filter By </label>
                        <div class="col-md-2">
                            <select id="searchOp" class="form-control" name="searchOp">
                                <option value="name">Name</option>
                                <option value="cpf">CPF</option>
                                <option value="cnpj">CNPJ</option>
                                <option value="city">City</option>
                                <option value="state">State</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group form-horizontal">
						        <input type="text" id="searchValue" class="form-control" name="searchValue" onkeypress="">
						        <span class="input-group-btn">
								    <button id="searchPartners" style="top:-7px;" class="btn btn-success" type="button"><em class="fa fa-search"></em></button>
						        </span>
						    </div>
                        </div>
                    </div>
			    </div>

		    </form>
		    
        </div>
        
	</div>
 </div><!--fim container -->
<div class='main-table col-md-12' id='caixa_tabela' style="overflow: scroll; height:22em;">
			    <br />
			    <h3>Data of the Partners</h3>
			    <table class='table table-hover table-striped' style="width:180em;" >
		            <thead>
		                <tr class='success'>
		        	        <th>Name</th>
		        	        <th>CPF</th>
		        	        <th>CNPJ</th>
		        	        <th>Country</th>
		        	        <th>State</th>
		        	        <th>City</th>
		        	        <th>District</th>
		        	        <th>Address</th>
		        	        <th>Complement</th>
		        	        <th>CEP</th>
                            <th>E-mail</th>
                            <th>Site</th>
                            <!--<th>Fax</th>-->
                            <th>Telephone I</th>
                            <th>Telephone II</th>
                            <th></th>
		                </tr>
		            </thead>
		            <tbody id="exibeParceiros">
		            </tbody>
		        </table>
		    </div>
<div class="modal fade" id="editPartner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Partner</h4>
                    </div>
                <div class="modal-body">
                    <form  class="form-horizontal has-success"  onSubmit="return false;" id="partnerData"  role="form">     		
      		            <div class="form-group">
        		            <label for="nome" class="col-md-3 control-label s16">Name: </label>
			                <div class="col-sm-8">
				                <input type="text" class="form-control" id="name" name="name" />
				                <input type="hidden" class="form-control" id="partnerCod" name="partnerCod" />
			                </div>
			            </div>
			            <div class="form-group">
				            <label for="login" class="col-md-3 control-label s16">CPF: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" data-mask="999.999.999-99" id="cpf" name="cpf" />
					        </div>
			            </div>
			            <div class="form-group">
				            <label for="senha" class="col-md-3 control-label s16">CNPJ: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" data-mask="99.999.999/9999-99" id="cnpj" name="cnpj" />
					        </div>
			            </div>
			            <div class="form-group">
				            <label for="email" class="col-md-3 control-label s16">Country: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="country" name="country" />
					        </div>
			            </div>
			            <div class="form-group">
				            <label for="tel" class="col-md-3 control-label s16">State: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="state" name="state" />
					        </div>
			            </div>
			            <div class="form-group">
				            <label for="uf" class="col-md-3 control-label s16">City: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="city" name="city" />
					        </div>
			            </div>
			            <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">District: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="district" name="district" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Address: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="address" name="address" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Complement: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="complement" name="complement" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Cep: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" data-mask="99.999-999" id="cep" name="cep" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">E-mail: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="email" name="email" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Site: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="site" name="site" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Telephone I: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="telephone1" name="telephone1" />
					        </div>
			            </div>
                        <div class="form-group">
				            <label for="cidade" class="col-md-3 control-label s16">Telephone II: </label>
					        <div class="col-sm-8">
						        <input type="text" class="form-control" id="telephone2" name="telephone2" />
					        </div>
			            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="updatePartner" data-dismiss="modal">Save</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <br /><br /><br />
    </div>
    <div id="saida"></div>