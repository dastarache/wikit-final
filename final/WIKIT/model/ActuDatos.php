<?php

    $query = "UPDATE usuario 
    SET perfil = '$nombre_img', nombre = '$usuario'
    WHERE id=$llave";
    $resultado = Conexion::conectar()->prepare($query);


?>