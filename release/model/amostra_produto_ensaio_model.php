<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of amostra_produto_marca_fase_model
 *
 * @author Luiz
 */
class amostra_produto_marca_fase_model {
    private $cod_amostra;
    private $cod_produto;
    private $cod_set_valores;
    private $cod_ensaio;
    private $produto_nome;
    private $pedigree_original;
    private $pedigree_nacional;
    private $peletizada;
    private $observacao;
    private $resistencia;
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

    public function getCod_set_valores() {
        return $this->cod_set_valores;
    }

    public function setCod_set_valores($cod_set_valores) {
        $this->cod_set_valores = $cod_set_valores;
    }

    public function getCod_ensaio() {
        return $this->cod_ensaio;
    }

    public function setCod_ensaio($cod_ensaio) {
        $this->cod_ensaio = $cod_ensaio;
    }

    public function getProduto_nome() {
        return $this->produto_nome;
    }

    public function setProduto_nome($produto_nome) {
        $this->produto_nome = $produto_nome;
    }

    public function getPedigree_original() {
        return $this->pedigree_original;
    }

    public function setPedigree_original($pedigree_original) {
        $this->pedigree_original = $pedigree_original;
    }

    public function getPedigree_nacional() {
        return $this->pedigree_nacional;
    }

    public function setPedigree_nacional($pedigree_nacional) {
        $this->pedigree_nacional = $pedigree_nacional;
    }

    public function getPeletizada() {
        return $this->peletizada;
    }

    public function setPeletizada($peletizada) {
        $this->peletizada = $peletizada;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
    }

    public function getResistencia() {
        return $this->resistencia;
    }

    public function setResistencia($resistencia) {
        $this->resistencia = $resistencia;
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
