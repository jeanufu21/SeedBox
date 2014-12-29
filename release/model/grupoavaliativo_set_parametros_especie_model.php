<?php

class grupoavaliativo_set_parametros_especie_model {
    private $cod_set_valores;
    private $cod_par_avaliacao;
    private $cod_especie;
    private $obrigatorio;
    private $min;
    private $max;
    private $nro_avaliacoes;
    private $observacao;
    private $valores_set;
    private $parametro_avaliacao;
    private $quantitativo;
    private $especie;
    private $data_cadastro;
    private $leituras_feitas;

    public function getCod_set_valores() {
        return $this->cod_set_valores;
    }

    public function setCod_set_valores($cod_set_valores) {
        $this->cod_set_valores = $cod_set_valores;
    }

    public function getCod_par_avaliacao() {
        return $this->cod_par_avaliacao;
    }

    public function setCod_par_avaliacao($cod_par_avaliacao) {
        $this->cod_par_avaliacao = $cod_par_avaliacao;
    }

    public function getCod_especie() {
        return $this->cod_especie;
    }

    public function setCod_especie($cod_especie) {
        $this->cod_especie = $cod_especie;
    }

    public function getObrigatorio() {
        return $this->obrigatorio;
    }

    public function setObrigatorio($obrigatorio) {
        $this->obrigatorio = $obrigatorio;
    }

    public function getMin() {
        return $this->min;
    }

    public function setMin($min) {
        $this->min = $min;
    }

    public function getMax() {
        return $this->max;
    }

    public function setMax($max) {
        $this->max = $max;
    }

    public function getNro_avaliacoes() {
        return $this->nro_avaliacoes;
    }

    public function setNro_avaliacoes($nro_avaliacoes) {
        $this->nro_avaliacoes = $nro_avaliacoes;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getValores_set() {
        return $this->valores_set;
    }

    public function setValores_set($valores_set) {
        $this->valores_set = $valores_set;
    }

    public function getParametro_avaliacao() {
        return $this->parametro_avaliacao;
    }

    public function setParametro_avaliacao($parametro_avaliacao) {
        $this->parametro_avaliacao = $parametro_avaliacao;
    }

    public function getQuantitativo() {
        return $this->quantitativo;
    }

    public function setQuantitativo($quantitativo) {
        $this->quantitativo = $quantitativo;
    }

    public function getEspecie() {
        return $this->especie;
    }

    public function setEspecie($especie) {
        $this->especie = $especie;
    }

    public function getData_cadastro() {
        return $this->data_cadastro;
    }

    public function setData_cadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

    public function getLeituras_feitas() {
        return $this->leituras_feitas;
    }

    public function setLeituras_feitas( $leituras_feitas ) {
        $this->leituras_feitas = $leituras_feitas;
    }
   
}

?>
