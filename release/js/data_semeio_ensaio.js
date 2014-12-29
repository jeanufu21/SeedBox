$(document).ready(function() {

$(".data-picker").datepicker(
    {
        autoSize:true,
        changeMonth:true,
        changeYear:true,
    });

    $.ajax({
            url: "../control/busca_campo.php?estado=0",
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
            url: "../control/busca_ensaio.php?estado=0",
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
    
});


$( "#select_campo" ).change(function() {
	$("#select_ensaio").empty();

	ajax_campo = $("option:selected", this).val();
	
	$.ajax({
            url: "../control/busca_ensaio.php?estado=0",
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

$( "#cadastra_data_semeio").click( function() {
    ajax_ensaio = $("#select_ensaio option:selected").val();
    ajax_date = $('#date').val();

    $.ajax({
            url: '../control/cadastra_data_semeio_ensaio.php',
            type: 'post',
            data: {
                ensaio : ajax_ensaio,
                data_semeio : ajax_date
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