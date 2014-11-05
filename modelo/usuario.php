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
		$usuarios = validarUsuarioUnivalle($correouv, $contrasena);
		echo ''. $usuarios;
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

validarUsuario('sergio.garcia@correounivalle.edu.co', 'univalle123');
?>