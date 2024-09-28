<?php
    include "../../InstaladorWIKIT/model/Conexion.php";

if (isset($_GET['id'])) {
    try {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Preparar la consulta de eliminación
        $sql = "DELETE FROM foro WHERE id = :id";
        $stmt = $conn->prepare($sql);
        
        // Bind del parámetro ID
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Comentario eliminado exitosamente.'); window.location.href='../controller/controll.php?seccion=13';</script>";
        } else {
            echo "Error al eliminar el comentario.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
