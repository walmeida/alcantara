<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Wallace Almeida">
    <link rel="icon" href="../img/favicon.ico">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/admin_login.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="POST" action="login.php">
        <img src="../img/logo.png" class="img-responsive form-signin-heading">
        <label for="inputLogin" class="sr-only">Login</label>
        <input type="text" id="inputLogin" name="inputLogin" class="form-control" placeholder="Login" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Senha" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Continuar conectado
          </label>
        </div>
        <p class="bg-danger"><?php if(isset($_GET['erro']) && $_GET['erro'] == 1){ echo "Erro de login. Usuário ou senha inválidos!"; }  ?></p>
        <p class="bg-warning"><?php if(isset($_GET['erro']) && $_GET['erro'] == 2){ echo "Você deve estar logado para essa página!"; }  ?></p>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>