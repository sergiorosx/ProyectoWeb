<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
require ('../../../modelo/usuario.php');

if (isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
  $_SESSION['oauth_status'] = 'oldtoken';
  header('Location: ./clearsessions.php');
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);

$_SESSION['access_token'] = $access_token;

unset($_SESSION['oauth_token']);
unset($_SESSION['oauth_token_secret']);

if (200 == $connection->http_code) {
	$_SESSION['status'] = 'verified';
	$content = $connection->get('account/verify_credentials');
	$usertw = $content->screen_name;
	// se consulta el usuario
	$Usuario = new Usuario();
	// el usuario existe
	if ($Usuario->validarUsuarioTw($usertw)) { 
		$_SESSION['autorizado']=true; 
		$_SESSION['alias'] = $Usuario->getAlias();
		$_SESSION['rol'] = $Usuario->getRol();
		$rol = $_SESSION['rol'];
		
		if ($rol == 'Participante') {
			header('Location: ../../index_participante.php');
		}
		elseif ($rol == 'Coordinador') {
			header('Location: ../../index_coordinador.php');
		}
		elseif ($rol == 'Jurado') {
			header('Location: ../../index_jurado.php');
		}
		elseif ($rol == 'Administrador') {
			header('Location: ../../index_admin.php');
		}
	}
} else {
  header('Location: ./error.html');
}
?>