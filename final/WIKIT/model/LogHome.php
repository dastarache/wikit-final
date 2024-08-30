<?php 

	$query = "SELECT t1.ruta AS ruta, t1.contenido, t1.id AS id_curso, t1.nombre AS curso, t2.nombre AS categoria, t1.precio AS precio, COALESCE(SUM(t3.likes), 0) AS total_likes, MAX(t3.color) AS color, GROUP_CONCAT(DISTINCT t3.id_usuario) AS usuarios FROM cursos AS t1 JOIN categoria AS t2 ON t2.id = t1.id_categoria LEFT JOIN (SELECT id_curso, id_usuario, color, SUM(likes) AS likes FROM likes GROUP BY id_curso, id_usuario, color) AS t3 ON t1.id = t3.id_curso GROUP BY t1.id, t1.nombre, t2.nombre, t1.precio;";

	$resultado = Conexion::conectar()->prepare($query);

	$resultado->execute();

		
?>