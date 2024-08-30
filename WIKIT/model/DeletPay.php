<?php

    $query = "DELETE FROM pagos WHERE id = $llaveE;";
    $resultado = Conexion::conectar()->prepare($query);
    if( $resultado->execute() )
    {

        echo "
        <script type='text/javascript'>

            window.location.href = '../controller/controll.php?seccion=5&tab=5';

        </script>
        ";

    }

?>

