<?php
		/*
				Title: Modelo Parametros de Especie
				Author:Jean Fabrício
				Date:  21/02/2014
		*/

		class ParametrosEspecie{
			private $_codEspecie;
			private $_nomeParamEspecie;
			private $_codParamEspecie;

			function setNomeParam($nome){
				$this->_nomeParamEspecie = $nome;
			}
			function getNomeParam(){
				return $this->_nomeParamEspecie;
			}
			function setCodParamEspecie($value){
				$this->_codParamEspecie = $value;
			}
			function getCodParamEspecie(){
				return $this->_codParamEspecie;
			}
			function setCodEspecie($codEsp){
				$this->_codEspecie = $codEsp;
			}
			function getCodEspecie(){
				return $this->_codEspecie;
			}
		}

?>