    $(document).ready(function(){

        $("#submeter").on("click",function(){

                var parametros = $( "form" ).serializeArray();
                    // a função serialieArray pega todos os valores e campos 
                    // contruindo-os em um array do mesmo formato que o .ajax
                    //  exige
                    
                $.ajax({

                        type:"POST",
                        url:"insertTrials.php",
                        data: parametros,
                        success: function(){alert("Cadatro Realizado!");}
                        
                    });
        });


    });





function addRow(frm) {
	
    /* Altera o valor do campo hidden que conta o numero de insercoes que seram realizadas no banco de dados */
    $('#nInserts').val(parseInt($('#nInserts').val()) + 1);
    
    /* A variavel "nInserts" recebe o valor do campo hidden que guarda o numero de insercoes que seram realizadas no banco de dados */
    nInserts = parseInt($('#nInserts').val());
    
    //alert('Valor do campo hidden: ' + parseInt($('#nInserts').val()));
    
    /* Cria uma linha com as opcoes para cadastro de parametros de avaliacao */
	var row = '<div id="p1rowNum'+nInserts+'" style="padding: 10px 0 0 5px; margin-top:5px; border:1px solid gray; border-radius: 5px; -moz-border-radius: 5px; -o-border-radius: 5px; -webkit-border-radius: 5px; -ms-border-radius: 5px;">'+
                    '<h3 style="margin-top: 0;">0'+nInserts+'</h3>'+
                    '<span style="color:  red; font-weight: bold;">*&nbsp;</span><label>Assessment Phase: </label>&nbsp;&nbsp;'+
                    /* Criar codigo php para gerar dinamicamente este menu de selecao */
                    '<select name="fase_parametroAvaliacao'+nInserts+'">'+                   
                        '<option value="1">Screaning</option>'+
                        '<option value="2">Pre Commercial</option>'+
                        '<option value="3">Commercial</option>'+
                    '</select><br>'+
                    '<span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="tipo_parametroAvaliacao'+nInserts+'">Type of Attribute:</label><br>'+
					'<input type="radio" name="tipo_parametroAvaliacao'+nInserts+'" value="0" required="required">Quantitative'+
					'&nbsp;&nbsp;<input type="radio" name="tipo_parametroAvaliacao'+nInserts+'" value="1" required="required">Qualitative<br>'+
					'<span style="color:  red; font-weight: bold;">*&nbsp;</span><label for="obrigatorio_parametroAvaliacao'+nInserts+'">Required: </label><br>'+
					'<input type="radio" name="obrigatorio_parametroAvaliacao'+nInserts+'" value="0" required="required">Yes'+
					'&nbsp;&nbsp;<input type="radio" name="obrigatorio_parametroAvaliacao'+nInserts+'" value="1" required="required">No<br>'+
					'<div class="form-group has-success form-inline" style="margin-top: 8px;">'+
						'<span style="color:  red; font-weight: bold;">*&nbsp;</span><label>Name:&nbsp;&nbsp;</label><input type="text" class="form-control" name="nomeParametro_parametroAvaliacao'+nInserts+'" placeholder="Attribute name" style="width: 200px" required="required"/>'+
                        '<br><br><span style="color:  red; font-weight: bold; font-size:11px;">*&nbsp;Required itens</span>'+
                        '<br><button style="margin-top: 5px;" class="btn btn-danger" onclick="removeRow('+nInserts+');">Remove</button>'+
					'</div> '+
				'</div>';
    //alert(row);
	$('#ItemRows').append(row);
}

function removeRow(rnum) {
	
    /*Remove campos do formulario adicionados pela funcao "addRow(frm)" */
    $('#p1rowNum'+rnum).remove();
    
    /*Atualiza o valor do campo hidden que guarda a quantidade de campos a serem inseridos no banco de dados*/
	$('#nInserts').val(parseInt($('#nInserts').val())-1);
	//alert($('#nInserts').val());
}
