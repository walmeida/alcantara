<?php

	require_once("BancoDeDados.php");
	require_once("Usuario.php");

	class Login{
		public function fazLogin($login, $senhaCript, $loginOkPage, $loginErrorPage){
			$bd = BancoDeDados::getInstance();
			$conn = $bd->getConexao();
			$redirectPage = $loginErrorPage;
			
			$query = "SELECT * FROM usuarios WHERE login = ? AND senha_cripto = ?";

			$stmt = $conn->prepare($query);
			$stmt->bind_param("ss", $login, $senhaCript);
			$stmt->execute();

			$result = $stmt->get_result(); 
    		
			if($result->num_rows > 0){
				$linha = $result->fetch_assoc();
				$usuario = new Usuario();
				$usuario->setId($linha['id']);
				$usuario->setEmail($linha['email']);
				$usuario->setPrimeiroNome($linha['primeiro_nome']);
				$usuario->setUltimoNome($linha['ultimo_nome']);
				$usuario->setLogin($linha['login']);
				$usuario->setPrivilegio($linha['id_privilegio']);
				$_SESSION["usuarioLogado"] = serialize($usuario);

				$redirectPage = $loginOkPage;
			}

			$bd->fechaConexao($conn);
			
			header("Location: $redirectPage");

		}

		public function fazLogout($redirectPage = 'index.php'){
			header('meta charset="UTF-8"');
			if (isset($_SESSION['usuarioLogado'])){
				session_unset();
				session_destroy(); 
				echo 'Deslogado com sucesso!';
			}
			else{
				echo 'Você não está logado!';
			}

			echo "<br/> <a href=\"$redirectPage\">Ir para a página inicial</a>";

			header('Location: ' . $redirectPage);
		}
	}

?>