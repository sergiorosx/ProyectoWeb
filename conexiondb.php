/*
CREATE TABLE usuario{
	alias VARCHAR(20) PRIMARY KEY,
	contraseña VARCHAR(20) NOT NULL,
	nombres VARCHAR(30) NOT NULL,
	apellidos VARCHAR(30) NOT NULL,
	fechaNacimiento DATE NOT NULL,
	nroDocumento VARCHAR(15) NOT NULL,
	nroCelular VARCHAR(15) NOT NULL,
	correoUnivalle VARCHAR(40) UNIQUE NOT NULL
	--,
	--correoFacebook VARCHAR(40) UNIQUE NOT NULL,
	--correoTwitter VARCHAR(40) UNIQUE NOT NULL
}
*/

<?php

Function conectarBD(){
// Conectando y seleccionando la base de datos  
$direccionIP ="ec2-54-235-250-41.compute-1.amazonaws.com";
$puerto = "5432";
$nombreBD = "d6i1ehn8ve7f2c";
$usuario = "mttiyzfntucejl";
$contraseña = "cKeLbaJYsEc-RGBwAO0GJVLJQh";
$conexion = pg_connect("host=".$direccion." port=".$puerto." dbname=".$nombreBD." user=".$usuario." password=".$contraseña)
    or die('No se ha podido conectar debido al siguiente error: ' . pg_last_error());
return $conexion;
}

Function crearUsuario($alias,$contrasena, $nombres, $apellidos, $fechaNac, $nroDoc, $nroCel, $correoUV, $correoFace, $correoTwitter, $codigorol){
	$conexion = conectarBD();
	$pass = base64_encode($contrasena);
	$consulta = "INSERT INTO usuario VALUES('".$alias."','".$pass."','".$nombres."','".$apellidos."','".$fechaNac."','".$nroDoc."','".$nroCel."','".$correoUV."','".$correoFace."','".$correoTwitter."','".$codigorol."')";
	$consulta2 = "INSERT INTO usuarioxrol (codigorol) VALUES ('".$codigorol."')";
	
	//$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());
	$resultado = pg_insert($conexion, $consulta);
	$resultado = pg_insert($conexion, $consulta2);
	if (!$resultado) {
		echo("La inserción falló por el siguiente error: ". pg_last_error() );
	}

	pg_close($conexion);
}

Function consultarUsuarioUnivalle($correoUV){
$conexion = conectarBD();

$consulta = "SELECT * FROM usuario, usuarioxrol WHERE correoUnivalle='$correoUV'";

$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());
$filas=pg_numrows($resultado); 
if ($filas==0){ 
    echo "No se encontro ningun registro\n"; exit;
}else{             
                for($cont=0;$cont<$filas;$cont++)
                { 
                 $campo1=pg_result($resultado,$cont,0);//posicion 0 se encuentra el dato alias             
                 $campo2=pg_result($resultado,$cont,1);//posicion 1 se encuentra el dato contrasena 
				 $pass = base64_decode($campo2);//decodificar contrasena
				 echo "$campo1 - $pass \n";
                }
}
pg_FreeResult($resultado);
pg_close($conexion);
}

Function consultarUsuarioFacebook($correoFace){
$conexion = conectarBD();

$consulta = "SELECT * FROM usuario, usuarioxrol WHERE correofacebook='$correoFace'";

$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());
$filas=pg_numrows($resultado); 
if ($filas==0){ 
    echo "No se encontro ningun registro\n"; exit;
}else{             
                for($cont=0;$cont<$filas;$cont++)
                { 
                 $campo1=pg_result($resultado,$cont,0);//posicion 0 se encuentra el dato alias             
                 echo "$campo1 \n";
                }
}
pg_FreeResult($resultado);
pg_close($conexion);
}

Function consultarUsuarioTwitter($correoTwitter){
$conexion = conectarBD();

$consulta = "SELECT * FROM usuario, usuarioxrol WHERE correotwitter='$correoTwitter'";

$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());
$filas=pg_numrows($resultado); 
if ($filas==0){ 
    echo "No se encontro ningun registro\n"; exit;
}else{             
                for($cont=0;$cont<$filas;$cont++)
                { 
                 $campo1=pg_result($resultado,$cont,0);//posicion 0 se encuentra el dato alias             
                 echo "$campo1 \n";
                }
}
pg_FreeResult($resultado);
pg_close($conexion);
}


//Función codificar: base64_encode ( string $data )//Función decodificar: base64_decode ( string $data )
?>

