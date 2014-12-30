<?php

/*
				Title: Modelo de Marca
				Author:Tacio
				Date:  17/03/2014
		*/

		class Marca{

			private $_originalBrand;
			private $_nomeFantasia;
			private $_codigo;
			private $_codParceiro;

			function setCodigo($codigo){
				$this->_codigo = $codigo;
			}
			function getCodigo(){
				return $this->_codigo;
			}
			function setOriginalBrand($original){
				$this->_originalBrand = $original;
			}
			function getOriginalBrand(){
				return $this->_originalBrand;
			}
			function setNomeFantasia($nome){
				$this->_nomeFantasia = $nome;
			}
			function getNomeFantasia(){
				return $this->_nomeFantasia;
			}
			function setParceiro($parceiro)
			{
			 	 $this->_codParceiro = $parceiro;
			}
			function getParceiro()
			{
				return $this->_codParceiro;
			}

		}

?>