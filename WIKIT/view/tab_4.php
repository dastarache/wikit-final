<form action="../controller/controll.php?seccion=5&llave=<?php echo $_SESSION['id']; ?>" enctype="multipart/form-data" method="post">
    <div class="col-12">
        <label for="usuario" class="form-label">Usuario <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="<?php echo $usuarioLog; ?>" value="<?php echo $usuarioLog; ?>" required><br>
    </div>
    <div class="col-12">
        <label for="foto" class="form-label">Foto de perfil, Tamaño recomendado en pixeles* 661 x 377 <span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="imagen" id="foto" required><br>
    </div>
    <div class="col-12">
        <input name="actualizarD" type="submit" class="btn btn-primary" value="Acualizar">
    </div>
</form><br><br>
<img style="width: 300px;" src="../assets/img/<?php echo $fotoLog; ?>" alt="">