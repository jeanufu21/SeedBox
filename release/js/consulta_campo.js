/*
	*	Title: consulta_campo.js
	*	Author: Frederico
	*	Date: 17/07/2014
*/

/* Busca todos os parceiros cadastrados e exibe ao entrar na pagina */
$(document).ready(function () {
    getAllCamps();
});

function getAllCamps() {
    var acao = "getAllCamps";
    $.ajax({
        type: "GET",
        url: "../control/consulta_campo_control.php",
        data: "acao=getAllCamps"
    }).done(function (html) {
        $("#exibeCampos").html(html);
    });
};


$(document).ready(function () {
    $("#updateCountryside").on("click", function () {

        if(!($("#countrysideData").validationEngine('validate')))
            return 0;
        
        $("#updateCountryside").attr('data-dismiss','modal');

        var countrysideData = $("#countrysideData").serializeArray();
        $.ajax({
            type: "POST",
            url: "../control/consulta_campo_control.php?acao=updateCountryside",
            data: countrysideData
        }).done(function (html) {
            
            if (parseInt(html) == 0) {
            novaMensagem("sucesso", "Countryside Successfully Updated!");
            $("#exibeCampos").empty();
            getAllCamps();
            }
        });
    });
});


$(document).ready(function () {
    $("#searchCountryside").on("click", function () {
        var op = $("#searchOp").val();
        if ($("#searchValue").val() != "" && op != 0) {
            $("#exibeCampos").empty();
            var search = $("#searchMethod").serializeArray();
            $.ajax({
                type: "POST",
                url: "../control/consulta_campo_control.php?acao=searchByTerm",
                data: search
            }).done(function (html) {
                
                if (parseInt(html) == 0) {
                    novaMensagem("erro", "None countryside was found!<br> Please verify your search terms!");
                } else {
                    $("#exibeCampos").html(html);
                }
            });
        } else {
            if (op == 0) {
                novaMensagem("erro", "Please select the search method!");
            } else if ($("#searchValue").val() == "") {
                novaMensagem("erro", "Please fill the search camp!");
            }
        }
    });
});
/*
$(document).ready(function(){
    $("#altitude, #latitude, #longitude").keyup(function(){
	    justNumbers($(this));	
    });
});

function justNumbers(elem){
	var expre = /[^0-9]/g;
	// REMOVE OS CARACTERES DA EXPRESSAO ACIMA
	if (elem.val().match(expre))
	    elem.val(elem.val().replace(expre,''));
};*/