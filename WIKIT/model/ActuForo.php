<?php

    $query = "UPDATE foro 
    SET nombre = '$usuario'
    WHERE nombre='$usuarioLog'";
    $resultado = Conexion::conectar()->prepare($query);


?>