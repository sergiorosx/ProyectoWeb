<?php
require '../../../modelo/usuario.php';
	$Usuario = new Usuario();
	$data_json = $Usuario->getUsuarios();
	die($data_json);
?>
