
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Wallace Almeida">
    <link rel="icon" href="img/favicon.ico">

    <title>Cá entre elas</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:400" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:300" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=PT+Sans" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!--<div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="#">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
    </div>-->

    <img src="img/header.png" class="img-responsive center-block">

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <?php
        include_once('comum/config.php');
        $bd = BancoDeDados::getInstance();
        $conn = $bd->getConexao();

        $query = "SELECT b.* FROM banners b WHERE b.ativo = 1 ORDER BY b.ordem LIMIT 3";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();
      ?>
      <ol class="carousel-indicators">
      <?php
        for($i=0; $i < $result->num_rows; $i++){
          if($i==0){
            echo "<li data-target=\"#myCarousel\" data-slide-to=\"$i\" class=\"active\"></li>";
          }
          else{
            echo "<li data-target=\"#myCarousel\" data-slide-to=\"$i\"></li>"; 
          }
        }
      ?>
      </ol>

      <div class="carousel-inner" role="listbox">
        <?php
          $classes = ['first-slide','second-slide','third-slide'];
          $cont = 0;
          while ($linha = $result->fetch_assoc()) {
        ?>
            <div class="item <?php if($cont==0) echo 'active'; ?>">
              <img class="<?php echo $classes[$cont]; ?> img-responsive center-block" src="<?php echo $linha['uri_imagem']; ?>" alt="<?php echo $linha['titulo']; ?>">
              <div class="container">
                <div class="carousel-caption">
                  <p><span class="carousel-title"><?php echo $linha['titulo']; ?></span></p>
                </div>
              </div>
            </div>
        <?php
            $cont++;
          }
        ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
      </a>
    </div><!-- /.carousel -->


    <div class="container">

      <!-- <div class="blog-header">
        <h1 class="blog-title">The Bootstrap Blog</h1>
        <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
      </div> -->

      <div class="row">

        <div class="col-sm-8 blog-main">

          <?php

              $query = "SELECT p.*, u.primeiro_nome, u.ultimo_nome FROM posts p INNER JOIN usuarios u WHERE p.id_autor = u.id ORDER BY p.timestamp DESC LIMIT 3";

              $stmt = $conn->prepare($query);
              $stmt->execute();

              $result = $stmt->get_result();

              while ($linha = $result->fetch_assoc()) {
          ?>
              <div class="blog-post">
                <h2 class="blog-post-title"><?php echo $linha['titulo']; ?></h2>
                <p class="blog-post-meta text-center">em <?php echo date('j/m/Y', strtotime($linha['timestamp'])); ?> por <a href="#"><?php echo $linha['primeiro_nome'] . ' ' . $linha['ultimo_nome']; ?></a></p>

                <?php
                  if(!is_null($linha['uri_imagem'])){
                    echo "<img src=\"" . $linha['uri_imagem'] . "\" class=\"img-responsive center-block\">";
                  }
                ?>
                
                <p><?php echo $linha['texto']; ?></p>

                <hr class="post-hr">

                <span class="center-block text-center"><a href="#" class="btn btn-blog">LEIA MAIS</a></span>
              </div><!-- /.blog-post -->
          <?php
            }
            $bd->fechaConexao($conn);
          ?>

          <nav>
            <ul class="pager">
              <li><a href="#">Anterior</a></li>
              <li><a href="#">Próximo</a></li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <!--<div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>-->
          <div class="sidebar-module">
            <div class="row row-vertical-align sidebar-module-first">
                <div class="col-sm-3 col-xs-3"><a href="#"><img src="img/facebook_icon.png" class="center-block"></a></div>
                <div class="col-sm-3 col-xs-3"><a href="#"><img src="img/instagram_icon.png" class="center-block"></a></div>
                <div class="col-sm-3 col-xs-3"><a href="#"><img src="img/youtube_icon.png" class="center-block"></a></div>
                <div class="col-sm-3 col-xs-3"><a href="#"><img src="img/pinterest_icon.png" class="center-block"></a></div>
            </div>
          </div>

          <hr class="sidebar-hr">

          <img src="img/camila_perfil.png" class="img-responsive center-block">

          <p class="autora"><span class="camila">CAMILA</span><span>, PRAZER!<span></p>
          <p class="text-center">JORNALISTA, MAQUIADORA, FASHION LOVER E CURIOSA POR NATUREZA.<br>VIVO EM SÃO PAULO, MAS ACREDITO QUE O MUNDO É O NOSSO LUGAR.</p>

          <hr class="sidebar-hr">

          <p class="text-center">Para parcerias, pautas ou enviar amor:</p>

          <a href="#"><img src="img/contato.png" class="img-responsive center-block"></a>

          <div class="sidebar-module sidebar-module-first">
            <p class="text-center"><span class="sidebar-title">INSCREVA-SE!</span></p>
            
            <div class="row">
              <p class="text-center">Receba as últimas novidades e promoções primeiro!</p>

              <form>
                <div class="form-group">
                  <input type="text" id="email_inscricao" placeholder="seu e-mail" />
                </div>
              </form>
            </div>

          </div>

          <div class="sidebar-module">
            <img src="img/bloco.png" class="img-responsive center-block">
            <img src="img/ca_entre_elas_insta.png" class="img-responsive center-block sidebar-img-overlayed-1">
          </div>

          <div class="sidebar-module">
            <img src="img/eyes.png" class="img-responsive center-block">
          </div>

          <div class="sidebar-module">
            <img src="img/inspire_se.png" class="img-responsive center-block sidebar-img-overlay">
            <img src="img/bloco.png" class="img-responsive center-block sidebar-img-overlayed-3">
          </div>

          <div class="sidebar-module">
            <img src="img/ad.png" class="img-responsive center-block">
          </div>

          <div class="sidebar-module">
            <img src="img/segue_o_som.png" class="img-responsive center-block sidebar-img-overlay">
            <img src="img/bloco.png" class="img-responsive center-block sidebar-img-overlayed-2">
          </div>

          <div class="sidebar-module">
            <p class="text-center"><span class="sidebar-title">Trend Topics!</span></p>
            <!--<ul class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">March 2014</a></li>
              <li><a href="#">March 2014</a></li>
            </ul>-->
            
            <div class="row row-vertical-align">
              <div class="col-sm-6 col-xs-4"><img src="img/bloco.png" class="img-thumbnail"></div>
              <div class="col-sm-6 col-xs-4"><p class="text-center">5 top marcas de maquiagem francesa</p></div>
            </div>

            <div class="row row-vertical-align">
              <div class="col-sm-6 col-xs-4"><img src="img/bloco.png" class="img-thumbnail"></div>
              <div class="col-sm-6 col-xs-4"><p class="text-center">5 top marcas de maquiagem francesa</p></div>
            </div>

            <div class="row row-vertical-align">
              <div class="col-sm-6 col-xs-4"><img src="img/bloco.png" class="img-thumbnail"></div>
              <div class="col-sm-6 col-xs-4"><p class="text-center">5 top marcas de maquiagem francesa</p></div>
            </div>

          </div>

          <div class="sidebar-module">
            <img src="img/ad.png" class="img-responsive center-block">
          </div>

        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="img/bloco.png" class="img-thumbnail"></div>
        <div class="col-sm-4 col-xs-4"><img src="img/bloco.png" class="img-thumbnail"></div>
        <div class="col-sm-4 col-xs-4"><img src="img/bloco.png" class="img-thumbnail"></div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <p class="text-center">Para parcerias, pautas ou enviar amor: <a href="#"><img src="img/contato.png"></a></p> 
      </div>
    </div>

    <footer class="blog-footer">
      <!--<p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>-->
      <p>
        <a href="#">Topo</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-3.0.0.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
