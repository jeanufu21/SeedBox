<?php 

/*
		Title: Modelo para Pedido
		Author:Jean Fabrício
		Date:12/03/2014
*/


		class Pedido
		{
			private $FUNCIONARIO;
			private $DATA_PEDIDO;
			private $PARCEIRO;
			
			public function setFuncionario($value)
			{
				$this->FUNCIONARIO = $value;
			}
			public function getFuncionario()
			{
				return $this->FUNCIONARIO;
			}
			public function setDataPedido($value)
			{
				$this->DATA_PEDIDO = $value;
			}
			public function getDataPedido()
			{
				return $this->DATA_PEDIDO;
			}
			public function setParceiro($value)
			{
				$this->PARCEIRO = $value;
			}
			public function getParceiro()
			{
				return $this->PARCEIRO;
			}
			


		}


 ?>