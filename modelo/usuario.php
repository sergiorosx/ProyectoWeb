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
	
	function getAlias () {
		return $this->alias;
	}
	
	function getNombre () {
		return $this->nombre;
	}
	
	function getRol () {
		return $this->rol;
	}

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
	
	function validarUsuarioFb ($correoFbFb) {
		$usuario = validarUsuarioFacebook($correoFbFb);
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
	
	function validarUsuarioTw ($usertw) {
		$usuario = validarUsuarioTwitter($usertw);
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
		if (existeUsuario($this->alias, $this->correouv)) {
			return false;
		} else {
			crearUser($alias, $contrasena, $nombre, $correouv, $correofb, $usuariotw, $rol, $tipodoc, $numdoc, $numcel);
			return true;
		}
	}
}
/*$Usuario = new Usuario();
//$Usuario->validarUsuario('sergio.garcia@correounivalle.edu.co', 'univalle123');
$Usuario->validarUsuario('sergio.garcia@correounivalle.edu.co', 'univa');
$Usuario->validarUsuarioFb('sergiorosx@hotmail.com');
$Usuario->validarUsuarioFb('juancamilo_lopez9218@hotmail.com');
$Usuario->validarUsuarioTw('sergiorosx');*/
?>