<?php
require '../../../modelo/convocatoria.php';
	$Convocatoria_act = new Convocatoria();
	$data_json = $Convocatoria_act->getConvocatorias_act();	die($data_json);
?>
