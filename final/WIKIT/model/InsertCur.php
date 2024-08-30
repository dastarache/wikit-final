<?php

    $query = "INSERT INTO cursos(nombre,id_categoria,fecha,precio,contenido,ruta)
    VALUES('$nombre',$llave_cate,now(),'$precio','$contenido','$newFileName')";
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