<?php
	class leituras_resumo{
		private $cod_ensaio;
		private $cod_par_avaliacao;
		private $leituras_feitas;
		private $nro_avaliacoes;
		private $obrigatorio;
		
		public function getCod_ensaio() {
                    return $this->cod_ensaio;
                }

                public function setCod_ensaio($cod_ensaio) {
                    $this->cod_ensaio = $cod_ensaio;
                }

                public function getCod_par_avaliacao() {
                    return $this->cod_par_avaliacao;
                }

                public function setCod_par_avaliacao($cod_par_avaliacao) {
                    $this->cod_par_avaliacao = $cod_par_avaliacao;
                }

                public function getLeituras_feitas() {
                    return $this->leituras_feitas;
                }

                public function setLeituras_feitas($leituras_feitas) {
                    $this->leituras_feitas = $leituras_feitas;
                }

                public function getNro_avaliacoes() {
                    return $this->nro_avaliacoes;
                }

                public function setNro_avaliacoes($nro_avaliacoes) {
                    $this->nro_avaliacoes = $nro_avaliacoes;
                }

                public function getObrigatorio() {
                    return $this->obrigatorio;
                }

                public function setObrigatorio($obrigatorio) {
                    $this->obrigatorio = $obrigatorio;
                }


	}
?>