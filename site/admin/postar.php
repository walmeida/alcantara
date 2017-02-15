<?php 
	session_start();

	require_once('../classes/Post.php');
	require_once('../classes/Usuario.php');

	/*TODO: Reforçar autenticação para postagem */

	if(!isset($_SESSION["usuarioLogado"])){
        header('Location: index.php?erro=2');
    }

	$usuarioLogado = unserialize($_SESSION['usuarioLogado']);

	include_once('../comum/upload.php');
	$uriImagem = $novo_arquivo;
	
	$titulo = filter_var($_POST['inputTitulo'], FILTER_SANITIZE_STRING);
	$texto = filter_var($_POST['inputTexto'], FILTER_SANITIZE_STRING);
	$idAutor = filter_var($usuarioLogado->getId(), FILTER_SANITIZE_NUMBER_INT);

	$post = new Post($titulo, $uriImagem, $texto, $idAutor);
	$post->postar();
		
?>