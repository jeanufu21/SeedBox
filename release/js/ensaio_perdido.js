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
            data: {ensaio:-1},
            success: function (data) {      

                $.each(data, function (i, item) {
                    
                    $('#select_ensaio').append($('<option>', { 
                        value: data[i].COD_ENSAIO,
                        text : data[i].COD_ENSAIO + ' - ' + data[i].VALORES_SET  
                    }));
                });

            }
            
    });
    
});


$( "#select_campo" ).change(function() {
	$("#select_ensaio").empty();

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
    
    ajax_ensaio = $("option:selected", this).val();

    $.ajax({
            url: '../control/busca_campo.php',
            type: 'post',
            dataType: 'json',
            data: {ensaio:ajax_ensaio},
            
            success: function (data) {      

                $('#select_campo').val( data[ 0 ].COD_CAMPO );

            }
            
    });

});

$( "#ensaio_perdido").click( function() {
    ajax_ensaio = $("#select_ensaio option:selected").val();
    ajax_motivo = $('#motivo').val();

    $.ajax({
            url: '../control/ensaio_perdido.php',
            type: 'post',
            data: {
                ensaio : ajax_ensaio,
                motivo : ajax_motivo
            },
            
            success: function (data) {      

                novaMensagem("sucesso","Successful Operation!");

                $("input").each(function(){
                    $(this).val("");

                });
                $("select").val("-1");
                // location.reload();
            }
            
    });    

});