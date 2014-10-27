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
$direccionIP ="localhost";
$puerto = "5432";
$nombreBD = "ideasUV";
$usuario = "postgres";
$contraseña = "postgres";
$conexion = pg_connect("host=".$direccion." port=".$puerto." dbname=".$nombreBD." user=".$usuario." password=".$contraseña)
    or die('No se ha podido conectar debido al siguiente error: ' . pg_last_error());
return $conexion;
}

Function crearUsuario($alias,$contrasena, $nombres, $apellidos, $fechaNac, $nroDoc, $nroCel, $correoUV){
	$conexion = conectarBD();

	$consulta = "INSERT INTO usuario VALUES('".$alias."','".$contrasena."','".$nombres."','".$apellidos."','".$fechaNac."','".$nroDoc."','".$nroCel."','".$correoUV."')";

	//$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());
	$resultado = pg_insert($conexion, $consulta);
	if (!$resultado) {
		echo("La inserción falló por el siguiente error: ". pg_last_error() );
	}

	pg_close($conexion);
}

Function consultarUsuario($alias){
$conexion = conectarBD();

$consulta = "SELECT * FROM usuario";

$resultado = pg_query($conexion, $consulta) or die ('La consulta falló por el siguiente error: ' . pg_last_error());

pg_close($conexion);
}


// Realizando una consulta SQL
$query = 'SELECT * FROM authors';
$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());

// Imprimiendo los resultados en HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Liberando el conjunto de resultados
pg_free_result($result);

// Cerrando la conexión
pg_close($dbconn);
?>

Función codificar: base64_encode ( string $data )
Función decodificar: base64_decode ( string $data )