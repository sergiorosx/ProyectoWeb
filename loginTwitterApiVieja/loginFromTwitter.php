<?php
/*
si el usuario acepta la aplicacion twitter redireccion hacia este archivo loginFromTwitter.php 

primero agregamos session_start() al principio del archivo para poder guardar 
los datos que nos retorna la api de twitter en sesiones

después verificamos y mediante la variable superglobal $_GET nos llega el token "oauth_token", 
si nos da verdadero significa que el usuario acepto la app. LLamamos a la clase EpiTwitter 
pasándole los key de nuestra app como parámetro y mediante el metodo get_accountVerify_credentials() 
verificamos los datos del usuario y guardamos en sesiones el nombre del usuario y su imagen de perfil
de esta manera, y redireccionamos al usuario a loginTwitter.php que va a mostrar los datos que nos retorna la api 
*/
session_start();

	include("lib/EpiCurl.php");

	include('lib/EpiOAuth.php');

	include('lib/EpiTwitter.php');

	include('keyTwitter.php');

	if (isset($_GET['oauth_token'])) {

	$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);

	$twitterObj->setToken($_GET['oauth_token']);

	$token = $twitterObj->getAccessToken();

	$twitterObj->setToken($token->oauth_token, $token->oauth_token_secret);

	$userdata = $twitterObj->get_accountVerify_credentials();

	$_SESSION["username"] = $userdata->screen_name;

	$_SESSION["image"] = $userdata->profile_image_url;}

	// agregar a base de datos

	/*$twitter_id = $userdata->id;

	$screen_name = $userdata->screen_name;
	*/

	header("Location: loginTwitter.php");

?> 