
$(document).ready(function (e) {

    checkURL();
    // função que varre o menu de acordo com o item que foi clicado e 
    // faz uma chamada ajax via Jquery para os arquivos respectivios ao menu.

    $("#menu a").on("click", function () {

        var nome = $(this).attr("href");
        // var  id = $("input[type=hidden]").attr("id");
        loadPage(nome);
    });

});   // fim do document

function checkURL(hash) {
    if(!hash) hash=window.location.hash;    //if no parameter is provided, use the hash value from the current address
    
    if(hash!="")
        loadPage(hash);
}

function loadPage(nome){
  // teste para todos os links de perfil e historico
        if (nome == "#perfil")
            $("#corp").load("../view/view_perfil.php");

        else if (nome == "#historico")
            $("#corp").load("../view/view_historico.php");


        // testes para todos os links de cadastro
        if (nome == "#parceiros")
            $("#corp").load("../view/view_parceiro.php");
        else if (nome == "#produto")
            $("#corp").load("../view/view_produto.php");
        else if (nome == "#avaliacao")
            $("#corp").load("../view/view_trialgroups.php");
        else if (nome == "#configuracao")
            $("#corp").load("../view/view_parametros.php");
        else if (nome == "#cadastro_especie")
            $("#corp").load("../view/view_especie.php");
        else if (nome == "#marca")
            $("#corp").load("../view/view_marca.php");
        else if (nome == "#campo")
            $("#corp").load("../view/view_campo.php");


        // teste para todas as consultas
        if (nome == "#busca_produto")
            $("#corp").load("../view/view_consulta_produto.php");
        if (nome == "#buscas_estoque")
            $("#corp").load("../view/view_consulta_estoque.php");
        if (nome == "#busca_marca")
            $("#corp").load("../view/view_consulta_marca.php");
        if (nome == "#busca_gerente")
            $("#corp").load("../view/view_consulta_gerente.php");
        if (nome == "#busca_usuario")
            $("#corp").load("../view/view_consulta_user.php");
        if (nome == "#busca_parceiro")
            $("#corp").load("../view/view_consulta_parceiro.php");
        if (nome == "#busca_campo")
            $("#corp").load("../view/view_consulta_campo.php");

        // teste para configurações
        if (nome == "#cadastro_user")
            $("#corp").load("../view/view_CadastroUser.php");

        // teste para pedidos
        if (nome == "#pedidos")
            $("#corp").load("../view/view_pedido.php");
        if (nome == "#caixa_pedidos")
            $("#corp").load("../view/view_pedido_consolidado.php");

        if (nome == "#nota_fiscal")
            $("#corp").load("../view/view_notaFiscal.php");
        if (nome == "#nota_fiscal_entrada")
            $("#corp").load("../view/nota_fiscal_view_entrada.php");
        if (nome == "#detalhes_pedido")
            $("#corp").load("../view/view_detalhes_pedido.php");

        // teste para avaliações
        if (nome == "#pdf")
            $("#corp").load("../view/view_pdf.php");
        else if (nome == "#data_semeio_ensaio")
            $("#corp").load("../view/view_data_semeio_ensaio.php");
        else if (nome == "#cancelar_ensaio")
            $("#corp").load("../view/view_cancelar_ensaio.php");
        else if (nome == "#avaliacao_ensaio")
            $("#corp").load("../view/view_Avaliacao.php");
        else if (nome == "#ensaio_perdido")
            $("#corp").load("../view/view_ensaio_perdido.php");    
}