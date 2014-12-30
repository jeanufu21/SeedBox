<?php

include_once '../model/campo_ensaio_set_model.php';
include_once '../dao/campo_ensaio_set_dao.php';

include_once '../dao/especie_parametrosespecie_dao.php';
include_once '../model/especie_parametrosespecie_model.php';

include_once '../dao/amostra_produto_marca_fase_dao.php';
include_once '../model/amostra_produto_marca_fase_model.php';

include_once '../dao/grupoavaliativo_set_parametros_especie_dao.php';
include_once '../model/grupoavaliativo_set_parametros_especie_model.php';

include_once '../dao/controle_leitura_dao.php';
include_once '../model/controle_leitura_model.php';

include_once '../auxiliar/gerador_pdf.php';

header('Content-Type: application/pdf');   

$campo_ensaio_set_dao = new campo_ensaio_set_dao();
$stmt_pdf = $campo_ensaio_set_dao->busca($_POST['campo'], $_POST['ensaio'] );
$dado_pdf = $stmt_pdf->fetch(PDO::FETCH_ASSOC);


$campo_ensaio_set_model = new campo_ensaio_set_model();
$campo_ensaio_set_model->setCidade($dado_pdf['CIDADE']);
$campo_ensaio_set_model->setUf($dado_pdf['UF']);
$campo_ensaio_set_model->setLatitude($dado_pdf['LATITUDE']);
$campo_ensaio_set_model->setLongitude($dado_pdf['LONGITUDE']);
$campo_ensaio_set_model->setAltitude($dado_pdf['ALTITUDE']);
$campo_ensaio_set_model->setProduto_testemunha($dado_pdf['PRODUTO_TESTEMUNHA']);
$campo_ensaio_set_model->setData_semeio($dado_pdf['DATA_SEMEIO']);
$campo_ensaio_set_model->setData_transplante($dado_pdf['DATA_TRANSPLANTE']);
$campo_ensaio_set_model->setData_colheita($dado_pdf['DATA_COLHEITA']);
$campo_ensaio_set_model->setQuantidade_amostras($dado_pdf['QUANTIDADE_AMOSTRAS']);
$campo_ensaio_set_model->setEmpresa($dado_pdf['EMPRESA']);
$campo_ensaio_set_model->setProdutor($dado_pdf['PRODUTOR']);
$campo_ensaio_set_model->setResponsavel($dado_pdf['RESPONSAVEL']);
$campo_ensaio_set_model->setSupervisor($dado_pdf['SUPERVISOR']);
$campo_ensaio_set_model->setAvaliador($dado_pdf['AVALIADOR']);
$campo_ensaio_set_model->setValores_set($dado_pdf['VALORES_SET']);
$campo_ensaio_set_model->setCod_set_valores($dado_pdf['COD_SET_VALORES']);

$lista = explode('#', $dado_pdf['VALORES_SET']);

$especie_parametrosespecie_dao = new especie_parametrosespecie_dao();
$stmt = $especie_parametrosespecie_dao->busca($lista[0]);

$lista_especie_patrametrosespecie_model = array();

while( $dado = $stmt->fetch(PDO::FETCH_ASSOC) )
{
    $especie_parametrosespecie_model = new especie_parametrosespecie_model();
    $especie_parametrosespecie_model->setEspecie( $dado['ESPECIE'] );
    $especie_parametrosespecie_model->setNome_par_especie($dado['NOME_PAR_ESPECIE']);
    
    $lista_especie_patrametrosespecie_model[] = $especie_parametrosespecie_model;
}

$amostra_produto_marca_fase_model = new amostra_produto_marca_fase_dao();
$stmt3 = $amostra_produto_marca_fase_model->busca($_POST['ensaio'], $campo_ensaio_set_model->getCod_set_valores());


$lista_amostra_produto_marca_fase_model = array();

while( $dado = $stmt3->fetch(PDO::FETCH_ASSOC) )
{
    $amostra_produto_marca_fase_model = new amostra_produto_marca_fase_model();
    
    $amostra_produto_marca_fase_model->setProduto_nome($dado['PRODUTO_NOME']);
    $amostra_produto_marca_fase_model->setPedigree_original($dado['PEDIGREE_ORIGINAL']);
    $amostra_produto_marca_fase_model->setPedigree_nacional($dado['PEDIGREE_BRASIL']);
    $amostra_produto_marca_fase_model->setNro_estaca($dado['NRO_ESTACA']);
    
    $lista_amostra_produto_marca_fase_model[] = $amostra_produto_marca_fase_model;
}

$grupoavaliativo_set_parametros_especie_dao = new grupoavaliativo_set_parametros_especie_dao();
$controle_leitura_dao = new Controle_Leitura_DAO();

$stmt4 = $grupoavaliativo_set_parametros_especie_dao->busca( $campo_ensaio_set_model->getCod_set_valores() );

$lista_grupoavaliativo_set_parametros_especie_model = array();

while( $dado = $stmt4->fetch(PDO::FETCH_ASSOC) )
{
    $grupoavaliativo_set_parametros_especie_model = new grupoavaliativo_set_parametros_especie_model();
    
    $grupoavaliativo_set_parametros_especie_model->setObrigatorio($dado['OBRIGATORIO']);
    $grupoavaliativo_set_parametros_especie_model->setNro_avaliacoes($dado['NRO_AVALIACOES']);
    $grupoavaliativo_set_parametros_especie_model->setParametro_avaliacao($dado['PARAMETRO_AVALIACAO']);
    $grupoavaliativo_set_parametros_especie_model->setQuantitativo($dado['QUANTITATIVO']);
    $grupoavaliativo_set_parametros_especie_model->setObservacao($dado['OBSERVACAO']);

    $stmt5 = $controle_leitura_dao->busca( $dado['COD_PAR_AVALIACAO'], $dado['OBRIGATORIO'], $_POST['ensaio'] );

    if( $dado2 = $stmt5->fetch(PDO::FETCH_ASSOC) )
    {
        $grupoavaliativo_set_parametros_especie_model->setLeituras_feitas( $dado2['LEITURAS_FEITAS'] );

    }
    else
    {
        $grupoavaliativo_set_parametros_especie_model->setLeituras_feitas( 0 );

    }
    
    
    $lista_grupoavaliativo_set_parametros_especie_model[] = $grupoavaliativo_set_parametros_especie_model;
}





while( $dado = $stmt5->fetch(PDO::FETCH_ASSOC) )
{
    $controle_leitura_model = new controle_leitura();
    
    $controle_leitura_model->setCod_par_avaliacao($dado['COD_PAR_AVALIACAO']);
    $controle_leitura_model->setObrigatorio($dado['OBRIGATORIO']);
    $controle_leitura_model->setLeituras_feitas($dado['LEITURAS_FEITAS']);
    
    $lista_controle_leitura_model[] = $controle_leitura_model;
}



$gerador_pdf = new gerador_pdf($campo_ensaio_set_model, $lista_especie_patrametrosespecie_model,  $lista_amostra_produto_marca_fase_model, $lista_grupoavaliativo_set_parametros_especie_model);
$gerador_pdf->gerar();

?>
