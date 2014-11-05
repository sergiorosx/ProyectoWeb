<?php

function conectar() {
	/**
	 * Estos son los detalles de inicio de sesión de la base de datos: 
	 */ 
	$dbhost = 'ec2-54-235-250-41.compute-1.amazonaws.com';
	$dbport = '5432';
	$dbname = 'd6i1ehn8ve7f2c';
	$dbuser = 'mttiyzfntucejl';
	$dbpass = 'cKeLbaJYsEc-RGBwAO0GJVLJQh';
	$conexion = pg_connect("host=".$dbhost." port=".$dbport." dbname=".$dbname." user=".$dbuser." password=".$dbpass)
		or die('No se ha podido conectar debido al siguiente error: ' . pg_last_error());
	return $conexion;
}

function cerrar($conn) {
	pg_close($conexion);
}

function crearUsuario($alias, $contrasenia, $nombrecompleto, $correoUV, $correoFace, $usuarioTwitter, $rol, $tipoDoc, $numDoc, $numCel) {
	
	$conexion = conectar();
	$contrasenia = base64_encode($contrasenia);
	
	$consulta = "INSERT INTO usuario VALUES('".$alias."','".$contrasenia."','".$nombrecompleto."','".$correoUV."','".$correoFace."','".$usuarioTwitter."','".$rol."','".$tipoDoc."','".$numDoc."','".$numCel."')";
	$resultado = pg_query($conexion, $consulta);
	
	if (!$resultado) {
		echo("La inserción falló por el siguiente error: ". pg_last_error() );
	}
	pg_freeResult($resultado);
	pg_close($conexion);
}

function validarUsuarioUnivalle($correoUV, $pwd){
	$conexion = conectar();
	
	$pwd = base64_encode($pwd);
	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE correoUnivalle = '$correoUV' AND contrasenia = '$pwd'";
	$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());
	$filas = pg_numrows($resultado);

	if ($filas == 0){
    		$infousuario = "False";
	}
	else {
		while ($line = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
    		foreach ($line as $col_value) {
        		$infousuario .= $col_value.",";
    		}
		}
	}
	//echo $infousuario;
	pg_freeResult($resultado);
	pg_close($conexion);

	return $infousuario;
}

function ValidarUsuarioFacebook($correoFace){
	$conexion = conectar();

	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE correoFacebook='$correoFace'";

	$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());	

	$filas=pg_numrows($resultado); 

	if ($filas==0){ 
    	$infousuario = "False";
	} else {             
        while ($line = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
    		foreach ($line as $col_value) {
        		$infousuario .= $col_value.",";
    		}
		}
	}
	//echo $infousuario;

	pg_freeResult($resultado);
	pg_close($conexion);

	return $infousuario;
}

function validarUsuarioTwitter($usuarioTwitter){
	$conexion = conectar();
	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE usuarioTwitter ='$usuarioTwitter'";

	$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());

	$filas=pg_numrows($resultado); 

	if ($filas==0){ 
    	$infousuario = "False";
	} else {             
        while ($line = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
    		foreach ($line as $col_value) {
        		$infousuario .= $col_value.",";
    		}
		}
	}
	echo $infousuario;

	pg_freeResult($resultado);
	pg_close($conexion);

	return $infousuario;
}

//conexion_bd();
//crearUsuario('sergiogl', 'univalle123', 'Sergio Garcia', 'sergio.garcia@correounivalle.edu.co', 'sergiorosx@hotmail.com', 'sergiorosx','Participante','','','');
//crearUsuario('sergio.garcia', 'unamascontra', 'Sergio Garcia', 'sergio.garcia@correounivalle.edu.co', 'sergiorosx@hotmail.com', 'sergiorosx','Administrador','','','');
//crearUsuario('juancamilo', 'otracontra', 'Juan Camilo Lopez', 'juan.camilo.lopez@correounivalle.edu.co', '','','Participante','','','');
//validarUsuarioUnivalle('sergio.garcia@correounivalle.edu.co', 'univalle123');
//validarUsuarioFacebook('sergiorosx@hotmail.com');
//validarUsuarioTwitter('sergiorosx');
echo 'ok';
?>