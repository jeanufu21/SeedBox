/*
		Title:Jquery para a tela de Criação de Pedido
		Author:Jean Fabrício
		Date: 04/03/2014
*/

$(document).ready(function () {

    /*
    * função 1: Realiza a consulta no banco e mostra uma caixa de sugestão
    para o usuario, está divida em duas partes:
    1 - faz uma consulta no banco retornando os produtos associados
    a especies que o gerente em questão administra.
    2 - logo após que um item seja adicionado no pedido, ele modifica
    a primeira caixa de sugestão para mostrar apenas os produtos que 
    contem o mesmo set de parametros do produto cadastrado no item.

    * função 2: Corresponde a uma caixa de sugestão com os nomes dos parceiros cadastrados no
    sistema.

    * função 3: Cadastra o pedido com os dados informados.

    * função 4: Adiciona dinamicamente os campos dos itens quando clicado no botao +
    e remove quando clicado no botão -
    */


    // função 1
    $(".produto").focusin(function () {
        // essa função foi associada ao focus pois tem duas etapas distintas


        //primeira parte 
        if ($(".subitem").length == 0)// não existe item cadastrado
        {
            codGerente = $("select option:selected").val();

            $.getJSON("../control/json_control.php?gerente=" + codGerente, function (data) {

                // console.log(data);
                var item = [];
                $(data).each(function (key, value) {

                    item.push(value.NOME);
                    // console.log(value.NOME);
                });

                $(".produto").autocomplete({

                      source: item

                  }).autocomplete("widget").addClass("fixed-height");
                        });

                    }
                    else if ($(".subitem").length > 0)// pelo menos um item foi cadastrado
                    {
                        // resgato o valor do primeiro produto cadastrado no item do pedido
                        nomeProduto = $(this).parents("tr").next('tr').children('th').children('label:first').text();

                        $.getJSON("../control/json_control.php?produto=" + nomeProduto, function (data) {

                            // console.log(data);
                            var item2 = [];
                            $(data).each(function (key, value) {

                                item2.push(value.NOME);
                                // console.log(value.NOME);
                            });

                $(".produto").autocomplete(
          {
              source: item2


          }).autocomplete("widget").addClass("fixed-height");
            });
        }

    }); // fim da função


    // =============================   função 2    =================================


    $.getJSON("../control/json_control.php?jsonParceiro=true", function (data) {

        // console.log(data);
        var item = [];
        $(data).each(function (key, value) {

            item.push(value.NOME);
            // console.log(value.NOME);
        });

        validacaoParc = false;
        $("#parceiro_busca").autocomplete(
          {
              source: item,
              change: function (event, ui) {
                  if (!ui.item) {
                      validacaoParc = false;

                  }
                  else
                      validacaoParc = true;
              }


          }).autocomplete("widget").addClass("fixed-height");
    }); // fim da função

    //============================        função 3      ===========================


    $("#save_pedido").on("click", function () {



        var vazio = false;

        $(".head_nota input").each(function () {

            if ($(this).val() == "")
                vazio = true;

        });

        if ($("select").val() == "")
            vazio = true;

        if (vazio) {
            novaMensagem("erro", "Fill out all fields!");
            return 0;
        }
        else {
            if ($(".subitem ").length == 0) {
                novaMensagem("erro", "Please enter the order items!");
                return 0;
            }
        }
        if (validacaoParc) {
            var valores = $("form").serializeArray();
            ativaProgressBar();
            $.ajax({

                type: "POST",
                url: "../control/pedido_control.php",
                data: valores

            }).done(function (html) {

                // $("#saida").append(html);
                //alert(html);
                if (parseInt(html, 10) == 0) {
                    novaMensagem("erro", "Could not ask for request!");
                }

                //Verificar com o Tacio o retorno da função de envio de email -Verificar retorno do post do pedidoControl -
                if (parseInt(html, 10) == 1) {
                    novaMensagem("sucesso", "Requested order!");
                    // limpa todos os inputs menos o dataAtual que vem do sistema
                    $("input:not('.dataAtual')").each(function () {

                        $(this).val('');
                    });
                    //limpa todos os campos itens gerados dinamicamente
                    $(".subitem").each(function () {
                        $(this).remove();
                    });
                }
                if (parseInt(html, 10) == 2) {
                    novaMensagem("erro", "Failed: None existent Products!");
                }
                finalizaProgressBar();

            });
        }
        else
            novaMensagem("erro", "None existent Partner!");


    }); // fim da função

    //=============================        função 4	       =============================
    $("#add").on("click", function () {

        /* 

        Array 'valores = []' com os valores [Produto, Quantidade, Medida]
        digitados pelo usuario para serem adicionados na tabela itens da pagina

        */

        valores = [];

        $("#novos_campos input").each(function () {

            valores.push($(this).val());

        });

        if (valores[0] == 0){
            novaMensagem("erro", "Fill: Product Name");
            return 0;
        }
        // crio as linhas da tabela
        html = "<tr id='iten' class='subitem'>" +
						"<th>" +
							"<input type='hidden' class='form-control produto' readonly='readonly' name='produto[]' value='" + valores[0] + "'>" +
							"<label  class='col-sm-6 control-label' >" + valores[0] + "</label>" +
						"</th>" +
						"<th>" +
							"<input type='hidden' class='form-control produto' readonly='readonly' name='quantidade[]' value='" + valores[1] + "'>" +
							"<label  class='col-sm-6 control-label' >" + valores[1] + "</label>" +
						"</thi>" +
						"<th>" +
							"<input type='hidden' class='form-control produto' readonly='readonly' name='medida[]' value='" + $("#medida").val() + "'>" +
							"<label  class='col-sm-6 control-label' >" + $("#medida").val() + "</label>" +
						"</th>" +
						"<th><span class='fa fa-times icon_black fechar' onclick='remover(this)'></span></th>" +
					"</tr>";
        // ultimo corresponde ao botão de deletar item 'X'

        // limpa os campos 
        $("#novos_campos").append(html);

        $("#novos_campos tr:first input").each(function () {
            $(this).val("");
        });

    }); // fim da função


    $(".somenteNumero").bind("keyup", function () {
        var expre = /[^0-9]/g;

        // REMOVE OS CARACTERES DA EXPRESSAO ACIMA
        if ($(this).val().match(expre))
            $(this).val($(this).val().replace(expre, ''));
    });



});         //fim do document

function remover(dom)
	{
		/*
			Função remover remove  os campos adicionados e decrementa seu contador
			para ajustar o numero maximo de campos que é 4.
		*/
		$(dom).parents('tr').remove();
	
	}

var myVar;

function ativaProgressBar(){
    $(document).ready(function () {
        $("#prog").slideDown();
        myVar = 100;
        setInterval(function () {
            var valorAtual = parseInt($("#progressBar").attr("aria-valuenow"));
            if (valorAtual  < 90) {
                valorAtual++;
                $("#progressBar").attr("aria-valuenow", valorAtual);
                $("#progressBar").css("width", valorAtual + "%");
                $("#progressBar").text(valorAtual + "%");
            } else {
                clearInterval(myVar);
            }
        }, myVar);
    });
}
function finalizaProgressBar(){
    $(document).ready(function () {
        $("#progressBar").attr("aria-valuenow", "100");
        $("#progressBar").css("width", "100%");
        $("#progressBar").text("100%");
        clearInterval(myVar);
    });
}