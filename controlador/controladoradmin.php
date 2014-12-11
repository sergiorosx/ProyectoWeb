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


// REGISTRO / EDICION DE USUARIO index-admin.php
if (isset($_POST['nombre']) 	&& isset($_POST['correoUV'])		&&
	isset($_POST['alias']) 		&& isset($_POST['rol'])					&&
	isset($_POST['contrasena']) && isset($_POST['valcontrasena']) 	&& 
	isset($_POST['correoFB']) 	&& isset($_POST['usuarioTw'])		&& 
	isset($_POST['tipodoc'])	&& isset($_POST['documento'])		&& 
	isset($_POST['celular'])	&& isset($_POST['accion'])) {
	
	//Sanitize input data using PHP filter_var().
	$nombre			= $_POST["nombre"];
	$correoUV     	= filter_var($_POST["correoUV"], FILTER_SANITIZE_EMAIL);
	$alias			= $_POST["alias"];
	$contrasena 	= $_POST["contrasena"];
	$valcontrasena	= $_POST["valcontrasena"];
	$correoFB		= $_POST["correoFB"];
	$usuarioTw		= $_POST["usuarioTw"];
	$tipodoc 		= $_POST["tipodoc"];
	$documento		= $_POST["documento"];
	$celular		= $_POST["celular"];
	$accion 		= $_POST['accion'];
	
	//validar que sea correo univalle
	// pendiente validacoin del password, evitar sql injection y longitud minima
	
	$Usuario = new Usuario();
	
	if ($accion == 'Crear') {
		if	($Usuario->crearUsuario($alias, $contrasena, $nombre, $correoUV, $correoFB, $usuarioTw, $rol, $tipodoc, $documento, $celular)) {
			$output = json_encode(array('type'=>'message', 'alias' => $Usuario->getAlias()));
			die($output);
		} else {
			$output = json_encode(array('type'=>'error', 'text' => 'el usuario ya existe'));
			die($output);
		}
	}
	elseif ($accion == 'Editar'){
		if	($Usuario->editarUsuario($alias, $nombre, $correoUV, $correoFB, $usuarioTw, $rol, $tipodoc, $documento, $celular)) {
			$output = json_encode(array('type'=>'message', 'text' => 'usuario editado correctamente'));
			die($output);
		}
		else {
			$output = json_encode(array('type'=>'error', 'text' => 'usuario no existe'));
			die($output);
		}
	}
	else {
		$output = json_encode(array('type'=>'error', 'text' => 'error de accion'));
		die($output);
	}
}
elseif (isset($_POST['aliasdel'])) {
	$alias = $_POST['aliasdel'];
	$Usuario = new Usuario();
	
	if ($Usuario->eliminarUsuario($alias)) {
		$output = json_encode(array('type'=>'message', 'text' => 'usuario eliminado del sistema'));
		die($output);
	}
	else {
		$output = json_encode(array('type'=>'error', 'text' => 'error al eliminar el usuario'));
		die($output);
	}
}
else {
	$output = json_encode(array('type'=>'error', 'text' => 'Fatal Error'));
	die($output);
}
?>