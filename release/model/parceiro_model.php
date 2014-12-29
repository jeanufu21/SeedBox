<?php
		/*
				Title: Modelo de Parceiro 
				Author: Tacio
				Date:  28/02/2014
		*/

		class Parceiro{
			private $_codigoParceiro;
			private $_nome;
			private $_cnpj;
			private $_email;
			private $_site;
			private $_endereco;
			private $_complemento;
			private $_bairro;
			private $_municipio;
			private $_uf;
			private $_cep;
			private $_pais;
			private $_tel1;
			private $_tel2;
			//private $_fax;
			private $_cpf;
			private $_observacoes;


            function setNome($nome){
				$this->_nome = $nome;
			}

			function getNome(){
				return $this->_nome;
			}

            function setCpf($cpf){
				$this->_cpf = $cpf;
			}

			function getCpf(){
				return $this->_cpf;
			}

            function setCnpj($cnpj){
				$this->_cnpj = $cnpj;
			}

			function getCnpj(){
				return $this->_cnpj;
			}

            function setPais($pais){
				$this->_pais = $pais;
			}

			function getPais(){
				return $this->_pais;
			}

            function setUF($uf){
				$this->_uf = $uf;
			}

			function getUF(){
				return $this->_uf;
			}

            function setMunicipio($municipio){
				$this->_municipio = $municipio;
			}

			function getMunicipio(){
				return $this->_municipio;
			}

            function setBairro($bairro){
				$this->_bairro = $bairro;
			}

			function getBairro(){
				return $this->_bairro;
			}

            function setEndereco($endereco){
				$this->_endereco = $endereco;
			}

			function getEndereco(){
				return $this->_endereco;
			}

            function setComplemento($complemento){
				$this->_complemento = $complemento;
			}

			function getComplemento(){
				return $this->_complemento;
			}

            function setCep($cep){
				$this->_cep = $cep;
			}

			function getCep(){
				return $this->_cep;
			}

            function setEmail($email){
				$this->_email = $email;
			}

			function getEmail(){
				return $this->_email;
			}

            function setSite($site){
				$this->_site = $site;
			}

			function getSite(){
				return $this->_site;
			}

            function setTelefone1($tel1){
				$this->_tel1 = $tel1;
			}

			function getTelefone1(){
				return $this->_tel1;
			}

            function setTelefone2($tel2){
				$this->_tel2 = $tel2;
			}

			function getTelefone2(){
				return $this->_tel2;
			}

			function setObservacoes($observacoes){
				$this->_observacoes = $observacoes;
			}

			function getObservacoes(){
				return $this->_observacoes;
			}
            /*
			function setFax($fax){
				$this->_fax = $fax;
			}

			function getFax(){
				return $this->_fax;
			}*/
            
            function setCodigo($id){
				$this->_codigoParceiro = $id;
			}

			function getCodigo(){
				return $this->_codigoParceiro;
			}			
		}
?>