<?php 

	$query = "SELECT id,nombre,correo,contrasena,perfil FROM usuario WHERE correo = :correo";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->bindParam(":correo",$correoR);

	$resultado->execute();
		
?>