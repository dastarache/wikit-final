<?php

    $query = "UPDATE usuario 
    SET contrasena = '$contra'
    WHERE id=$llave";
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