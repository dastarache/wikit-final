<?php 

	$query = "SELECT id,nombre,correo FROM usuario WHERE permiso = 1";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->execute();
		
?>