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
//$Convocatoria->crearConvocatoria('restauranteUV','Largas Filas en el restaurante universitario de univalle','2014/11/6','2014/11/20', 'false');
?>