<?php
    include "../../InstaladorWIKIT/model/Conexion.php";

if (isset($_GET['id'])) {
    try {
        // Conexión a la base de datos
        $conn = Conexion::conectar();

        // Obtener el comentario a editar
        $sql = "SELECT * FROM foro WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $comentario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el comentario existe
        if ($comentario) {
            // Formulario de edición
            echo '<form action="procesar_edicion_foro.php" method="POST">';
            echo '<input type="hidden" name="id" value="' . $comentario['id'] . '">';
            echo '<div>';
            echo '<label for="nombre">Nombre:</label>';
            echo '<input type="text" name="nombre" value="' . htmlspecialchars($comentario['nombre']) . '" readonly>';
            echo '</div>';
            echo '<div>';
            echo '<label for="contenido_foro">Mensaje:</label>';
            echo '<textarea name="contenido_foro" rows="4" required>' . htmlspecialchars($comentario['contenido_foro']) . '</textarea>';
            echo '</div>';
            echo '<button type="submit" class="btn btn-primary">Guardar cambios</button>';
            echo '</form>';
        } else {
            echo "Comentario no encontrado.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn = null;
}
?>
