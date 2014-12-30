<?php


class campo {
    private $cod_campo;
    private $nome;
    private $cidade;
    private $uf;
    private $latitude;
    private $longitude;
    private $altitude;
    
    public function getCod_campo() {
        return $this->cod_campo;
    }

    public function setCod_campo($cod_campo) {
        $this->cod_campo = $cod_campo;
    }


     public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
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

/*    public function getLocalizacao() {
        return $this->lat . ' ' . $this->long;
    }

    public function setLocalizacao($lat, $long) {
        $this->lat = $lat;
        $this->long = $long;
    }
*/
    public function getAltitude() {
        return $this->altitude;
    }

    public function setAltitude($altitude) {
        $this->altitude = $altitude;
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


}

?>
