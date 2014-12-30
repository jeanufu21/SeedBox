<?php
		/*
				Title: Modelo de Parceiro 
				Author:Tacio
				Date:  28/02/2014
		*/

		class ParametroAvaliacao{
				private $_codParAvaliacao;
				private $_nome;
				private $_quantitativo;
				private $_cod_especie;

				function getCodParAvaliacao()
				{
				    return $this->_codParAvaliacao;
				}
				
				function setCodParAvaliacao($codParAvaliacao)
				{
				    $this->_codParAvaliacao = $codParAvaliacao;
				    return $this;
				}

				function getNome()
				{
				    return $this->_nome;
				}
				
				function setNome($nome)
				{
				    $this->_nome = $nome;
				    return $this;
				}

				function getQuantitativo()
				{
				    return $this->_quantitativo;
				}
				
				function setQuantitativo($quantitativo)
				{
				    $this->_quantitativo = $quantitativo;
				    return $this;
				}

				function getCodEspecie()
				{
				    return $this->_cod_especie;
				}
				
				function setCodEspecie($cod_especie)
				{
				    $this->_cod_especie = $cod_especie;
				    return $this;
				}
		}
?>