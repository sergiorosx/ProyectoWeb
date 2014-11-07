<?php
require 'conexion_db.php';

class Convocatoria {
	var $nombre;
	var $descripcion;
	var $fecha_inicio;
	var $fecha_fin;
	var $publicada;
	
	function Convocatoria ($nombre, $descripcion, $inicio, $fin, $publicada) {
	$this->nombre = $nombre;
	$this->descripcion = $descripcion;
	$this->inicio = $inicio;
	$this->fin = $fin;
	$this->publicada = $publicada;
	}
	
	function crearConvocatoria () {
		$creada = crearConv($this->nombre, $this->descripcion, $this->inicio, $this->fin, $this->publicada);
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
?>