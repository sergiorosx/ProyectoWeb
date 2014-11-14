<?php
require '../modelo/usuario.php';
	$Usuario = new Usuario();
	$arreglo = $Usuario -> consultarUsuario();
	/*$json = array(
				array('id' => 0, 'name' => 'Item 50', 'price' => '$10'),
				array('id' => 1, 'name' => 'Item 1', 'price' => '$6'),
				array('id' => 2, 'name' => 'Item 2', 'price' => '$8'));*/
	print_r($arreglo);			  		echo $arreglo[0][0];	
	//$data_json = json_encode($arreglo);		//print_r($data_json);	
	//echo $data_json;
	
	//return $data_json;

	/*$fp = fopen("estructura.json","w"); 
	if($fp == false) { 
	   die("No se ha podido crear el archivo."); 
	}

	fwrite($fp, $data_json);
	fclose($fh);*/
?>