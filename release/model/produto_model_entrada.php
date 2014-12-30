<?php
		/*
				Title: Modelo de Produto 
				Author:Jean Fabrício
				Date:  22/02/2014
		*/

		class Produto{
			private $_COD_PRODUTO;
			private $_NOME;
			private $_COD_SET_VALORES;
			private $_COD_MARCA;
			private $_PDG_ORIGINAL;
			private $_PDG_NACIONAL;
			private $_PELETIZADO;
			private $_ORGANICO;
			private $_OBSERVACAO;
			private $_COD_FASE;
			private $_RESISTENCIA;

			function setCodProduto($var){
				$this->_COD_PRODUTO = $var;
			}
			function getCodProduto(){
				return $this->_COD_PRODUTO;
			}
			function setNome($var){
				$this->_NOME = $var;
			}
			function getNome(){
				return $this->_NOME;
			}
			function setCodSetValores($var){
				$this->_COD_SET_VALORES = $var;
			}
			function getCodSetValores(){
				return $this->_COD_SET_VALORES;
			}
			function setCodMarca($var){
				$this->_COD_MARCA = $var;
			}
			function getCodMarca(){
				return $this->_COD_MARCA;
			}
			function setPdgOriginal($var){
				$this->_PDG_ORIGINAL = $var;
			}
			function getPdgOriginal(){
				return $this->_PDG_ORIGINAL;
			}
			function setPdgNacional($var){
				$this->_PDG_NACIONAL = $var;
			}
			function getPdgNacional(){
				return $this->_PDG_NACIONAL;
			}
			function setPeletizado($var){
				$this->_PELETIZADO = $var;
			}
			function getPeletizado(){
				return $this->_PELETIZADO;
			}
			function setOrganico($var){
				$this->_ORGANICO = $var;
			}
			function getOrganico(){
				return $this->_ORGANICO;
			}
			function setObservacao($var){
				$this->_OBSERVACAO = $var;
			}
			function getObservacao(){
				return $this->_OBSERVACAO;
			}
			function setCodFase($var){
				$this->_COD_FASE = $var;
			}
			function getCodFase(){
				return $this->_COD_FASE;
			}
			function setResistencia($var){
				$this->_RESISTENCIA = $var;
			}
			function getResistencia(){
				return $this->_RESISTENCIA;
			}
		}

?>