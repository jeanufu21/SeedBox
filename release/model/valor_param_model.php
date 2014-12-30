<?php
		/*
				Title: Modelo Parametros de Especie
				Author:Jean Fabrício
				Date:  21/02/2014
		*/

		class ValorParametros{
			private $_codParamEspecie;
			private $_valorParam = array();

			function setValorParam($valor){
				$this->_valorParam[] = $valor;
			}
			function getValorParam(){
				// retorna uma array de valores
				return $this->_valorParam;
			}
			function setCodParamEspecie($codigo){
				$this->_codParamEspecie = $codigo;
			}
			function getCodParamEspecie(){
				return $this->_codParamEspecie;
			}
			
		}

?>