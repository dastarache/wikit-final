<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Carrusel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Gestión de Carrusel de Imágenes</h2>
    <form action="controll.php?seccion=5&tab=8" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        <div class="mb-3">
            <label for="id_curso" class="form-label">Curso</label>
            <select name="id_curso" id="id_curso" class="form-select" required>
                <option value="">Seleccione un curso</option>
                <?php foreach ($cursos as $curso): ?>
                    <option value="<?php echo $curso['id']; ?>"><?php echo $curso['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="img_1" class="form-label">Imagen 1</label>
            <input type="file" name="img_1" id="img_1" class="form-control">
        </div>
        <div class="mb-3">
            <label for="img_2" class="form-label">Imagen 2</label>
            <input type="file" name="img_2" id="img_2" class="form-control">
        </div>
        <div class="mb-3">
            <label for="img_3" class="form-label">Imagen 3</label>
            <input type="file" name="img_3" id="img_3" class="form-control">
        </div>
        <div class="mb-3">
            <label for="img_4" class="form-label">Imagen 4</label>
            <input type="file" name="img_4" id="img_4" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
