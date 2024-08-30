<?php

    $query = "UPDATE pagos 
    SET estado = 2, ref_pago = '$pago'
    WHERE id=$llavec AND estado = 1";
    $resultado = Conexion::conectar()->prepare($query);
    if( $resultado->execute() )
    {

        $query2 = "CALL EliminarRegistrosPorValor(2);";
        $resultado2 = Conexion::conectar()->prepare($query2);
        if($resultado2->execute())
        {

            echo "
            <script type='text/javascript'>
    
                window.location.href = '../controller/controll.php?seccion=5&tab=5';
    
            </script>
            ";

        }


    }

?>