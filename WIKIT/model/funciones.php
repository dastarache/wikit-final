<?php
// Obtener lista de cursos para el select
function obtenerCursos($con)
{
    $sql = "SELECT id, nombre FROM cursos";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Llamar la función gestionarCarrusel en MySQL
function gestionarCarrusel($con, $id, $id_curso, $img_1, $img_2, $img_3, $img_4)
{
    // Verificar si ya existe una entrada con el id_curso
    $sqlCheck = "SELECT COUNT(*) FROM mt_apoyo WHERE id_curso = :id_curso";
    $stmtCheck = $con->prepare($sqlCheck);
    $stmtCheck->bindParam(':id_curso', $id_curso);
    $stmtCheck->execute();
    $count = $stmtCheck->fetchColumn();

    // Si ya existe un registro con el id_curso, mostrar una alerta y redirigir
    if ($count > 0) {
        echo '<script>
            alert("Ya existe un carrusel para este curso. No se puede duplicar.");
            window.location.href = "controll.php?seccion=5&tab=8";
        </script>';
        exit; // Termina la ejecución para evitar la inserción duplicada
    }

    // Si no hay duplicado, insertar el nuevo registro
    $sql = "INSERT INTO mt_apoyo (id, id_curso, img_1, img_2, img_3, img_4) 
            VALUES (:id, :id_curso, :img_1, :img_2, :img_3, :img_4)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':id_curso', $id_curso);
    $stmt->bindParam(':img_1', $img_1);
    $stmt->bindParam(':img_2', $img_2);
    $stmt->bindParam(':img_3', $img_3);
    $stmt->bindParam(':img_4', $img_4);
    $stmt->execute();

    // Redirigir de nuevo a la página del carrusel después de insertar
    echo '<script>
        alert("Carrusel agregado exitosamente.");
        window.location.href = "controll.php?seccion=5&tab=8";
    </script>';
}


// Obtener los datos de los cursos
$cursos = obtenerCursos($con);

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $id_curso = intval($_POST['id_curso']);
    $img_1 = $_FILES['img_1']['name'] ?? null;
    $img_2 = $_FILES['img_2']['name'] ?? null;
    $img_3 = $_FILES['img_3']['name'] ?? null;
    $img_4 = $_FILES['img_4']['name'] ?? null;

    // Subir imágenes al servidor
    $target_dir = "../assets/uploads/";
    if ($img_1)
        move_uploaded_file($_FILES['img_1']['tmp_name'], $target_dir . basename($img_1));
    if ($img_2)
        move_uploaded_file($_FILES['img_2']['tmp_name'], $target_dir . basename($img_2));
    if ($img_3)
        move_uploaded_file($_FILES['img_3']['tmp_name'], $target_dir . basename($img_3));
    if ($img_4)
        move_uploaded_file($_FILES['img_4']['tmp_name'], $target_dir . basename($img_4));

    // Llamar a la función SQL para insertar o actualizar el carrusel
    gestionarCarrusel($con, $id, $id_curso, $img_1, $img_2, $img_3, $img_4);
}

?>