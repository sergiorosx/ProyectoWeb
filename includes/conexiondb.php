<?php

Function conexion_bd() {
/**
 * Estos son los detalles de inicio de sesión de la base de datos: 
 */  
	// El alojamiento al que deseas conectarte
	define("HOST", "ec2-54-235-250-41.compute-1.amazonaws.com");
	// El nombre de usuario de la base de datos
	define("USER", "mttiyzfntucejl");
	// La contraseña de la base de datos
	define("PASSWORD", "cKeLbaJYsEc-RGBwAO0GJVLJQh");
	// El nombre de la base de datos
	define("DATABASE", "d6i1ehn8ve7f2c");
	// El puerto de la base de datos
	define("PORT", "5432");
	// conexion a la base de datos
	$conexion = pg_connect("host=".HOST." port=".PORT." dbname=".DATABASE." user=".USER." password=".PASSWORD) 
			or die('No se ha podido conectar debido al siguiente error: ' . pg_last_error());
	return $conexion;
}


Function crearUsuario($alias, $contrasena, $nombrecompleto, $correoUV, $correoFace, $correoTwitter, $rol, $tipoDoc, $numDoc, $numCel){
	
	$conexion = conexion_bd();
	
	$pass = base64_encode($contrasena);
	
	$consulta = "INSERT INTO usuario VALUES('".$alias."','".$pass."','".$nombrecompleto."','".$correoUV."','".$correoFace."','".$correoTwitter."','".$rol."','".$tipoDoc."','".$numDoc."','".$numCel."')";

	$resultado = pg_query($conexion, $consulta);
	
	if (!$resultado) {
		echo("La inserción falló por el siguiente error: ". pg_last_error() );
	}

	pg_close($conexion);
}

Function validarUsuarioUnivalle($correoUV, $pwd){

	$conexion = conexion_bd();
	
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

	pg_FreeResult($resultado);
	pg_close($conexion);

	return $infousuario;
}

Function ValidarUsuarioFacebook($correoFace){

	$conexion = conexion_bd();

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
	echo $infousuario;

	pg_FreeResult($resultado);

	pg_close($conexion);

	return $infousuario;
}

Function validarUsuarioTwitter($correoTwitter){

	$conexion = conexion_bd();

	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE correoTwitter ='$correoTwitter'";

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

	pg_FreeResult($resultado);

	pg_close($conexion);

	return $infousuario;
}

//conexion_bd();
//crearUsuario('sergiogl', 'univalle123', 'Sergio Garcia', 'sergio.garcia@correounivalle.edu.co', 'sergiorosx@hotmail.com', 'sergiorosx@hotmail.com','Participante','','','');
//crearUsuario('juancamilo', 'univalle', 'Juan Camilo Lopez', 'juan.camilo.lopez@correounivalle.edu.co', '','','Participante','','','');
//validarUsuarioUnivalle('sergio.garcia@correounivalle.edu.co', 'univalle123');
//validarUsuarioFacebook('sergiorosx@hotmail.com');
//validarUsuarioTwitter('sergiorosx@hotmail.com');
//Función codificar: base64_encode ( string $data )//Función decodificar: base64_decode ( string $data )
?>
