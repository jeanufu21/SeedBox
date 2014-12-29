<br /><br /><br /><br /><br />
<head>
    <link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/pedido.css"  />
    <script type="text/javascript" src="../js/pedido.js"></script>
    <!-- esta utilizando a mesma folha de estilo de especie devido ao fieldset ser igual -->
</head>
    <div class="navigationBar">Request &#62;&#62;<strong>&nbsp;Create Request</strong></div>
        <div class="col-md-9">
	        <div class="alert little" id="alerta"></div>
                <form  class="form-horizontal has-success"  role="form"  method="post">
                    <div class="col-sm-12 he"></div>
                    <div class="container">
                        <div class='panel panel-success'>
                            <div class='panel-heading'>Data Request</div>
                                <div class='panel-body'>
		                            <div class="form-group fo1 col-md-12">
			                            <label for="gerente" class="col-sm-1 control-label">Manager </label>
				                        <div class="col-sm-3" >
		                                    <select name="gerente" class="form-control">
			                                    <option value=""></option>
			                                    <?php 
				                                    // script que seleciona todos as especies do banco e mostra elas na view
					                                    include_once("../dao/funcionario_dao.php");

						                                    $funcionario_obj = new FuncionarioDAO();
						                                    $query = $funcionario_obj->buscaFuncionario("TIPO",2);

					                                    while($dados = $query->fetch(PDO::FETCH_ASSOC))
					                                    {
						                                    echo "<option value='".$dados["ID_FUNCIONARIO"]."'>".$dados["NOME"]."</option>";
					                                    }
			                                    ?>						

		                                    </select>
	                                    </div>
			                            <label for="dataPedido" class="col-sm-2 control-label">Date Request </label>
				                        <div class="col-sm-2">
				                            <?php 
				      		                    $dataAtual = 	date("m/d/Y");
				                                echo "<input type='text' class='form-control dataAtual'  name='dataPedido' value='".
				      		                    $dataAtual."'readonly='readonly'>";
				                            ?>
				                        </div>
				                        <label for="dataPedido" class="col-sm-1 control-label">Partner </label>
			                            <div class="col-sm-3"  >
						                    <input type="text" class="form-control" id='parceiro_busca' name="parceiro" placeholder="Partner Name...">
                                        </div>
				
			                </div><!--Fim da div form-group -->
		                <label for="obs" class="col-sm-2 control-label">Description </label>
		                <div class="col-md-10">
			                <textarea class="form-control" name="descricao" style="resize:vertical;min-height:40px;" rows="3" 
						                placeholder="Description..."></textarea>
			                <br />
		                </div>
	                </div>		
                  </div>
	                  <br /><br />
	                <!-- fim da div de dados do pedido  -->
                <div class='panel panel-success'>
                  <div class='panel-heading'>Order items</div>
                  <div class='panel-body'>

	                <div id="itens">
		                <div class=" main-table">
			                <br />
			                <table class="table table-hover table-striped fo1" id="tabela">
		                        <thead>
		                        <tr class="success">
		        	                <th>Product</th>
		        	                <th>Ammount</th>
		        	                <th>Measure</th>
		        	                <th></th>
		                        </tr>
		                        </thead>
		                        <tbody id="novos_campos">
		       		                <tr>
		       			                <!-- readonly para desabilitar o input -->
		       			                <th>
		       				                <div class="col-sm-12 busca"  >
						                      <input type="text" class="form-control produto" placeholder="Product Name...">

						                    </div>
		       			                </th>
		       			                <th>
		       				                <div class="col-sm-12">
						                      <input type="text" class="form-control somenteNumero" placeholder="Ammount...">
						                    </div>
		       			                </th>
		       			                <th>
                                            <select class="col-sm-12 form-control" id="medida">
                                                <option value="MX" class="medida_valida">MX</option>
                                                <option value="KG" class="medida_valida">KG</option>
                                            </select>
						                    <!--<input type="text" class="form-control medida_valida" placeholder="Measure...">-->
		       			                </th>
		       			                <th><span class="fa fa-plus icon_black" id="add"></span></th>
		       		                </tr>
		                        </tbody>
		                    </table>
		                </div> 
	                </div>
                  </div>	
                </div>
                <div class="progress" id="prog" style="display: none;">
                    <div id="progressBar" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                        0%
                    </div>
                </div>
                </div>
                
	                  <br /><br />
	                  <div class="col-md-1"></div>
			                  <button type="button" id="save_pedido"  class="btn btn-success btn-lg">
	  			                <span class="fa fa-upload icon"></span> Submit Order
			                </button>
			                <br /><br />
	                </form>

<br /><br />

<div id="saida"></div>


</div>