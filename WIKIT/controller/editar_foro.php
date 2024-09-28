<?php
    include "../../InstaladorWIKIT/model/Conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $conn = Conexion::conectar();
        $sql = "SELECT * FROM foro WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$post) {
            echo '<p>Comentario no encontrado.</p>';
            exit;
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $contenido_foro = $_POST['contenido_foro'];

    try {
        $conn = Conexion::conectar();
        $sql = "UPDATE foro SET nombre = :nombre, contenido_foro = :contenido_foro WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':contenido_foro', $contenido_foro);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<script>window.location.href='../controller/controll.php?seccion=13';</script>";
        } else {
            echo "<p>Error al actualizar el comentario.</p>";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Mensaje</title>
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f8f9fa;
        }
        .edit-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="edit-container">
                <h2 class="text-center mb-4">Editar Mensaje</h2>

                <form action="editar_foro.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo htmlspecialchars($post['nombre']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contenido_foro" class="form-label">Mensaje</label>
                        <textarea name="contenido_foro" id="contenido_foro" class="form-control" rows="4" required><?php echo htmlspecialchars($post['contenido_foro']); ?></textarea>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                        <a href="index.php" class="btn btn-secondary btn-lg">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
