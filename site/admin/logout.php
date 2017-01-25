<?php 
	session_start();

	require_once('../classes/Login.php');

	$logOut = new login();
	$logOut->fazLogout();

?>