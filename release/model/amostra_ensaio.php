<?php

// Possivelmente não esta sendo usada



class amostra_ensaio {
    private $cod_amostra;
    private $cod_produto;
    private $cod_ensaio;
    private $nro_estaca;
    private $quantidade_sementes;
    
    public function getCod_amostra() {
        return $this->cod_amostra;
    }
    public function setCod_amostra($cod_amostra) {
        $this->cod_amostra = $cod_amostra;
    }

    public function getCod_produto() {
        return $this->cod_produto;
    }

    public function setCod_produto($cod_produto) {
        $this->cod_produto = $cod_produto;
    }

    public function getCod_ensaio() {
        return $this->cod_ensaio;
    }

    public function setCod_ensaio($cod_ensaio) {
        $this->cod_ensaio = $cod_ensaio;
    }

    public function getNro_estaca() {
        return $this->nro_estaca;
    }

    public function setNro_estaca($nro_estaca) {
        $this->nro_estaca = $nro_estaca;
    }

    public function getQuantidade_sementes() {
        return $this->quantidade_sementes;
    }

    public function setQuantidade_sementes($quantidade_sementes) {
        $this->quantidade_sementes = $quantidade_sementes;
    }

}

?>
