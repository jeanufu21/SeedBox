/*
 *script desenvolvido por Washington Soares Braga 
 * arquivo javascript de confuguração ajax/jquery do projeto form1 
 * 
 * */
function ativaCampo(){
	document.getElementById("exclui").disabled = false;
}
function desativaCampo(){
	document.getElementById("exclui").disabled = true;	
}
function chekbox(){
   elem = document.getElementById("checa");
   qtd = document.getElementsByName("select[]").length;
   if(elem.checked == true){
   	ativaCampo();
   		 for(i=0;i<=qtd;i++){
   		 	document.getElementsByName("select[]")[i].checked = true;
   		 }
   }else{
   	desativaCampo();
   		for(i=0;i<=qtd;i++){
   		 	document.getElementsByName("select[]")[i].checked = false;
   		 }
   }
}


var req;
 
// FUNÇÃO PARA BUSCAR O CAMPO E O VALOR A SER PESQUISADO
function buscarNoticias(valor,dado) {
 
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "../select.php?valor="+valor+"&campo="+dado;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true); 
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
	// Exibe a mensagem "Buscando Noticias..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('sucesso').innerHTML = "carregando...";
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resposta
	document.getElementById('sucesso').innerHTML = resposta;
	}
}
req.send(null);
}

function exibe(){
	document.getElementById("altera").innerHTML = '<input id="alterar" type="submit" class="btn btn-large" value="Alterar" name="altera">';
}
function buscarCampos(id) {
exibe();
// Verificando Browser
if(window.XMLHttpRequest) {
   req = new XMLHttpRequest();
}
else if(window.ActiveXObject) {
   req = new ActiveXObject("Microsoft.XMLHTTP");
}
// Arquivo PHP juntamente com o valor digitado no campo (método GET)
var url = "../campos.php?id="+id;
 
// Chamada do método open para processar a requisição
req.open("Get", url, true); 
 
// Quando o objeto recebe o retorno, chamamos a seguinte função;
req.onreadystatechange = function() {
 
	// Exibe a mensagem "Buscando ..." enquanto carrega
	if(req.readyState == 1) {
		document.getElementById('box-campos').innerHTML = "carregando...";
	}
 
	// Verifica se o Ajax realizou todas as operações corretamente
	if(req.readyState == 4 && req.status == 200) {
 
	// Resposta retornada pelo busca.php
	var resposta = req.responseText;
 
	// Abaixo colocamos a(s) resposta(s) na div resultado
	document.getElementById('box-campos').innerHTML = resposta;
	}
}
req.send(null);
}