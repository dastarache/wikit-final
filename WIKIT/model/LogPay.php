<?php 

	$query = "SELECT t1.id AS id, t2.nombre AS curso, t3.nombre AS usuario, t1.precio AS precio, t1.fecha AS fecha, t1.estado AS estado FROM pagos AS t1, cursos AS t2, usuario AS t3 WHERE t1.id_usuario = t3.id AND t1.id_curso = t2.id AND t3.id=$llave";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->execute();
		
?>