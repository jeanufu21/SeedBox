var last_json = null;
var i = 0;
var j = 0;
var matrix = null;
var count = 0;

var array_checked = [];
var matriz_produto_parametros  = [];

var files = [];

// $(function()
// {
    // Variable to store your files
    

    

    $('#upload_div').on('change', 'input[type=file]', prepareUpload);
    $('#finalizar_button').on('click', uploadFiles);

    // Grab the files and set them to our variable
    function prepareUpload(event)
    {
        files[count] =  event.target.files[ 0 ];
        readURL(count);
    }

    // Catch the form submit and upload the files
    function uploadFiles(event)
    {
    

        // START A LOADING SPINNER HERE

        var newFiles = files.filter(Boolean);
        // Create a formdata object and add the files
        var data = new FormData();
        $.each(newFiles, function(key, value)
        {
               
                data.append(key, value);
            
        });
        
        $.ajax({
            url: '../control/cadastra_leituras_amostras_control.php?files',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
                if(typeof data.error === 'undefined')
                {
                    // Success so call function to process the form
                    submitForm(event, data);
                }
                else
                {
                    // Handle errors here
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                // Handle errors here
                console.log('ERRORS: ' + textStatus);
                // STOP LOADING SPINNER
            }
        });
    }

    function submitForm(event, data)
    {

        var amostras = [];

        for (var i = 0; i < last_json[ 1 ].length; i++) {
            amostras.push( last_json[ 1 ][ i ].COD_AMOSTRA );
        }

        var parametros = [];

        for (var i = 0; i < array_checked.length; i++) {
            parametros.push({
                cod_parametro : last_json[ 0 ][ array_checked[ i ] ].COD_PAR_AVALIACAO,
                obrigatorio : last_json[ 0 ][ array_checked[ i ] ].OBRIGATORIO
            });

        }

        var ensaio = $("#select_ensaio option:selected").val();

        $.ajax({
            url: '../control/cadastra_leituras_amostras_control.php',
            type: 'POST',
            data: {
                valores : matriz_produto_parametros,
                amostras : amostras,
                parametros : parametros,
                ensaio : ensaio
            },
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
                if(typeof data.error === 'undefined')
                {
                    // alert( data.success );
                    novaMensagem("sucesso",data.success);
                    // Success so call function to process the form
                    console.log('SUCCESS: ' + data.success);
                }
                else
                {
                    // alert(data.error);
                    novaMensagem("erro",data.error);
                    // Handle errors here
                    console.log('ERRORS: ' + data.error);
                }
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                // alert(data.error);
                novaMensagem("erro",data.error);
                // Handle errors here
                console.log('ERRORS: ' + textStatus);
            },
            complete: function()
            {
                location.reload();
            }
        });
    }

     function readURL(f) {
        if (files[f]) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(files[f]);
        }
    }
            
    function readURL2(file, f) {
        
        if (file) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $(".preview_resultado").eq( f ).attr('src', e.target.result);
        }
            
            reader.readAsDataURL(file);
        }
    }
    
    
// });

$(document).ready(function() {



    $.ajax({
            url: "../control/busca_campo.php?estado=1",
            type: 'post',
            dataType: 'json',
            success: function (data) {      

                $.each(data, function (i, item) {
                    
                    $('#select_campo').append($('<option>', { 
                        value: data[i].COD_CAMPO,
                        text : data[i].NOME + ' - ' + data[i].CIDADE + ' - ' + data[i].UF
                    }));
                });

            },
            error: function (){
                novaMensagem("erro","Field not Found!");
            } 
            
    });

    $.ajax({
            url: "../control/busca_ensaio.php?estado=1",
            type: 'post',
            dataType: 'json',
            success: function (data) {      

                $.each(data, function (i, item) {
                    
                    $('#select_ensaio').append($('<option>', { 
                        value: data[i].COD_ENSAIO,
                        text : data[i].COD_ENSAIO + ' - ' + data[i].VALORES_SET  
                    }));
                });

            }
            
    });

    $( "#fechar_ensaio" ).hide();
    
});

$( "#fechar_ensaio" ).click(function() {
    
    ajax_ensaio = $("#select_ensaio option:selected").val();

    $.ajax({
            url: "../control/conclui_ensaio.php",
            type: 'post',
            data: { ensaio : ajax_ensaio },
            success: function (data) {

                $("#corp").empty();
                $("#corp").load("../view/view_avaliacao.php"); 
                novaMensagem("sucesso",'Trial completed successfully.');
                
            }
            
        });
});



$( "#select_campo" ).change(function() {
	$("#select_ensaio").empty();
    $("#table_parametros tbody").empty();
    $("#div_parametros").hide();

	ajax_campo = $("option:selected", this).val();
	
	$.ajax({
            url: "../control/busca_ensaio.php?estado=1",
            type: 'post',
            dataType: 'json',
            data: {campo:ajax_campo},
            success: function (data) {		


                $('#select_ensaio').append('<option value="-1"></option>'); 
            	$.each(data, function (i, item) {
                    
                    $('#select_ensaio').append($('<option>', { 
                        value: data[i].COD_ENSAIO,
                        text : data[i].COD_ENSAIO + ' - ' + data[i].VALORES_SET 
                    }));
                });

            }
            
        });
});

$( "#select_ensaio" ).change(function() {
    $("#table_parametros tbody").empty();
    $("#div_parametros").show();

	
	ajax_ensaio = $("option:selected", this).val();
    if( ajax_ensaio == -1 ) $("#div_parametros").hide();
    else
    {

    	$.ajax({
                url: '../control/busca_parametros_leituras.php',
                type: 'post',
                dataType: 'json',
                data: {ensaio:ajax_ensaio},
                
                success: function (data) {		

                	last_json = data;

                	$.each(data[ 0 ], function (i, item) {
                        if( data[ 0 ][ i ].OBRIGATORIO == 1)
                        {
                            if( data[ 0 ][ i ].LEITURAS_FEITAS == data[ 0 ][ i ].NRO_AVALIACOES )
                            {
                                $("#table_parametros").find('tbody')
                                .append($('<tr>')
                                    .append($('<td>').html( '<b>' + data[ 0 ][ i ].PARAMETRO_AVALIACAO + '</b> <small style="color: #999;">(Obrigatorio)</small>'))
                                    .append($('<td>').html(data[ 0 ][ i ].LEITURAS_FEITAS + '&nbsp&nbsp&nbsp<button class="btn btn-success btn-xs valores_button">info</button>'))                                    
                                    .append($('<td>').text(data[ 0 ][ i ].NRO_AVALIACOES))
                                    .append('<td><input id="checkbox' + i + '" class="checkbox" type="checkbox" disabled></td>')
                                ); 
                            }
                            else
                            {
                                if( data[ 0 ][ i ].LEITURAS_FEITAS == 0)
                                {
                                    $("#table_parametros").find('tbody')
                                    .append($('<tr>')
                                        .append($('<td>').html( '<b>' + data[ 0 ][ i ].PARAMETRO_AVALIACAO + '</b> <small style="color: #999;">(Obrigatorio)</small>'))
                                        .append($('<td>').html(data[ 0 ][ i ].LEITURAS_FEITAS))
                                        .append($('<td>').text(data[ 0 ][ i ].NRO_AVALIACOES))
                                        .append('<td><input id="checkbox' + i + '" class="checkbox" type="checkbox"></td>')
                                    );
                                }
                                else
                                {
                                    $("#table_parametros").find('tbody')
                                    .append($('<tr>')
                                        .append($('<td>').html( '<b>' + data[ 0 ][ i ].PARAMETRO_AVALIACAO + '</b> <small style="color: #999;">(Obrigatorio)</small>'))
                                        .append($('<td>').html(data[ 0 ][ i ].LEITURAS_FEITAS + '&nbsp&nbsp&nbsp<button class="btn btn-success btn-xs valores_button">info</button>'))                                    
                                        .append($('<td>').text(data[ 0 ][ i ].NRO_AVALIACOES))
                                        .append('<td><input id="checkbox' + i + '" class="checkbox" type="checkbox"></td>')
                                    );
                                }
                                 

                            }
                            
                        }
                        else
                        {
                            if( data[ 0 ][ i ].LEITURAS_FEITAS == data[ 0 ][ i ].NRO_AVALIACOES )
                            {
                                $("#table_parametros").find('tbody')
                                .append($('<tr>')
                                    .append($('<td>').html(data[ 0 ][ i ].PARAMETRO_AVALIACAO + ' <small style="color: #999;">(Opcional)</small>'))
                                    .append($('<td>').html(data[ 0 ][ i ].LEITURAS_FEITAS + '&nbsp&nbsp&nbsp<button class="btn btn-success btn-xs valores_button">info</button>'))
                                    .append($('<td>').text(data[ 0 ][ i ].NRO_AVALIACOES))
                                    .append('<td><input id="checkbox' + i + '" class="checkbox" type="checkbox" disabled></td>')
                                );
                            }
                            else
                            {
                                if( data[ 0 ][ i ].LEITURAS_FEITAS == 0)
                                {
                                    $("#table_parametros").find('tbody')
                                    .append($('<tr>')
                                        .append($('<td>').html(data[ 0 ][ i ].PARAMETRO_AVALIACAO + ' <small style="color: #999;">(Opcional)</small>'))
                                        .append($('<td>').html(data[ 0 ][ i ].LEITURAS_FEITAS))
                                        .append($('<td>').text(data[ 0 ][ i ].NRO_AVALIACOES))
                                        .append('<td><input id="checkbox' + i + '" class="checkbox" type="checkbox"></td>')
                                    );
                                }
                                else
                                {
                                    $("#table_parametros").find('tbody')
                                    .append($('<tr>')
                                        .append($('<td>').html(data[ 0 ][ i ].PARAMETRO_AVALIACAO + ' <small style="color: #999;">(Opcional)</small>'))
                                        .append($('<td>').html(data[ 0 ][ i ].LEITURAS_FEITAS + '&nbsp&nbsp&nbsp<button class="btn btn-success btn-xs valores_button">info</button>'))                                    
                                        .append($('<td>').text(data[ 0 ][ i ].NRO_AVALIACOES))
                                        .append('<td><input id="checkbox' + i + '" class="checkbox" type="checkbox"></td>')
                                    );
                                }

                            }
                           
                    
                        }
                    });

                    if( data[ 2 ] )
                    {
                        $( "#fechar_ensaio" ).show();
                    }


                    $('#select_campo').val( data[ 3 ]);

                }
                
        });
    }
});


$('#checkboxall').click(function() {
    if ($(this).is(':checked'))  $('.checkbox:not(:disabled)').prop('checked', true);
    else $('.checkbox:not(:disabled)').prop('checked', false);
});


$('#avaliacao').on('show.bs.modal', function (e) {

    $('#div_teste', this).empty();
    $('#preview').attr('src', "#");
    $('#comentario').val("");
    

    $('#myModalLabel', this).text(last_json[ 1 ][ j ].PRODUTO_NOME );
	
	if(last_json[ 1 ][ j ].PRODUTO_NOME == null){
        $('#myModalLabel', this).text('Testemunha');
        last_json[ 1 ][ j ].PRODUTO_NOME = 'Testemunha'; 
    }
	
    if( last_json[ 0 ][ array_checked[ i ] ].OBRIGATORIO == 1 )
    {
        $('#div_teste', this).append('<h4> ' + last_json[ 0 ][ array_checked[ i ] ].PARAMETRO_AVALIACAO + ' <small>(Obrigatorio)</small></h4>');
    }
    else
    {
        $('#div_teste', this).append('<h4> ' + last_json[ 0 ][ array_checked[ i ] ].PARAMETRO_AVALIACAO + ' <small>(Opcional)</small></h4>');
    }
    
    if( last_json[ 0 ][ array_checked[ i ] ].OBSERVACAO )
    {
        $('#div_teste', this).append( '<b>Obs:</b> ' + last_json[ 0 ][ array_checked[ i ] ].OBSERVACAO + '<br><br>');
    }

    if( last_json[ 0 ][ array_checked[ i ] ].QUANTITATIVO == 1 )
    { 
        if( matriz_produto_parametros[ j ][ i ] != undefined )
        {

            $('#div_teste', this).append('Valor: <input class="form-control" type="text" name="parametro_quantitativo" value="' + matriz_produto_parametros[ j ][ i ].value + '" style="width:50%;"> (' + last_json[ 0 ][ array_checked[ i ] ].MIN + ', ' + last_json[ 0 ][ array_checked[ i ] ].MAX + ')' );

        }
        else
        {
            $('#div_teste', this).append('Valor: <input class="form-control" type="text" name="parametro_quantitativo" style="width:50%;"> (' + last_json[ 0 ][ array_checked[ i ] ].MIN + ', ' + last_json[ 0 ][ array_checked[ i ] ].MAX + ')' );

        }

    } 
    else 
    {  
        if( matriz_produto_parametros[ j ][ i ] != undefined )
        {
            $('#div_teste', this).append('Valor: 1 <input type="radio" name="parametro_qualitativo" value="1"> 2 <input type="radio" name="parametro_qualitativo" value="2"> 3 <input type="radio" name="parametro_qualitativo" value="3"> 4 <input type="radio" name="parametro_qualitativo" value="4"> 5 <input type="radio" name="parametro_qualitativo" value="5">');
            $('#div_teste input[type=radio]', this).eq( matriz_produto_parametros[ j ][ i ].value - 1).prop('checked', true);
        }
        else
        {
            $('#div_teste', this).append('Valor: 1 <input type="radio" name="parametro_qualitativo" value="1"> 2 <input type="radio" name="parametro_qualitativo" value="2"> 3 <input type="radio" name="parametro_qualitativo" value="3" checked> 4 <input type="radio" name="parametro_qualitativo" value="4"> 5 <input type="radio" name="parametro_qualitativo" value="5">');
     
        }

    }

    if( files[ count ])
    {
        readURL(count);
    }

    if( matriz_produto_parametros[ j ][ i ] != undefined )
    {
        $('#comentario').val( matriz_produto_parametros[ j ][ i ].comment );   
    }
    
    if( i == 0 && j == 0 ) $('#back_button').hide();
    else $('#back_button').show();
    
    
});

$('#finalizar').on('show.bs.modal', function (e) {

    $("#finalizar_table").find('tbody').empty();
    $('#finalizar_preview').empty();

    

    $.each(matriz_produto_parametros, function (i) {
        $.each(matriz_produto_parametros[ i ], function (j) {
            if( j == 0 )
            {
                $("#finalizar_table").find('tbody')
                .append($('<tr>')
                    .append($('<td>').html( '<b>' + last_json[ 1 ][ i ].PRODUTO_NOME + '</b>' ) )
                    .append($('<td>').text( last_json[ 0 ][ array_checked[ j ] ].PARAMETRO_AVALIACAO ) )
                    .append($('<td>').text( matriz_produto_parametros[i][j].value ))
                    .append($('<td>').text( matriz_produto_parametros[i][j].comment ))
                    .append($('<td>').html( '<img class="preview_resultado" src="#" alt="" style="width:100px;"/>' ))
                );

            }
            else
            {
                $("#finalizar_table").find('tbody')
                .append($('<tr>')
                    .append($('<td>').html( '' ) )
                    .append($('<td>').text( last_json[ 0 ][ array_checked[ j ] ].PARAMETRO_AVALIACAO ) )
                    .append($('<td>').text( matriz_produto_parametros[i][j].value ))
                    .append($('<td>').text( matriz_produto_parametros[i][j].comment ))
                    .append($('<td>').html( '<img class="preview_resultado" src="#" alt="" style="width:100px;"/>' ))
                );
            }

        })
    })


    for(var i = 0; i < count; i++) {
        if( files[i] )
        {
            readURL2( files[i], i );
        }
    }

});

$('.close_button').click(function (e) {
   

    i = 0;
    j = 0;
    count = 0;

    array_checked = [];
    matriz_produto_parametros = [];
    var last_json = null;

    files = [];
      
  
});

 
$('#launch_button').click(function(e){

     
	$(".checkbox").each(function(i) {
	   if (this.checked) {
	       array_checked.push( i );
	   }
	});

	var size_parametros = array_checked.length;
    var size_amostras = last_json[ 1 ].length;

    $('#upload_div').empty();
    for (var i = 0; i < (size_amostras * size_parametros); i++) {
        $('#upload_div').append('<input type="file" style="display:none;">');
    }

    files = new Array( size_amostras * size_parametros );

    $('#upload_div input[type=file]').eq(count).show();

    matriz_produto_parametros = new Array( size_amostras );

    for (var i = 0; i < size_amostras; i++) {
        matriz_produto_parametros[ i ] = new Array( size_parametros );
    }

    if( size_parametros == 0 ) novaMensagem("erro",'No selected parameter.');
    else 
    {
    	$('#avaliacao').modal();
		$('#avaliacao').modal('show');    
    }
});

$('#next_button').click(function(e){
    
    $("#labelValidacao").remove();


    if( last_json[ 0 ][ array_checked[ i ] ].QUANTITATIVO == 1 )
    {
        $('#div_teste input[name=parametro_quantitativo]').focus();

        var valorCampo = ($('#div_teste input[name=parametro_quantitativo]').val())/1;
       
        
        if(!$.isNumeric(valorCampo)){
            $('#div_teste').attr('class','form-group has-error');
            $('#div_teste input[name=parametro_quantitativo]').attr('class','form-control');
            $('#div_teste').append('<label class="control-label" id="labelValidacao">Valor inválido!</label>');
            $('#div_teste input[name=parametro_quantitativo]').select();
        }else if( valorCampo == ""){
            $('#div_teste').attr('class','form-group has-error');
            $('#div_teste input[name=parametro_quantitativo]').attr('class','form-control');
            $('#div_teste').append('<label class="control-label" id="labelValidacao">Preencha o campo!</label>');
            $('#div_teste input[name=parametro_quantitativo]').select();
        }else if(valorCampo < last_json[ 0 ][ array_checked[ i ] ].MIN || valorCampo > last_json[ 0 ][ array_checked[ i ] ].MAX){
            $('#div_teste').attr('class','form-group has-error');
            $('#div_teste input[name=parametro_quantitativo]').attr('class','form-control');
            $('#div_teste').append('<label class="control-label" id="labelValidacao">Valor inválido!</label>');
            $('#div_teste input[name=parametro_quantitativo]').select();
        }else{
            $('#div_teste').removeAttr('class');
            if( files[ count ] )
            {

                matriz_produto_parametros[ j ][ i ] = { 
                    value : $('#div_teste input[name=parametro_quantitativo]').val(),
                    file : files[ count ].name,
                    comment : $('#comentario').val()
                };
            }
            else
            {
                matriz_produto_parametros[ j ][ i ] = { 
                    value : $('#div_teste input[name=parametro_quantitativo]').val(),
                    file : "",
                    comment : $('#comentario').val()
                };    
            }

            i++;
            count++;
            if(  i > array_checked.length - 1  )
            {

                i = 0;
                j++;
            }

            $('#upload_div input[type=file]').eq(count).show();
            $('#upload_div input[type=file]').eq(count - 1).hide();

            $('#avaliacao').modal('hide');

            if(  count > array_checked.length * last_json[ 1 ].length - 1  )
            {
                
                $('#finalizar').modal('show');

            }
            else
            {
                
                $('#avaliacao').modal('show');

            }
            $('#div_teste input[name=parametro_quantitativo]').focus();

        }
        
        
    }
    else
    {

        //  if (!$("input[type='radio']").is(':checked') ){
        //     alert("Nenhum valor selecionado!");
                
        
        
        // }else{

            
        if( files[ count ] )
                {
                     
                    matriz_produto_parametros[ j ][ i ] = { 
                        value : $('#div_teste input[name=parametro_qualitativo]:checked').val(),
                        file: files[ count ].name,
                        comment : $('#comentario').val()
                    };
                }
                else
                {
                    matriz_produto_parametros[ j ][ i ] = { 
                        value : $('#div_teste input[name=parametro_qualitativo]:checked').val(),
                        file: "",
                        comment : $('#comentario').val()
                    };

                }

                i++;
                count++;
                if(  i > array_checked.length - 1  )
                {

                    i = 0;
                    j++;
                }

                $('#upload_div input[type=file]').eq(count).show();
                $('#upload_div input[type=file]').eq(count - 1).hide();

                $('#avaliacao').modal('hide');

                if(  count > array_checked.length * last_json[ 1 ].length - 1  )
                {
                    
                    $('#finalizar').modal('show');

                }
                else
                {
                    
                    $('#avaliacao').modal('show');

                }
                $('#div_teste input[name=parametro_quantitativo]').focus();
            }
//    }


   
});

$('#back_button, #finalizar_back_button').click(function(e){
   
    i--;
    count--;
    if(  i < 0  )
    {

        i = array_checked.length - 1;
        j--;
    }

    $('#upload_div input[type=file]').eq(count).show();
    $('#upload_div input[type=file]').eq(count + 1).hide();


    $('#avaliacao').modal('hide');

	$('#avaliacao').modal();
	$('#avaliacao').modal('show');
    
});

$(document).on("click", ".valores_button", function(){
   var indexRow = $(this).closest('tr')[0].sectionRowIndex;
   var cod_parametro = last_json[ 0 ][ indexRow ].COD_PAR_AVALIACAO;
   var obrigatorio = last_json[ 0 ][ indexRow ].OBRIGATORIO;

   var amostras = [];

    for (var i = 0; i < last_json[ 1 ].length; i++) {
        amostras.push( last_json[ 1 ][ i ].COD_AMOSTRA );
    }

   $('#leituras_table tbody').empty();

   $.ajax({
            url: "../control/busca_valores_leituras_feitas.php",
            type: 'post',
            dataType: 'json',
            data: { 
                cod_parametro : cod_parametro,
                obrigatorio : obrigatorio,
                amostras : amostras,
                ensaio : $("#select_ensaio").val()
             },
            success: function (data) {   

                $('#leitura_label').text( last_json[0][ indexRow ].PARAMETRO_AVALIACAO );
               
                $.each(data, function (i) {
                    
                    var nome_produto = last_json[ 1 ][ i ].PRODUTO_NOME == null ? 'Testemunha' : last_json[ 1 ][ i ].PRODUTO_NOME;

                    $.each(data[ i ], function (j) {
                        if( j == 0 )
                        {
                            if( i % 2 === 0 )
                            {
                                $("#leituras_table").find('tbody')
                                .append($('<tr style="background:#D6E9C6;">')
                                    .append($('<td>').html( '<b>' + nome_produto + '</b>' ) )
                                    .append($('<td>').text( j ) )
                                    .append($('<td>').text( data[i][j].LEITURA_VALOR ))
                                    .append($('<td>').text( data[i][j].DATA_LEITURA ))
                                    .append($('<td>').text( data[i][j].COMENTARIO ))
                                    .append($('<td>').html( '<a href="../uploads/' + data[i][j].PATH + '" target="_blank" ><img src="../uploads/' + data[i][j].PATH + '" alt="" style="width:100px;" /></a>' ))
                                );
                            }
                            else
                            {
                                $("#leituras_table").find('tbody')
                                .append($('<tr>')
                                    .append($('<td>').html( '<b>' + nome_produto + '</b>' ) )
                                    .append($('<td>').text( j ) )
                                    .append($('<td>').text( data[i][j].LEITURA_VALOR ))
                                    .append($('<td>').text( data[i][j].DATA_LEITURA ))
                                    .append($('<td>').text( data[i][j].COMENTARIO ))
                                    .append($('<td>').html( '<a href="../uploads/' + data[i][j].PATH + '" target="_blank" ><img src="../uploads/' + data[i][j].PATH + '" alt="" style="width:100px;" /></a>' ))
                                );

                            }

                        }
                        else
                        {
                            if( i % 2 === 0 )
                            {
                                $("#leituras_table").find('tbody')
                                .append($('<tr style="background:#D6E9C6;">')
                                    .append($('<td>').text('') )
                                    .append($('<td>').text( j ) )
                                    .append($('<td>').text( data[i][j].LEITURA_VALOR ))
                                    .append($('<td>').text( data[i][j].DATA_LEITURA ))
                                    .append($('<td>').html( '<a href="../uploads/' + data[i][j].PATH + '" target="_blank"><img src="../uploads/' + data[i][j].PATH + '" alt="" style="width:100px;" /></a>' ))
                                );
                            }
                            else
                            {
                                $("#leituras_table").find('tbody')
                                .append($('<tr>')
                                    .append($('<td>').text('') )
                                    .append($('<td>').text( j ) )
                                    .append($('<td>').text( data[i][j].LEITURA_VALOR ))
                                    .append($('<td>').text( data[i][j].DATA_LEITURA ))
                                    .append($('<td>').html( '<a href="../uploads/' + data[i][j].PATH + '" target="_blank" ><img src="../uploads/' + data[i][j].PATH + '" alt="" style="width:100px;" /></a>' ))
                                );

                            }
                        }
                            
                    })
             
                })

                $('#leituras').modal('show');
                
            }
     
    });
    
});

