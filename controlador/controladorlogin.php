<?php
require '../modelo/usuario.php';

//check if its an ajax request, exit if not
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {  
    $output = json_encode(array( //create JSON data
    'type'=>'error',
     'text' => 'Sorry Request must be Ajax POST'
    ));
    die($output); //exit script outputting json data
}

// INICIO DE SESION POR BASE DE DATOS TRANSACCIONAL
if ( isset($_POST['correo']) && isset($_POST['contrasena']) ) {

	//Sanitize input data using PHP filter_var().
	$correo     = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
	$contrasena = $_POST["contrasena"];
	// se consulta el usuario
	$Usuario = new Usuario();
	// el usuario existe
	if ($Usuario->validarUsuario($correo, $contrasena)) {
		session_start(); 
		$_SESSION['autorizado']=true; 
		$_SESSION['alias'] = $Usuario->getAlias();
		$_SESSION['rol'] = $Usuario->getRol();
		$output = json_encode(array('type'=>'message', 'role' => $Usuario->getRol()));
		die($output);
	}
	else {
		// el usuario no existe
		$output = json_encode(array('type'=>'error', 'text' => 'usuario o contraseña inválidas'));
		die($output);
	}
} // INICIO DE SESION POR FACEBOOK
elseif ( isset($_POST['correoFacebook']) ) {
	//Sanitize input data using PHP filter_var().
	$correoFacebook = filter_var($_POST["correoFacebook"], FILTER_SANITIZE_EMAIL);
	// se consulta el usuario
	$Usuario = new Usuario();
	// el usuario existe
	if ($Usuario->validarUsuarioFb($correoFacebook)) {
		session_start(); 
		$_SESSION['autorizado']=true; 
		$_SESSION['alias'] = $Usuario->getAlias();
		$_SESSION['rol'] = $Usuario->getRol();
		$output = json_encode(array('type'=>'message', 'role' => $Usuario->getRol()));
		die($output);
	}
	else {
		// el usuario no existe
		$output = json_encode(array('type'=>'error', 'text' => 'cuenta Facebook no relacionada con @correoUV'));
		die($output);
	}
}// REGISTRO DE USUARIO index-admin.php
elseif (isset($_POST['nombre']) 		&& isset($_POST['correoUV'])	&&
		isset($_POST['alias']) 			&& isset($_POST['contrasena']) 	&&
		isset($_POST['valcontrasena']) 	&& isset($_POST['correoFB']) 	&&
		isset($_POST['usuarioTw'])) {

	//Sanitize input data using PHP filter_var().
	$nombre			= $_POST["nombre"];
	$correoUV     	= filter_var($_POST["correoUV"], FILTER_SANITIZE_EMAIL);
	$alias			= $_POST["alias"];
	$contrasena 	= $_POST["contrasena"];
	$valcontrasena	= $_POST["valcontrasena"];
	$correoFB		= $_POST["correoFB"];
	$usuarioTw		= $_POST["usuarioTw"];
	
	/*//additional php validation
	if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => 'Ingrese un correo valido!'));
		die($output);
	}*/
	//validar que sea correo univalle
	// pendiente validacoin del password, evitar sql injection y longitud minima
	
	$Usuario = new Usuario();
	
	if	($Usuario->crearUsuario($alias, $contrasena, $nombre, $correoUV, $correoFB, $usuarioTw, , '','','') ) {
		$output = json_encode(array('type'=>'message', 'alias' => $Usuario->getAlias()));
		die($output);
	} else {
		$output = json_encode(array('type'=>'error', 'text' => 'el usuario ya existe'));
		die($output);
	}
}
// REGISTRO DE USUARIO index.php
elseif (isset($_POST['nombre']) 		&& isset($_POST['correoUV'])	&&
		isset($_POST['alias']) 			&& isset($_POST['contrasena']) 	&&
		isset($_POST['valcontrasena']) 	&& isset($_POST['correoFB']) 	&&
		isset($_POST['usuarioTw'])) {

	//Sanitize input data using PHP filter_var().
	$nombre			= $_POST["nombre"];
	$correoUV     	= filter_var($_POST["correoUV"], FILTER_SANITIZE_EMAIL);
	$alias			= $_POST["alias"];
	$contrasena 	= $_POST["contrasena"];
	$valcontrasena	= $_POST["valcontrasena"];
	$correoFB		= $_POST["correoFB"];
	$usuarioTw		= $_POST["usuarioTw"];
	
	/*//additional php validation
	if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => 'Ingrese un correo valido!'));
		die($output);
	}*/
	//validar que sea correo univalle
	// pendiente validacoin del password, evitar sql injection y longitud minima
	
	$Usuario = new Usuario();
	
	if	($Usuario->crearUsuario($alias, $contrasena, $nombre, $correoUV, $correoFB, $usuarioTw, 'Participante', '','','') ) {
		$output = json_encode(array('type'=>'message', 'alias' => $Usuario->getAlias()));
		die($output);
	} else {
		$output = json_encode(array('type'=>'error', 'text' => 'el usuario ya existe'));
		die($output);
	}
}
else {
	$output = json_encode(array('type'=>'error', 'text' => 'Fatal Error'));
	die($output);
}
?>