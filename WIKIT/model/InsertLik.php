<?php

    $query2 = "SELECT id,id_curso,id_usuario FROM likes WHERE $llave_c = id_curso AND $llave_u = id_usuario ";

    $resultado2 = Conexion::conectar()->prepare($query2);

    $resultado2->execute();

    if($resultado2->rowCount()>0)
    {
        $filas = $resultado2->fetch();
        $id = $filas['id'];

        $query3 = "DELETE FROM likes WHERE $llave_c = id_curso AND $llave_u = id_usuario AND id = $id ";
        $resultado3 = Conexion::conectar()->prepare($query3);
        if( $resultado3->execute() )
        {

            echo "
            <script type='text/javascript'>
    
                window.location.href = '../controller/controll.php?seccion=5&tab=1';
    
            </script>
            ";

        }



    }else{


        $query = "INSERT INTO likes(id_curso,id_usuario,likes,fecha,color)
        VALUES($llave_c,$llave_u,1,now(),'$color')";
        $resultado = Conexion::conectar()->prepare($query);
        if( $resultado->execute() )
        {
    
            echo "
            <script type='text/javascript'>
    
                window.location.href = '../controller/controll.php?seccion=5&tab=1';
    
            </script>
            ";
    
        }


    }


?>