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
	$contrasena   = filter_var($_POST["contrasena"], FILTER_SANITIZE_NUMBER_INT);

	// se consulta el usuario
	$Usuario = new Usuario();
	if ($Usuario->validarUsuario()) {
		// el usuario existe
		$output = json_encode(array('type'=>'message', 'text' => 'Login'));
		die($output);
	}
	else {
		// el usuario no existe
		$output = json_encode(array('type'=>'error', 'text' => 'el usuario no existe'));
		die($output);
	}
}// REGISTRO DE USUARIO
elseif (isset($_POST['nombre']) 		&& isset($_POST['correoUV'])	&&
		isset($_POST['alias']) 			&& isset($_POST['contrasena']) 	&&
		isset($_POST['valcontrasena']) 	&& isset($_POST['correoFB']) 		&&
		isset($_POST['usuarioTw'])) {

	//Sanitize input data using PHP filter_var().
	$correo     = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
	$contrasena   = filter_var($_POST["contrasena"], FILTER_SANITIZE_NUMBER_INT);

	//additional php validation
	if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => 'Ingrese un correo valido!'));
		die($output);
	}
	//validar que sea correo univalle
	// pendiente validacoin del password, evitar sql injection y longitud minima

	$output = json_encode(array('type'=>'message', 'text' => 'entra formulario registro php'));
	die($output);
}
else {
	$output = json_encode(array('type'=>'error', 'text' => 'No entro a ninun formulario'));
	die($output);
}
?>