<?php 

		class Estoque
		{

			private $COD_PRODUTO;
			private $COD_LOTE;
			private $QNT_ENTRADA;
			private $QUANT_ATUAL;
			private $UNIDADE_MEDIDA;
			private $TIPO_EMBALAGEM;
			private $PESO_POR_EMBALAGEM;
			private $DATA_ENTRADA;
			private $DATA_VENCIMENTO;
			private $COD_NOTAFISCAL;
			private $COD_ITEMNF;



			function setCodProduto($dado)
			{
				$this->COD_PRODUTO = $dado;
			}
			function getCodProduto()
			{
				return $this->COD_PRODUTO;
			}
			function setCodLote($dado)
			{
				$this->COD_LOTE = $dado;
			}
			function getCodLote()
			{
				return $this->COD_LOTE;
			}
			function setQuantEntrada($dado)
			{
				$this->QNT_ENTRADA = $dado;
			}
			function getQuantEntrada()
			{
				return $this->QNT_ENTRADA;
			}
			function setQuantAtual($dado)
			{
				$this->QUANT_ATUAL = $dado;
			}
			function getQuantAtual()
			{
				return $this->QUANT_ATUAL;
			}
			function setUnidadeMedida($dado)
			{
				$this->UNIDADE_MEDIDA = $dado;
			}
			function getUnidadeMedida()
			{
				return $this->UNIDADE_MEDIDA;
			}
			function setTipoEmb($dado)
			{
				$this->TIPO_EMBALAGEM = $dado;
			}
			function getTipoEmb()
			{
				return $this->TIPO_EMBALAGEM;
			}
			function setPesoEmb($dado)
			{
				$this->PESO_POR_EMBALAGEM = $dado;
			}
			function getPesoEmb()
			{
				return $this->PESO_POR_EMBALAGEM;
			}
			function setDataEntrada($dado)
			{
				$this->DATA_ENTRADA = $dado;
			}
			function getDataEntrada()
			{
				return $this->DATA_ENTRADA;
			}
			function setDataVenci($dado)
			{
				$this->DATA_VENCIMENTO = $dado;
			}
			function getDataVenci()
			{
				return $this->DATA_VENCIMENTO;
			}
			function setCodNota($dado)
			{
				$this->COD_NOTAFISCAL = $dado;
			}
			function getCodNota()
			{
				return $this->COD_NOTAFISCAL;
			}
			function setCodItemNota($dado)
			{
				$this->COD_ITEMNF = $dado;
			}
			function getCodItemNota()
			{
				return $this->COD_ITEMNF;
			}
		}// fim da classe

 ?>