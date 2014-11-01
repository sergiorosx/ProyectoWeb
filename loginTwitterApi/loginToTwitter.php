<?php
/*
las primeras 4 lineas se encargan de llamar a la libreria twitterAsync y la key de nuestra app,  
después iniciamos la clase EpiTwitter pasando como parámetros el consumer key y consurmer secret 
que es encuentra en el archivo keyTwitter.php

llamamos al metodo getAuthenticateUrl() que se encarga de autenticar los datos  
mediante la api REST usando OAuth. Paso siguiente redireccionamos al usuario 
mediante la function header de php 


*/ 
	include("lib/EpiCurl.php"); 
	include('lib/EpiOAuth.php'); 
	include('lib/EpiTwitter.php'); 
	include('keyTwitter.php'); 
	$twitterObj = new EpiTwitter($consumer_key, $consumer_secret); 
	$authenticateUrl = $twitterObj->getAuthenticateUrl();

	header('Location: '.$authenticateUrl.'');

?>