<?php

class ensaio {
    private $cod_ensaio;
    private $cod_set_valores;
    private $cod_campo;
    private $data_semeio;
    private $data_transplante;
    private $data_colheita;
    private $cod_prod_check;
    private $quantidade_amostra;
    private $quantidade_semente;
    private $repeticao;
    private $empresa;
    private $produtor;
    private $responsavel;
    private $supervisor;
    private $avaliador;
    private $status;
    
    public function getCod_ensaio() {
        return $this->cod_ensaio;
    }

    public function setCod_ensaio($cod_ensaio) {
        $this->cod_ensaio = $cod_ensaio;
    }

    public function getCod_set_valores() {
        return $this->cod_set_valores;
    }

    public function setCod_set_valores($cod_set_valores) {
        $this->cod_set_valores = $cod_set_valores;
    }
    public function getCod_campo() {
        return $this->cod_campo;
    }

    public function setCod_campo($cod_campo) {
        $this->cod_campo = $cod_campo;
    }

    public function getData_semeio() {
        return $this->data_semeio;
    }

    public function setData_semeio($data_semeio) {
        $this->data_semeio = $data_semeio;
    }

    public function getData_transplante() {
        return $this->data_transplante;
    }

    public function setData_transplante($data_transplante) {
        $this->data_transplante = $data_transplante;
    }

    public function getData_colheita() {
        return $this->data_colheita;
    }

    public function setData_colheita($data_colheita) {
        $this->data_colheita = $data_colheita;
    }

    public function getCod_prod_check() {
        return $this->cod_prod_check;
    }

    public function setCod_prod_check($cod_prod_check) {
        $this->cod_prod_check = $cod_prod_check;
    }

    public function getQuantidade_amostra() {
        return $this->quantidade_amostra;
    }

    public function setQuantidade_amostra($quantidade_amostra) {
        $this->quantidade_amostra = $quantidade_amostra;
    }

    public function getQuantidade_semente() {
        return $this->quantidade_semente;
    }

    public function setQuantidade_semente($quantidade_semente) {
        $this->quantidade_semente = $quantidade_semente;
    }

    public function getRepeticao() {
        return $this->repeticao;
    }

    public function setRepeticao($repeticao) {
        $this->repeticao = $repeticao;
    }

    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }

    public function getProdutor() {
        return $this->produtor;
    }

    public function setProdutor($produtor) {
        $this->produtor = $produtor;
    }

    public function getResponsavel() {
        return $this->responsavel;
    }

    public function setResponsavel($responsavel) {
        $this->responsavel = $responsavel;
    }

    public function getSupervisor() {
        return $this->supervisor;
    }

    public function setSupervisor($supervisor) {
        $this->supervisor = $supervisor;
    }

    public function getAvaliador() {
        return $this->avaliador;
    }

    public function setAvaliador($avaliador) {
        $this->avaliador = $avaliador;
    }
   public function setStatus($stat) {

        $this->status = $stat;
    }

    public function getStatus() {
        return $this->status;
    }


}

?>
