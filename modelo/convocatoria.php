<?php
require 'conexion_db.php';

class Convocatoria {
	var $nombre;
	var $descripcion;
	var $fecha_inicio;
	var $fecha_fin;
	var $publicada;
	
	function crearConvocatoria ($nombre, $descripcion, $inicio, $fin, $publicada) {
		$this->nombre = $nombre;
		$this->descripcion = $descripcion;
		$this->inicio = $inicio;
		$this->fin = $fin;
		$this->publicada = $publicada;
		$creada = crearConv($nombre, $descripcion, $inicio, $fin, $publicada);
		return $creada;
	}
	
	function setPublicacion ($nombre) {
		$publicada = publicarConvocatoria($nombre);
		return $publicada;
	}
	
	function getConvocatorias() {
		$convocatorias = consultarConvocatorias();
		$json = json_encode($convocatorias);
		return $json;
	}
	
	function getNombre() {
		return $this->nombre;
	}
	
	function getDescripcion() {
		return $this->descripcion;
	}
	
	function getFechaInicio() {
		return $this->fecha_inicio;
	}
	
	function getFechaFin() {
		return $this->fecha_fin;
	}
	
	function getPublicada() {
		return $this->publicada;
	}
}
//$Convocatoria = new Convocatoria();
//$Convocatoria->getConvocatorias();
//$Convocatoria->crearConvocatoria('restauranteUV','Largas Filas en el restaurante universitario de univalle','2014/11/6','2014/11/20', 'false');
?>