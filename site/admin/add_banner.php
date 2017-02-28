<?php 
	session_start();

	require_once('../classes/Banner.php');
	require_once('../classes/Usuario.php');

	/*TODO: Reforçar autenticação para postagem */

	if(!isset($_SESSION["usuarioLogado"])){
        header('Location: index.php?erro=2');
    }

	$usuarioLogado = unserialize($_SESSION['usuarioLogado']);

	include_once('../comum/upload.php');
	$uriImagem = $novo_arquivo;
	
	$titulo = filter_var($_POST['inputTitulo'], FILTER_SANITIZE_STRING);
	$ordem = filter_var($_POST['inputOrdem'], FILTER_SANITIZE_NUMBER_INT);
	$ativo = isset($_POST['checkAtivo']) ? 1 : 0;

	$banner = new Banner($titulo, $uriImagem, $ordem, $ativo);
	$banner->add();
		
?>