<?php 
/*
Title:Controle para construir os parametros de especie dinamicamente
Author:Jean Fabrício
Date:  22/02/2014
*/
include_once("../dao/param_especie_dao.php");
include_once("../dao/valor_param_dao.php");

$paramDao = new Param_EspecieDao();
$valorDao = new ValorParamDao();

$stmt = $paramDao->buscaParam("COD_ESPECIE",$_POST['especie_busca']);
$cont = 0;
/*	
cont é um gerenciador que determina que a cada tres loops
uma nova div form-group é gerada para padronizar o layout 
da pagina do via bootstrap
*/
while($_bd2 = $stmt->fetch(PDO::FETCH_ASSOC))
{
	if($cont == 0)
{
	echo "<div class='form-group'>";
}
$cont++;
echo "<div class='col-sm-2 dinamico' >
<label for='".$_bd2['NOME_PAR_ESPECIE']."'  style = 'text-align: center;' class='col-sm-12 control-label'>".$_bd2['NOME_PAR_ESPECIE']."</label>
					    <select class='form-control' name='".$_bd2['NOME_PAR_ESPECIE']."'>";	
/*	
	 Abaixo é realizada uma consulta no banco para cada iteração do while acima, assim
	 por exemplo o while retorna o id do parametro e essa consulta busca todos os valores
	 para aquele id e cria os options com esses valores dentro do mesmo select.

*/
	$query = $valorDao->busca_valores($_bd2['COD_PAR_ESPECIE']);
	while($_bd3 = $query->fetch(PDO::FETCH_ASSOC))
	{
		echo "<option>".$_bd3['VALOR']."</option>";
	}
	
	echo  "</select>
			</div>";

if($cont == 4)// fim da div form-group
{
	echo "</div>";
	$cont = 0;
}

}// script que seleciona todos as especies do banco e mostra elas na view

?>