<?php
include 'modelo/usuario.php';

// veifica si se envio un formulario de registro
if (isset($POST['Registrarme'])){
	echo "Registrado";
}

echo "Ya Existe";


private function login ($correo, $pss) {
	$retorno = validarUsuarioUnivalle($correo, $pss);
	
	if($retorno != "False") {
	 $retorno = explode(",", $retorno);
	 echo $retorno[0] ;
	 echo $retorno[1] ;
	 echo $retorno[2] ;
	 $rol = $retorno[2];
	}
	else {
	// setear span en html mostrando error
	}
}
?>