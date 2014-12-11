<?php
require '../../../modelo/convocatoria.php';
	$Convocatoria = new Convocatoria();
	$data_json = $Convocatoria->getConvocatorias();	die($data_json);
?>