<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Wallace Almeida">
    <link rel="icon" href="img/favicon.ico">

    <title>Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/admin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php
      session_start();
      if(!isset($_SESSION["usuarioLogado"])){
        header('Location: index.php?erro=2');
      }

      include_once('../comum/config.php');
      $bd = BancoDeDados::getInstance();
      $conn = $bd->getConexao();

      $query = "SELECT b.* FROM banners b ORDER BY b.ordem";

      $stmt = $conn->prepare($query);
      $stmt->execute();

      $result = $stmt->get_result();

    ?>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Cá entre elas</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="main.php">Home</a></li>
            <li><a href="#">Perfil</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <!-- <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="main.php">Home</a></li>
            <li><a href="posts.php">Posts</a></li>
            <li class="active"><a href="#">Banners <span class="sr-only">(current)</span></a></li>
          </ul>
          <!--<ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul>-->
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Admin</h1>

          <form class="form-horizontal" method="POST" action="add_banner.php" enctype="multipart/form-data">
            <h2>Novo Banner</h2>

            <div class="form-group">
              <label for="inputTitulo" class="col-sm-2 control-label">Título</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputTitulo" name="inputTitulo" placeholder="Título" autofocus>
              </div>
            </div>

            <div class="form-group">
              <label for="inputFoto" class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-8">
                <input type="file" class="form-control" id="inputFoto" name="inputFoto" placeholder="Foto">
                <p class="help-block">Escolha a foto do seu banner</p>
              </div>
            </div>

            <div class="form-group">
              <label for="inputOrdem" class="col-sm-2 control-label">Ordem</label>
              <div class="col-sm-2">
                <input type="number" id="inputOrdem" name="inputOrdem" class="form-control" min="1" max="3" placeholder="Ordem"></input>
              </div>
            </div>

            <div class="form-group">
              <label for="checkAtivo" class="col-sm-2 control-label">Ativo</label>
              <div class="col-sm-1">
                <input type="checkbox" id="checkAtivo" name="checkAtivo" checked="checked" class="form-control" value="ativo"></input>
              </div>
            </div>
                        
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-8">
                <button type="submit" class="btn btn-default">Adicionar</button>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-8">
                <!--<p class="bg-success"><?php if(isset($_GET['postado']) && $_GET['postado'] == 'ok'){ echo "Postagem realizada com sucesso!"; }  ?></p>
                <p class="bg-danger"><?php if(isset($_GET['postado']) && $_GET['postado'] == 'erro'){ echo "Ocorreu um erro ao realizar a Postagem!"; }  ?></p>-->
              </div>
            </div>

          </form>

          <h2 class="sub-header">Banners</h2>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Imagem</th>
                  <th>Título</th>
                  <th>Ordem</th>
                  <th colspan="2">Ativo</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  while ($linha = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $linha['id'] .'</td>';
                    echo '<td><img src="../' . $linha['uri_imagem'] .'" class="img-max-w img-thumbnail"></td>';
                    echo '<td>' . $linha['titulo'] .'</td>';
                    echo '<td>' . $linha['ordem'] .'</td>';
                    $ativo = ($linha['ativo'] == 1) ? 'Sim' : 'Não';
                    echo '<td>' . $ativo . '</td>';
                    echo '</tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../jquery-3.0.0.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
