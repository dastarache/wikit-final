<?php

    $query = "INSERT INTO usuario(nombre,correo,contrasena,perfil,fecha,permiso)
    VALUES('$usuario','$correo','$contrHash','$perfil',now(),1)";
    $resultado = Conexion::conectar()->prepare($query);
   



?>