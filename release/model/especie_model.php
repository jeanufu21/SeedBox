<?php
		/*
				Title: Modelo de Especies 
				Author:Jean Fabrício
				Date:  22/02/2014
		*/

		class Especie{
			private $_nomeEspecie;
			private $_idEspecie;
			private $_dataCadastroEsp;
			private $_funcionario;

			function setNome($nome){
				$this->_nomeEspecie = $nome;
			}
			function getNome(){
				return $this->_nomeEspecie;
			}
			function setId($id){
				$this->_idEspecie = $id;
			}
			function getId(){
				return $this->_idEspecie;
			}
			function setData($data){
				$this->_dataCadastroEsp = $data;
			}
			function getData(){
				return $this->_dataCadastroEsp;
			}
			function setFuncionario($data){

				$this->_funcionario = $data;
			}
			function getFuncionario(){
				return $this->_funcionario;
			}
		}

?>