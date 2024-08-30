<?php

    $query = "DELETE FROM usuario WHERE id = $llaveB;";
    $resultado = Conexion::conectar()->prepare($query);
    if( $resultado->execute() )
    {

        echo "
        <script type='text/javascript'>

            window.location.href = '../controller/controll.php?seccion=5&tab=2';

        </script>
        ";

    }

?>

