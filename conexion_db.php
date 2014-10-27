<?php

$user = "mttiyzfntucejl";
$password = "cKeLbaJYsEc-RGBwAO0GJVLJQh";
$dbname = "d6i1ehn8ve7f2c";
$port = "5432";
$host = "54.235.250.41";

$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
echo "<h3>Conexion Exitosa PHP - PostgreSQL</h3><hr><br>";

pg_close($conexion);

?>