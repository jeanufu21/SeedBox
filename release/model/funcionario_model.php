<?php
/*
		Title:model do funcionario
		Author:Washington
		Date:  25/03/2014
*/




	class Funcionario{

		private $_codigo;
		private $_nomeFuncionario;
		private $_loginFuncionario;
		private $_senha;
		private $_level;
		private $_email;
		private $_telefone;
		private $_cidade;
		private $_uf;


		//Getters do funcionario
		function GetCodigo(){
			return $this->_codigo;
		}

		function GetNomeFuncionario(){
			return $this->_nomeFuncionario;
		}
		function GetLoginFuncionario(){
			return $this->_loginFuncionario;
		}
		function GetSenha(){
			return $this->_senha;
		}
		function GetLevel(){
			return $this->_level;
		}
		function GetEmail(){
			return $this->_email;
		}
		function GetTelefone(){
			return $this->_telefone;
		}
		function GetCidade(){
			return $this->_cidade;
		}
		function GetUf(){
			return $this->_uf;
		}

		//setters do funcionario
		function setCodigo($codigo){
			$this->_codigo = $codigo;
		}

		function setNomeFuncionario($nomeFuncionario){
			$this->_nomeFuncionario = $nomeFuncionario;
		}
		function setLoginFuncionario($loginFuncionario){
			$this->_loginFuncionario = $loginFuncionario;
		}
		function setSenha($senha){
			$this->_senha= $senha;
		}

		function setLevel($level){
			$this->_level = $level;
		}
		function setEmail($email){
			$this->_email = $email;
		}
		function setTelefone($telefone){
			$this->_telefone = $telefone;
		}
		function setCidade($cidade){
			$this->_cidade = $cidade;
		}
		function setUf($uf){
			$this->_uf = $uf;
		}

	}

?>	
