<?php
session_start();
// El session_start(); ya estaría iniciado en tu script "padre" .. Si se llama directo .. ni se accederá a $_SESSION por ende no existirá y se redireccionará hacia tu página que indiques (puedes usar rutas [url]http://www.tal.tal[/url] por si llamasen al script desde otros sitios ... 
if (!isset($_SESSION['autorizado'])){ 
	header ("Location: http://ideasuv.heliohost.org"); 
	exit; 
}
if ($_SESSION['rol'] != 'Jurado') {
	header ("Location: http://ideasuv.heliohost.org"); 
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href='vista\web\img\LogoIdeasUV.jpg' rel='shortcut icon' type='image/png'>

    <title>Ideas UV - Universidad del Valle</title>

    <!-- Bootstrap core CSS -->
    <link href="web/css/bootstrap.css" rel="stylesheet">
	<!--botones redes sociales-->
	 <link href="web/css/bootstrap-social.css" rel="stylesheet" >
	
    <!-- Custom Google Web Font -->
    <link href="web/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <!-- Add custom CSS here -->
    <link href="web/css/custom.css" rel="stylesheet">
	<!-- JavaScript -->
    <script src="web/js/jquery-1.10.2.js"></script>
    <script src="web/js/bootstrap.js"></script>
    <script src="web/js/custom.js"></script>
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Ideas UV</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#" class="scroll-link" data-id="">Propuestas</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">¡Bienvenido <strong><?php echo ' '.$_SESSION['alias'].'!'; ?></strong> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Mi cuenta</a></li>
          <li class="divider"></li>
          <li><a href="logout.php">Cerrar sesion</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
  </nav>
  <div class="container" id="primer-elemento">
    <h1>Pagina de inicio para jurados</h1>
    <p>desarrollar front-end restante</p>
  </div>
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-lg-12">
                  <p class="copyright text-muted small">Copyright &copy; Ideas UV 2014. Todos los derechos reservados</p>
              </div>
          </div>
      </div>
  </footer>
</body>
</html>
