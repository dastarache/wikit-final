<?php

    $query = "INSERT INTO categoria(nombre,fecha)
    VALUES('$nombre',now())";
    $resultado = Conexion::conectar()->prepare($query);
   

    if( $resultado->execute() )
    {

        echo "
        <script type='text/javascript'>

            window.location.href = '../controller/controll.php?seccion=5&tab=3';

        </script>
        ";

    }

?>