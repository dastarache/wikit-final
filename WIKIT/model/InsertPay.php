<?php

    $query = "SELECT id_curso,id_usuario,precio,fecha,estado,ref_pago FROM pagos WHERE $llave_c = id_curso AND $llave_u = id_usuario AND $precio = precio";

    $resultado = Conexion::conectar()->prepare($query);

    if( $resultado->execute() )
    {

        if($resultado->rowCount()>0)
        {
        
            echo "
            <script type='text/javascript'>

                alert('Ya tienes este curso agregado');
                window.location.href = '../controller/controll.php?seccion=5&tab=1';

            </script>
            ";
        
        }else{

            $query2 = "INSERT INTO pagos(id_curso,id_usuario,precio,fecha,estado,ref_pago)
            VALUES($llave_c,$llave_u,'$precio',now(),1,'XXXXX')";
            $resultado2 = Conexion::conectar()->prepare($query2);
        
    
            if( $resultado2->execute() )
            {
    
                echo "
                <script type='text/javascript'>
    
                    window.location.href = '../controller/controll.php?seccion=5&tab=1';
    
                </script>
                ";
    
            }

        }

    }else{

        echo "
        <script type='text/javascript'>

            window.location.href = '../controller/controll.php?seccion=5&tab=1';

        </script>
        ";

    }

?>