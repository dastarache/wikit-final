<?php 

	$query = "SELECT id,nombre,correo,contrasena,perfil FROM usuario WHERE id = :llave";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->bindParam(":llave",$llave);

	$resultado->execute();
		
?>