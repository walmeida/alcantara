<?php

	require_once("BancoDeDados.php");

	class Banner{
		protected $id;
		protected $titulo;
		protected $uriImagem;
		protected $ordem;
		protected $ativo;

		function __construct($titulo, $uriImagem, $ordem, $ativo){
			$this->titulo = $titulo;
			$this->uriImagem = $uriImagem;
			$this->ordem = $ordem;
			$this->ativo = $ativo;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}

		public function add(){
			$bd = BancoDeDados::getInstance();
			$conn = $bd->getConexao();
		
			$query = "INSERT INTO banners(titulo, uri_imagem, ordem, ativo) VALUES(?,?,?,?)";

			$stmt = $conn->prepare($query);
			$stmt->bind_param("ssii", $this->titulo, $this->uriImagem, $this->ordem, $this->ativo);
			$result = $stmt->execute();

			if($result){
				$redirectPage = 'banners.php?resultado=ok';
			}
			else{
				$redirectPage = 'banners.php?resultado=erro';
			}

			$stmt->close();
			$bd->fechaConexao($conn);
			header("Location: $redirectPage");

		}

	}

?>