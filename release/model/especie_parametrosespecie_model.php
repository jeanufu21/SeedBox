<?php


class especie_parametrosespecie_model {
    private $cod_especie;
    private $cod_par_especie;
    private $especie;
    private $data_cadastro;
    private $nome_par_especie;
    
    public function getCod_especie() {
        return $this->cod_especie;
    }

    public function setCod_especie($cod_especie) {
        $this->cod_especie = $cod_especie;
    }

    public function getCod_par_especie() {
        return $this->cod_par_especie;
    }

    public function setCod_par_especie($cod_par_especie) {
        $this->cod_par_especie = $cod_par_especie;
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

    public function getNome_par_especie() {
        return $this->nome_par_especie;
    }

    public function setNome_par_especie($nome_par_especie) {
        $this->nome_par_especie = $nome_par_especie;
    }

}

?>
