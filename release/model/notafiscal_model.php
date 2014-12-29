<?php 


	class NotaFiscal
	{
		private $COD_PARCEIRO;
		private $DESCRICAO;
		private $DATA_PEDIDO;
		private $STATUS_PAGAMENTO;
		private $STATUS_ENTREGA;
		private $VALOR_TOTAL;
		private $DATA_ENTREGA;
		private $DATA_PREVISTA;


		function setCodParceiroRem($dados)
		{
			$this->COD_PARCEIRO = $dados;
		}
		function getCodParceiroRem()
		{
			return $this->COD_PARCEIRO;
		}
		function setDescricao($dados)
		{
			$this->DESCRICAO = $dados;
		}
		function getDescricao()
		{
			return $this->DESCRICAO;
		}
		function setDataPedido($dados)
		{
			$this->DATA_PEDIDO = $dados;
		}
		function getDataPedido()
		{
			return $this->DATA_PEDIDO;
		}
		function setStatusPag($dados)
		{
			$this->STATUS_PAGAMENTO = $dados;
		}
		function getStatusPag()
		{
			return $this->STATUS_PAGAMENTO;
		}
		function setStatusEnt($dados)
		{
			$this->STATUS_ENTREGA = $dados;
		}
		function getStatusEnt()
		{
			return $this->STATUS_ENTREGA;
		}
		function setValorTotal($dados)
		{
			$this->VALOR_TOTAL = $dados;
		}
		function getValorTotal()
		{
			return $this->VALOR_TOTAL;
		}
		function setDataEntrega($dados)
		{
			$this->DATA_ENTREGA = $dados;
		}
		function getDataEntrega()
		{
			return $this->DATA_ENTREGA;
		}
		function setDataPrevista($dados)
		{
			$this->DATA_PREVISTA = $dados;
		}
		function getDataPrevista()
		{
			return $this->DATA_PREVISTA;
		}
	}
		
 ?>