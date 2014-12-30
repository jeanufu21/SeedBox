<?php

//include_once '../modelo/modelo_pdf.php';
include_once '../resource/html2pdf/html2pdf.class.php';

include_once '../model/campo_ensaio_set_model.php';
include_once '../model/especie_parametrosespecie_model.php';
include_once '../model/amostra_produto_marca_fase_model.php';

include_once '../model/produto_model.php';
include_once '../model/parametro_avaliacao_model.php';

class gerador_pdf {
    private $capa_pdf;
    private $lista_especie_patrametrosespecie_model;
    private $lista_amostra_produto_marca_fase_model;
    private $lista_grupoavaliativo_set_parametros_especie_model;
    
    function __construct($capa_pdf, $lista_especie_patrametrosespecie_model, $lista_amostra_produto_marca_fase_model, $lista_grupoavaliativo_set_parametros_especie_model) {
        $this->capa_pdf = $capa_pdf;
        $this->lista_especie_patrametrosespecie_model = $lista_especie_patrametrosespecie_model;
        $this->lista_amostra_produto_marca_fase_model = $lista_amostra_produto_marca_fase_model;
        $this->lista_grupoavaliativo_set_parametros_especie_model = $lista_grupoavaliativo_set_parametros_especie_model;
    }
    
     
    function gerar() {
        
        $pdf = new HTML2PDF('P', 'A4', 'pt', true, 'UTF-8', array(0, 0, 0, 0));
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->writeHTML( $this->criaCapa() );
        $pdf->writeHTML( $this->criaResumo() );
        $pdf->writeHTML( $this->criaAvaliacao() );
        $pdf->Output();
    }
    
    
    private function criaCapa() {
        ob_start();
        include('pdf_res/capa.php');
        return ob_get_clean();
    }
    
    private function criaResumo() {
        ob_start();
        include('pdf_res/resumo.php');
        return ob_get_clean();
    }
    
    private function criaAvaliacao() {
        ob_start();
        include('pdf_res/avaliacao.php');
        return ob_get_clean();
    }
    
}

?>
