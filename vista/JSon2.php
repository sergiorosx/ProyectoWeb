<?php
	$json = array(
				array('id' => 0, 'name' => 'Item 50', 'price' => '$10'),
				array('id' => 1, 'name' => 'Item 1', 'price' => '$6'),
				array('id' => 2, 'name' => 'Item 2', 'price' => '$8'));
				  
	$data_json = json_encode($json);
	echo $data_json;

	/*$fp = fopen("estructura.json","w"); 
	if($fp == false) { 
	   die("No se ha podido crear el archivo."); 
	}

	fwrite($fp, $data_json);
	fclose($fh);*/
?>