<br /><br /><br /><br /><br />
<head>
    <script type="text/javascript" src="../js/avaliacao.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../resource/css/loading.css" />
</head>
<div class="navigationBar">Evaluation &#62;&#62;<strong>&nbsp;Evaluations</strong></div>
<h1 style="color:#238e23; padding-left:20px" >Evaluations</h1>
	<div class="panel panel-default">
	    <div class="has-success">

            <br />
            
	        <div class="row" style="padding-bottom: 15px; padding-left:20px;" id="setCampos">
		        <div class="form-group" style="padding-bottom: 5px;" >
			        <label class="col-sm-1 control-label">Camp </label>
				        <div class="col-sm-2 form-inline">
                            <!-- <input type="hidden" name="nInserts" id="nInserts" value="0" /> -->
					        <select id="select_campo" class="form-control" name="AvaliacaoCampo" style="width:  80%;">
						        <option value="-1"></option>
					        </select>
                        </div>
                            
                        <label class="col-sm-1 control-label">Assay </label>
                        <div class="col-sm-2 form-inline">
                            <!-- Criar codigo php para gerar dinamicamente este menu de selecao -->
                            <select id="select_ensaio" name="AvaliacaoEnsaio" class="form-control" style="width:  80%;">
                                <option value="-1"></option>      	
                            </select>
				        </div>

				        <label class="col-sm-2 control-label">
                      <button id="teste"  class="btn btn-success btn-mini">
                        <span class="fa fa-check icon"></span> View Parameters
                      </button>
                      <!--      <?php /* 
		 			            if(strstr($_SERVER['HTTP_USER_AGENT'],"Chrome")){
						            echo "<button type='button' id='teste'  class='btn btn-success btn-mini'>
								            <span class='fa fa-check icon'></span> View Parameters
								            </button>";
					            }*/
	 			            ?>-->
                        </label>
		            </div>
		        </div>
	    </div>
	
		<div id="div_parametros" class="panel panel-success" hidden>
	  		<div class="panel-heading">
          <h3 class="panel-title">Parameters </h3>
	  		</div>
        <div class="panel-body">
          <table id="table_parametros" class="table">
              <thead>
                  <tr>
                      <th>Avaliation Param</th>
                      <th>Readings Performed</th>
                      <th>Planned Readings</th>
                      <td><input id="checkboxall" type="checkbox"></td>
                  </tr>
              </thead>
              <tbody>
          
              </tbody>
      
          </table>
	  			<input type="button" id="launch_button" class="btn btn-success btn-lg" data-toggle="modal" value="Evaluate" />
          <input type="button" id="fechar_ensaio" class="btn btn-success btn-lg" value="Close Assay" />
<!-- Modal -->
<div class="modal" id="avaliacao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input type="button" class="close" data-dismiss="modal" aria-hidden="true" value="&times;" />
                <h4 class="modal-title" id="myModalLabel">Quantitative Parameter</h4>
            </div>
        <div class="modal-body">
            <div id="div_teste">
            
            </div>
            <br />  
      <div class="form-inline">
        <div id="upload_div" class="form-group col-sm-6">
        </div>
    
        <div class="form-group">
          <label class="col-sm-6" style='top:35px;left:15px;'>Comment </label>
        </div>
      </div>
    
      <br />
    
      <div class="form-inline">
        <div class="form-group">
          <img id="preview" class="col-sm-6" src="#" alt="" style="width:200px;"/>
        </div>
    
        <div class="form-group">
          <textarea id="comentario" class="col-sm-6" style="width:300px; height:125px; resize:none;"></textarea>
        </div>
      </div>


      <div class="modal-footer">
        <input type="button" class="btn btn-default close_button" data-dismiss="modal" value="Close">
        <input type="button" id="back_button" class="btn btn-primary" data-toggle="modal" value="&lt;&lt; Back" />
        <input type="button" id="next_button" class="btn btn-primary" data-toggle="modal" value="Next &gt;&gt;" />
      </div>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="finalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="button" class="close" data-dismiss="modal" aria-hidden="true" value="&times;" />
        <h4 class="modal-title" id="myModalLabel">Finalize</h4>
      </div>
      <div class="modal-body">
        <div id="finalizar_div">
          <table id="finalizar_table" class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Parameter</th>
                    <th>Value</th>
                    <th></th>
                    <th>Coments</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>

          </table>
        </div>

        <div id="finalizar_preview">
        </div>

      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default close_button" data-dismiss="modal" value="Close" />
        <input type="button" id="finalizar_back_button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" value="&lt;&lt; Back" />
        <button id="finalizar_button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" >
          <span class="spinner"><i class="icon-spin icon-refresh"></i></span>
        Finalize</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="leituras" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <input type="button" class="close" data-dismiss="modal" aria-hidden="true" value="&times;" />
        <h4 class="modal-title" id="leitura_label">Readings Made</h4>
      </div>
      <div class="modal-body">
        <table id="leituras_table" class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Reading</th>
                    <th>Value</th>
                    <th>Date of evaluation</th>
                    <th>Coments</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>

        </table>

      </div>
      <div class="modal-footer">
        <input type="button" class="btn btn-default" data-dismiss="modal" value="Close" />
      </div>
    </div>
  </div>
</div>
	  			</div>
	  		</div>
		</div>

	
