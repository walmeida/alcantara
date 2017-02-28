<?php
	
	include_once(__DIR__ . '/../classes/BancoDeDados.php');
	include_once(__DIR__ . '/../classes/Login.php');
	include_once(__DIR__ . '/../classes/Usuario.php');

	function verificaSeUsuarioEstaLogado(){
		if(!isset($_SESSION["usuarioLogado"])){
			header('Location: index.php');
		}
	}
?>