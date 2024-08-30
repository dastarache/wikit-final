<?php 

    $_SESSION['llave'] = $_REQUEST['llave']; 

    $llave = $_SESSION['llave'];

?>

<form action="../controller/controll.php?seccion=4&llave=<?php echo $llave ?>" method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Nueva contraseña</label>
        <input name="newcontra" type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Ingresa la nueva contraseña</div>
    </div>
    
    <input name="actualizar" value="Actualizar" type="submit" class="btn btn-primary">

</form>