<?php 
/*
$nombreUsuario	=$_POST['nombre'];
$tipoRol		=$_POST['rol'];
echo("Usuario: ".$nombreUsuario." Rol: ".$tipoRol."<br>");
*/
Function manejaUsuarioRol($tipoRol){

if($tipoRol == 'Administrador'){
	echo('Administrador');
	header('Location: index_admin.html');
}
if($tipoRol == 'Coordinador'){
	echo('Coordinador');
	header('Location: index_coordinador.html');
}
if($tipoRol == 'Jurado'){
	echo('Jurado');
	header('Location: index_jurado.html');
}
if($tipoRol == 'Participante'){
	echo('Participante');
	header('Location: index_participante.html');
}


?>