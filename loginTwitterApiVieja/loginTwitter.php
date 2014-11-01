<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Document</title>
		<style>
			body{
			 	font-family: Helvetica;

			}

			a{
			 	text-decoration: none;
			 }
			 #wrapper{
				 margin: 0 auto;
				 width: 800px;
			 }

			.btn-social {
				 width: 220px;
				 color: white;
				 padding: 10px;
				 font-weight: bold;
				 text-align: center;
				 font-size: 0.9em;
			 }

			.btn-twitter-login {
				 background: #49C0F0;
				 background: -moz-linear-gradient(top, #49C0F0 0%, #2CAFE3 100%);
				 background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#49C0F0), color-stop(100%,#2CAFE3));
				 background: -webkit-linear-gradient(top, #49C0F0 0%,#2CAFE3 100%);
				 background: -o-linear-gradient(top, #49C0F0 0%,#2CAFE3 100%);
				 background: -ms-linear-gradient(top, #49C0F0 0%,#2CAFE3 100%);
				 background: linear-gradient(to bottom, #49C0F0 0%,#2CAFE3 100%);
				 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#49c0f0', endColorstr='#2cafe3',GradientType=0 );
			 }

			.twitter-ico {
				 width: 26px;
				 height: 20px;
				 position: absolute;
				 margin-left: -45px;
				 background: url('http://static.digg.com/static/images/icon_twitter.png') no-repeat;
			 }
		 </style>
	</head>
	<body>

		<div id="wrapper">
			<br>
			<?php
				/*
					ponemos un condicional que verifica que la sesion con el nombre username exista. 
					Si nos da verdadero mostramos su imagen y nombre, además de un link para cerrar la sesión.
					En caso de que no exista la sesion mostramos el boton para loguearnos con twitter. 
				*/
				
				if(isset($_SESSION["username"])){

					echo "Hola ".$_SESSION['username'];

					echo "<img src=". $_SESSION['image'].' alt="" />';

					echo "<BR/>";

					echo '<a href="logout.php">Logout</a>';

					}else{

			?>

				<a href="loginToTwitter.php">
					<div><em class="twitter-ico"></em>Ingresa con twitter</div>
					<?php } ?></a>
		</div> 
	</body> 
</html>
