<?php

function conectar() {
	/**
	 * Estos son los detalles de inicio de sesi�n de la base de datos: 
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

function crearUser($alias, $contrasenia, $nombrecompleto, $correoUV, $correoFace, $usuarioTwitter, $rol, $tipoDoc, $numDoc, $numCel) {
	
	$conexion = conectar();
	$contrasenia = base64_encode($contrasenia);
	$consulta = "INSERT INTO usuario VALUES('".$alias."','".$contrasenia."','".$nombrecompleto."','".$correoUV."','".$correoFace."','".$usuarioTwitter."','".$rol."','".$tipoDoc."','".$numDoc."','".$numCel."')";
	$resultado = pg_query($conexion, $consulta);
	
	if (!$resultado) {
		echo("La inserci�n fall� por el siguiente error: ". pg_last_error() );
	}
	pg_freeResult($resultado);
	pg_close($conexion);
}

function existeUsuario ($alias, $corrreouv) {
	$conexion = conectar();
	$consulta = "SELECT * FROM usuario WHERE correoUnivalle = '$correoUV' AND contrasenia = '$pwd'";
	$resultado = pg_query($conexion, $consulta);
	
	if($resultado) {
		return false;
	}
		
	pg_freeResult($resultado);
	pg_close($conexion);
	
	return true;
}

function validarUsuarioUnivalle($correoUV, $pwd){
	$conexion = conectar();
	
	$pwd = base64_encode($pwd);
	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE correoUnivalle = '$correoUV' AND contrasenia = '$pwd'";
	$resultado = pg_query($conexion, $consulta) or die ('La consulta fall� por el siguiente error: ' . pg_last_error());

	if (!$resultado){
    		$infousuario = null;
	}
	$array = pg_fetch_array($resultado);
	pg_freeResult($resultado);
	pg_close($conexion);
	
	return $array;
}

function validarUsuarioFacebook($correoFace){
	$conexion = conectar();

	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE correoFacebook='$correoFace'";

	$resultado = pg_query($conexion, $consulta) or die ('La consulta fall� por el siguiente error: ' . pg_last_error());	

	if (!$resultado){ 
    	$infousuario = null;
	}
	$array = pg_fetch_array($resultado);
	pg_freeResult($resultado);
	pg_close($conexion);

	return $array;
}

function validarUsuarioTwitter($usuarioTwitter){
	$conexion = conectar();
	$consulta = "SELECT alias, nombre_completo, rol FROM usuario WHERE usuarioTwitter ='$usuarioTwitter'";

	$resultado = pg_query($conexion, $consulta) or die ('La consulta fall� por el siguiente error: ' . pg_last_error());

	if (!$resultado){ 
    	$infousuario = false;
	}
	$array = pg_fetch_array($resultado);

	pg_freeResult($resultado);
	pg_close($conexion);

	return $array;
}
//conexion_bd();
//crearUser('sergiogl', 'univalle123', 'Sergio Garcia', 'sergio.garcia@correounivalle.edu.co', 'sergiorosx@hotmail.com', 'sergiorosx','Participante','','','');
//crearUser('juancamilo', 'univalle123', 'Juan Camilo Lopez', 'juan.camilo.lopez@correounivalle.edu.co', 'juancamilo_lopez9218@hotmail.com','JuanCamilo9218','Administrador','','','');
//crearUser('luisfel', 'univalle123', 'Luis Felipe Murillo', 'luis.murillo@correounivalle.edu.co', '','','Coordinador','','','');
//validarUsuarioUnivalle('sergio.garcia@correounivalle.edu.co', 'univalle123');
//validarUsuarioFacebook('sergiorosx@hotmail.com');
//validarUsuarioTwitter('sergiorosx');

function crearConv($nombre, $descripcion, $fechainicio, $fechafin, $publica) {
	
	$conexion = conectar();
	
	$consulta = "INSERT INTO convocatoria (nombre, descripcion, fecha_inicio, fecha_fin, publicada) VALUES('".$nombre."','".$descripcion."','".$fechainicio."','".$fechafin."','".$publica."')";
	$resultado = pg_query($conexion, $consulta);
	
	if (!$resultado) {
		return false;
	}
	pg_freeResult($resultado);
	pg_close($conexion);
	return true;
}

//crearConv('restauranteUV','Largas Filas en el restaurante universitario de univalle','2014/11/6','2014/11/20','false');
//crearConv('reciclajeUV','Se estan desperdiciando grandes volumenes de material reciclable','2014/10/03','2014/12/03','false');
//crearConv('encapuchados','personas con identidad desconocidad alteran el orden publico de la universidad y el sector de la pasoancho con 100','2014/09/13','2014/12/03','false');

function consultarUsuarios(){
	$conexion = conectar();
	
	$consulta = "SELECT alias, nombre_completo, rol, correounivalle FROM usuario";
	$resultado = pg_query($conexion, $consulta) or die ('La consulta de convocatorias fall� por el siguiente error: ' . pg_last_error());
	
	$filas=pg_numrows($resultado);
	if ($filas==0){ 
    	$infousuarios = "False";
	} else {             
        while ($line = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
    		foreach ($line as $col_value) {
        		$infousuarios .= $col_value.",";
    		}
		}
	}
	//echo $infousuarios;
	
	$array = pg_fetch_all($resultado);
	pg_freeResult($resultado);
	pg_close($conexion);
	
	//print_r ($array);
	
	return $array;	
}
//consultarUsuarios();

//Esta funcion devuelve todas las convocatorias que se encuentran publicas en la base de datos, las envia en un array
//por tanto hay que ver linea por linea para colocar en cada convocatoria su nombre y su descripcion y validar su fecha
function consultarConvocatorias(){
	$conexion = conectar();
	
	$consulta = "SELECT nombre, descripcion, fecha_inicio, fecha_fin, publicada FROM convocatoria";
	$resultado = pg_query($conexion, $consulta) or die ('La consulta de convocatorias fall� por el siguiente error: ' . pg_last_error());
	
	if (!$resultado){ 
    	return false;
	}
	//echo $infoconvocatoria;
	$array = pg_fetch_all($resultado);
	pg_freeResult($resultado);
	pg_close($conexion);
	
	return $array;
}
//consultarConvocatorias();

function publicarConvocatoria ($nombre) {
	$conexion = conectar();
	
	$update = "UPDATE convocatoria SET publicada='t' WHERE nombre='".$nombre."'";
	$resultado = pg_query($conexion, $update);
	
	if (!$resultado){ 
    	return false;
	}
	
	pg_freeResult($resultado);
	pg_close($conexion);
	return true;
}
//publicarConvocatoria('restauranteUV');
?>