<?php

	class Usuario {
		protected $id;
		protected $primeiroNome;
		protected $ultimoNome;
		protected $email;
		protected $senhaCript;
		protected $login;
		protected $privilegio;

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getPrimeiroNome(){
			return $this->primeiroNome;
		}

		public function setPrimeiroNome($nome){
			$this->primeiroNome = $nome;
		}

		public function getUltimoNome(){
			return $this->ultimoNome;
		}

		public function setUltimoNome($nome){
			$this->ultimoNome = $nome;
		}

		public function getEmail(){
			return $this->email;
		}

		public function setEmail($email){
			$this->email = $email;
		}

		public function senhaCript(){
			return $this->senhaCript;
		}

		public function setSenhaCript($senha){
			$this->senhaCript = $senha;
		}

		public function getLogin(){
			return $this->login;
		}

		public function setLogin($login){
			$this->login = $login;
		}

		public function getPrivilegio(){
			return $this->privilegio;
		}

		public function setPrivilegio($privilegio){
			$this->privilegio = $privilegio;
		}

		public function getNomeCompleto(){
			return $this->primeiroNome . ' ' . $this->ultimoNome;
		}
	}
?>