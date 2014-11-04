<?php
include("controlador_login.php");	  

$login	=$_POST['login_correo'];
$pwd	=$_POST['login_contrasenia'];
echo("entro recibir datos".$login.$pwd);
login($login, $pwd);
login('sergio.garcia@correounivalle.edu.co', 'univalle123');
?>