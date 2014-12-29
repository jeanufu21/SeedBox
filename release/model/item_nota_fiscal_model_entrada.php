<?php
		/*
				Title: Modelo de Nota Fiscal
				Author:Gustavo Moreira
				Date:  24/03/2014
		*/

		class ItemNotaFiscal{
				private $_codNotaFiscal;
				private $_codProduto;
				private $_quantidade;
				private $_unidadeMedida;
				private $_valor;
				private $_codEstoque;
				private $_codParceiro;
				private $_io;

				function getCodNotaFiscal(){
					return $this->_codNotaFiscal;
				}

				function setCodNotaFiscal($_codNotaFiscal){
					$this->_codNotaFiscal = $_codNotaFiscal;
				}

				function getCodProduto(){
					return $this->_codProduto;
				}

				function setCodProduto($_codProduto){
					$this->_codProduto = $_codProduto;
				}

				function getQuantidade(){
					return $this->_quantidade;
				}

				function setQuantidade($_quantidade){
					$this->_quantidade = $_quantidade;
				}

				function getUnidadeMedida(){
					return $this->_unidadeMedida;
				}

				function setUnidadeMedida($_unidadeMedida){
					$this->_unidadeMedida = $_unidadeMedida;
				}

				function getValor(){
					return $this->_valor;
				}

				function setValor($_valor){
					$this->_valor = $_valor;
				}

				function getCodEstoque(){
						return $this->_codEstoque;
				}

				function setCodEstoque($_codEstoque){
						$this->_codEstoque = $_codEstoque;
				}

				function getCodParceiro()
				{
				    return $this->_codParceiro;
				}
				
				function setCodParceiro($_codParceiro)
				{
				    $this->_codParceiro = $_codParceiro;
				    return $this;
				}

				function getIO()
				{
				    return $this->_io;
				}
				
				function setIO($_io)
				{
				    $this->_io = $_io;
				    return $this;
				}
		}
?>