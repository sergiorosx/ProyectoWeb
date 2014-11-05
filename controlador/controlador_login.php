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
	$output = json_encode(array('type'=>'message', 'text' => 'entra formulario login php'));
	die($output);
}// REGISTRO DE USUARIO
elseif (isset($_POST['nombre']) 		&& isset($_POST['correoUV'])	&&
		isset($_POST['alias']) 			&& isset($_POST['contrasena']) 	&&
		isset($_POST['valcontrasena']) 	&& isset($_POST['correoFB']) 		&&
		isset($_POST['usuarioTw'])) {

	//Sanitize input data using PHP filter_var().
	$correo     = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
	$contrasena   = filter_var($_POST["contrasenia"], FILTER_SANITIZE_NUMBER_INT);

	//additional php validation
	if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => 'Ingrese un correo valido!'));
		die($output);
	}
	//validar que sea correo univalle
	// pendiente validacoin del password, evitar sql injection y longitud minima


	$output = json_encode(array('type'=>'message', 'text' => 'entra formulario registro php'));
	die($output);
	
	// validar campos
	$nombre = $_POST['registro_nombre'];
	$correo = $_POST['registro_correo'];
	$nick = $_POST['registro_nick'];
	$contrasenia = $_POST['registro_contrasenia'];
	$valcontrsenia = $_POST['re_reg_contrasenia'];
	$facebook = $_POST['registro_face'];
	$twitter = $_POST['registro_twitter'];
	/**/
}
else {
	$output = json_encode(array('type'=>'error', 'text' => 'No entro a ninun formulario'));
	die($output);
}
?>