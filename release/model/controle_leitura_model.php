<?php

class controle_leitura {
    private $cod_par_avaliacao;
    private $obrigatorio;
    private $cod_ensaio;
    private $leituras_feitas;


    public function getCod_par_avaliacao() {
        return $this->cod_par_avaliacao;
    }

    public function setCod_par_avaliacao($cod_par_avaliacao) {
        $this->cod_par_avaliacao = $cod_par_avaliacao;
    }

    public function getObrigatorio() {
        return $this->obrigatorio;
    }

    public function setObrigatorio($obrigatorio) {
        $this->obrigatorio = $obrigatorio;
    }

    public function getCod_ensaio() {
        return $this->cod_ensaio;
    }

    public function setCod_ensaio($cod_ensaio) {
        $this->cod_ensaio = $cod_ensaio;
    }

    public function getLeituras_feitas() {
        return $this->leituras_feitas;
    }

    public function setLeituras_feitas($leituras_feitas) {
        $this->leituras_feitas = $leituras_feitas;
    }


}

?>
