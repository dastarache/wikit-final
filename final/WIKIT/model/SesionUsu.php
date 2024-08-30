<?php 

	$query = "SELECT id,nombre,correo,contrasena,perfil,permiso FROM usuario WHERE nombre = :usuario";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->bindParam(":usuario",$usuario);

	$resultado->execute();
		
?>