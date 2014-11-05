<?php
require 'conexion_db.php';

class Usuario {

	var $alias;
	var $contrasena;
	var $nombre;
	var $correouv;
	var $correofb;
	var $usuariotw;
	var $rol;
	var $tipodoc;
	var $numdoc;
	var $numcel;

	function validarUsuario ($correouv, $contrasena) {
		$usuario = validarUsuarioUnivalle($correouv, $contrasena);
		if ($usuario == null) {
			return false;
		}
		else {
			$this->alias = $usuario[0];
			$this->nombre = $usuario[1];
			$this->rol = $usuario[2];
			return true;
		}
	}

	function crearUsuario ($alias, $contrasena, $nombre, $correouv, $correofb, $usuariotw, $rol, $tipodoc, $numdoc, $numcel) {
		$this->alias = $alias;
		$this->contrasena = $contrasena;
		$this->nombre = $nombre;
		$this->correouv = $correouv;
		$this->correofb = $correofb;
		$this->usuariotw = $usuariotw;
		$this->rol = $rol;
		$this->tipodoc = $tipodoc;
	}
}
/*
$Usuario = new Usuario();
$Usuario->validarUsuario('sergio.garcia@correounivalle.edu.co', 'univalle123');
$Usuario->validarUsuario('sergio.garcia@correounivalle.edu.co', 'univa');
*/
?>