<?php
include('Conexion.php');
// Conectamos a la base de datos
Conexion::conectar();

// Obtenemos el nombre de la base de datos
$nombreBaseDatos = Conexion::getDatabaseName();

// Guardamos el nombre de la base de datos en la sesión
$_SESSION['ah'] = $nombreBaseDatos;

$nombreBaseDatos;

$query = "SELECT * FROM information_schema.tables WHERE table_schema = '$nombreBaseDatos' AND table_name = 'usuario'";
$resultado = Conexion::conectar()->prepare($query);
$resultado->execute();

if ($resultado->rowCount() > 0) {

  echo "
    <script type='text/javascript'>

        window.location.href = '../../WIKIT/index.php';

    </script>
    ";


} else {

  $db = $_REQUEST['db'];
  if ($nombreBaseDatos == $db) {

    $query1 = "CREATE TABLE `categoria` (
    `id` int(11) NOT NULL,
    `nombre` varchar(200) NOT NULL,
    `fecha` datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  
  
  CREATE TABLE `certificado` (
    `id` int(11) NOT NULL,
    `id_curso` int(11) NOT NULL,
    `id_usuario` int(11) NOT NULL,
    `precio` varchar(200) NOT NULL,
    `fecha` datetime NOT NULL,
    `estado` int(11) NOT NULL,
    `ref_pago` varchar(200) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  
  
  CREATE TABLE `cursos` (
    `id` int(11) NOT NULL,
    `nombre` varchar(200) NOT NULL,
    `id_categoria` int(11) NOT NULL,
    `fecha` datetime NOT NULL,
    `precio` varchar(200) NOT NULL,
    `contenido` text NOT NULL,
    `ruta` varchar(200) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

    


  CREATE TABLE `likes` (
    `id` int(11) NOT NULL,
    `id_curso` int(11) NOT NULL,
    `id_usuario` int(11) NOT NULL,
    `likes` varchar(100) NOT NULL,
    `fecha` datetime NOT NULL,
    `color` varchar(200) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  
  CREATE TABLE `pagos` (
    `id` int(11) NOT NULL,
    `id_curso` int(11) NOT NULL,
    `id_usuario` int(11) NOT NULL,
    `precio` varchar(200) NOT NULL,
    `fecha` datetime NOT NULL,
    `estado` int(11) NOT NULL,
    `ref_pago` varchar(200) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  
    CREATE TABLE `mt_apoyo` (
    `id` int(11) NOT NULL,
    `img_1` varchar(200) NOT NULL,
    `img_2` varchar(200) NOT NULL,
    `img_3` varchar(200) NOT NULL,
    `img_4` varchar(200) NOT NULL,
    `id_curso` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  CREATE TRIGGER REPOR_CER_BI BEFORE UPDATE ON pagos 
        FOR EACH ROW 
        BEGIN 
        IF new.estado = 2 THEN 
        INSERT INTO certificado (id_curso, id_usuario, precio, fecha, estado, ref_pago) 
        VALUES (new.id_curso, new.id_usuario, new.precio, now(), new.estado, new.ref_pago); 
        END IF; 
    END;
  
  CREATE TABLE `usuario` (
    `id` int(11) NOT NULL,
    `nombre` varchar(200) NOT NULL,
    `correo` varchar(250) NOT NULL,
    `contrasena` varchar(200) NOT NULL,
    `perfil` varchar(200) NOT NULL,
    `fecha` datetime NOT NULL,
    `permiso` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
  
  CREATE TABLE `foro`(
  id int(11) NOT NULL,
  contenido_foro text NOT NULL,
  nombre varchar (100) NOT NULL,
  fecha_publicacion datetime NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

  ALTER TABLE `mt_apoyo`
    ADD PRIMARY KEY (`id`);

  ALTER TABLE `foro`
    ADD PRIMARY KEY (`id`);


  ALTER TABLE `categoria`
    ADD PRIMARY KEY (`id`);
  
  ALTER TABLE `certificado`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_curso` (`id_curso`),
    ADD KEY `id_usuario` (`id_usuario`);
  
  ALTER TABLE `cursos`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_categoria` (`id_categoria`);
  
  ALTER TABLE `pagos`
    ADD PRIMARY KEY (`id`),
    ADD KEY `id_curso` (`id_curso`),
    ADD KEY `id_usuario` (`id_usuario`);
  
  ALTER TABLE `usuario`
    ADD PRIMARY KEY (`id`);
  
  ALTER TABLE `categoria`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  ALTER TABLE `certificado`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  
  ALTER TABLE `cursos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  
  ALTER TABLE `pagos`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

    ALTER TABLE `foro`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

      ALTER TABLE `mt_apoyo`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  ALTER TABLE `usuario`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
  COMMIT;
  ";

    $resultado1 = Conexion::conectar()->prepare($query1);


    if ($resultado1->execute()) {

      $query = "CREATE PROCEDURE EliminarRegistrosPorValor (IN valor INT)   BEGIN 
      DELETE FROM pagos WHERE estado = valor; 
      END ;";
      $resultado = Conexion::conectar()->prepare($query);

      if ($resultado->execute()) {
        $query11 = "CREATE FUNCTION gestionarCarrusel(
    p_id INT,
    p_id_curso INT,
    p_img_1 VARCHAR(255),
    p_img_2 VARCHAR(255),
    p_img_3 VARCHAR(255),
    p_img_4 VARCHAR(255)
) RETURNS BOOLEAN
BEGIN
    DECLARE v_exists INT;
    
  
    SELECT COUNT(*) INTO v_exists
    FROM mt_apoyo
    WHERE id = p_id;
    
    IF v_exists = 0 THEN
      
        INSERT INTO mt_apoyo (id_curso, img_1, img_2, img_3, img_4)
        VALUES (p_id_curso, p_img_1, p_img_2, p_img_3, p_img_4);
    ELSE
     
        UPDATE mt_apoyo
        SET id_curso = p_id_curso,
            img_1 = p_img_1,
            img_2 = p_img_2,
            img_3 = p_img_3,
            img_4 = p_img_4
        WHERE id = p_id;
    END IF;
    
    RETURN TRUE;
END ;";
      $resultado11 = Conexion::conectar()->prepare($query11);
      if ($resultado11->execute()) {
        $usuario = $_REQUEST['usuario'];
        $contra = $_REQUEST['contra'];
        $correo = $_REQUEST['correo'];
        $pass = password_hash($contra, PASSWORD_BCRYPT);

        $query2 = "INSERT INTO usuario(nombre,correo,contrasena,perfil,fecha,permiso)
          VALUES('$usuario','$correo','$pass','logoiano.png',now(),2)";
        $resultado2 = Conexion::conectar()->prepare($query2);
        if ($resultado2->execute()) {

          $query3 = "SELECT * FROM usuario WHERE permiso = 2";
          $resultado3 = Conexion::conectar()->prepare($query3);
          $resultado3->execute();
          if ($resultado3->rowCount() > 0) {

            // Ruta al archivo que deseas modificar
            $archivo = '../../index.php';

            // Leer el contenido actual del archivo (opcional)
            $contenidoActual = file_get_contents($archivo);

            // Modificar el contenido (puedes hacer cualquier modificación aquí)
            $nuevoContenido = str_replace('InstaladorWIKIT/index.html', 'WIKIT/index.php', $contenidoActual);

            // Escribir el nuevo contenido en el archivo
            file_put_contents($archivo, $nuevoContenido);
            echo "
              <script type='text/javascript'>
          
                  window.location.href = '../../WIKIT/index.php';
          
              </script>
              ";
          }

        }
      }

      }
    }
  }
}
