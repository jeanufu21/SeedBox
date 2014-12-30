<?php
		/*
				Title: Modelo de Especies 
				Author:Washington Soares
				Date:  22/02/2014
		*/

		class AmostraEnsaio{
			// private $_codAmostra;
			private $_codEnsaio;
			private $_codProduto;
			private $_nroEstaca;
			private $_quantidadeSementes;

			// function setcodAmostra($nome){
			// 	$this->_codAmostra = $nome;
			// }
			// function getcodAmostra(){
			// 	return $this->_codAmostra;
			// }
			

			function setcodEnsaio($id){
				$this->_codEnsaio = $id;
			}
			function getcodEnsaio(){
				return $this->_codEnsaio;
			}


			function setcodProduto($data){
				$this->_codProduto = $data;
			}
			function getcodProduto(){
				return $this->_codProduto;
			}


			function setnroEstaca($data){

				$this->_nroEstaca = $data;
			}
			function getnroEstaca(){
				return $this->_nroEstaca;
			}


			function setquantidadeSementes($data){

				$this->_quantidadeSementes = $data;
			}
			function getquantidadeSementes(){
				return $this->_quantidadeSementes;
			}
		}

?>