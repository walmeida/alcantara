<?php

	require_once("BancoDeDados.php");

	class Post{
		protected $id;
		protected $titulo;
		protected $uriImagem;
		protected $texto;
		protected $timestamp;
		protected $idAutor;

		function __construct($titulo, $uriImagem, $texto, $idAutor){
			$this->titulo = $titulo;
			$this->uriImagem = $uriImagem;
			$this->texto = $texto;
			$this->idAutor = $idAutor;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function getTimestamp(){
			return $this->timestamp;
		}

		public function setTimestamp($timestamp){
			$this->nome = $timestamp;
		}

		public function postar(){
			$bd = BancoDeDados::getInstance();
			$conn = $bd->getConexao();
		
			$query = "INSERT INTO posts(titulo, uri_imagem, texto, id_autor) VALUES(?,?,?,?)";

			$stmt = $conn->prepare($query);
			$stmt->bind_param("sssi", $this->titulo, $this->uriImagem, $this->texto, $this->idAutor);
			$result = $stmt->execute();

			if($result){
				$redirectPage = 'main.php?postado=ok';
			}
			else{
				$redirectPage = 'main.php?postado=erro';
			}

			$stmt->close();
			$bd->fechaConexao($conn);
			header("Location: $redirectPage");

		}

	}

?>