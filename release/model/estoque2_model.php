<?php
		/*
				Title: Modelo de Nota Fiscal
				Author:Gustavo Moreira
				Date:  25/03/2014
		*/
		class  Estoque{
				private $_codProduto;
				private $_codLote;
				private $_qtdEntrada;
				private $_qtdAtual;
				private $_unidadeMedida;
				private $_tipoEmbalagem;
				private $_pesoEmbalagem;
				private $_dataEntrada;
				private $_dataVencimento;

				public function getCodProduto(){
						return $this->_codProduto;
				}

				public function setCodProduto($_codProduto){
						$this->_codProduto = $_codProduto;
				}

				public function getCodLote(){
						return $this->_codLote;
				}

				public function setCodLote($_codLote){
						$this->_codLote = $_codLote;
				}

				public function getQtdEntrada(){
						return $this->_qtdEntrada;
				}

				public function setQtdEntrada($_qtdEntrada){
						$this->_qtdEntrada = $_qtdEntrada;
				}

				public function getQtdAtual(){
						return $this->_qtdAtual;
				}

				public function setQtdAtual($_qtdAtual){
						$this->_qtdAtual = $_qtdAtual;
				}

				public function getUnidadeMedida(){
						return $this->_unidadeMedida;
				}

				public function setUnidadeMedida($_unidadeMedida){
						$this->_unidadeMedida = $_unidadeMedida;
				}

				public function getTipoEmbalagem(){
						return $this->_tipoEmbalagem;
				}

				public function setTipoEmbalagem($_tipoEmbalagem){
						$this->_tipoEmbalagem = $_tipoEmbalagem;
				}

				public function getPesoEmbalagem(){
						return $this->_pesoEmbalagem;
				}

				public function setPesoEmbalagem($_pesoEmbalagem){
						$this->_pesoEmbalagem = $_pesoEmbalagem;
				}

				public function getDataEntrada(){
						return $this->_dataEntrada;
				}

				public function setDataEntrada($_dataEntrada){
						$this->_dataEntrada = $_dataEntrada;
				}

				public function getDataVencimento(){
						return $this->_dataVencimento;
				}

				public function setDataVencimento($_dataVencimento){
						$this->_dataVencimento = $_dataVencimento;
				}

		}

?>