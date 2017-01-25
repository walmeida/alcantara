<?php

	class BancoDeDados {

		public static function getInstance()
	    {
	        static $instance = null;
	        if (null === $instance) {
	            $instance = new static();
	        }

	        return $instance;
	    }

	    protected function __construct()
	    {

	    }
	    
	    public function getConexao(){
	    	$conn = new mysqli("localhost", "root", "", "ca_entre_elas");

			if ($conn->connect_error) {
			    die("Erro de conexão com o Banco de Dados " . $conn->connect_error);
			}
			
			return $conn;	
	    }

	    public function fechaConexao($obj){
	    	try{
				$obj->close();
			}
			catch(Exception $e){
				//
			}
	    }

		
	}
?>