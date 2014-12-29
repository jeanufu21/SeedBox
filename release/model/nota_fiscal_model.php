<?php
		/*
				Title: Modelo de Nota Fiscal
				Author:Gustavo Moreira
				Date:  20/03/2014
		*/

		class NotaFiscal{
			private $_codParceiro;
			private $_descricao;
			private $_dataPedido;
            /*
			private $_statusPagamento;
			private $_statusEntrega;*/
			private $_valorTotal;
			private $_dataEntrega;
			/*private $_dataPrevista;*/
			private $_codNota;
			private $_io;

			public function getCodParceiro()
			{
			    return $this->_codParceiro;
			}
			
			public function setCodParceiro($codParceiro)
			{
			    $this->_codParceiro = $codParceiro;
			    return $this;
			}

			public function getDescricao()
			{
			    return $this->_descricao;
			}
			
			public function setDescricao($descricao)
			{
			    $this->_descricao = $descricao;
			    return $this;
			}

			public function getDataPedido()
			{
			    return $this->_dataPedido;
			}
			
			public function setDataPedido($dataPedido)
			{
			    $this->_dataPedido = $dataPedido;
			    return $this;
			}

            /*
			public function getStatusPagamento()
			{
			    return $this->_statusPagamento;
			}
			
			public function setStatusPagamento($statusPagamento)
			{
			    $this->_statusPagamento = $statusPagamento;
			    return $this;
			}

			public function getStatusEntrega()
			{
			    return $this->_statusEntrega;
			}
			
			public function setStatusEntrega($statusEntrega)
			{
			    $this->_statusEntrega = $statusEntrega;
			    return $this;
			}
            */
			public function getValorTotal()
			{
			    return $this->_valorTotal;
			}
			
			public function setValorTotal($valorTotal)
			{
			    $this->_valorTotal = $valorTotal;
			    return $this;
			}
			public function getDataEntrega()
			{
			    return $this->_dataEntrega;
			}
			
			public function setDataEntrega($dataEntrega)
			{
			    $this->_dataEntrega = $dataEntrega;
			    return $this;
			}
            /*
			public function getDataPrevista()
			{
			    return $this->_dataPrevista;
			}
			
			public function setDataPrevista($dataPrevista)
			{
			    $this->_dataPrevista = $dataPrevista;
			    return $this;
			}
            */
			public function getCodNota()
			{
			    return $this->_codNota;
			}
			
			public function setCodNota($_codNota)
			{
			    $this->_codNota = $_codNota;
			    return $this;
			}

			public function getIO()
			{
			    return $this->_io;
			}
			
			public function setIO($io)
			{
			    $this->_io = $io;
			    return $this;
			}
		}

?>