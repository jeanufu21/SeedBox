<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of capa_pdf_model
 *
 * @author Luiz
 */
class campo_ensaio_set_model {
    private $cod_campo;
    private $cod_ensaio;
    private $cod_set_valores;
    private $cidade;
    private $uf;
    private $latitude;
    private $longitude;
    private $altitude;
    private $produto_testemunha;
    private $data_semeio;
    private $data_transplante;
    private $data_colheita;
    private $quantidade_amostras;
    private $empresa;
    private $produtor;
    private $responsavel;
    private $supervisor;
    private $avaliador;
    private $valores_set;
    
    public function getCod_campo() {
        return $this->cod_campo;
    }

    public function setCod_campo($cod_campo) {
        $this->cod_campo = $cod_campo;
    }

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

    public function getCidade() {
        return $this->cidade;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function getUf() {
        return $this->uf;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }
    
    public function getLongitude() {
        return $this->longitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function getAltitude() {
        return $this->altitude;
    }

    public function setAltitude($altitude) {
        $this->altitude = $altitude;
    }

    public function getProduto_testemunha() {
        return $this->produto_testemunha;
    }

    public function setProduto_testemunha($produto_testemunha) {
        $this->produto_testemunha = $produto_testemunha;
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

    public function getQuantidade_amostras() {
        return $this->quantidade_amostras;
    }

    public function setQuantidade_amostras($quantidade_amostras) {
        $this->quantidade_amostras = $quantidade_amostras;
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

    public function getValores_set() {
        return $this->valores_set;
    }

    public function setValores_set($valores_set) {
        $this->valores_set = $valores_set;
    }
    
}

?>
