<?php
	/*
		*	Title: grupo_avaliativo.php
		*	Authors: Frederico, Gustavo
		*	Date: 27/03/2014
	*/

	class GrupoAvaliativo{
			private $_codSet;
			private $_codParametroAvaliacao;
			private $_codEspecie;
			private $_obrigatorio;
			private $_min;
			private $_max;
			private $_nroAvaliacoes;
			private $_comentario;

			function getCodSet()
			{
			    return $this->_codSet;
			}
			
			function setCodSet($cod)
			{
			    $this->_codSet = $cod;
			    return $this;
			}

			function getCodParametroAvaliacao()
			{
			    return $this->_codParametroAvaliacao;
			}
			
			function setCodParametroAvaliacao($codParametroAvaliacao)
			{
			    $this->_codParametroAvaliacao = $codParametroAvaliacao;
			    return $this;
			}

			function getCodEspecie()
			{
			    return $this->_codEspecie;
			}
			
			function setCodEspecie($codEspecie)
			{
			    $this->_codEspecie = $codEspecie;
			    return $this;
			}

			function getObrigatorio()
			{
			    return $this->_obrigatorio;
			}
			
			function setObrigatorio($obrigatorio)
			{
			    $this->_obrigatorio = $obrigatorio;
			    return $this;
			}

			function getMin()
			{
			    return $this->_min;
			}
			
			function setMin($min)
			{
			    $this->_min = $min;
			    return $this;
			}

			function getMax()
			{
			    return $this->_max;
			}
			
			function setMax($max)
			{
			    $this->_max = $max;
			    return $this;
			}

			function getNroAvaliacoes()
			{
			    return $this->_nroAvaliacoes;
			}
			
			function setNroAvaliacoes($nroAvaliacoes)
			{
			    $this->_nroAvaliacoes = $nroAvaliacoes;
			    return $this;
			}

			function getComentario()
			{
			    return $this->_comentario;
			}
			
			function setComentario($comentario)
			{
			    $this->_comentario = $comentario;
			    return $this;
			}

	}

?>