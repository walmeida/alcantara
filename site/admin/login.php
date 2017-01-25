<?php 
	session_start();

	require_once('../classes/Login.php');

	$loginOkPage = 'main.php';
	$loginErrorPage = 'index.php?erro=1';
	$login = filter_var($_POST['inputLogin'], FILTER_SANITIZE_STRING);
	$senhaCript = hash("sha256", filter_var($_POST['inputPassword'], FILTER_SANITIZE_STRING));
	
	$logIn = new login();
	$logIn->fazLogin($login, $senhaCript, $loginOkPage, $loginErrorPage);

?>