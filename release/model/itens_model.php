<?php 

/*
		Title:Model para Itens do pedido
		Author:Jean Fabrício
		Date: 12/03/2014
*/


		class Item
		{

			private $COD_PEDIDO;
			private $COD_PRODUTO;
			private $QUANTIDADE;
			private $MEDIDA;
			

			public function setCodPedido($value)
			{
				$this->COD_PEDIDO = $value;
			}
			public function getCodPedido()
			{
				return $this->COD_PEDIDO;
			}


			public function setCodProduto($value)
			{
				$this->COD_PRODUTO = $value;
			}
			public function getCodProduto()
			{
				return $this->COD_PRODUTO;
			}

			public function setQuantidade($value)
			{
				$this->QUANTIDADE = $value;
			}
			public function getQuantidade()
			{
				return $this->QUANTIDADE;
			}
			public function setMedida($value)
			{
				$this->MEDIDA = $value;
			}
			public function getMedida()
			{
				return $this->MEDIDA;
			}


		}

 ?>