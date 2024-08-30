<?php

    $query = "DELETE FROM cursos WHERE id = $llave_c;";
    $resultado = Conexion::conectar()->prepare($query);
    if( $resultado->execute() )
    {

        echo "
        <script type='text/javascript'>

            window.location.href = '../controller/controll.php?seccion=5&tab=1';

        </script>
        ";

    }

?>