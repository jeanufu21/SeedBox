<?php

class leitura_amostra {
    private $cod_leitura;
    private $cod_amostra;
    private $cod_par_avaliacao;
    private $obrigatorio;
    private $data_leitura;
    private $leitura;
    private $nome_foto;
    private $comentario;

     public function getCod_leitura() {
        return $this->cod_amostra;
    }

    public function setCod_leitura($cod_amostra) {
        $this->cod_amostra = $cod_amostra;
    }

    public function getCod_amostra() {
        return $this->cod_amostra;
    }

    public function setCod_amostra($cod_amostra) {
        $this->cod_amostra = $cod_amostra;
    }

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

    public function getData_leitura() {
        return $this->data_leitura;
    }

    public function setData_leitura($data_leitura) {
        $this->data_leitura = $data_leitura;
    }

    public function getLeitura() {
        return $this->leitura;
    }

    public function setLeitura($leitura) {
        $this->leitura = $leitura;
    }

    public function getNome_foto() {
        return $this->nome_foto;
    }

    public function setNome_foto($nome_foto) {
        $this->nome_foto = $nome_foto;
    }

    public function getComentario() {
        return $this->comentario;
    }

    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    
}

?>
