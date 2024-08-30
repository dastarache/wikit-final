<form action="../controller/controll.php?seccion=6" method="post" enctype="multipart/form-data">
  <div class="row">
    <p>INSERTAR CURSOS</p>
    <div class="col-md-6">
      <label for="nombre" class="form-label">Nombre</label>
      <input name="curso" type="text" class="form-control" id="nombre" required>
    </div>
    <div class="col-md-6">
      <label for="precio" class="form-label">Precio</label>
      <input name="precio" type="text" class="form-control" id="precio" required>
    </div>
    <div class="col-md-6">
    <label for="nombre" class="form-label">Selecciona Categoria</label>
      <select name="llave_cate" class="form-select" aria-label="Default select example" required>
        <option selected>Categoria</option>
      <?php while ($filas = $resultado->fetch()) { ?>
        <option value="<?php echo $filas['id']; ?>"><?php echo $filas['nb_categoria']; ?></option>
      <?php } ?>
      </select>
    </div>
    <div class="col-md-12">
      <label for="precio" class="form-label">Contenido</label>
      <textarea class="form-control" name="contenido" id="" required></textarea>
    </div>
    <div class="col-md-12">
      <label for="precio" class="form-label">Soportes</label>
      <input class="form-control" type="file" name="file" id="file" accept=".pdf" required>
    </div>
    <div class="col-md-6">
      <br><input value="GUARDAR" name="guardar" type="submit" class="btn btn-primary">
    </div>
  </div>
</form><br>
<hr/>
<form action="../controller/controll.php?seccion=6" method="post">
  <div class="row">
  <p>INSERTAR CATEGORIAS</p>
    <div class="col-md-6">
      <label for="nombre" class="form-label">Nombre</label>
      <input name="nombre" type="text" class="form-control" id="nombre" required>
    </div>
    <div class="col-md-6">
    <br><input name="enviar" type="submit" class="btn btn-primary" value="GUARDA">
    </div>
  </div>
</form>