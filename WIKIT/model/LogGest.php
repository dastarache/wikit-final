<?php 

	$query = "SELECT id, nombre AS nb_categoria, fecha FROM categoria";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->execute();
		
?>