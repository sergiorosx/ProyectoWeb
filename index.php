<?php
session_start();
// validar si ya se ha iniciado sesion y redirigir al index de acuerdo al rol
if (isset($_SESSION['autorizado']) && isset($_SESSION['alias']) && isset($_SESSION['rol'])){
	if ($_SESSION['rol'] == 'Administrador') {
	header("Location: vista/index_admin.php"); 
	exit;
	}
	else if ($_SESSION['rol'] == 'Coordinador') {
		header("Location: vista/index_coordinador.php"); 
		exit;
	}
	else if ($_SESSION['rol'] == 'Jurado') {
		header("Location: vista/index_jurado.php"); 
	exit;
	}	
	else if ($_SESSION['rol'] == 'Participante') {
		header("Location: vista/index_participante.php"); 
		exit;
	}
	else {
		exit;
	}
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
    <link href="vista/web/css/bootstrap.css" rel="stylesheet">
	  <!--botones redes sociales-->
	  <link href="vista/web/css/bootstrap-social.css" rel="stylesheet" >
	
    <!-- Custom Google Web Font -->
    <link href="vista/web/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <!-- Add custom CSS here -->
    <link href="vista/web/css/custom.css" rel="stylesheet">
	  <!-- JavaScript -->    
    <script src="vista/web/js/jquery-1.10.2.js"></script>
    <script src="vista/web/js/bootstrap.js"></script>
    <script src="vista/web/js/custom.js"></script>
    <script src="vista/web/loginFacebook/loginFacebook.js"></script>
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
      <li><a href="#" class="scroll-link" data-id="home">Inicio</a></li>
      <li><a href="#" class="scroll-link" data-id="about">Acerca de</a></li>
      <li><a style="cursor:pointer;" class="loginpopup">Ingresar / Registrarse</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->
  </nav>
  
  <!-- Code for Login / Signup Popup -->
  <!-- Modal Log in -->
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
	  <div class="modal-dialog" style="margin-top: 150px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="usuarioLabel">Inicio de Sesión</h4>
	      </div>
        <form id="formlogin" method="post">
  	      <div class="modal-body" id="login_details">
    	        <span> ¿Ya tienes una cuenta? </span> <br /></br>
    	        <span style="font-weight:bold;">*Correo</span><br />
    	        <input type="email" placeholder="example@correounivalle.edu.co" name="login_correo" required="true" /><br /><br />
    	        <span style="font-weight:bold;" >*Contraseña</span><br />
    	        <input type="password" placeholder="Password" name="login_contrasenia" maxlength="20" required="true" /><br />
              <span id="error_login"></span><br />
  	      </div>
  	      <div class="modal-footer">
    			    <input style="float: left" type="submit" class="btn btn-success" value="Iniciar Sesión" id="ingresar"/>
    	        <span style="padding-right: 12px">Iniciar sesión con:</span>
    			    <div>
              <a onClick="facebookLogin()" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
    			    <a href="vista/web/loginTwitter/redirect.php" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
    			    </div>
              </br></br>
    	        <span class="fp-link"> <a href="#">¿Olvidaste la contraseña?</a></span>
    	        </br></br>
    			    <span> ¿Todavía no te has registrado?</span>
    			    <span id="signup-link" style="cursor:pointer;" class="text-info">¡Haz click aquí!</span>
  	      </div>
        </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
 <!--Modal Login Ends -->

 <!-- Modal Sign-up Starts -->
	<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
	  <div class="modal-dialog" style="margin-top: 100px;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="myModalLabel2">Registrate en Ideas UV</h4>
	      </div>
        <form id="formregistro" method="post">
  	      <div class="modal-body" id="signup_details">
    	      <span >*Nombre Completo</span>
    	      <input type="text" placeholder="Escriba su nombre completo" maxlength="30" name="registro_nombre" required="true" /> </br></br>
            <span >*Correo institucional</span>
    	      <input type="email" placeholder="example@coreounivalle.edu.co" name="registro_correo" required="true" /></br></br>
            <span >*Alias</span>
            <input type="text" placeholder="miusuario" name="registro_nick" required/> </br></br>
    	      <span >*Contraseña</span>
    	      <input type="password" placeholder="Escriba su contraseña" name="registro_contrasenia" required="true" /></br></br>
    	      <span >*Repetir contraseña</span>
    	      <input type="password" placeholder="Repita su contraseña" name="re_reg_contrasenia" required="true" /> </br></br>
            <span >Correo de facebook (opcional)</span>
            <input type="email" placeholder="example@example.com" name="registro_face" /> </br></br>
            <span >Usuario Twitter (opcional)</span>
            <input type="text" placeholder="username" maxlength="40" name="registro_twitter" /> </br></br>
            <span>* Campos obligatorios</span>
            <span id="error_registro"></span>
  	      </div>
  	      <div class="modal-footer" >
        		<input style="float: left" type="submit" class="btn btn-success" value="Registrarme" id="registro"/> 
  	        <span>&nbsp;&nbsp;&nbsp; ¿Ya eres miembro? </span><span id="login-link" class="text-info" style="cursor:pointer;">  ¡Inicia ahora!  </span> 
  		    </div>
        </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
  <!-- Modal Sign up ends! -->
  <!-- End code for Login / Signup Popup -->

  <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron intro-header" id="home">
      <div class="container">
        <br/>
        <br/>
        <br/>
        <h2>Construye soluciones socialmente</h2>
        <p class="lead">Con Ideas UV puedes: votar, opinar y crear propuestas para dar solucion a un problema en nuestra universidad.</p>
        <p><a class="btn btn-primary btn-lg loginpopup" role="button">Comienza Ya &raquo;</a></p>
      </div>
    </div> <!-- /.jumbotron -->
    <div class="content-section-a" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">Acerca de</h2>
                    <p class="lead">Ideas UV es una aplicación Web de la Universidad del Valle que permite a la comunidad universitaria aportar posibles soluciones a un problema en el marco de un concurso de ideas que se consolidan como propuestas y son sometidas a votación. También participa un grupo de expertos o jurados, los cuales evalúan si las mejores propuestas son viables y son estos los que eligen, de acuerdo a unos criterios establecidos, la mejor de ellas entre las más votadas por la comunidad.</p>
                </div>
                <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                    <img class="img-responsive" src="vista/web/img/ipad.jpg" alt="">
                </div>
            </div>
        </div><!-- /.container -->
    </div><!-- /.content-section-a -->

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