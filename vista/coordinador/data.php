<?php
require '../../modelo/convocatoria.php';
	$Convocatoria = new Convocatoria();
	$data_json = $Convocatoria->getConvocatorias();
	/*$json = array(
				array('id' => 0, 'name' => 'Item 50', 'price' => '$10'),
				array('id' => 1, 'name' => 'Item 1', 'price' => '$6'),
				array('id' => 2, 'name' => 'Item 2', 'price' => '$8'));*/	die($data_json);
?>