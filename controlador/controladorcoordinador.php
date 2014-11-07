<?php
require '../modelo/convocatoria.php';

//check if its an ajax request, exit if not
if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {  
    $output = json_encode(array( //create JSON data
    'type'=>'error',
     'text' => 'Sorry Request must be Ajax POST'
    ));
    die($output); //exit script outputting json data
}

if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['inicio']) && isset($_POST['fin'])) {
	/*
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$inicio = $_POST['inicio'];
	$fin = $_POST['fin'];
	
	$Convocatoria = new Convocatoria($nombre, $descripcion, $inicio, $fin, false);
	
	if($convocatoria->crearConvocatoria()) {
		$output = json_encode(array('type'=>'message', 'text' => 'creada'));
		die($output);
	} else {
		$output = json_encode(array('type'=>'error', 'text' => 'creando la convocatoria'));
		die($output);
	}*/
	$output = json_encode(array('type'=>'message', 'text' => 'creada'));
	die($output);
}
else {
	$output = json_encode(array('type'=>'error', 'text' => 'Fatal Error'));
	die($output);
}
?>