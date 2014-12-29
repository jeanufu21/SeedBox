<?php 

		class ItensNotas
		{
			private $COD_NOTAFISCAL;
			private $COD_PRODUTO;
			private $QUANTIDADE;
			private $UNIDADE_MEDIDA;
			private $VALOR;


			function setCodNota($dado)
			{
				$this->COD_NOTAFISCAL = $dado;
			}
			function getCodNota()
			{
				return $this->COD_NOTAFISCAL;
			}
			function setCodProduto($dado)
			{
				$this->COD_PRODUTO = $dado;
			}
			function getCodProduto()
			{
				return $this->COD_PRODUTO;
			}
			function setQuant($dado)
			{
				$this->QUANTIDADE = $dado;
			}
			function getQuant()
			{
				return $this->QUANTIDADE;
			}
			function setMedida($dado)
			{
				$this->UNIDADE_MEDIDA = $dado;
			}
			function getMedida()
			{
				return $this->UNIDADE_MEDIDA;
			}
			function setValor($dado)
			{
				$this->VALOR = $dado;
			}
			function getValor()
			{
				return $this->VALOR;
			}
		}


 ?>