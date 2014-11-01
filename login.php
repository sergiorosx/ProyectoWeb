<?php
	echo "<h5>Entro</h5>";
	/*require_once('conexion_db.php');
	$resultado = pg_query($cadenaConexion, "SELECT * FROM usuarios");
	
	if (!$resultado) { 
		echo "<b>Error de busqueda</b>";
		exit;
	}
	$filas=pg_numrows($resultado); 
	if ($filas==0) {
		echo "No se encontro ningun registro\n"; 
		exit;
	}
	else{
		echo "<ul>";
        for($cont=0;$cont<$filas;$cont++){
			$campo1=pg_result($resultado,$cont,0);
            $campo2=pg_result($resultado,$cont,1);
            $campo3=pg_result($resultado,$cont,2);
			$campo4=pg_result($resultado,$cont,3);
             
			echo " <li>$campo1 $campo2 $campo3 $campo4\n";
		}
   }
	pg_FreeResult($resultado);*/
?>