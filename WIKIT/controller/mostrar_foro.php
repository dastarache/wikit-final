<?php
   include "../../InstaladorWIKIT/model/Conexion.php";  
    session_start();
    $llave = $_SESSION['id'];
    require_once("../model/Log.php");
    $filas = $resultado->fetch();
    $usuarioLog = $filas['nombre'];
 

try {
    $conn = Conexion::conectar();
    $sql = "SELECT * FROM foro ORDER BY fecha_publicacion DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        foreach ($result as $row) {
            $class = ($row['nombre'] === $usuarioLog) ? 'sender' : 'receiver';
            echo '<div class="card mb-3">';
            echo '<div class="card-body ' . $class . '">';
            echo '<div class="d-flex justify-content-between">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['nombre']) . '</h5>';
            echo '<small class="text-muted">' . $row['fecha_publicacion'] . '</small>';
            echo '</div>';
            echo '<p class="card-text">' . htmlspecialchars($row['contenido_foro']) . '</p>';

            if ($row['nombre'] === $usuarioLog) { 
                echo '<div class="text-end">';
                echo '<a href="editar_foro.php?id=' . $row['id'] . '" class="btn btn-sm btn-warning btn-edit">Editar</a>';
                echo '<a href="eliminar_foro.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger btn-delete" onclick="return confirm(\'¿Estás seguro de eliminar este comentario?\')">Eliminar</a>';
                echo '</div>';
            }

            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No hay mensajes en el foro.</p>';
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
