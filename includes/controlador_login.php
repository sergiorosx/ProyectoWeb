<?php
include 'conexiondb.php';

Function login ($correo, $pss) {
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

Function login_facebook () {
}

Function login_twitter ($correo) {

}

login('sergio.garcia@correounivalle.edu.co', 'univalle123');
?>
