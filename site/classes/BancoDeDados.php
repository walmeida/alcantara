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

			if (!$conn->set_charset("utf8")) {
    			die("Erro ao carregar character set utf8: %s\n" . $conn->error);
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