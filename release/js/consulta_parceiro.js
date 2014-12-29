/*
	*	Title: consulta_parceiro.js
	*	Author: Frederico
	*	Date: 17/07/2014
*/

/* Busca todos os parceiros cadastrados e exibe ao entrar na pagina */
$(document).ready(function () {
    getAllPartners();
});

function getAllPartners() {
    var acao = "getAllPartners";
    $.ajax({
        type: "GET",
        url: "../control/consulta_parceiro_control.php",
        data: "acao=getAllPartners"
    }).done(function (html) {
        $("#exibeParceiros").html(html);
    });
};

$(document).ready(function () {
    $("#updatePartner").on("click", function () {
        var partnerData = $("#partnerData").serializeArray();
        $.ajax({
            type: "POST",
            url: "../control/consulta_parceiro_control.php?acao=updatePartner",
            data: partnerData
        }).done(function (html) {
            if (parseInt(html) == 0) {
                novaMensagem("sucesso", "Partner Successfully Updated!");
                $("#exibeParceiros").empty();
                getAllPartners();
            }
        });
    });
});

$(document).ready(function () {
    $("#searchPartners").on("click", function(){
        var op = $("#searchOp").val();
        if ($("#searchValue").val() != "" && op != 0) {
            $("#exibeParceiros").empty();
            var search = $("#searchMethod").serializeArray();
            $.ajax({
                type: "POST",
                url: "../control/consulta_parceiro_control.php?acao=searchByTerm",
                data: search
            }).done(function (html) {
                if (parseInt(html) == 0) {
                    novaMensagem("erro", "None partner was found!<br> Please verify your search terms!");
                }else{
                    $("#exibeParceiros").html(html);
                }
            });
        } else {
            if ($("#searchValue").val() == "") {
               getAllPartners();
            }
        }
    });
    
    $("#searchValue").on("keyup",function(e){
        if(e.which == 13)
        {
            var op = $("#searchOp").val();
        if ($("#searchValue").val() != "" && op != 0) {
            $("#exibeParceiros").empty();
            var search = $("#searchMethod").serializeArray();
            $.ajax({
                type: "POST",
                url: "../control/consulta_parceiro_control.php?acao=searchByTerm",
                data: search
            }).done(function (html) {
                if (parseInt(html) == 0) {
                    novaMensagem("erro", "None partner was found!<br> Please verify your search terms!");
                }else{
                    $("#exibeParceiros").html(html);
                }
            });
        } else {
            if ($("#searchValue").val() == "") {
               getAllPartners();
            }
        }
        }
    });
});

$(document).ready(function(){
    $("#complement, #telephone1, #telephone2").keyup(function(){
	    justNumbers($(this));	
    });
});

function justNumbers(elem){
	var expre = /[^0-9]/g;
	// REMOVE OS CARACTERES DA EXPRESSAO ACIMA
	if (elem.val().match(expre))
	elem.val(elem.val().replace(expre,''));
};

    $(document).on('click',".editar", function(){
        var linha = $(this).parent().parent().find('td');
        var modalCamps = [
                'name',
                'cpf',
                'cnpj',
                'country',
                'state',
                'city',
                'district',
                'address',
                'complement',
                'cep',
                'email',
                'site',
                'telephone1',
                'telephone2'];

        for(i=0; i<modalCamps.length; i++){
            if(linha.eq(i).text().length > 1){
                $('#'+modalCamps[i]).val(linha.eq(i).text());   
            }else{
                $('#'+modalCamps[i]).val('');
            }
        }

        $('#partnerCod').val($(this).parent().parent().data('partnercod'));
    });

