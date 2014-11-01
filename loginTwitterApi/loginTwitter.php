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

			}else{ echo '<a href="loginToTwitter.php"></a>';
				}
?>