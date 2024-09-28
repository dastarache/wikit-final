<?php
    include "../../InstaladorWIKIT/model/Conexion.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Escapar los datos para evitar inyecciones SQL
        $nombre = htmlspecialchars($_POST['nombre']);
        $contenido_foro = htmlspecialchars($_POST['contenido_foro']);

        // Preparar la consulta de inserción
        $sql = "INSERT INTO foro (nombre, contenido_foro, fecha_publicacion) VALUES (:nombre, :contenido_foro, NOW())";
        $stmt = $conn->prepare($sql);
        
        // Bind de parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contenido_foro', $contenido_foro);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>window.location.href='../controller/controll.php?seccion=13'</script>";
        } else {
            echo "Error al insertar el mensaje en el foro.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
