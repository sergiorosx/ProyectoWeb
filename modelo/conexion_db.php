<?php

class conexion_db {

	private static $dbhost = 'ec2-54-235-250-41.compute-1.amazonaws.com';
	private static $dbport = '5432';
	private static $dbuser = 'mttiyzfntucejl';
	private static $dbpass = 'cKeLbaJYsEc-RGBwAO0GJVLJQh';
	private static $dbname = 'd6i1ehn8ve7f2c';
	private $conexion;


	private function conectar() {
		/**
		 * Estos son los detalles de inicio de sesión de la base de datos: 
		 */ 
		$conexion = pg_connect("host=".$dbhost." port=".$dbport." dbname=".$dbname." user=".$dbuser." password=".$dbpass) 
					or die('No se ha podido conectar debido al siguiente error: ' . pg_last_error());
	}

	private function cerrar() {
		pg_close($conexion);
	}


	function crearUsuario($alias, $contrasenia, $nombrecompleto, $correoUV, $correoFace, $usuarioTwitter, $rol, $tipoDoc, $numDoc, $numCel) {
		
		$conexion = this->conectar();
		
		$contrasenia = base64_encode($contrasenia);
		
		$consulta = "INSERT INTO usuario VALUES('".$alias."','".$contrasenia."','".$nombrecompleto."','".$correoUV."','".$correoFace."','".$usuarioTwitter."','".$rol."','".$tipoDoc."','".$numDoc."','".$numCel."')";

		$resultado = pg_query($conexion, $consulta);
		
		if (!$resultado) {
			echo("La inserción falló por el siguiente error: ". pg_last_error() );
		}

		this->cerrar();	
	}

	function validarUsuarioUnivalle($correoUV, $pwd){

		$conexion = this->conectar();
		
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
		this->cerrar();

		return $infousuario;
	}

	function ValidarUsuarioFacebook($correoFace){

		$conexion = this->conectar();

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
		this->cerrar();

		return $infousuario;
	}

	function validarUsuarioTwitter($usuarioTwitter){

		$conexion = this->conectar();

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

		this->cerrar();

		return $infousuario;
	}

	//conexion_bd();
	//crearUsuario('sergiogl', 'univalle123', 'Sergio Garcia', 'sergio.garcia@correounivalle.edu.co', 'sergiorosx@hotmail.com', 'sergiorosx@hotmail.com','Participante','','','');
	//crearUsuario('juancamilo', 'univalle', 'Juan Camilo Lopez', 'juan.camilo.lopez@correounivalle.edu.co', '','','Participante','','','');
	//validarUsuarioUnivalle('sergio.garcia@correounivalle.edu.co', 'univalle123');
	//validarUsuarioFacebook('sergiorosx@hotmail.com');
	//validarUsuarioTwitter('sergiorosx@hotmail.com');
	//Función codificar: base64_encode ( string $data )//Función decodificar: base64_decode ( string $data )
}
?>
