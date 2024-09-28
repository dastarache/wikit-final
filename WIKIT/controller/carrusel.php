<?php
$conn = Conexion::conectar();

// Obtener los cursos y sus imágenes
$sql = "SELECT c.id, c.nombre, a.img_1, a.img_2, a.img_3, a.img_4 
        FROM cursos c 
        JOIN mt_apoyo a ON c.id = a.id_curso";
$stmt = $conn->prepare($sql);
$stmt->execute();
$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Procesar eliminación de imagen
if (isset($_POST['eliminar_imagen'])) {
    $id_curso = intval($_POST['id_curso']);
    $img_col = $_POST['img_col'];
    $sqlEliminar = "UPDATE mt_apoyo SET $img_col = NULL WHERE id_curso = :id_curso";
    $stmtEliminar = $conn->prepare($sqlEliminar);
    $stmtEliminar->bindParam(':id_curso', $id_curso);
    $stmtEliminar->execute();
    echo '<script>alert("Imagen eliminada exitosamente."); window.location.href="controll.php?seccion=14";</script>';
}

// Procesar edición de imagen
if (isset($_POST['editar_imagen'])) {
    $id_curso = intval($_POST['id_curso']);
    $img_col = $_POST['img_col'];
    $nueva_imagen = $_FILES['nueva_imagen']['name'];

    if ($nueva_imagen) {
        $target_dir = "../assets/uploads/";
        move_uploaded_file($_FILES['nueva_imagen']['tmp_name'], $target_dir . basename($nueva_imagen));

        $sqlEditar = "UPDATE mt_apoyo SET $img_col = :nueva_imagen WHERE id_curso = :id_curso";
        $stmtEditar = $conn->prepare($sqlEditar);
        $stmtEditar->bindParam(':nueva_imagen', $nueva_imagen);
        $stmtEditar->bindParam(':id_curso', $id_curso);
        $stmtEditar->execute();
        echo '<script>alert("Imagen actualizada exitosamente."); window.location.href="controll.php?seccion=14";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrusel por Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f0f8ff;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-top: 20px;
            font-weight: bold;
        }

        .card-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding: 20px 0;
            margin-bottom: 30px;
            scrollbar-width: thin;
            scrollbar-color: #007bff #f0f8ff;
        }

        .card {
            margin-right: 15px;
            width: 18rem;
            border: none;
            border-radius: 15px;
            transition: transform 0.2s ease-in-out;
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            box-shadow: 4px 4px 8px #b3b3b3, -4px -4px 8px #ffffff;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            font-weight: bold;
            border-radius: 15px 15px 0 0;
        }

        .carousel-item img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            cursor: pointer;
        }

        .modal-body img {
            width: 100%;
            height: auto;
            max-height: 90vh;
            object-fit: contain;
        }

        .btn-icon {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            margin-left: 5px;
        }

        .btn-icon:hover {
            color: #ff0000;
        }

        /* Estilos para barra de desplazamiento */
        .card-container::-webkit-scrollbar {
            height: 8px;
        }

        .card-container::-webkit-scrollbar-thumb {
            background-color: #007bff;
            border-radius: 10px;
        }
    </style>
</head>

<body>

    <h1>Material de Apoyo</h1>

    <div class="container">
        <div class="card-container">
            <?php
            foreach ($cursos as $curso) {
                echo '<div class="card">';
                echo '<div class="card-header">' . htmlspecialchars($curso['nombre']) . '</div>';
                echo '<div class="card-body">';
                echo '<div id="carouselCurso' . $curso['id'] . '" class="carousel slide" data-bs-ride="carousel">';
                echo '<div class="carousel-inner">';

                $activeSet = false;

                for ($i = 1; $i <= 4; $i++) {
                    $img_col = 'img_' . $i;
                    if ($curso[$img_col]) {
                        echo '<div class="carousel-item ' . (!$activeSet ? 'active' : '') . '">';
                        echo '<img src="../assets/uploads/' . htmlspecialchars($curso[$img_col]) . '" class="d-block w-100 img-thumbnail" alt="Imagen ' . $i . '" data-bs-toggle="modal" data-bs-target="#modalCarrusel' . $curso['id'] . '">';

                        // Botones de editar y eliminar
                        echo '<form action="" method="POST" enctype="multipart/form-data" style="display:inline;">';
                        echo '<input type="hidden" name="id_curso" value="' . $curso['id'] . '">';
                        echo '<input type="hidden" name="img_col" value="' . $img_col . '">';
                        echo '<button type="submit" name="eliminar_imagen" class="btn-icon"><i class="fas fa-trash-alt"></i></button>';
                        echo '</form>';

                        echo '<form action="" method="POST" enctype="multipart/form-data" style="display:inline;">';
                        echo '<input type="hidden" name="id_curso" value="' . $curso['id'] . '">';
                        echo '<input type="hidden" name="img_col" value="' . $img_col . '">';
                        echo '<label for="nueva_imagen_' . $img_col . '"><i class="fas fa-edit btn-icon"></i></label>';
                        echo '<input type="file" name="nueva_imagen" id="nueva_imagen_' . $img_col . '" style="display:none;" onchange="this.form.submit()">';
                        echo '</form>';

                        echo '</div>';
                        $activeSet = true;
                    }
                }

                echo '</div>'; // Cierra carousel-inner
                echo '</div>'; // Cierra carousel
                echo '</div>'; // Cierra card-body
                echo '</div>'; // Cierra card
            
                // Modal para ver las imágenes en grande
                echo '<div class="modal fade" id="modalCarrusel' . $curso['id'] . '" tabindex="-1" aria-labelledby="modalLabelCarrusel' . $curso['id'] . '" aria-hidden="true">';
                echo '<div class="modal-dialog modal-dialog-centered modal-lg">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<h5 class="modal-title" id="modalLabelCarrusel' . $curso['id'] . '">Imágenes del curso: ' . htmlspecialchars($curso['nombre']) . '</h5>';
                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                echo '</div>';
                echo '<div class="modal-body">';

                echo '<div id="modalCarousel' . $curso['id'] . '" class="carousel slide" data-bs-ride="carousel">';
                echo '<div class="carousel-inner">';

                $activeSet = false;

                // Generar las imágenes dentro del modal como un nuevo carrusel
                for ($i = 1; $i <= 4; $i++) {
                    $img_col = 'img_' . $i;
                    if ($curso[$img_col]) {
                        echo '<div class="carousel-item ' . (!$activeSet ? 'active' : '') . '">';
                        echo '<img src="../assets/uploads/' . htmlspecialchars($curso[$img_col]) . '" class="d-block w-100" alt="Imagen ' . $i . '">';
                        echo '</div>';
                        $activeSet = true;
                    }
                }

                echo '</div>'; // Cierra carousel-inner
                echo '<button class="carousel-control-prev" type="button" data-bs-target="#modalCarousel' . $curso['id'] . '" data-bs-slide="prev">';
                echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Previous</span>';
                echo '</button>';
                echo '<button class="carousel-control-next" type="button" data-bs-target="#modalCarousel' . $curso['id'] . '" data-bs-slide="next">';
                echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                echo '<span class="visually-hidden">Next</span>';
                echo '</button>';
                echo '</div>'; // Cierra modal-carousel
            
                echo '</div>'; // Cierra modal-body
                echo '</div>'; // Cierra modal-content
                echo '</div>'; // Cierra modal-dialog
                echo '</div>'; // Cierra modal
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>