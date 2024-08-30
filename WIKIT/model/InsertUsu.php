<?php

    $query = "INSERT INTO usuario(nombre,correo,contrasena,perfil,fecha,permiso)
    VALUES('$usuario','$correo','$contrHash','$perfil',now(),1)";
    $resultado = Conexion::conectar()->prepare($query);
   

    if( $resultado->execute() )
    {

        echo "
        <script type='text/javascript'>

            window.location.href = '../controller/controll.php?seccion=1';

        </script>
        ";

    }

?>